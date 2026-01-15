-- =============================================
-- Script de inserción de datos para SecuenciasNumericas
-- Motor: MySQL
-- =============================================

-- Limpiar datos existentes (opcional, descomentar si es necesario)
-- DELETE FROM SecuenciasNumericas;

-- =============================================
-- Insertar secuencias para todas las tablas
-- =============================================

-- Tabla: Empresa
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Empresa', 'Empresa', 5, '-', 'EMP', 1, 1);

-- Tabla: Empleados
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Empleados', 'Empleados', 5, '-', 'EMP', 1, 1);

-- Tabla: Puestos
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Puestos', 'Puestos', 5, '-', 'PUE', 1, 1);

-- Tabla: Contratos
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Contratos', 'Contratos', 5, '-', 'CON', 1, 1);

-- Tabla: Deducciones
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Deducciones', 'Deducciones', 5, '-', 'DED', 1, 1);

-- Tabla: Conceptos
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Conceptos', 'Conceptos', 5, '-', 'CON', 1, 1);

-- Tabla: Bonos
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Bonos', 'Bonos', 5, '-', 'BON', 1, 1);

-- Tabla: Planilla
INSERT INTO SecuenciasNumericas (IdSecuencia, IdTabla, Digitos, Separador, Prefijo, Inicial, Siguiente)
VALUES ('Planilla', 'Planilla', 5, '-', 'PLA', 1, 1);

-- =============================================
-- Fin del Script
-- =============================================
