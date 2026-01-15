# API ContratosDeducciones

## Descripcion
API para gestionar la relacion entre contratos y deducciones.

## URL Base
```
/Api/ContratosDeducciones.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todas las relaciones
```
GET /Api/ContratosDeducciones.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/ContratosDeducciones.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdContrato": "CON-00001",
            "IdDeducciones": "DED-00001",
            "IdEmpresa": "EMP-00001"
        },
        {
            "IdContrato": "CON-00001",
            "IdDeducciones": "DED-00002",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener deducciones por contrato
```
GET /Api/ContratosDeducciones.php?idContrato={IdContrato}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idContrato | string | Si | Identificador del contrato |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/ContratosDeducciones.php?idContrato=CON-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdContrato": "CON-00001",
            "IdDeducciones": "DED-00001",
            "IdEmpresa": "EMP-00001",
            "PorcentajeDeduccion": "4.8300",
            "DeduccionFijo": "0.00"
        }
    ]
}
```

### GET - Obtener relacion especifica
```
GET /Api/ContratosDeducciones.php?idContrato={IdContrato}&idDeducciones={IdDeducciones}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idContrato | string | Si | Identificador del contrato |
| idDeducciones | string | Si | Identificador de la deduccion |
| idEmpresa | string | Si | Identificador de la empresa |

---

### POST - Crear nueva relacion
```
POST /Api/ContratosDeducciones.php
```

#### Cuerpo de la solicitud
```json
{
    "IdContrato": "CON-00001",
    "IdDeducciones": "DED-00001",
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdContrato | string(20) | Si | Identificador del contrato |
| IdDeducciones | string(20) | Si | Identificador de la deduccion |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Relacion contrato-deduccion creada exitosamente"
}
```

---

### DELETE - Eliminar relacion
```
DELETE /Api/ContratosDeducciones.php?idContrato={IdContrato}&idDeducciones={IdDeducciones}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idContrato | string | Si | Identificador del contrato |
| idDeducciones | string | Si | Identificador de la deduccion |

#### Ejemplo
```
DELETE /Api/ContratosDeducciones.php?idContrato=CON-00001&idDeducciones=DED-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Relacion eliminada exitosamente"
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

### Relacion no encontrada
```json
{
    "success": false,
    "error": "Relacion no encontrada"
}
```
