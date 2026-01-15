# API Conceptos

## Descripcion
API para gestionar los conceptos de pago en el sistema de nomina.

## URL Base
```
/Api/Conceptos.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los conceptos
```
GET /Api/Conceptos.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Conceptos.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdConcepto": "CON-00001",
            "PorcentajeConcepto": "10.0000",
            "ConceptoFijo": "0.00",
            "IdEmpresa": "EMP-00001"
        },
        {
            "IdConcepto": "CON-00002",
            "PorcentajeConcepto": "0.0000",
            "ConceptoFijo": "250.00",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener concepto por ID
```
GET /Api/Conceptos.php?id={IdConcepto}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del concepto |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Conceptos.php?id=CON-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdConcepto": "CON-00001",
        "PorcentajeConcepto": "10.0000",
        "ConceptoFijo": "0.00",
        "IdEmpresa": "EMP-00001"
    }
}
```

---

### POST - Crear nuevo concepto
```
POST /Api/Conceptos.php
```

#### Cuerpo de la solicitud
```json
{
    "IdConcepto": "CON-00001",
    "PorcentajeConcepto": 10.00,
    "ConceptoFijo": 0.00,
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdConcepto | string(20) | Si | Identificador unico del concepto |
| PorcentajeConcepto | decimal(18,4) | No | Porcentaje del concepto |
| ConceptoFijo | decimal(18,2) | No | Monto fijo del concepto |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Concepto creado exitosamente",
    "id": "CON-00001"
}
```

---

### PUT - Actualizar concepto
```
PUT /Api/Conceptos.php?id={IdConcepto}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del concepto a actualizar |

#### Cuerpo de la solicitud
```json
{
    "PorcentajeConcepto": 12.00,
    "ConceptoFijo": 0.00,
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Concepto actualizado exitosamente"
}
```

---

### DELETE - Eliminar concepto
```
DELETE /Api/Conceptos.php?id={IdConcepto}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del concepto a eliminar |

#### Ejemplo
```
DELETE /Api/Conceptos.php?id=CON-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Concepto eliminado exitosamente"
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

### Concepto no encontrado
```json
{
    "success": false,
    "error": "Concepto no encontrado"
}
```
