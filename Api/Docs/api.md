# Documentacion API Sistema de Nomina

---

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

---
---

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

---
---

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

---
---

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

---
---

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

---
---

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

---
---

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

---
---

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

---
---

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

---
---

# API Planilla

## Descripcion
API para gestionar las planillas de pago en el sistema de nomina.

## URL Base
```
/Api/Planilla.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todas las planillas
```
GET /Api/Planilla.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Planilla.php?idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdPlanilla": "PLA-00001",
            "TipoPlanilla": "Quincenal",
            "InicioPeriodo": "2024-01-01",
            "FinPeriodo": "2024-01-15",
            "FechaPago": "2024-01-16",
            "TotalEmpleados": 50,
            "TotalSalarios": "150000.00",
            "TotalDeducciones": "15000.00",
            "TotalBonificaciones": "12500.00",
            "TotalNetoPagar": "147500.00",
            "Registrada": 1,
            "FechaRegistro": "2024-01-16 10:30:00",
            "UsuarioRegistro": "admin",
            "Observaciones": "",
            "IdEmpresa": "EMP-00001"
        }
    ]
}
```

### GET - Obtener planilla por ID
```
GET /Api/Planilla.php?id={IdPlanilla}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la planilla |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/Planilla.php?id=PLA-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": {
        "IdPlanilla": "PLA-00001",
        "TipoPlanilla": "Quincenal",
        "InicioPeriodo": "2024-01-01",
        "FinPeriodo": "2024-01-15",
        "FechaPago": "2024-01-16",
        "TotalEmpleados": 50,
        "TotalSalarios": "150000.00",
        "TotalDeducciones": "15000.00",
        "TotalBonificaciones": "12500.00",
        "TotalNetoPagar": "147500.00",
        "Registrada": 1,
        "FechaRegistro": "2024-01-16 10:30:00",
        "UsuarioRegistro": "admin",
        "Observaciones": "",
        "IdEmpresa": "EMP-00001"
    }
}
```

---

### POST - Crear nueva planilla
```
POST /Api/Planilla.php
```

#### Cuerpo de la solicitud
```json
{
    "IdPlanilla": "PLA-00001",
    "TipoPlanilla": "Quincenal",
    "InicioPeriodo": "2024-01-01",
    "FinPeriodo": "2024-01-15",
    "FechaPago": "2024-01-16",
    "TotalEmpleados": 50,
    "TotalSalarios": 150000.00,
    "TotalDeducciones": 15000.00,
    "TotalBonificaciones": 12500.00,
    "TotalNetoPagar": 147500.00,
    "Registrada": 0,
    "FechaRegistro": null,
    "UsuarioRegistro": "",
    "Observaciones": "",
    "IdEmpresa": "EMP-00001"
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdPlanilla | string(20) | Si | Identificador unico de la planilla |
| TipoPlanilla | string(100) | No | Tipo de planilla (Quincenal, Mensual, etc.) |
| InicioPeriodo | date | No | Fecha de inicio del periodo |
| FinPeriodo | date | No | Fecha de fin del periodo |
| FechaPago | date | No | Fecha de pago |
| TotalEmpleados | int | No | Total de empleados en la planilla |
| TotalSalarios | decimal(18,2) | No | Suma total de salarios |
| TotalDeducciones | decimal(18,2) | No | Suma total de deducciones |
| TotalBonificaciones | decimal(18,2) | No | Suma total de bonificaciones |
| TotalNetoPagar | decimal(18,2) | No | Total neto a pagar |
| Registrada | boolean | No | Indica si la planilla esta registrada |
| FechaRegistro | datetime | No | Fecha y hora de registro |
| UsuarioRegistro | string(100) | No | Usuario que registro la planilla |
| Observaciones | string(255) | No | Observaciones adicionales |
| IdEmpresa | string(20) | No | Identificador de la empresa |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Planilla creada exitosamente",
    "id": "PLA-00001"
}
```

---

### PUT - Actualizar planilla
```
PUT /Api/Planilla.php?id={IdPlanilla}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la planilla a actualizar |

#### Cuerpo de la solicitud
```json
{
    "TipoPlanilla": "Quincenal",
    "InicioPeriodo": "2024-01-01",
    "FinPeriodo": "2024-01-15",
    "FechaPago": "2024-01-16",
    "TotalEmpleados": 52,
    "TotalSalarios": 155000.00,
    "TotalDeducciones": 15500.00,
    "TotalBonificaciones": 13000.00,
    "TotalNetoPagar": 152500.00,
    "Registrada": 1,
    "FechaRegistro": "2024-01-16 10:30:00",
    "UsuarioRegistro": "admin",
    "Observaciones": "Planilla actualizada",
    "IdEmpresa": "EMP-00001"
}
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Planilla actualizada exitosamente"
}
```

---

### DELETE - Eliminar planilla
```
DELETE /Api/Planilla.php?id={IdPlanilla}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| id | string | Si | Identificador de la planilla a eliminar |

#### Ejemplo
```
DELETE /Api/Planilla.php?id=PLA-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Planilla eliminada exitosamente"
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

### Planilla no encontrada
```json
{
    "success": false,
    "error": "Planilla no encontrada"
}
```

---
---

# API DetallePlanilla

## Descripcion
API para gestionar el detalle de las planillas por empleado.

## URL Base
```
/Api/DetallePlanilla.php
```

**Nota:** El parametro `idEmpresa` es requerido en todas las operaciones GET.

---

## Endpoints

### GET - Obtener todos los detalles por empresa
```
GET /Api/DetallePlanilla.php?idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/DetallePlanilla.php?idEmpresa=EMP-00001
```

### GET - Obtener detalles por planilla
```
GET /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/DetallePlanilla.php?idPlanilla=PLA-00001&idEmpresa=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "data": [
        {
            "IdPlanilla": "PLA-00001",
            "IdEmpleado": "EMP-00001",
            "IdContrato": "CON-00001",
            "Nombres": "Juan Carlos",
            "Apellidos": "Perez Lopez",
            "SalarioBase": "5000.00",
            "DiasTrabajados": "15.00",
            "HorasOrdinarias": "120.00",
            "HorasExtraordinarias": "10.00",
            "Ordinario": "2500.00",
            "Extraordinario": "312.50",
            "OtrosSalarios": "0.00",
            "SeptimosAsuetos": "0.00",
            "Vacaciones": "0.00",
            "TotalSalario": "2812.50",
            "DeduccionCuotaLaboralIGSS": "135.96",
            "DeduccionDescuentosISR": "0.00",
            "OtrasDeducciones": "0.00",
            "TotalDeducciones": "135.96",
            "BonificacionAnual": "0.00",
            "AguinaldoDecreto": "0.00",
            "BonificacionIncentivo": "125.00",
            "DevolucionesISR": "0.00",
            "SalarioLiquido": "2801.54",
            "Observaciones": "",
            "IdEmpresa": "EMP-00001",
            "TipoPago": "Transferencia",
            "ComprobantePago": ""
        }
    ]
}
```

### GET - Obtener historial por empleado
```
GET /Api/DetallePlanilla.php?idEmpleado={IdEmpleado}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idEmpleado | string | Si | Identificador del empleado |
| idEmpresa | string | Si | Identificador de la empresa |

#### Ejemplo
```
GET /Api/DetallePlanilla.php?idEmpleado=EMP-00001&idEmpresa=EMP-00001
```

### GET - Obtener detalle especifico
```
GET /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpleado={IdEmpleado}&idEmpresa={IdEmpresa}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpleado | string | Si | Identificador del empleado |
| idEmpresa | string | Si | Identificador de la empresa |

---

### POST - Crear nuevo detalle
```
POST /Api/DetallePlanilla.php
```

#### Cuerpo de la solicitud
```json
{
    "IdPlanilla": "PLA-00001",
    "IdEmpleado": "EMP-00001",
    "IdContrato": "CON-00001",
    "SalarioBase": 5000.00,
    "DiasTrabajados": 15.00,
    "HorasOrdinarias": 120.00,
    "HorasExtraordinarias": 10.00,
    "Ordinario": 2500.00,
    "Extraordinario": 312.50,
    "OtrosSalarios": 0.00,
    "SeptimosAsuetos": 0.00,
    "Vacaciones": 0.00,
    "TotalSalario": 2812.50,
    "DeduccionCuotaLaboralIGSS": 135.96,
    "DeduccionDescuentosISR": 0.00,
    "OtrasDeducciones": 0.00,
    "TotalDeducciones": 135.96,
    "BonificacionAnual": 0.00,
    "AguinaldoDecreto": 0.00,
    "BonificacionIncentivo": 125.00,
    "DevolucionesISR": 0.00,
    "SalarioLiquido": 2801.54,
    "Observaciones": "",
    "IdEmpresa": "EMP-00001",
    "TipoPago": "Transferencia",
    "ComprobantePago": ""
}
```

#### Campos
| Campo | Tipo | Requerido | Descripcion |
|-------|------|-----------|-------------|
| IdPlanilla | string(20) | Si | Identificador de la planilla |
| IdEmpleado | string(20) | Si | Identificador del empleado |
| IdContrato | string(20) | No | Identificador del contrato |
| SalarioBase | decimal(18,2) | No | Salario base del empleado |
| DiasTrabajados | decimal(18,2) | No | Dias trabajados en el periodo |
| HorasOrdinarias | decimal(18,2) | No | Horas ordinarias trabajadas |
| HorasExtraordinarias | decimal(18,2) | No | Horas extraordinarias trabajadas |
| Ordinario | decimal(18,2) | No | Pago por horas ordinarias |
| Extraordinario | decimal(18,2) | No | Pago por horas extraordinarias |
| OtrosSalarios | decimal(18,2) | No | Otros ingresos salariales |
| SeptimosAsuetos | decimal(18,2) | No | Pago por septimos y asuetos |
| Vacaciones | decimal(18,2) | No | Pago por vacaciones |
| TotalSalario | decimal(18,2) | No | Total de salario devengado |
| DeduccionCuotaLaboralIGSS | decimal(18,2) | No | Deduccion IGSS laboral |
| DeduccionDescuentosISR | decimal(18,2) | No | Deduccion ISR |
| OtrasDeducciones | decimal(18,2) | No | Otras deducciones |
| TotalDeducciones | decimal(18,2) | No | Total de deducciones |
| BonificacionAnual | decimal(18,2) | No | Bonificacion anual (Bono 14) |
| AguinaldoDecreto | decimal(18,2) | No | Aguinaldo |
| BonificacionIncentivo | decimal(18,2) | No | Bonificacion incentivo |
| DevolucionesISR | decimal(18,2) | No | Devoluciones de ISR |
| SalarioLiquido | decimal(18,2) | No | Salario neto a recibir |
| Observaciones | string(255) | No | Observaciones adicionales |
| IdEmpresa | string(20) | No | Identificador de la empresa |
| TipoPago | string(50) | No | Forma de pago |
| ComprobantePago | string(100) | No | Numero de comprobante |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Detalle de planilla creado exitosamente"
}
```

---

### PUT - Actualizar detalle
```
PUT /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpleado={IdEmpleado}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpleado | string | Si | Identificador del empleado |

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Detalle de planilla actualizado exitosamente"
}
```

---

### DELETE - Eliminar detalle
```
DELETE /Api/DetallePlanilla.php?idPlanilla={IdPlanilla}&idEmpleado={IdEmpleado}
```

#### Parametros
| Parametro | Tipo | Requerido | Descripcion |
|-----------|------|-----------|-------------|
| idPlanilla | string | Si | Identificador de la planilla |
| idEmpleado | string | Si | Identificador del empleado |

#### Ejemplo
```
DELETE /Api/DetallePlanilla.php?idPlanilla=PLA-00001&idEmpleado=EMP-00001
```

#### Respuesta exitosa
```json
{
    "success": true,
    "message": "Detalle eliminado exitosamente"
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

### Detalle no encontrado
```json
{
    "success": false,
    "error": "Detalle no encontrado"
}
```

---
---

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
