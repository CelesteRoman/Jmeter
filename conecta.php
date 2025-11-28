<?php
$host = "https://jmetersgut.onrender.com";
$usuario = "if0_40451170";
$contrasena = "Q4pRrb66caRH";
$bd = "if0_40451170_sgut";

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8",
        $usuario,
        $contrasena
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


// ===============================
// CARGAR CATÁLOGOS
// ===============================

// Roles
$stmt = $conexion->prepare("SELECT * FROM rol_usuario");
$stmt->execute();
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Géneros
$stmt = $conexion->prepare("SELECT * FROM genero");
$stmt->execute();
$generos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cargos
$stmt = $conexion->prepare("SELECT * FROM cargo");
$stmt->execute();
$cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Unidades Administrativas
$stmt = $conexion->prepare("SELECT * FROM unidad_administrativa");
$stmt->execute();
$unidades = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ===============================
// CARGAR USUARIOS (tabla: usuario)
// ===============================

$sql = "SELECT 
            u.*,
            r.descripcion AS rol,
            g.descripcion AS genero,
            c.nombre AS cargo,
            ua.nombre AS unidad_administrativa
        FROM usuario u
        LEFT JOIN rol_usuario r ON u.id_rol = r.id
        LEFT JOIN genero g ON u.id_genero = g.id
        LEFT JOIN cargo c ON u.id_cargo = c.id
        LEFT JOIN unidad_administrativa ua ON u.id_unidad_administrativa = ua.id";

$stmt = $conexion->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ===============================
// INSERTAR NUEVO USUARIO
// ===============================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "INSERT INTO usuario
            (nombre, apellido_paterno, apellido_materno, correo, nickname, id_rol, id_genero, id_cargo, id_unidad_administrativa)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        $_POST['nombre'],
        $_POST['apellido_paterno'],
        $_POST['apellido_materno'],
        $_POST['correo'],
        $_POST['nickname'],
        $_POST['id_rol'],
        $_POST['id_genero'],
        $_POST['id_cargo'],
        $_POST['id_unidad_administrativa']
    ]);

    header("Location: index.php");
    exit;
}
?>
