<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$host='mysql-diboweb.alwaysdata.net'; $db='diboweb_libreriagit'; $user='diboweb'; $pass='Gol123456*';
try {
 $pdo=new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4",$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]);
 $pdo->exec("CREATE TABLE IF NOT EXISTS libros(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,titulo VARCHAR(200) NOT NULL,autor VARCHAR(160) NOT NULL,isbn VARCHAR(30) NOT NULL UNIQUE,creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,INDEX(titulo),INDEX(autor)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
 $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios(cedula VARCHAR(30) PRIMARY KEY,nombre VARCHAR(160) NOT NULL,telefono VARCHAR(30) NOT NULL,creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,INDEX(nombre)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
 $pdo->exec("CREATE TABLE IF NOT EXISTS prestamos(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,usuario_cedula VARCHAR(30) NOT NULL,fecha_prestamo DATE NOT NULL,fecha_devolucion DATE NULL,estado ENUM('Activo','Devuelto') NOT NULL DEFAULT 'Activo',notas VARCHAR(500) NULL,creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,INDEX(fecha_prestamo),INDEX(estado),CONSTRAINT fk_prestamo_usuario FOREIGN KEY(usuario_cedula) REFERENCES usuarios(cedula) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
 $pdo->exec("CREATE TABLE IF NOT EXISTS prestamo_libros(prestamo_id INT UNSIGNED NOT NULL,libro_id INT UNSIGNED NOT NULL,PRIMARY KEY(prestamo_id,libro_id),CONSTRAINT fk_detalle_prestamo FOREIGN KEY(prestamo_id) REFERENCES prestamos(id) ON DELETE CASCADE,CONSTRAINT fk_detalle_libro FOREIGN KEY(libro_id) REFERENCES libros(id) ON DELETE RESTRICT) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
} catch(PDOException $ex) { $dbError=$ex->getMessage(); }
function e($v):string{return htmlspecialchars((string)$v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
function token():string{if(empty($_SESSION['csrf']))$_SESSION['csrf']=bin2hex(random_bytes(32));return $_SESSION['csrf'];}
function check_token():void{if(!hash_equals($_SESSION['csrf']??'',$_POST['csrf']??''))throw new RuntimeException('Sesión vencida. Recarga la página.');}
