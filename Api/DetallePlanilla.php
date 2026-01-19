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

// CALCULAR - Generar cálculo de planilla para todos los empleados con contrato activo
function calcularPlanilla($idPlanilla, $idEmpresa) {
    if (!$idPlanilla || !$idEmpresa) {
        return ['success' => false, 'error' => 'Los parámetros idPlanilla e idEmpresa son requeridos'];
    }

    $conn = getConnection();
    try {
        // Verificar que la planilla existe y obtener sus datos
        $stmtPlanilla = $conn->prepare("SELECT * FROM Planilla WHERE IdPlanilla = ? AND IdEmpresa = ?");
        $stmtPlanilla->bind_param("ss", $idPlanilla, $idEmpresa);
        $stmtPlanilla->execute();
        $resultPlanilla = $stmtPlanilla->get_result();
        $planilla = $resultPlanilla->fetch_assoc();
        $stmtPlanilla->close();

        if (!$planilla) {
            $conn->close();
            return ['success' => false, 'error' => 'Planilla no encontrada'];
        }

        // Obtener todos los contratos activos de la empresa
        $stmtContratos = $conn->prepare("
            SELECT c.*, e.IdEmpleado, e.Nombres, e.Apellidos
            FROM Contratos c
            INNER JOIN Empleados e ON c.IdEmpleado = e.IdEmpleado
            WHERE c.IdEmpresa = ? AND c.Activo = TRUE AND e.Activo = TRUE
        ");
        $stmtContratos->bind_param("s", $idEmpresa);
        $stmtContratos->execute();
        $resultContratos = $stmtContratos->get_result();

        $empleadosProcesados = 0;
        $errores = [];

        while ($contrato = $resultContratos->fetch_assoc()) {
            // Calcular valores de nómina
            $salarioBase = floatval($contrato['SalarioBase']);
            $diasMes = intval($contrato['DiasMes']) ?: 30;
            $horasDiarias = intval($contrato['HorasDiarias']) ?: 8;

            // Salario diario y por hora
            $salarioDiario = $salarioBase / $diasMes;
            $salarioHora = $salarioDiario / $horasDiarias;

            // Días trabajados (por defecto los días del mes del contrato)
            $diasTrabajados = $diasMes;
            $horasOrdinarias = $diasTrabajados * $horasDiarias;
            $horasExtraordinarias = 0;

            // Cálculo de salario ordinario
            $ordinario = $salarioDiario * $diasTrabajados;
            $extraordinario = 0;
            $otrosSalarios = 0;
            $septimosAsuetos = 0;
            $vacaciones = 0;

            // Total salario bruto
            $totalSalario = $ordinario + $extraordinario + $otrosSalarios + $septimosAsuetos + $vacaciones;

            // Deducciones (IGSS laboral 4.83%)
            $deduccionIGSS = $totalSalario * 0.0483;
            $deduccionISR = 0; // Se calcula según tabla de ISR
            $otrasDeducciones = 0;
            $totalDeducciones = $deduccionIGSS + $deduccionISR + $otrasDeducciones;

            // Bonificaciones
            $bonificacionIncentivo = 250; // Bonificación incentivo decreto 37-2001
            $bonificacionAnual = 0;
            $aguinaldoDecreto = 0;
            $devolucionesISR = 0;

            // Salario líquido
            $salarioLiquido = $totalSalario - $totalDeducciones + $bonificacionIncentivo;

            // Verificar si ya existe el detalle para este empleado en esta planilla
            $stmtVerificar = $conn->prepare("SELECT 1 FROM DetallePlanilla WHERE IdPlanilla = ? AND IdEmpleado = ?");
            $stmtVerificar->bind_param("ss", $idPlanilla, $contrato['IdEmpleado']);
            $stmtVerificar->execute();
            $existe = $stmtVerificar->get_result()->fetch_assoc();
            $stmtVerificar->close();

            if ($existe) {
                // Actualizar registro existente
                $stmtUpdate = $conn->prepare("
                    UPDATE DetallePlanilla SET
                        IdContrato=?, SalarioBase=?, DiasTrabajados=?, HorasOrdinarias=?,
                        HorasExtraordinarias=?, Ordinario=?, Extraordinario=?, OtrosSalarios=?,
                        SeptimosAsuetos=?, Vacaciones=?, TotalSalario=?, DeduccionCuotaLaboralIGSS=?,
                        DeduccionDescuentosISR=?, OtrasDeducciones=?, TotalDeducciones=?,
                        BonificacionAnual=?, AguinaldoDecreto=?, BonificacionIncentivo=?,
                        DevolucionesISR=?, SalarioLiquido=?, IdEmpresa=?
                    WHERE IdPlanilla=? AND IdEmpleado=?
                ");
                $stmtUpdate->bind_param("sdddddddddddddddddddssss",
                    $contrato['IdContrato'], $salarioBase, $diasTrabajados, $horasOrdinarias,
                    $horasExtraordinarias, $ordinario, $extraordinario, $otrosSalarios,
                    $septimosAsuetos, $vacaciones, $totalSalario, $deduccionIGSS,
                    $deduccionISR, $otrasDeducciones, $totalDeducciones,
                    $bonificacionAnual, $aguinaldoDecreto, $bonificacionIncentivo,
                    $devolucionesISR, $salarioLiquido, $idEmpresa,
                    $idPlanilla, $contrato['IdEmpleado']
                );
                $stmtUpdate->execute();
                $stmtUpdate->close();
            } else {
                // Insertar nuevo registro
                $stmtInsert = $conn->prepare("
                    INSERT INTO DetallePlanilla (
                        IdPlanilla, IdEmpleado, IdContrato, SalarioBase, DiasTrabajados,
                        HorasOrdinarias, HorasExtraordinarias, Ordinario, Extraordinario,
                        OtrosSalarios, SeptimosAsuetos, Vacaciones, TotalSalario,
                        DeduccionCuotaLaboralIGSS, DeduccionDescuentosISR, OtrasDeducciones,
                        TotalDeducciones, BonificacionAnual, AguinaldoDecreto,
                        BonificacionIncentivo, DevolucionesISR, SalarioLiquido, IdEmpresa
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmtInsert->bind_param("sssddddddddddddddddddds",
                    $idPlanilla, $contrato['IdEmpleado'], $contrato['IdContrato'], $salarioBase, $diasTrabajados, 
                    $horasOrdinarias, $horasExtraordinarias,$ordinario, $extraordinario, 
                    $otrosSalarios, $septimosAsuetos, $vacaciones, $totalSalario, 
                    $deduccionIGSS, $deduccionISR, $otrasDeducciones, 
                    $totalDeducciones, $bonificacionAnual, $aguinaldoDecreto, 
                    $bonificacionIncentivo, $devolucionesISR, $salarioLiquido, $idEmpresa
                );
                $stmtInsert->execute();
                $stmtInsert->close();
            }

            $empleadosProcesados++;
        }
        $stmtContratos->close();

        // Actualizar totales en la tabla Planilla
        $stmtTotales = $conn->prepare("
            UPDATE Planilla SET
                TotalEmpleados = (SELECT COUNT(*) FROM DetallePlanilla WHERE IdPlanilla = ?),
                TotalSalarios = (SELECT COALESCE(SUM(TotalSalario), 0) FROM DetallePlanilla WHERE IdPlanilla = ?),
                TotalDeducciones = (SELECT COALESCE(SUM(TotalDeducciones), 0) FROM DetallePlanilla WHERE IdPlanilla = ?),
                TotalBonificaciones = (SELECT COALESCE(SUM(BonificacionIncentivo + BonificacionAnual + AguinaldoDecreto), 0) FROM DetallePlanilla WHERE IdPlanilla = ?),
                TotalNetoPagar = (SELECT COALESCE(SUM(SalarioLiquido), 0) FROM DetallePlanilla WHERE IdPlanilla = ?)
            WHERE IdPlanilla = ? AND IdEmpresa = ?
        ");
        $stmtTotales->bind_param("sssssss", $idPlanilla, $idPlanilla, $idPlanilla, $idPlanilla, $idPlanilla, $idPlanilla, $idEmpresa);
        $stmtTotales->execute();
        $stmtTotales->close();

        $conn->close();
        return [
            'success' => true,
            'message' => 'Planilla calculada exitosamente',
            'empleadosProcesados' => $empleadosProcesados
        ];
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
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

switch ($method) {
    case 'GET':
        if ($accion === 'calcular') {
            $response = calcularPlanilla($idPlanilla, $idEmpresa);
        } else {
            $response = getDetallePlanilla($idPlanilla, $idEmpleado, $idEmpresa);
        }
        break;
    case 'POST':
        if ($accion === 'calcular') {
            $response = calcularPlanilla($idPlanilla, $idEmpresa);
        } else {
            $response = createDetallePlanilla($input);
        }
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
