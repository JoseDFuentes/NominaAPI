# API Contratos

## Descripcion
API para gestionar los contratos de empleados en el sistema de nomina.

## URL Base
```
/Api/Contratos.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los contratos
```
GET /Api/Contratos.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Contratos.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdContrato": "CON-00001",
            "IdEmpleado": "EMP-00001",
            "IdPuesto": "PUE-00001",
            "FechaInicio": "2024-01-01",
            "FechaFinal": "2024-12-31",
            "TipoContrato": 1,
            "SalarioBase": "5000.00",
            "DiasMes": 30,
            "DiasQuincena": 15,
            "DiasSemana": 5,
            "HorasDiarias": 8,
            "Observaciones": "",
            "Activo": 1,
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener contrato por ID
```
GET /Api/Contratos.php?id={IdContrato}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del contrato |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Contratos.php?id=CON-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdContrato": "CON-00001",
        "IdEmpleado": "EMP-00001",
        "IdPuesto": "PUE-00001",
        "FechaInicio": "2024-01-01",
        "FechaFinal": "2024-12-31",
        "TipoContrato": 1,
        "SalarioBase": "5000.00",
        "DiasMes": 30,
        "DiasQuincena": 15,
        "DiasSemana": 5,
        "HorasDiarias": 8,
        "Observaciones": "",
        "Activo": 1,
        "IdEmpresa": "EMP-00001"
    }
}
```

### GET - Obtener contratos por empleado
```
GET /Api/Contratos.php?idEmpleado={IdEmpleado}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpleado | string | Si | Identificador del empleado |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Contratos.php?idEmpleado=EMP-00001&idEmpresa=EMP-00001
```

---

### POST - Crear nuevo contrato
```
POST /Api/Contratos.php
```

#### Cuerpo de la solicitud
```json
{
    "IdContrato": "CON-00001",
    "IdEmpleado": "EMP-00001",
    "IdPuesto": "PUE-00001",
    "FechaInicio": "2024-01-01",
    "FechaFinal": "2024-12-31",
    "TipoContrato": 1,
    "SalarioBase": 5000.00,
    "DiasMes": 30,
    "DiasQuincena": 15,
    "DiasSemana": 5,
    "HorasDiarias": 8,
    "Observaciones": "",
    "Activo": 1,
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdContrato | string(20) | Si | Identificador unico del contrato |
| IdEmpleado | string(20) | No | Identificador del empleado |
| IdPuesto | string(20) | No | Identificador del puesto |
| FechaInicio | date | No | Fecha de inicio del contrato |
| FechaFinal | date | No | Fecha de finalizacion del contrato |
| TipoContrato | int | No | Tipo de contrato |
| SalarioBase | decimal(18,2) | No | Salario base del contrato |
| DiasMes | int | No | Dias laborales por mes |
| DiasQuincena | int | No | Dias laborales por quincena |
| DiasSemana | int | No | Dias laborales por semana |
| HorasDiarias | int | No | Horas laborales por dia |
| Observaciones | string(255) | No | Observaciones adicionales |
| Activo | boolean | No | Estado del contrato (default: true) |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Contrato creado exitosamente",
    "id": "CON-00001"
}
```

---

### PUT - Actualizar contrato
```
PUT /Api/Contratos.php?id={IdContrato}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del contrato a actualizar |

#### Cuerpo de la solicitud
```json
{
    "IdEmpleado": "EMP-00001",
    "IdPuesto": "PUE-00001",
    "FechaInicio": "2024-01-01",
    "FechaFinal": "2025-12-31",
    "TipoContrato": 1,
    "SalarioBase": 5500.00,
    "DiasMes": 30,
    "DiasQuincena": 15,
    "DiasSemana": 5,
    "HorasDiarias": 8,
    "Observaciones": "Contrato renovado",
    "Activo": 1,
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Contrato actualizado exitosamente"
}
```

---

### DELETE - Eliminar contrato
```
DELETE /Api/Contratos.php?id={IdContrato}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del contrato a eliminar |

#### Ejemplo
```
DELETE /Api/Contratos.php?id=CON-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Contrato eliminado exitosamente"
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

### Contrato no encontrado
```json
{
    "success": false,
    "error": "Contrato no encontrado"
}
```
