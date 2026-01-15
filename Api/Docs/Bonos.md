# API Bonos

## Descripcion
API para gestionar los bonos en el sistema de nomina.

## URL Base
```
/Api/Bonos.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los bonos
```
GET /Api/Bonos.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Bonos.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdBono": "BON-00001",
            "Descripcion": "Bonificacion Incentivo",
            "PorcentajeSalario": "0.0000",
            "BonoFijo": "250.00",
            "IdEmpresa": "EMP-00001"
        },
        {
            "IdBono": "BON-00002",
            "Descripcion": "Bono por productividad",
            "PorcentajeSalario": "5.0000",
            "BonoFijo": "0.00",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener bono por ID
```
GET /Api/Bonos.php?id={IdBono}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del bono |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Bonos.php?id=BON-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdBono": "BON-00001",
        "Descripcion": "Bonificacion Incentivo",
        "PorcentajeSalario": "0.0000",
        "BonoFijo": "250.00",
        "IdEmpresa": "EMP-00001"
    }
}
```

---

### POST - Crear nuevo bono
```
POST /Api/Bonos.php
```

#### Cuerpo de la solicitud
```json
{
    "IdBono": "BON-00001",
    "Descripcion": "Bonificacion Incentivo",
    "PorcentajeSalario": 0.00,
    "BonoFijo": 250.00,
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdBono | string(20) | Si | Identificador unico del bono |
| Descripcion | string(100) | No | Descripcion del bono |
| PorcentajeSalario | decimal(18,4) | No | Porcentaje sobre el salario |
| BonoFijo | decimal(18,2) | No | Monto fijo del bono |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Bono creado exitosamente",
    "id": "BON-00001"
}
```

---

### PUT - Actualizar bono
```
PUT /Api/Bonos.php?id={IdBono}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del bono a actualizar |

#### Cuerpo de la solicitud
```json
{
    "Descripcion": "Bonificacion Incentivo Ley",
    "PorcentajeSalario": 0.00,
    "BonoFijo": 250.00,
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Bono actualizado exitosamente"
}
```

---

### DELETE - Eliminar bono
```
DELETE /Api/Bonos.php?id={IdBono}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del bono a eliminar |

#### Ejemplo
```
DELETE /Api/Bonos.php?id=BON-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Bono eliminado exitosamente"
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

### Bono no encontrado
```json
{
    "success": false,
    "error": "Bono no encontrado"
}
```
