<?php
//Parametros recibidos.
$moneda = $_POST['moneda'];
$fecha = $_POST['fecha'];

//Adaptando al fecha del lenguaje usuario a SQL.
$fecha_sql = explode("/", $fecha);
$fecha = $fecha_sql[2] . "/" . $fecha_sql[1] . "/" . $fecha_sql[0];

//Parametros BD.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cotizacion_supervielle";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql="SELECT compra, venta FROM cotizaciones WHERE moneda = '".$moneda."' AND fecha = '".$fecha."'";
$result = mysqli_query($conn,$sql);
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
mysqli_close($conn); // Se cierra la conexión a la base.
?>