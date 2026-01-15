<?php
// =============================================
// API CRUD para tabla Empresa
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

// GET - Obtener todas las empresas o una específica
function getEmpresas($id = null) {
    $conn = getConnection();
    try {
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM Empresa WHERE IdEmpresa = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $sql = "SELECT * FROM Empresa ORDER BY IdEmpresa ASC";
            $result = $conn->query($sql);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $conn->close();
        return ['success' => true, 'data' => $data];
    } catch (Exception $e) {
        $conn->close();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// POST - Crear nueva empresa
function createEmpresa($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO Empresa (IdEmpresa, Nombre, RazonSocial, NIT, IGSSPatronal, Direccion, Telefono) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss",
            $data['IdEmpresa'],
            $data['Nombre'],
            $data['RazonSocial'],
            $data['NIT'],
            $data['IGSSPatronal'],
            $data['Direccion'],
            $data['Telefono']
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Empresa creada exitosamente', 'id' => $data['IdEmpresa']];
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

// PUT - Actualizar empresa
function updateEmpresa($id, $data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("UPDATE Empresa SET Nombre=?, RazonSocial=?, NIT=?, IGSSPatronal=?, Direccion=?, Telefono=? WHERE IdEmpresa=?");
        $stmt->bind_param("sssssss",
            $data['Nombre'],
            $data['RazonSocial'],
            $data['NIT'],
            $data['IGSSPatronal'],
            $data['Direccion'],
            $data['Telefono'],
            $id
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Empresa actualizada exitosamente'];
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

// DELETE - Eliminar empresa
function deleteEmpresa($id) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM Empresa WHERE IdEmpresa = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Empresa eliminada exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Empresa no encontrada'];
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
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        $response = getEmpresas($id);
        break;
    case 'POST':
        $response = createEmpresa($input);
        break;
    case 'PUT':
        $response = updateEmpresa($id, $input);
        break;
    case 'DELETE':
        $response = deleteEmpresa($id);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
