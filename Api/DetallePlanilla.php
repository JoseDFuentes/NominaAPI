<?php
// =============================================
// API CRUD para tabla DetallePlanilla
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

// GET - Obtener detalles de planilla (IdEmpresa requerido)
function getDetallePlanilla($idPlanilla = null, $idEmpleado = null, $idEmpresa = null) {
    if (!$idEmpresa) {
        return ['success' => false, 'error' => 'El parámetro idEmpresa es requerido'];
    }

    $conn = getConnection();
    try {
        if ($idPlanilla && $idEmpleado) {
            $stmt = $conn->prepare("SELECT * FROM DetallePlanilla WHERE IdPlanilla = ? AND IdEmpleado = ? AND IdEmpresa = ?");
            $stmt->bind_param("sss", $idPlanilla, $idEmpleado, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } elseif ($idPlanilla) {
            $stmt = $conn->prepare("SELECT dp.*, e.Nombres, e.Apellidos FROM DetallePlanilla dp INNER JOIN Empleados e ON dp.IdEmpleado = e.IdEmpleado WHERE dp.IdPlanilla = ? AND dp.IdEmpresa = ? ORDER BY e.Apellidos, e.Nombres");
            $stmt->bind_param("ss", $idPlanilla, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } elseif ($idEmpleado) {
            $stmt = $conn->prepare("SELECT dp.*, p.TipoPlanilla, p.InicioPeriodo, p.FinPeriodo FROM DetallePlanilla dp INNER JOIN Planilla p ON dp.IdPlanilla = p.IdPlanilla WHERE dp.IdEmpleado = ? AND dp.IdEmpresa = ? ORDER BY p.InicioPeriodo DESC");
            $stmt->bind_param("ss", $idEmpleado, $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } else {
            $stmt = $conn->prepare("SELECT * FROM DetallePlanilla WHERE IdEmpresa = ?");
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

// POST - Crear nuevo detalle de planilla
function createDetallePlanilla($data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("INSERT INTO DetallePlanilla (IdPlanilla, IdEmpleado, IdContrato, SalarioBase, DiasTrabajados, HorasOrdinarias, HorasExtraordinarias, Ordinario, Extraordinario, OtrosSalarios, SeptimosAsuetos, Vacaciones, TotalSalario, DeduccionCuotaLaboralIGSS, DeduccionDescuentosISR, OtrasDeducciones, TotalDeducciones, BonificacionAnual, AguinaldoDecreto, BonificacionIncentivo, DevolucionesISR, SalarioLiquido, Observaciones, IdEmpresa, TipoPago, ComprobantePago) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssdddddddddddddddddddssss",
            $data['IdPlanilla'],
            $data['IdEmpleado'],
            $data['IdContrato'],
            $data['SalarioBase'],
            $data['DiasTrabajados'],
            $data['HorasOrdinarias'],
            $data['HorasExtraordinarias'],
            $data['Ordinario'],
            $data['Extraordinario'],
            $data['OtrosSalarios'],
            $data['SeptimosAsuetos'],
            $data['Vacaciones'],
            $data['TotalSalario'],
            $data['DeduccionCuotaLaboralIGSS'],
            $data['DeduccionDescuentosISR'],
            $data['OtrasDeducciones'],
            $data['TotalDeducciones'],
            $data['BonificacionAnual'],
            $data['AguinaldoDecreto'],
            $data['BonificacionIncentivo'],
            $data['DevolucionesISR'],
            $data['SalarioLiquido'],
            $data['Observaciones'],
            $data['IdEmpresa'],
            $data['TipoPago'],
            $data['ComprobantePago']
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Detalle de planilla creado exitosamente'];
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

// PUT - Actualizar detalle de planilla
function updateDetallePlanilla($idPlanilla, $idEmpleado, $data) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("UPDATE DetallePlanilla SET IdContrato=?, SalarioBase=?, DiasTrabajados=?, HorasOrdinarias=?, HorasExtraordinarias=?, Ordinario=?, Extraordinario=?, OtrosSalarios=?, SeptimosAsuetos=?, Vacaciones=?, TotalSalario=?, DeduccionCuotaLaboralIGSS=?, DeduccionDescuentosISR=?, OtrasDeducciones=?, TotalDeducciones=?, BonificacionAnual=?, AguinaldoDecreto=?, BonificacionIncentivo=?, DevolucionesISR=?, SalarioLiquido=?, Observaciones=?, IdEmpresa=?, TipoPago=?, ComprobantePago=? WHERE IdPlanilla=? AND IdEmpleado=?");

        $stmt->bind_param("sdddddddddddddddddddsssssss",
            $data['IdContrato'],
            $data['SalarioBase'],
            $data['DiasTrabajados'],
            $data['HorasOrdinarias'],
            $data['HorasExtraordinarias'],
            $data['Ordinario'],
            $data['Extraordinario'],
            $data['OtrosSalarios'],
            $data['SeptimosAsuetos'],
            $data['Vacaciones'],
            $data['TotalSalario'],
            $data['DeduccionCuotaLaboralIGSS'],
            $data['DeduccionDescuentosISR'],
            $data['OtrasDeducciones'],
            $data['TotalDeducciones'],
            $data['BonificacionAnual'],
            $data['AguinaldoDecreto'],
            $data['BonificacionIncentivo'],
            $data['DevolucionesISR'],
            $data['SalarioLiquido'],
            $data['Observaciones'],
            $data['IdEmpresa'],
            $data['TipoPago'],
            $data['ComprobantePago'],
            $idPlanilla,
            $idEmpleado
        );

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Detalle de planilla actualizado exitosamente'];
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

// DELETE - Eliminar detalle de planilla
function deleteDetallePlanilla($idPlanilla, $idEmpleado) {
    $conn = getConnection();
    try {
        $stmt = $conn->prepare("DELETE FROM DetallePlanilla WHERE IdPlanilla = ? AND IdEmpleado = ?");
        $stmt->bind_param("ss", $idPlanilla, $idEmpleado);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response = ['success' => true, 'message' => 'Detalle eliminado exitosamente'];
            } else {
                $response = ['success' => false, 'error' => 'Detalle no encontrado'];
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
$idPlanilla = isset($_GET['idPlanilla']) ? $_GET['idPlanilla'] : null;
$idEmpleado = isset($_GET['idEmpleado']) ? $_GET['idEmpleado'] : null;
$idEmpresa = isset($_GET['idEmpresa']) ? $_GET['idEmpresa'] : null;
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        $response = getDetallePlanilla($idPlanilla, $idEmpleado, $idEmpresa);
        break;
    case 'POST':
        $response = createDetallePlanilla($input);
        break;
    case 'PUT':
        $response = updateDetallePlanilla($idPlanilla, $idEmpleado, $input);
        break;
    case 'DELETE':
        $response = deleteDetallePlanilla($idPlanilla, $idEmpleado);
        break;
    default:
        $response = ['success' => false, 'error' => 'Método no permitido'];
        http_response_code(405);
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
