<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<select name="monedas" class="letter", id="monedas">
  <option value="">Selecciona una moneda:</option>
              <option value="Real">Real</option>
              <option value="Dolar">Dolar</option>
              <option value="Euro">Euro</option>
              <option value="Libra">Libra</option>
  </select>
<input type="text" name="fecha" id="fecha">
<button type="button", id="buscar" onclick="buscar()">Buscar</button>
<br>
<div id="resultados"><b></b></div>
</body>
</html>

<script>

function buscar(){
var moneda = $("#monedas").val();
var fecha = $("#fecha").val();
$.ajax({
        url: 'buscar.php',
        type: 'POST',
        data: {'moneda': moneda, 'fecha': fecha},
        success: function(responseText) {
            document.getElementById("resultados").innerHTML = responseText;
        },
    });

}

</script>

<script>
  $( function() {
    $( "#fecha" ).datepicker();
    $( "#fecha" ).datepicker( "option", "dateFormat", "dd/mm/yy");
  } );
  </script>
