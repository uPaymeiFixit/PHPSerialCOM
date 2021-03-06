<?php

/**
 * This script sends x and y coordinates to the selected serial interface on the server rendering this script
 *
 * @author Josh Gibbs <uPaymeiFixit@gmail.com
 * @thanks RÈmy Sanchez <thenux@gmail.com> for writing serial interface class
 *
 */

echo "start php";
echo "<br/>";

//Load the serial port class
require ("php_serial.class.php");
echo "serial class aquired";
echo "<br/>";

//Initialize the class
$serial = new phpSerial();
echo "Initilized new phpSerial";
echo "<br/>";

//Specify the serial port to use
$serial -> deviceSet("/dev/tty.usbmodem1d121");
echo "deviceSet -> /dev/tty.usbmodem1d121";
echo "<br/>";

//Set the serial port parameters. The documentation says 9600
$serial -> confBaudRate(9600);
//Baud rate: 9600
echo "baud rate -> 9600";
echo "<br/>";

//open the port to communicate
$serial -> deviceOpen();
echo "serial opened";
echo "<br/>";

//communication
$serial -> sendMessage($_GET['coordinate']);
echo "sent (";
echo $_GET['coordinate'];
echo ") <br/>";

//close serial
$serial -> deviceClose();
echo "serial closed";
echo "<br/>";
?>

<html>
	<head>
		<script type="text/javascript">var _gaq=_gaq||[];_gaq.push(['_setAccount', 'UA-31002145-1']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();</script>
	</head>
	<body>
		<!--
		012343210 //Up down (5P)
		00010203041424344443424140302010 //Circle (MPX)
		00010203041011121314202122232430313233344041424344 //All lights (MPX)
		-->
		<form action="<?php $_REQUEST['self'] ?>" method="GET">
			<input type="text" name="coordinate"/>
			<input type="submit"/>
		</form>
	</body>
</html>