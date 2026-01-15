# API ContratosConceptos

## Descripcion
API para gestionar la relacion entre contratos y conceptos de pago.

## URL Base
```
/Api/ContratosConceptos.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todas las relaciones
```
GET /Api/ContratosConceptos.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/ContratosConceptos.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdContrato": "CON-00001",
            "IdConcepto": "CON-00001",
            "IdEmpresa": "EMP-00001"
        },
        {
            "IdContrato": "CON-00001",
            "IdConcepto": "CON-00002",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener conceptos por contrato
```
GET /Api/ContratosConceptos.php?idContrato={IdContrato}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idContrato | string | Si | Identificador del contrato |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/ContratosConceptos.php?idContrato=CON-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdContrato": "CON-00001",
            "IdConcepto": "CON-00001",
            "IdEmpresa": "EMP-00001",
            "PorcentajeConcepto": "10.0000",
            "ConceptoFijo": "0.00"
        }
    ]
}
```

### GET - Obtener relacion especifica
```
GET /Api/ContratosConceptos.php?idContrato={IdContrato}&idConcepto={IdConcepto}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idContrato | string | Si | Identificador del contrato |
| idConcepto | string | Si | Identificador del concepto |
| idEmpresa | string | Si | Identificador de la empresa |

---

### POST - Crear nueva relacion
```
POST /Api/ContratosConceptos.php
```

#### Cuerpo de la solicitud
```json
{
    "IdContrato": "CON-00001",
    "IdConcepto": "CON-00001",
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdContrato | string(20) | Si | Identificador del contrato |
| IdConcepto | string(20) | Si | Identificador del concepto |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Relacion contrato-concepto creada exitosamente"
}
```

---

### DELETE - Eliminar relacion
```
DELETE /Api/ContratosConceptos.php?idContrato={IdContrato}&idConcepto={IdConcepto}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idContrato | string | Si | Identificador del contrato |
| idConcepto | string | Si | Identificador del concepto |

#### Ejemplo
```
DELETE /Api/ContratosConceptos.php?idContrato=CON-00001&idConcepto=CON-00001
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
