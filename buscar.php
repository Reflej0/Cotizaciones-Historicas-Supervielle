<?php
//Parametros recibidos.
$moneda = $_POST['moneda'];
$fecha = $_POST['fecha'];

//Adaptando la fecha del lenguaje usuario a SQL.
$fecha_sql = explode("/", $fecha);
$fecha = $fecha_sql[2] . "/" . $fecha_sql[1] . "/" . $fecha_sql[0];

//Parametros BD.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cotizacion_supervielle";

// Estableciendo los parámetros de conexión a la base de datos.
$conexion = mysqli_connect($servername, $username, $password, $dbname);

/*	Utilizando el escapeo de caracteres nativo de PHP, para evitar inyeccion SQL.
	Adicionalmente se podría utilizar una vista o un stored procedure en la BD.
*/
$moneda_safe = mysqli_real_escape_string($conexion, $moneda);
$fecha_safe = mysqli_real_escape_string($conexion, $fecha);

//Estableciendo los parámetros de consulta a la base de datos.

$sql="SELECT compra, venta FROM cotizaciones WHERE moneda = '".$moneda_safe."' AND fecha = '".$fecha_safe."'";
$result = mysqli_query($conexion,$sql);

//Se imprime visualmente una tabla con la información.
echo "<table> 
<tr>
<th>Compra</th>
<th>Venta</th>
</tr>";

while($row = mysqli_fetch_array($result)) { // Se imprime agrupado en tablas la informacion de la base de datos.
    echo "<tr>";
    echo "<td>" . $row['compra'] . "</td>";
    echo "<td>" . $row['venta'] . "</td>";
    echo "</tr>";
}
echo "</table>"; // Se cierra la tabla.
mysqli_close($conexion); // Se cierra la conexión a la base.
?>
