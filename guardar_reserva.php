<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aerolineas_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$documento = $_POST['documento'];
$destino = $_POST['destino'];
$aerolinea = $_POST['aerolinea'];
$horario = $_POST['horario'];
$tipo_vuelo = $_POST['tipo_vuelo'];
$pasajeros = (int)$_POST['pasajeros'];
$tipo_tarjeta = $_POST['tipo_tarjeta'];
$menu = $_POST['comida'];
$idaVuelta = $_POST['idaVuelta'];
$aeropuerto = $_POST['aeropuerto'];

if ($idaVuelta == 'solo_ida') {
    // Solo necesitamos la fecha de salida
    $fecha_salida = $_POST["fecha_salida"];
    if (empty($fecha_salida)) {
        echo "Fecha de vuelo: " . $fecha_salida;
    } else {
        // Procesar la reserva solo de ida
        $detalle = "Vuelo reservado para la fecha: " . $fecha_salida;
    }
} elseif ($idaVuelta == 'ida_vuelta') {
    // Necesitamos ambas fechas
    $fecha_salida = $_POST["fecha_salida"];
    $fecha_regreso = $_POST["fecha_regreso"];
    if (empty($fecha_salida) || empty($fecha_regreso)) {//or
        $detalle = "Vuelva a ingresar, faltó seleccionar una fecha.";
    } else {
        $detalle = "Fecha de salida: " . $fecha_salida . ". Fecha de regreso: " . $fecha_regreso;//para mostrar los dos lo podemos hacer separado
    }
}

// Inicializa el precio base
$precio_base = 0;

// Calcula el precio base según el tipo de vuelo y el tipo de viaje
if ($idaVuelta == 'ida_vuelta') {
    $precio_base = ($tipo_vuelo == 'Económica') ? 800 : (($tipo_vuelo == 'Ejecutiva') ? 1000 : 1200);
} elseif ($idaVuelta == 'solo_ida') {
    $precio_base = ($tipo_vuelo == 'Económica') ? 400 : (($tipo_vuelo == 'Ejecutiva') ? 500 : 600);
}

// Multiplica por el número de pasajeros si el precio_base es mayor a 0
if ($precio_base > 0 && $pasajeros > 0) {//&& and
    $precio_total = $precio_base * $pasajeros;
    //echo "El precio total para $pasajeros pasajero(s) es: $" . $precio_total;
} else {
    echo "Error: Verifica los datos ingresados.";
}


// Genera un número de reserva aleatorio
$reserva = rand(1000, 9999);

// Insertar datos en la base de datos
$sql = "INSERT INTO reservas (reserva, nombre, apellido, email, telefono, documento, destino, aerolinea, tipo_vuelo, menu, horario, idaVuelta, pasajeros,detalle, precio_total, tipo_tarjeta) 
        VALUES ('$reserva','$nombre', '$apellido', '$email', '$telefono', '$documento', '$destino', '$aerolinea', '$tipo_vuelo', '$menu', '$horario', '$idaVuelta', '$pasajeros', '$detalle','$precio_total', '$tipo_tarjeta')";

if ($conn->query($sql) === TRUE) {
    echo '<h1 style="color: red;">Detalles de la Reserva</h1>' . "<br>";    
    echo "Nombre: " . $nombre . "<br>";
    echo "Apellido: " . $apellido . "<br>";
    echo "Correo electrónico: " . $email . "<br>";
    echo "Número de reserva: " . $reserva . "<br>";
    echo "Teléfono: " . $telefono . "<br>";
    echo "DNI o Pasaporte: " . $documento . "<br>";
    echo "Destino: " . $aeropuerto . " - " . $destino . "<br>";
    echo "Compañía Aérea: " . $aerolinea . "<br>";
    echo "Tipo de vuelo: " . $tipo_vuelo . "<br>";
    echo "Usted eligió el menú: " . $menu . "<br>";
    echo "Horario de salida: " . $horario . "<br>";
    echo "Tipo de reserva: " . $idaVuelta . "<br>";
    echo "Fecha de reserva: " . $detalle . "<br>";
    echo "Cantidad de pasajeros: " . $pasajeros . "<br>";
    echo "Precio total: USD " . $precio_total . "<br>";
    echo "Tipo de tarjeta: " . $tipo_tarjeta . "<br>";
    
    echo "<br><br><strong>Un correo de confirmación ha sido enviado a su dirección de correo.</strong>";
    echo "<p>Por favor, verifique su bandeja de entrada para más detalles y para responder nuestra encuesta de satisfacción.</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


