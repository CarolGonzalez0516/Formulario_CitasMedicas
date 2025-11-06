# 🩺 Formulario_CitasMedicas

## 🚀 Pasos para abrir el proyecto en un servidor local

1. **Clonar el repositorio con Git**
   ```bash
   git clone https://github.com/CarolGonzalez0516/Formulario_CitasMedicas.git
   
2. **Crear la base de datos con las tablas**
-- Crear base de datos
```sql
CREATE DATABASE IF NOT EXISTS veterinaria;
USE veterinaria;

-- Tabla de usuarios
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de citas médicas
```sql
CREATE TABLE citas_medicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_propietario VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    nombre_mascota VARCHAR(100) NOT NULL,
    tipo_mascota VARCHAR(50),
    motivo TEXT,
    fecha DATETIME NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
