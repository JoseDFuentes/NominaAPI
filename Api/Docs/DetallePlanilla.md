# API DetallePlanilla

## Descripcion
API para gestionar el detalle de las planillas por empleado.

## URL Base
```
/Api/DetallePlanilla.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los detalles por empresa
```
GET /Api/DetallePlanilla.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/DetallePlanilla.php?idEmpresa=EMP-00001
```

### GET - Obtener detalles por planilla
```
GET /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/DetallePlanilla.php?idPlanilla=PLA-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdPlanilla": "PLA-00001",
            "IdEmpleado": "EMP-00001",
            "IdContrato": "CON-00001",
            "Nombres": "Juan Carlos",
            "Apellidos": "Perez Lopez",
            "SalarioBase": "5000.00",
            "DiasTrabajados": "15.00",
            "HorasOrdinarias": "120.00",
            "HorasExtraordinarias": "10.00",
            "Ordinario": "2500.00",
            "Extraordinario": "312.50",
            "OtrosSalarios": "0.00",
            "SeptimosAsuetos": "0.00",
            "Vacaciones": "0.00",
            "TotalSalario": "2812.50",
            "DeduccionCuotaLaboralIGSS": "135.96",
            "DeduccionDescuentosISR": "0.00",
            "OtrasDeducciones": "0.00",
            "TotalDeducciones": "135.96",
            "BonificacionAnual": "0.00",
            "AguinaldoDecreto": "0.00",
            "BonificacionIncentivo": "125.00",
            "DevolucionesISR": "0.00",
            "SalarioLiquido": "2801.54",
            "Observaciones": "",
            "IdEmpresa": "EMP-00001",
            "TipoPago": "Transferencia",
            "ComprobantePago": ""
        }
    ]
}
```

### GET - Obtener historial por empleado
```
GET /Api/DetallePlanilla.php?idEmpleado={IdEmpleado}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpleado | string | Si | Identificador del empleado |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/DetallePlanilla.php?idEmpleado=EMP-00001&idEmpresa=EMP-00001
```

### GET - Obtener detalle especifico
```
GET /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpleado={IdEmpleado}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpleado | string | Si | Identificador del empleado |
| idEmpresa | string | Si | Identificador de la empresa |

---

### POST - Crear nuevo detalle
```
POST /Api/DetallePlanilla.php
```

#### Cuerpo de la solicitud
```json
{
    "IdPlanilla": "PLA-00001",
    "IdEmpleado": "EMP-00001",
    "IdContrato": "CON-00001",
    "SalarioBase": 5000.00,
    "DiasTrabajados": 15.00,
    "HorasOrdinarias": 120.00,
    "HorasExtraordinarias": 10.00,
    "Ordinario": 2500.00,
    "Extraordinario": 312.50,
    "OtrosSalarios": 0.00,
    "SeptimosAsuetos": 0.00,
    "Vacaciones": 0.00,
    "TotalSalario": 2812.50,
    "DeduccionCuotaLaboralIGSS": 135.96,
    "DeduccionDescuentosISR": 0.00,
    "OtrasDeducciones": 0.00,
    "TotalDeducciones": 135.96,
    "BonificacionAnual": 0.00,
    "AguinaldoDecreto": 0.00,
    "BonificacionIncentivo": 125.00,
    "DevolucionesISR": 0.00,
    "SalarioLiquido": 2801.54,
    "Observaciones": "",
    "IdEmpresa": "EMP-00001",
    "TipoPago": "Transferencia",
    "ComprobantePago": ""
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdPlanilla | string(20) | Si | Identificador de la planilla |
| IdEmpleado | string(20) | Si | Identificador del empleado |
| IdContrato | string(20) | No | Identificador del contrato |
| SalarioBase | decimal(18,2) | No | Salario base del empleado |
| DiasTrabajados | decimal(18,2) | No | Dias trabajados en el periodo |
| HorasOrdinarias | decimal(18,2) | No | Horas ordinarias trabajadas |
| HorasExtraordinarias | decimal(18,2) | No | Horas extraordinarias trabajadas |
| Ordinario | decimal(18,2) | No | Pago por horas ordinarias |
| Extraordinario | decimal(18,2) | No | Pago por horas extraordinarias |
| OtrosSalarios | decimal(18,2) | No | Otros ingresos salariales |
| SeptimosAsuetos | decimal(18,2) | No | Pago por septimos y asuetos |
| Vacaciones | decimal(18,2) | No | Pago por vacaciones |
| TotalSalario | decimal(18,2) | No | Total de salario devengado |
| DeduccionCuotaLaboralIGSS | decimal(18,2) | No | Deduccion IGSS laboral |
| DeduccionDescuentosISR | decimal(18,2) | No | Deduccion ISR |
| OtrasDeducciones | decimal(18,2) | No | Otras deducciones |
| TotalDeducciones | decimal(18,2) | No | Total de deducciones |
| BonificacionAnual | decimal(18,2) | No | Bonificacion anual (Bono 14) |
| AguinaldoDecreto | decimal(18,2) | No | Aguinaldo |
| BonificacionIncentivo | decimal(18,2) | No | Bonificacion incentivo |
| DevolucionesISR | decimal(18,2) | No | Devoluciones de ISR |
| SalarioLiquido | decimal(18,2) | No | Salario neto a recibir |
| Observaciones | string(255) | No | Observaciones adicionales |
| IdEmpresa | string(20) | No | Identificador de la empresa |
| TipoPago | string(50) | No | Forma de pago |
| ComprobantePago | string(100) | No | Numero de comprobante |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Detalle de planilla creado exitosamente"
}
```

---

### PUT - Actualizar detalle
```
PUT /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpleado={IdEmpleado}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpleado | string | Si | Identificador del empleado |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Detalle de planilla actualizado exitosamente"
}
```

---

### DELETE - Eliminar detalle
```
DELETE /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpleado={IdEmpleado}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpleado | string | Si | Identificador del empleado |

#### Ejemplo
```
DELETE /Api/DetallePlanilla.php?idPlanilla=PLA-00001&idEmpleado=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Detalle eliminado exitosamente"
}
```

---

## Respuestas de error

### Parametro idEmpresa requerido
```json
{
    "success": false,
    "error": "El parametro idEmpresa es requerido"
}
```

### Detalle no encontrado
```json
{
    "success": false,
    "error": "Detalle no encontrado"
}
```
