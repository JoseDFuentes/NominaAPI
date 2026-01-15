<?php
// =============================================
// API CRUD para tabla Planilla
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

// GET - Obtener todas las planillas o una específica (IdEmpresa requerido)
function getPlanillas($id = null, $idEmpresa = null) {
    if (!$idEmpresa) {
        return ['success' => false, 'error' => 'El parámetro idEmpresa es requerido'];
    }

    $conn = getConnection();
    try {
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM Planilla WHERE IdPlanilla = ? AND IdEmpresa = ?");
            $stmt->bind_param("ss", $id, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $stmt = $conn->prepare("SELECT * FROM Planilla WHERE IdEmpresa = ? ORDER BY InicioPeriodo DESC");
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

// POST - Crear nueva planilla
function createPlanilla($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO Planilla (IdPlanilla, TipoPlanilla, InicioPeriodo, FinPeriodo, FechaPago, TotalEmpleados, TotalSalarios, TotalDeducciones, TotalBonificaciones, TotalNetoPagar, Registrada, FechaRegistro, UsuarioRegistro, Observaciones, IdEmpresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $registrada = isset($data['Registrada']) ? $data['Registrada'] : 0;

        $stmt->bind_param("sssssiddddiisss",
            $data['IdPlanilla'],
            $data['TipoPlanilla'],
            $data['InicioPeriodo'],
            $data['FinPeriodo'],
            $data['FechaPago'],
            $data['TotalEmpleados'],
            $data['TotalSalarios'],
            $data['TotalDeducciones'],
            $data['TotalBonificaciones'],
            $data['TotalNetoPagar'],
            $registrada,
            $data['FechaRegistro'],
            $data['UsuarioRegistro'],
            $data['Observaciones'],
            $data['IdEmpresa']
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Planilla creada exitosamente', 'id' => $data['IdPlanilla']];
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

// PUT - Actualizar planilla
function updatePlanilla($id, $data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("UPDATE Planilla SET TipoPlanilla=?, InicioPeriodo=?, FinPeriodo=?, FechaPago=?, TotalEmpleados=?, TotalSalarios=?, TotalDeducciones=?, TotalBonificaciones=?, TotalNetoPagar=?, Registrada=?, FechaRegistro=?, UsuarioRegistro=?, Observaciones=?, IdEmpresa=? WHERE IdPlanilla=?");

        $stmt->bind_param("ssssiddddiissss",
            $data['TipoPlanilla'],
            $data['InicioPeriodo'],
            $data['FinPeriodo'],
            $data['FechaPago'],
            $data['TotalEmpleados'],
            $data['TotalSalarios'],
            $data['TotalDeducciones'],
            $data['TotalBonificaciones'],
            $data['TotalNetoPagar'],
            $data['Registrada'],
            $data['FechaRegistro'],
            $data['UsuarioRegistro'],
            $data['Observaciones'],
            $data['IdEmpresa'],
            $id
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Planilla actualizada exitosamente'];
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

// DELETE - Eliminar planilla
function deletePlanilla($id) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM Planilla WHERE IdPlanilla = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Planilla eliminada exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Planilla no encontrada'];
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
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        $response = getPlanillas($id, $idEmpresa);
        break;
    case 'POST':
        $response = createPlanilla($input);
        break;
    case 'PUT':
        $response = updatePlanilla($id, $input);
        break;
    case 'DELETE':
        $response = deletePlanilla($id);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
