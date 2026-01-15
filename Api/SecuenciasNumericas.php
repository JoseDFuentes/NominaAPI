<?php
// =============================================
// API CRUD para tabla SecuenciasNumericas
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

// GET - Obtener todas las secuencias o una específica
function getSecuencias($id = null, $idTabla = null, $idEmpresa = null) {
    $conn = getConnection();
    try {
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM SecuenciasNumericas WHERE IdSecuencia = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } elseif ($idTabla) {
            $stmt = $conn->prepare("SELECT * FROM SecuenciasNumericas WHERE IdTabla = ?");
            $stmt->bind_param("s", $idTabla);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $sql = "SELECT * FROM SecuenciasNumericas ORDER BY IdSecuencia ASC";
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

// GET - Obtener siguiente número de secuencia
function getSiguienteNumero($idTabla, $idEmpresa = null) {
    $conn = getConnection();
    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("SELECT * FROM SecuenciasNumericas WHERE IdTabla = ? FOR UPDATE");
        $stmt->bind_param("s", $idTabla);
        $stmt->execute();
        $result = $stmt->get_result();
        $secuencia = $result->fetch_assoc();
        $stmt->close();

        if (!$secuencia) {
            throw new Exception("Secuencia no encontrada para la tabla: " . $idTabla);
        }

        $siguiente = $secuencia['Siguiente'];
        $nuevoSiguiente = $siguiente + 1;

        // Formatear número
        $numeroFormateado = str_pad($siguiente, $secuencia['Digitos'], '0', STR_PAD_LEFT);
        $codigoCompleto = $secuencia['Prefijo'] . $secuencia['Separador'] . $numeroFormateado;

        // Actualizar siguiente
        $stmtUpdate = $conn->prepare("UPDATE SecuenciasNumericas SET Siguiente = ? WHERE IdSecuencia = ?");
        $stmtUpdate->bind_param("is", $nuevoSiguiente, $secuencia['IdSecuencia']);
        $stmtUpdate->execute();
        $stmtUpdate->close();

        $conn->commit();
        $conn->close();

        return [
            'success' => true,
            'data' => [
                'numero' => $siguiente,
                'codigo' => $codigoCompleto,
                'siguiente' => $nuevoSiguiente
            ]
        ];
    } catch (Exception $e) {
        $conn->rollback();
        $conn->close();
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// POST - Crear nueva secuencia
function createSecuencia($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssissii",
            $data['IdSecuencia'],
            $data['IdTabla'],
            $data['Digitos'],
            $data['Separador'],
            $data['Prefijo'],
            $data['Inicial'],
            $data['Siguiente']
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Secuencia creada exitosamente', 'id' => $data['IdSecuencia']];
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

// PUT - Actualizar secuencia
function updateSecuencia($id, $data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("UPDATE SecuenciasNumericas SET IdTabla=?, Digitos=?, Separador=?, Prefijo=?, Inicial=?, Siguiente=? WHERE IdSecuencia=?");

        $stmt->bind_param("sissiis",
            $data['IdTabla'],
            $data['Digitos'],
            $data['Separador'],
            $data['Prefijo'],
            $data['Inicial'],
            $data['Siguiente'],
            $id
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Secuencia actualizada exitosamente'];
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

// DELETE - Eliminar secuencia
function deleteSecuencia($id) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM SecuenciasNumericas WHERE IdSecuencia = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Secuencia eliminada exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Secuencia no encontrada'];
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
$idTabla = isset($_GET['idTabla']) ? $_GET['idTabla'] : null;
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if ($accion === 'siguiente' && $idTabla) {
            $response = getSiguienteNumero($idTabla);
        } else {
            $response = getSecuencias($id, $idTabla);
        }
        break;
    case 'POST':
        $response = createSecuencia($input);
        break;
    case 'PUT':
        $response = updateSecuencia($id, $input);
        break;
    case 'DELETE':
        $response = deleteSecuencia($id);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
