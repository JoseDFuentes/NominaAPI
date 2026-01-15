# API Planilla

## Descripcion
API para gestionar las planillas de pago en el sistema de nomina.

## URL Base
```
/Api/Planilla.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todas las planillas
```
GET /Api/Planilla.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Planilla.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdPlanilla": "PLA-00001",
            "TipoPlanilla": "Quincenal",
            "InicioPeriodo": "2024-01-01",
            "FinPeriodo": "2024-01-15",
            "FechaPago": "2024-01-16",
            "TotalEmpleados": 50,
            "TotalSalarios": "150000.00",
            "TotalDeducciones": "15000.00",
            "TotalBonificaciones": "12500.00",
            "TotalNetoPagar": "147500.00",
            "Registrada": 1,
            "FechaRegistro": "2024-01-16 10:30:00",
            "UsuarioRegistro": "admin",
            "Observaciones": "",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener planilla por ID
```
GET /Api/Planilla.php?id={IdPlanilla}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la planilla |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Planilla.php?id=PLA-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdPlanilla": "PLA-00001",
        "TipoPlanilla": "Quincenal",
        "InicioPeriodo": "2024-01-01",
        "FinPeriodo": "2024-01-15",
        "FechaPago": "2024-01-16",
        "TotalEmpleados": 50,
        "TotalSalarios": "150000.00",
        "TotalDeducciones": "15000.00",
        "TotalBonificaciones": "12500.00",
        "TotalNetoPagar": "147500.00",
        "Registrada": 1,
        "FechaRegistro": "2024-01-16 10:30:00",
        "UsuarioRegistro": "admin",
        "Observaciones": "",
        "IdEmpresa": "EMP-00001"
    }
}
```

---

### POST - Crear nueva planilla
```
POST /Api/Planilla.php
```

#### Cuerpo de la solicitud
```json
{
    "IdPlanilla": "PLA-00001",
    "TipoPlanilla": "Quincenal",
    "InicioPeriodo": "2024-01-01",
    "FinPeriodo": "2024-01-15",
    "FechaPago": "2024-01-16",
    "TotalEmpleados": 50,
    "TotalSalarios": 150000.00,
    "TotalDeducciones": 15000.00,
    "TotalBonificaciones": 12500.00,
    "TotalNetoPagar": 147500.00,
    "Registrada": 0,
    "FechaRegistro": null,
    "UsuarioRegistro": "",
    "Observaciones": "",
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdPlanilla | string(20) | Si | Identificador unico de la planilla |
| TipoPlanilla | string(100) | No | Tipo de planilla (Quincenal, Mensual, etc.) |
| InicioPeriodo | date | No | Fecha de inicio del periodo |
| FinPeriodo | date | No | Fecha de fin del periodo |
| FechaPago | date | No | Fecha de pago |
| TotalEmpleados | int | No | Total de empleados en la planilla |
| TotalSalarios | decimal(18,2) | No | Suma total de salarios |
| TotalDeducciones | decimal(18,2) | No | Suma total de deducciones |
| TotalBonificaciones | decimal(18,2) | No | Suma total de bonificaciones |
| TotalNetoPagar | decimal(18,2) | No | Total neto a pagar |
| Registrada | boolean | No | Indica si la planilla esta registrada |
| FechaRegistro | datetime | No | Fecha y hora de registro |
| UsuarioRegistro | string(100) | No | Usuario que registro la planilla |
| Observaciones | string(255) | No | Observaciones adicionales |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Planilla creada exitosamente",
    "id": "PLA-00001"
}
```

---

### PUT - Actualizar planilla
```
PUT /Api/Planilla.php?id={IdPlanilla}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la planilla a actualizar |

#### Cuerpo de la solicitud
```json
{
    "TipoPlanilla": "Quincenal",
    "InicioPeriodo": "2024-01-01",
    "FinPeriodo": "2024-01-15",
    "FechaPago": "2024-01-16",
    "TotalEmpleados": 52,
    "TotalSalarios": 155000.00,
    "TotalDeducciones": 15500.00,
    "TotalBonificaciones": 13000.00,
    "TotalNetoPagar": 152500.00,
    "Registrada": 1,
    "FechaRegistro": "2024-01-16 10:30:00",
    "UsuarioRegistro": "admin",
    "Observaciones": "Planilla actualizada",
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Planilla actualizada exitosamente"
}
```

---

### DELETE - Eliminar planilla
```
DELETE /Api/Planilla.php?id={IdPlanilla}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la planilla a eliminar |

#### Ejemplo
```
DELETE /Api/Planilla.php?id=PLA-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Planilla eliminada exitosamente"
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

### Planilla no encontrada
```json
{
    "success": false,
    "error": "Planilla no encontrada"
}
```
