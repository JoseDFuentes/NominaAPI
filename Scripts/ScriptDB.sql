-- =============================================
-- Script de creación de base de datos para Sistema de Nómina
-- Motor: MySQL
-- =============================================

-- Crear la base de datos (opcional, descomentar si es necesario)
-- CREATE DATABASE IF NOT EXISTS NominaDB;
-- USE NominaDB;

-- =============================================
-- Tabla: Empresa
-- =============================================
CREATE TABLE IF NOT EXISTS Empresa (
    IdEmpresa VARCHAR(20) NOT NULL,
    Nombre VARCHAR(255),
    RazonSocial VARCHAR(255),
    NIT VARCHAR(40),
    IGSSPatronal VARCHAR(40),
    Direccion VARCHAR(255),
    Telefono VARCHAR(50),
    PRIMARY KEY (IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Empleados
-- =============================================
CREATE TABLE IF NOT EXISTS Empleados (
    IdEmpleado VARCHAR(20) NOT NULL,
    Nombres VARCHAR(255),
    Apellidos VARCHAR(255),
    Genero VARCHAR(50),
    EstadoCivil VARCHAR(50),
    Nacionalidad VARCHAR(50),
    TipoIdentificacion VARCHAR(40),
    NoIdentificacion VARCHAR(25),
    NIT VARCHAR(20),
    Direccion VARCHAR(255),
    Telefono1 VARCHAR(50),
    Telefono2 VARCHAR(50),
    CorreoElectronico VARCHAR(50),
    Contacto VARCHAR(100),
    Observaciones VARCHAR(255),
    AfiliacionIGSS VARCHAR(40),
    Banco VARCHAR(100),
    NoCuentaBanco VARCHAR(50),
    TipoCuentaBanco VARCHAR(50),
    IdEmpresa VARCHAR(20),
    Activo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (IdEmpleado),
    CONSTRAINT FK_Empleados_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Puestos
-- =============================================
CREATE TABLE IF NOT EXISTS Puestos (
    IdPuesto VARCHAR(20) NOT NULL,
    SalarioBase DECIMAL(18,2),
    Activo BOOLEAN DEFAULT TRUE,
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdPuesto),
    CONSTRAINT FK_Puestos_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Contratos
-- =============================================
CREATE TABLE IF NOT EXISTS Contratos (
    IdContrato VARCHAR(20) NOT NULL,
    IdEmpleado VARCHAR(20),
    IdPuesto VARCHAR(20),
    FechaInicio DATE,
    FechaFinal DATE,
    TipoContrato INT,
    SalarioBase DECIMAL(18,2),
    DiasMes INT,
    DiasQuincena INT,
    DiasSemana INT,
    HorasDiarias INT,
    Observaciones VARCHAR(255),
    Activo BOOLEAN DEFAULT TRUE,
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdContrato),
    CONSTRAINT FK_Contratos_Empleado FOREIGN KEY (IdEmpleado) REFERENCES Empleados(IdEmpleado),
    CONSTRAINT FK_Contratos_Puesto FOREIGN KEY (IdPuesto) REFERENCES Puestos(IdPuesto),
    CONSTRAINT FK_Contratos_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Deducciones
-- =============================================
CREATE TABLE IF NOT EXISTS Deducciones (
    IdDeducciones VARCHAR(20) NOT NULL,
    PorcentajeDeduccion DECIMAL(18,4),
    DeduccionFijo DECIMAL(18,2),
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdDeducciones),
    CONSTRAINT FK_Deducciones_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Conceptos
-- =============================================
CREATE TABLE IF NOT EXISTS Conceptos (
    IdConcepto VARCHAR(20) NOT NULL,
    PorcentajeConcepto DECIMAL(18,4),
    ConceptoFijo DECIMAL(18,2),
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdConcepto),
    CONSTRAINT FK_Conceptos_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Bonos
-- =============================================
CREATE TABLE IF NOT EXISTS Bonos (
    IdBono VARCHAR(20) NOT NULL,
    Descripcion VARCHAR(100),
    PorcentajeSalario DECIMAL(18,4),
    BonoFijo DECIMAL(18,2),
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdBono),
    CONSTRAINT FK_Bonos_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: ContratosConceptos (Tabla intermedia)
-- =============================================
CREATE TABLE IF NOT EXISTS ContratosConceptos (
    IdContrato VARCHAR(20) NOT NULL,
    IdConcepto VARCHAR(20) NOT NULL,
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdContrato, IdConcepto),
    CONSTRAINT FK_ContratosConceptos_Contrato FOREIGN KEY (IdContrato) REFERENCES Contratos(IdContrato),
    CONSTRAINT FK_ContratosConceptos_Concepto FOREIGN KEY (IdConcepto) REFERENCES Conceptos(IdConcepto),
    CONSTRAINT FK_ContratosConceptos_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: ContratosDeducciones (Tabla intermedia)
-- Nota: En la especificación dice IdConcepto pero debería ser IdDeducciones
-- =============================================
CREATE TABLE IF NOT EXISTS ContratosDeducciones (
    IdContrato VARCHAR(20) NOT NULL,
    IdDeducciones VARCHAR(20) NOT NULL,
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdContrato, IdDeducciones),
    CONSTRAINT FK_ContratosDeducciones_Contrato FOREIGN KEY (IdContrato) REFERENCES Contratos(IdContrato),
    CONSTRAINT FK_ContratosDeducciones_Deduccion FOREIGN KEY (IdDeducciones) REFERENCES Deducciones(IdDeducciones),
    CONSTRAINT FK_ContratosDeducciones_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: Planilla
-- =============================================
CREATE TABLE IF NOT EXISTS Planilla (
    IdPlanilla VARCHAR(20) NOT NULL,
    TipoPlanilla VARCHAR(100),
    InicioPeriodo DATE,
    FinPeriodo DATE,
    FechaPago DATE,
    TotalEmpleados INT,
    TotalSalarios DECIMAL(18,2),
    TotalDeducciones DECIMAL(18,2),
    TotalBonificaciones DECIMAL(18,2),
    TotalNetoPagar DECIMAL(18,2),
    Registrada BOOLEAN DEFAULT FALSE,
    FechaRegistro DATETIME,
    UsuarioRegistro VARCHAR(100),
    Observaciones VARCHAR(255),
    IdEmpresa VARCHAR(20),
    PRIMARY KEY (IdPlanilla),
    CONSTRAINT FK_Planilla_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: DetallePlanilla
-- =============================================
CREATE TABLE IF NOT EXISTS DetallePlanilla (
    IdPlanilla VARCHAR(20) NOT NULL,
    IdEmpleado VARCHAR(20) NOT NULL,
    IdContrato VARCHAR(20),
    SalarioBase DECIMAL(18,2),
    DiasTrabajados DECIMAL(18,2),
    HorasOrdinarias DECIMAL(18,2),
    HorasExtraordinarias DECIMAL(18,2),
    Ordinario DECIMAL(18,2),
    Extraordinario DECIMAL(18,2),
    OtrosSalarios DECIMAL(18,2),
    SeptimosAsuetos DECIMAL(18,2),
    Vacaciones DECIMAL(18,2),
    TotalSalario DECIMAL(18,2),
    DeduccionCuotaLaboralIGSS DECIMAL(18,2),
    DeduccionDescuentosISR DECIMAL(18,2),
    OtrasDeducciones DECIMAL(18,2),
    TotalDeducciones DECIMAL(18,2),
    BonificacionAnual DECIMAL(18,2),
    AguinaldoDecreto DECIMAL(18,2),
    BonificacionIncentivo DECIMAL(18,2),
    DevolucionesISR DECIMAL(18,2),
    SalarioLiquido DECIMAL(18,2),
    Observaciones VARCHAR(255),
    IdEmpresa VARCHAR(20),
    TipoPago VARCHAR(50),
    ComprobantePago VARCHAR(100),
    PRIMARY KEY (IdPlanilla, IdEmpleado),
    CONSTRAINT FK_DetallePlanilla_Planilla FOREIGN KEY (IdPlanilla) REFERENCES Planilla(IdPlanilla),
    CONSTRAINT FK_DetallePlanilla_Empleado FOREIGN KEY (IdEmpleado) REFERENCES Empleados(IdEmpleado),
    CONSTRAINT FK_DetallePlanilla_Contrato FOREIGN KEY (IdContrato) REFERENCES Contratos(IdContrato),
    CONSTRAINT FK_DetallePlanilla_Empresa FOREIGN KEY (IdEmpresa) REFERENCES Empresa(IdEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Tabla: SecuenciasNumericas
-- =============================================
CREATE TABLE IF NOT EXISTS SecuenciasNumericas (
    IdSecuencia VARCHAR(20) NOT NULL,
    IdTabla VARCHAR(100),
    Digitos INT,
    Separador VARCHAR(5),
    Prefijo VARCHAR(10),
    Inicial INT,
    Siguiente INT,
    PRIMARY KEY (IdSecuencia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Fin del Script
-- =============================================
