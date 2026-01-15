# API Puestos

## Descripcion
API para gestionar los puestos de trabajo en el sistema de nomina.

## URL Base
```
/Api/Puestos.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los puestos
```
GET /Api/Puestos.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Puestos.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdPuesto": "PUE-00001",
            "SalarioBase": "5000.00",
            "Activo": 1,
            "IdEmpresa": "EMP-00001"
        },
        {
            "IdPuesto": "PUE-00002",
            "SalarioBase": "8000.00",
            "Activo": 1,
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener puesto por ID
```
GET /Api/Puestos.php?id={IdPuesto}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del puesto |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Puestos.php?id=PUE-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdPuesto": "PUE-00001",
        "SalarioBase": "5000.00",
        "Activo": 1,
        "IdEmpresa": "EMP-00001"
    }
}
```

---

### POST - Crear nuevo puesto
```
POST /Api/Puestos.php
```

#### Cuerpo de la solicitud
```json
{
    "IdPuesto": "PUE-00001",
    "SalarioBase": 5000.00,
    "Activo": 1,
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdPuesto | string(20) | Si | Identificador unico del puesto |
| SalarioBase | decimal(18,2) | No | Salario base del puesto |
| Activo | boolean | No | Estado del puesto (default: true) |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Puesto creado exitosamente",
    "id": "PUE-00001"
}
```

---

### PUT - Actualizar puesto
```
PUT /Api/Puestos.php?id={IdPuesto}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del puesto a actualizar |

#### Cuerpo de la solicitud
```json
{
    "SalarioBase": 5500.00,
    "Activo": 1,
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Puesto actualizado exitosamente"
}
```

---

### DELETE - Eliminar puesto
```
DELETE /Api/Puestos.php?id={IdPuesto}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del puesto a eliminar |

#### Ejemplo
```
DELETE /Api/Puestos.php?id=PUE-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Puesto eliminado exitosamente"
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

### Puesto no encontrado
```json
{
    "success": false,
    "error": "Puesto no encontrado"
}
```
