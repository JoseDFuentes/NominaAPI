<?php
// =============================================
// API CRUD para tabla ContratosDeducciones
// =============================================
require_once 'config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

function getConnection() {
    try {
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            throw new Exception("Error de conexión: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}

// GET - Obtener relaciones contratos-deducciones (IdEmpresa requerido)
function getContratosDeducciones($idContrato = null, $idDeducciones = null, $idEmpresa = null) {
    if (!$idEmpresa) {
        return ['success' => false, 'error' => 'El parámetro idEmpresa es requerido'];
    }

    $conn = getConnection();
    try {
        if ($idContrato && $idDeducciones) {
            $stmt = $conn->prepare("SELECT * FROM ContratosDeducciones WHERE IdContrato = ? AND IdDeducciones = ? AND IdEmpresa = ?");
            $stmt->bind_param("sss", $idContrato, $idDeducciones, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } elseif ($idContrato) {
            $stmt = $conn->prepare("SELECT cd.*, d.PorcentajeDeduccion, d.DeduccionFijo FROM ContratosDeducciones cd INNER JOIN Deducciones d ON cd.IdDeducciones = d.IdDeducciones WHERE cd.IdContrato = ? AND cd.IdEmpresa = ?");
            $stmt->bind_param("ss", $idContrato, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } else {
            $stmt = $conn->prepare("SELECT * FROM ContratosDeducciones WHERE IdEmpresa = ?");
            $stmt->bind_param("s", $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        }
        $conn->close();
        return ['success' => true, 'data' => $data];
    } catch (Exception $e) {
        $conn->close();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// POST - Crear nueva relación contrato-deducción
function createContratoDeduccion($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO ContratosDeducciones (IdContrato, IdDeducciones, IdEmpresa) VALUES (?, ?, ?)");

        $stmt->bind_param("sss",
            $data['IdContrato'],
            $data['IdDeducciones'],
            $data['IdEmpresa']
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Relación contrato-deducción creada exitosamente'];
        } else {
            throw new Exception("Error al crear: " . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        return $response;
    } catch (Exception $e) {
        $conn->close();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// DELETE - Eliminar relación contrato-deducción
function deleteContratoDeduccion($idContrato, $idDeducciones) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM ContratosDeducciones WHERE IdContrato = ? AND IdDeducciones = ?");
        $stmt->bind_param("ss", $idContrato, $idDeducciones);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Relación eliminada exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Relación no encontrada'];
            }
        } else {
            throw new Exception("Error al eliminar: " . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        return $response;
    } catch (Exception $e) {
        $conn->close();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Procesar petición
$method = $_SERVER['REQUEST_METHOD'];
$idContrato = isset($_GET['idContrato']) ? $_GET['idContrato'] : null;
$idDeducciones = isset($_GET['idDeducciones']) ? $_GET['idDeducciones'] : null;
$idEmpresa = isset($_GET['idEmpresa']) ? $_GET['idEmpresa'] : null;
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        $response = getContratosDeducciones($idContrato, $idDeducciones, $idEmpresa);
        break;
    case 'POST':
        $response = createContratoDeduccion($input);
        break;
    case 'DELETE':
        $response = deleteContratoDeduccion($idContrato, $idDeducciones);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
