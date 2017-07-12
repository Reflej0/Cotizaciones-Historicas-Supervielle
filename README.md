# Cotizaciones-Historicas-Supervielle
Ejemplo de como crear un sitio web que guarde las cotizaciones historicas de las distintas monedas.

# Resumen
El ejemplo utiliza la información del banco Supervielle, el cual provee la cotización cada día de distintas monedas, pero no guarda un histórico.  
La misión es crear una web donde la información de las distintas monedas se extraiga de la página web del banco y se almacene en una base de datos.  

# SQL
Por la parte de SQL se mantiene una sola base de datos llamada cotizacion_supervielle, la cual contiene una sola tabla con los siguientes campos.  
fecha, Formato: DATE.  
moneda, Formato: VARCHAR.  
compra, Formato: FLOAT.  
venta, Formato: FLOAT.  
La tabla contiene como clave primaria a los campos fecha y moneda. Es decir se admite un valor de compra y venta por dia de una moneda.  
Además se incluye un trigger, que a cada registro agregado le define la fecha, dado que el campo DATE no admite CURRENT_TIMESTAMP.

# PHP
Por la parte de PHP, se incluyen 3 archivos.  
Update.php: Este archivo se debe (mediante alguna optimización) ejecutar tan solo una vez por día.  
Obtiene las cotizaciones del sitio https://personas.supervielle.com.ar/Pages/QuotesPanel/QuotesCoins.aspx  
Index.php: Ofrece una mínima interfaz para seleccionar la moneda y la fecha para consultar la cotización histórica.  
Buscar.php: Realiza la consulta de búsqueda del index, es decir Index->Llamada de Ajax->Buscar

# Contacto 
Cualquier contacto, realizarlo mediante issues.
