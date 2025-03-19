<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aerolineas_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir número de reserva del formulario
 $reserva = $_POST['reserva'];

// Consultar base de datos
$sql = "SELECT * FROM reservas WHERE reserva ='$reserva'";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar detalles de la reserva
    echo '<h1 style="color: red;">Detalles de la Reserva</h1>';
    while($row = $result->fetch_assoc()) {
        // Muestra todos los datos de la reserva
        foreach ($row as $campo => $valor) {
            echo ucfirst($campo) . ": " . $valor . "<br>";
        }
    }
} else {
    echo "No se encontró ninguna reserva con ese número.";
}

// Cerrar conexión
$conn->close();
?>


