# Agenda GTD - Aplicación de Gestión de Grupos, Tareas y Proyectos

Este proyecto es una aplicación web desarrollada en **PHP 5** con base de datos **MySQL**, 
diseñada para administrar grupos de trabajo (mediante una llave de acceso), tareas y proyectos. 
Proporciona funcionalidades clave para la organización de equipos y el seguimiento del 
progreso en proyectos colaborativos.

---

## 📐 Arquitectura General

- **Backend:** PHP 5 (Usando)
- **Base de datos:** MySQL ó MariaDB
- **Modelo:** Aplicación monolítica (LAMP Stack)
- **Estructura:** Código procedimental o parcialmente modular
- **Persistencia:** Consultas SQL directas
- **Gestión de sesiones:** A través de `$_SESSION`

---

## 🔐 Módulo de Autenticación

- Inicio de sesión con validación de credenciales
- Control de sesiones de usuario

---

## 👥 Gestión de Usuarios y Grupos

- CRUD de usuarios
- Asignación de usuarios a grupos de trabajo
- Listado y administración de grupos

---

## 📁 Gestión de Proyectos

- Creación y edición de proyectos
- Asociación de proyectos a grupos o usuarios

---

## ✅ Gestión de Tareas

- CRUD de tareas

---

## ⚙️ Proceso de Instalación

### Requisitos

- Servidor web con **Apache**
- **PHP 5.x**
- **MySQL 5.x**
- Navegador moderno

### Pasos

1. **Clonar o descargar el repositorio** en el directorio raíz de tu servidor web (por ejemplo, `/var/www/html`):

   ```bash
   git clone https://github.com/aldomontero/Agenda-GTD.git

2. **Crear la base de datos** MySQL (por ejemplo, aldom_com_redx).

3. **Importar el archivo .sql incluido** (aldom_com_redx.sql) con la estructura y datos iniciales:

   `
  mysql -u root -p aldom_com_redx < aldom_com_redx.sql
   `

4. **Verificar permisos de carpetas** si es necesario para lectura/escritura.

5. **Acceder a la aplicación desde el navegador**, ejemplo http://localhost/tu_repositorio/:

