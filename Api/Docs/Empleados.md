# API Empleados

## Descripcion
API para gestionar los datos de los empleados en el sistema de nomina.

## URL Base
```
/Api/Empleados.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los empleados
```
GET /Api/Empleados.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Empleados.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdEmpleado": "EMP-00001",
            "Nombres": "Juan Carlos",
            "Apellidos": "Perez Lopez",
            "Genero": "Masculino",
            "EstadoCivil": "Casado",
            "Nacionalidad": "Guatemalteco",
            "TipoIdentificacion": "DPI",
            "NoIdentificacion": "1234567890101",
            "NIT": "12345678",
            "Direccion": "Zona 1, Ciudad de Guatemala",
            "Telefono1": "5555-1234",
            "Telefono2": "5555-5678",
            "CorreoElectronico": "juan.perez@email.com",
            "Contacto": "Maria Perez - 5555-9999",
            "Observaciones": "",
            "AfiliacionIGSS": "123456789",
            "Banco": "Banco Industrial",
            "NoCuentaBanco": "123-456789-0",
            "TipoCuentaBanco": "Monetaria",
            "IdEmpresa": "EMP-00001",
            "Activo": 1
        }
    ]
}
```

### GET - Obtener empleado por ID
```
GET /Api/Empleados.php?id={IdEmpleado}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del empleado |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Empleados.php?id=EMP-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdEmpleado": "EMP-00001",
        "Nombres": "Juan Carlos",
        "Apellidos": "Perez Lopez",
        "Genero": "Masculino",
        "EstadoCivil": "Casado",
        "Nacionalidad": "Guatemalteco",
        "TipoIdentificacion": "DPI",
        "NoIdentificacion": "1234567890101",
        "NIT": "12345678",
        "Direccion": "Zona 1, Ciudad de Guatemala",
        "Telefono1": "5555-1234",
        "Telefono2": "5555-5678",
        "CorreoElectronico": "juan.perez@email.com",
        "Contacto": "Maria Perez - 5555-9999",
        "Observaciones": "",
        "AfiliacionIGSS": "123456789",
        "Banco": "Banco Industrial",
        "NoCuentaBanco": "123-456789-0",
        "TipoCuentaBanco": "Monetaria",
        "IdEmpresa": "EMP-00001",
        "Activo": 1
    }
}
```

---

### POST - Crear nuevo empleado
```
POST /Api/Empleados.php
```

#### Cuerpo de la solicitud
```json
{
    "IdEmpleado": "EMP-00001",
    "Nombres": "Juan Carlos",
    "Apellidos": "Perez Lopez",
    "Genero": "Masculino",
    "EstadoCivil": "Casado",
    "Nacionalidad": "Guatemalteco",
    "TipoIdentificacion": "DPI",
    "NoIdentificacion": "1234567890101",
    "NIT": "12345678",
    "Direccion": "Zona 1, Ciudad de Guatemala",
    "Telefono1": "5555-1234",
    "Telefono2": "5555-5678",
    "CorreoElectronico": "juan.perez@email.com",
    "Contacto": "Maria Perez - 5555-9999",
    "Observaciones": "",
    "AfiliacionIGSS": "123456789",
    "Banco": "Banco Industrial",
    "NoCuentaBanco": "123-456789-0",
    "TipoCuentaBanco": "Monetaria",
    "IdEmpresa": "EMP-00001",
    "Activo": 1
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdEmpleado | string(20) | Si | Identificador unico del empleado |
| Nombres | string(255) | No | Nombres del empleado |
| Apellidos | string(255) | No | Apellidos del empleado |
| Genero | string(50) | No | Genero del empleado |
| EstadoCivil | string(50) | No | Estado civil |
| Nacionalidad | string(50) | No | Nacionalidad |
| TipoIdentificacion | string(40) | No | Tipo de documento de identificacion |
| NoIdentificacion | string(25) | No | Numero de identificacion |
| NIT | string(20) | No | Numero de Identificacion Tributaria |
| Direccion | string(255) | No | Direccion de residencia |
| Telefono1 | string(50) | No | Telefono principal |
| Telefono2 | string(50) | No | Telefono secundario |
| CorreoElectronico | string(50) | No | Correo electronico |
| Contacto | string(100) | No | Contacto de emergencia |
| Observaciones | string(255) | No | Observaciones adicionales |
| AfiliacionIGSS | string(40) | No | Numero de afiliacion IGSS |
| Banco | string(100) | No | Nombre del banco |
| NoCuentaBanco | string(50) | No | Numero de cuenta bancaria |
| TipoCuentaBanco | string(50) | No | Tipo de cuenta bancaria |
| IdEmpresa | string(20) | No | Identificador de la empresa |
| Activo | boolean | No | Estado del empleado (default: true) |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Empleado creado exitosamente",
    "id": "EMP-00001"
}
```

---

### PUT - Actualizar empleado
```
PUT /Api/Empleados.php?id={IdEmpleado}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del empleado a actualizar |

#### Cuerpo de la solicitud
```json
{
    "Nombres": "Juan Carlos",
    "Apellidos": "Perez Garcia",
    "Genero": "Masculino",
    "EstadoCivil": "Casado",
    "Nacionalidad": "Guatemalteco",
    "TipoIdentificacion": "DPI",
    "NoIdentificacion": "1234567890101",
    "NIT": "12345678",
    "Direccion": "Zona 10, Ciudad de Guatemala",
    "Telefono1": "5555-1234",
    "Telefono2": "5555-5678",
    "CorreoElectronico": "juan.perez@email.com",
    "Contacto": "Maria Perez - 5555-9999",
    "Observaciones": "Actualizado",
    "AfiliacionIGSS": "123456789",
    "Banco": "Banco Industrial",
    "NoCuentaBanco": "123-456789-0",
    "TipoCuentaBanco": "Monetaria",
    "IdEmpresa": "EMP-00001",
    "Activo": 1
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Empleado actualizado exitosamente"
}
```

---

### DELETE - Eliminar empleado
```
DELETE /Api/Empleados.php?id={IdEmpleado}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador del empleado a eliminar |

#### Ejemplo
```
DELETE /Api/Empleados.php?id=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Empleado eliminado exitosamente"
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

### Empleado no encontrado
```json
{
    "success": false,
    "error": "Empleado no encontrado"
}
```
