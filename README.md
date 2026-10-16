# Verde Esmeralda — Gestión de biblioteca

Aplicación PHP + MySQL con diseño responsive Esmeralda Premium.

## Funciones
- Libros: título, autor e ISBN único.
- Usuarios: cédula, nombre y teléfono.
- Préstamos: fecha, usuario, uno o varios libros, notas opcionales.
- Registro de devoluciones, búsqueda y filtro por estado.
- Panel de indicadores.
- Creación automática de las tablas `libros`, `usuarios`, `prestamos` y `prestamo_libros` si no existen.
- Consultas preparadas, protección CSRF y escapado de contenido HTML.

## Instalación
1. Sube `index.php`, `config.php`, `styles.css` y `app.js` a tu hosting PHP.
2. Confirma que la base de datos `diboweb_libreriagit` ya exista.
3. Abre `index.php`. Las tablas se crearán automáticamente si la cuenta MySQL tiene permisos suficientes.

Requisitos: PHP 8+ recomendado, extensión PDO MySQL y MySQL/MariaDB.

Nota: la aplicación crea las tablas, no la base de datos. No se ha probado la conexión al servidor remoto desde este empaquetado. Usa HTTPS en producción y no compartas `config.php`.
