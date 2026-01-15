<?php
// =============================================
// API CRUD para tabla Contratos
// =============================================
require_once 'config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
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

// GET - Obtener todos los contratos o uno específico (IdEmpresa requerido)
function getContratos($id = null, $idEmpresa = null, $idEmpleado = null) {
    if (!$idEmpresa) {
        return ['success' => false, 'error' => 'El parámetro idEmpresa es requerido'];
    }

    $conn = getConnection();
    try {
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM Contratos WHERE IdContrato = ? AND IdEmpresa = ?");
            $stmt->bind_param("ss", $id, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } elseif ($idEmpleado) {
            $stmt = $conn->prepare("SELECT * FROM Contratos WHERE IdEmpleado = ? AND IdEmpresa = ? ORDER BY FechaInicio DESC");
            $stmt->bind_param("ss", $idEmpleado, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } else {
            $stmt = $conn->prepare("SELECT * FROM Contratos WHERE IdEmpresa = ? ORDER BY IdContrato ASC");
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

// POST - Crear nuevo contrato
function createContrato($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO Contratos (IdContrato, IdEmpleado, IdPuesto, FechaInicio, FechaFinal, TipoContrato, SalarioBase, DiasMes, DiasQuincena, DiasSemana, HorasDiarias, Observaciones, Activo, IdEmpresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $activo = isset($data['Activo']) ? $data['Activo'] : 1;

        $stmt->bind_param("sssssidiiiisis",
            $data['IdContrato'],
            $data['IdEmpleado'],
            $data['IdPuesto'],
            $data['FechaInicio'],
            $data['FechaFinal'],
            $data['TipoContrato'],
            $data['SalarioBase'],
            $data['DiasMes'],
            $data['DiasQuincena'],
            $data['DiasSemana'],
            $data['HorasDiarias'],
            $data['Observaciones'],
            $activo,
            $data['IdEmpresa']
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Contrato creado exitosamente', 'id' => $data['IdContrato']];
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

// PUT - Actualizar contrato
function updateContrato($id, $data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("UPDATE Contratos SET IdEmpleado=?, IdPuesto=?, FechaInicio=?, FechaFinal=?, TipoContrato=?, SalarioBase=?, DiasMes=?, DiasQuincena=?, DiasSemana=?, HorasDiarias=?, Observaciones=?, Activo=?, IdEmpresa=? WHERE IdContrato=?");

        $stmt->bind_param("ssssiidiiisisss",
            $data['IdEmpleado'],
            $data['IdPuesto'],
            $data['FechaInicio'],
            $data['FechaFinal'],
            $data['TipoContrato'],
            $data['SalarioBase'],
            $data['DiasMes'],
            $data['DiasQuincena'],
            $data['DiasSemana'],
            $data['HorasDiarias'],
            $data['Observaciones'],
            $data['Activo'],
            $data['IdEmpresa'],
            $id
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Contrato actualizado exitosamente'];
        } else {
            throw new Exception("Error al actualizar: " . $stmt->error);
        }
        $stmt->close();
        $conn->close();
        return $response;
    } catch (Exception $e) {
        $conn->close();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// DELETE - Eliminar contrato
function deleteContrato($id) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM Contratos WHERE IdContrato = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Contrato eliminado exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Contrato no encontrado'];
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
$id = isset($_GET['id']) ? $_GET['id'] : null;
$idEmpresa = isset($_GET['idEmpresa']) ? $_GET['idEmpresa'] : null;
$idEmpleado = isset($_GET['idEmpleado']) ? $_GET['idEmpleado'] : null;
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        $response = getContratos($id, $idEmpresa, $idEmpleado);
        break;
    case 'POST':
        $response = createContrato($input);
        break;
    case 'PUT':
        $response = updateContrato($id, $input);
        break;
    case 'DELETE':
        $response = deleteContrato($id);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
