# API Empresa

## Descripcion
API para gestionar los datos de las empresas en el sistema de nomina.

## URL Base
```
/Api/Empresa.php
```

---

## Endpoints

### GET - Obtener todas las empresas
```
GET /Api/Empresa.php
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdEmpresa": "EMP-00001",
            "Nombre": "Empresa Demo S.A.",
            "RazonSocial": "Empresa Demostrativa Sociedad Anonima",
            "NIT": "12345678-9",
            "IGSSPatronal": "123456",
            "Direccion": "Ciudad de Guatemala, Zona 10",
            "Telefono": "2222-3333"
        }
    ]
}
```

### GET - Obtener empresa por ID
```
GET /Api/Empresa.php?id={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador unico de la empresa |

#### Ejemplo
```
GET /Api/Empresa.php?id=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdEmpresa": "EMP-00001",
        "Nombre": "Empresa Demo S.A.",
        "RazonSocial": "Empresa Demostrativa Sociedad Anonima",
        "NIT": "12345678-9",
        "IGSSPatronal": "123456",
        "Direccion": "Ciudad de Guatemala, Zona 10",
        "Telefono": "2222-3333"
    }
}
```

---

### POST - Crear nueva empresa
```
POST /Api/Empresa.php
```

#### Cuerpo de la solicitud
```json
{
    "IdEmpresa": "EMP-00001",
    "Nombre": "Empresa Demo S.A.",
    "RazonSocial": "Empresa Demostrativa Sociedad Anonima",
    "NIT": "12345678-9",
    "IGSSPatronal": "123456",
    "Direccion": "Ciudad de Guatemala, Zona 10",
    "Telefono": "2222-3333"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdEmpresa | string(20) | Si | Identificador unico de la empresa |
| Nombre | string(255) | No | Nombre comercial de la empresa |
| RazonSocial | string(255) | No | Razon social de la empresa |
| NIT | string(40) | No | Numero de Identificacion Tributaria |
| IGSSPatronal | string(40) | No | Numero patronal del IGSS |
| Direccion | string(255) | No | Direccion fisica de la empresa |
| Telefono | string(50) | No | Telefono de contacto |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Empresa creada exitosamente",
    "id": "EMP-00001"
}
```

---

### PUT - Actualizar empresa
```
PUT /Api/Empresa.php?id={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la empresa a actualizar |

#### Cuerpo de la solicitud
```json
{
    "Nombre": "Empresa Demo Actualizada S.A.",
    "RazonSocial": "Empresa Demostrativa Sociedad Anonima",
    "NIT": "12345678-9",
    "IGSSPatronal": "123456",
    "Direccion": "Ciudad de Guatemala, Zona 14",
    "Telefono": "2222-4444"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Empresa actualizada exitosamente"
}
```

---

### DELETE - Eliminar empresa
```
DELETE /Api/Empresa.php?id={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la empresa a eliminar |

#### Ejemplo
```
DELETE /Api/Empresa.php?id=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Empresa eliminada exitosamente"
}
```

---

## Respuestas de error

### Error de conexion
```json
{
    "success": false,
    "error": "Error de conexion: ..."
}
```

### Empresa no encontrada
```json
{
    "success": false,
    "error": "Empresa no encontrada"
}
```

### Metodo no permitido
```json
{
    "success": false,
    "error": "Metodo no permitido"
}
```
