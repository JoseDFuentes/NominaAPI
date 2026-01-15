# API SecuenciasNumericas

## Descripcion
API para gestionar las secuencias numericas para generacion de IDs automaticos.

## URL Base
```
/Api/SecuenciasNumericas.php
```

---

## Endpoints

### GET - Obtener todas las secuencias
```
GET /Api/SecuenciasNumericas.php
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdSecuencia": "Empresa",
            "IdTabla": "Empresa",
            "Digitos": 5,
            "Separador": "-",
            "Prefijo": "EMP",
            "Inicial": 1,
            "Siguiente": 1
        },
        {
            "IdSecuencia": "Empleados",
            "IdTabla": "Empleados",
            "Digitos": 5,
            "Separador": "-",
            "Prefijo": "EMP",
            "Inicial": 1,
            "Siguiente": 1
        }
    ]
}
```

### GET - Obtener secuencia por ID
```
GET /Api/SecuenciasNumericas.php?id={IdSecuencia}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la secuencia |

#### Ejemplo
```
GET /Api/SecuenciasNumericas.php?id=Empleados
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdSecuencia": "Empleados",
        "IdTabla": "Empleados",
        "Digitos": 5,
        "Separador": "-",
        "Prefijo": "EMP",
        "Inicial": 1,
        "Siguiente": 1
    }
}
```

### GET - Obtener secuencia por tabla
```
GET /Api/SecuenciasNumericas.php?idTabla={IdTabla}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idTabla | string | Si | Nombre de la tabla |

#### Ejemplo
```
GET /Api/SecuenciasNumericas.php?idTabla=Empleados
```

---

### GET - Obtener siguiente numero de secuencia
```
GET /Api/SecuenciasNumericas.php?accion=siguiente&idTabla={IdTabla}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| accion | string | Si | Debe ser "siguiente" |
| idTabla | string | Si | Nombre de la tabla |

#### Ejemplo
```
GET /Api/SecuenciasNumericas.php?accion=siguiente&idTabla=Empleados
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "numero": 1,
        "codigo": "EMP-00001",
        "siguiente": 2
    }
}
```

**Nota:** Esta operacion incrementa automaticamente el contador de la secuencia.

---

### POST - Crear nueva secuencia
```
POST /Api/SecuenciasNumericas.php
```

#### Cuerpo de la solicitud
```json
{
    "IdSecuencia": "NuevaTabla",
    "IdTabla": "NuevaTabla",
    "Digitos": 5,
    "Separador": "-",
    "Prefijo": "NUE",
    "Inicial": 1,
    "Siguiente": 1
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdSecuencia | string(20) | Si | Identificador unico de la secuencia |
| IdTabla | string(100) | No | Nombre de la tabla asociada |
| Digitos | int | No | Cantidad de digitos para el numero |
| Separador | string(5) | No | Caracter separador entre prefijo y numero |
| Prefijo | string(10) | No | Prefijo del codigo generado |
| Inicial | int | No | Numero inicial de la secuencia |
| Siguiente | int | No | Siguiente numero a generar |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Secuencia creada exitosamente",
    "id": "NuevaTabla"
}
```

---

### PUT - Actualizar secuencia
```
PUT /Api/SecuenciasNumericas.php?id={IdSecuencia}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la secuencia a actualizar |

#### Cuerpo de la solicitud
```json
{
    "IdTabla": "Empleados",
    "Digitos": 6,
    "Separador": "-",
    "Prefijo": "EMP",
    "Inicial": 1,
    "Siguiente": 100
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Secuencia actualizada exitosamente"
}
```

---

### DELETE - Eliminar secuencia
```
DELETE /Api/SecuenciasNumericas.php?id={IdSecuencia}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la secuencia a eliminar |

#### Ejemplo
```
DELETE /Api/SecuenciasNumericas.php?id=NuevaTabla
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Secuencia eliminada exitosamente"
}
```

---

## Formato de codigo generado

El codigo generado sigue el formato: `{Prefijo}{Separador}{Numero}`

Donde:
- **Prefijo**: Letras identificadoras de la tabla (ej: EMP, PLA, CON)
- **Separador**: Caracter de separacion (ej: -, _)
- **Numero**: Numero secuencial con la cantidad de digitos especificada, rellenado con ceros

### Ejemplos de codigos generados
| Tabla | Prefijo | Digitos | Codigo |
|-------|---------|---------|--------|
| Empresa | EMP | 5 | EMP-00001 |
| Empleados | EMP | 5 | EMP-00001 |
| Puestos | PUE | 5 | PUE-00001 |
| Contratos | CON | 5 | CON-00001 |
| Planilla | PLA | 5 | PLA-00001 |

---

## Respuestas de error

### Secuencia no encontrada
```json
{
    "success": false,
    "error": "Secuencia no encontrada para la tabla: NombreTabla"
}
```

### Secuencia no encontrada (DELETE)
```json
{
    "success": false,
    "error": "Secuencia no encontrada"
}
```
