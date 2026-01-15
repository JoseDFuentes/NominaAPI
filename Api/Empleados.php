<?php
// =============================================
// API CRUD para tabla Empleados
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

// GET - Obtener todos los empleados o uno específico (IdEmpresa requerido)
function getEmpleados($id = null, $idEmpresa = null) {
    if (!$idEmpresa) {
        return ['success' => false, 'error' => 'El parámetro idEmpresa es requerido'];
    }

    $conn = getConnection();
    try {
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM Empleados WHERE IdEmpleado = ? AND IdEmpresa = ?");
            $stmt->bind_param("ss", $id, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $stmt = $conn->prepare("SELECT * FROM Empleados WHERE IdEmpresa = ? ORDER BY IdEmpleado ASC");
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

// POST - Crear nuevo empleado
function createEmpleado($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO Empleados (IdEmpleado, Nombres, Apellidos, Genero, EstadoCivil, Nacionalidad, TipoIdentificacion, NoIdentificacion, NIT, Direccion, Telefono1, Telefono2, CorreoElectronico, Contacto, Observaciones, AfiliacionIGSS, Banco, NoCuentaBanco, TipoCuentaBanco, IdEmpresa, Activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $activo = isset($data['Activo']) ? $data['Activo'] : 1;

        $stmt->bind_param("ssssssssssssssssssssi",
            $data['IdEmpleado'],
            $data['Nombres'],
            $data['Apellidos'],
            $data['Genero'],
            $data['EstadoCivil'],
            $data['Nacionalidad'],
            $data['TipoIdentificacion'],
            $data['NoIdentificacion'],
            $data['NIT'],
            $data['Direccion'],
            $data['Telefono1'],
            $data['Telefono2'],
            $data['CorreoElectronico'],
            $data['Contacto'],
            $data['Observaciones'],
            $data['AfiliacionIGSS'],
            $data['Banco'],
            $data['NoCuentaBanco'],
            $data['TipoCuentaBanco'],
            $data['IdEmpresa'],
            $activo
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Empleado creado exitosamente', 'id' => $data['IdEmpleado']];
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

// PUT - Actualizar empleado
function updateEmpleado($id, $data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("UPDATE Empleados SET Nombres=?, Apellidos=?, Genero=?, EstadoCivil=?, Nacionalidad=?, TipoIdentificacion=?, NoIdentificacion=?, NIT=?, Direccion=?, Telefono1=?, Telefono2=?, CorreoElectronico=?, Contacto=?, Observaciones=?, AfiliacionIGSS=?, Banco=?, NoCuentaBanco=?, TipoCuentaBanco=?, IdEmpresa=?, Activo=? WHERE IdEmpleado=?");

        $stmt->bind_param("sssssssssssssssssssisi",
            $data['Nombres'],
            $data['Apellidos'],
            $data['Genero'],
            $data['EstadoCivil'],
            $data['Nacionalidad'],
            $data['TipoIdentificacion'],
            $data['NoIdentificacion'],
            $data['NIT'],
            $data['Direccion'],
            $data['Telefono1'],
            $data['Telefono2'],
            $data['CorreoElectronico'],
            $data['Contacto'],
            $data['Observaciones'],
            $data['AfiliacionIGSS'],
            $data['Banco'],
            $data['NoCuentaBanco'],
            $data['TipoCuentaBanco'],
            $data['IdEmpresa'],
            $data['Activo'],
            $id
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Empleado actualizado exitosamente'];
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

// DELETE - Eliminar empleado
function deleteEmpleado($id) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM Empleados WHERE IdEmpleado = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Empleado eliminado exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Empleado no encontrado'];
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
        $response = getEmpleados($id, $idEmpresa);
        break;
    case 'POST':
        $response = createEmpleado($input);
        break;
    case 'PUT':
        $response = updateEmpleado($id, $input);
        break;
    case 'DELETE':
        $response = deleteEmpleado($id);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
