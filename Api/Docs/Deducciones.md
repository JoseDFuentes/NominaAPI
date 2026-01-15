# API Deducciones

## Descripcion
API para gestionar las deducciones en el sistema de nomina.

## URL Base
```
/Api/Deducciones.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todas las deducciones
```
GET /Api/Deducciones.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Deducciones.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdDeducciones": "DED-00001",
            "PorcentajeDeduccion": "4.8300",
            "DeduccionFijo": "0.00",
            "IdEmpresa": "EMP-00001"
        },
        {
            "IdDeducciones": "DED-00002",
            "PorcentajeDeduccion": "0.0000",
            "DeduccionFijo": "100.00",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener deduccion por ID
```
GET /Api/Deducciones.php?id={IdDeducciones}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la deduccion |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Deducciones.php?id=DED-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdDeducciones": "DED-00001",
        "PorcentajeDeduccion": "4.8300",
        "DeduccionFijo": "0.00",
        "IdEmpresa": "EMP-00001"
    }
}
```

---

### POST - Crear nueva deduccion
```
POST /Api/Deducciones.php
```

#### Cuerpo de la solicitud
```json
{
    "IdDeducciones": "DED-00001",
    "PorcentajeDeduccion": 4.83,
    "DeduccionFijo": 0.00,
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdDeducciones | string(20) | Si | Identificador unico de la deduccion |
| PorcentajeDeduccion | decimal(18,4) | No | Porcentaje de la deduccion |
| DeduccionFijo | decimal(18,2) | No | Monto fijo de la deduccion |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Deduccion creada exitosamente",
    "id": "DED-00001"
}
```

---

### PUT - Actualizar deduccion
```
PUT /Api/Deducciones.php?id={IdDeducciones}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la deduccion a actualizar |

#### Cuerpo de la solicitud
```json
{
    "PorcentajeDeduccion": 5.00,
    "DeduccionFijo": 0.00,
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Deduccion actualizada exitosamente"
}
```

---

### DELETE - Eliminar deduccion
```
DELETE /Api/Deducciones.php?id={IdDeducciones}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la deduccion a eliminar |

#### Ejemplo
```
DELETE /Api/Deducciones.php?id=DED-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Deduccion eliminada exitosamente"
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

### Deduccion no encontrada
```json
{
    "success": false,
    "error": "Deduccion no encontrada"
}
```
