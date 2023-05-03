<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora montos de amortización</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!--- Declarar un Formulario -->
    <?php
	// Verificar si se ha enviado la solicitud
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Establecer el valor de las cajas de texto
		$monto = $_POST['txtMonto'];
        $periodos =  $_POST['txtPeriodos'];
        $interes =  $_POST['txtInteres'];
	} else {
		// Si no se ha enviado la solicitud, establecer valores predeterminados
		$monto = '';
        $periodos = '';
        $interes = '';
	}
	?>
    <form name="Formulario01" action="#" method="POST">
        <h3>PROCESAMIENTO DIFERENTES TIPOS DE AMORTIZACIÓN</h3>
        <p> Monto del crédito: <input type="text" name= "txtMonto" value="<?php echo $monto; ?>"></p>
        <p> Periodos de amortización: <input type="text" name= "txtPeriodos" value="<?php echo $periodos; ?>"></p>
        <p> Interés: <input type="text" name= "txtInteres" value="<?php echo $interes;?>"> % (considerar interés efectivo)</p>
        <p> Escoja un sistema de resolución </p> </p>
        <p><input type="submit" name="btnFrances" value="Frances">
            <input type="submit" name="btnAleman" value="Aleman">
            <input type="submit" name="btnIngles" value="Ingles">
            <input type="submit" name="btnFiat" value="FIAT"></p>
    </form>
    <?php
    if (isset($_POST["btnFrances"]))
    {
        $monto =  $_POST['txtMonto'];
        $periodos =  $_POST['txtPeriodos'];
        $interes =  $_POST['txtInteres']/100;
        $renta = $monto*(($interes*(1+$interes)**$periodos)/((1+$interes)**$periodos-1));
        echo "La renta constante es de ", round($renta,2);
        echo "</p>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "  <th> Periodos </th>";
        echo "  <th> Renta </th>";
        echo "  <th> Interés </th>";
        echo "  <th> Amortización </th>";
        echo "  <th> Saldo </th>";
        echo "</tr>";

        echo "<tr>";
            echo "  <td>0</td><td><td><td><td>$monto</td> ";
        echo "</tr>";
        $saldo_actual = $monto;
        for ($i = 1; $i <= $periodos; $i++) {
            echo "<tr>";
            echo "  <td> $i </td>";
            echo "  <td>", round($renta,2), "</td>";
            $monto_interes = $interes*$saldo_actual;
            echo "  <td>", round($monto_interes,2), "</td>";
            $amortizacion = $renta - $monto_interes;
            echo "  <td>", round($amortizacion,2) ,"</td>";
            $saldo_actual = $saldo_actual - $amortizacion;
            echo "  <td>", round($saldo_actual,2) ,"</td>";
            echo "</tr>";
        }
    }
    else if (isset($_POST["btnAleman"]))
    {
        $monto =  $_POST['txtMonto'];
        $periodos =  $_POST['txtPeriodos'];
        $interes =  $_POST['txtInteres']/100;
        $amortizacion = $monto/$periodos;
        echo "La amortización constante es de ", round($amortizacion,2);
        echo "</p>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "  <th> Periodos </th>";
        echo "  <th> Renta </th>";
        echo "  <th> Interés </th>";
        echo "  <th> Amortización </th>";
        echo "  <th> Saldo </th>";
        echo "</tr>";

        echo "<tr>";
            echo "  <td>0</td><td><td><td><td>$monto</td> ";
        echo "</tr>";
        $saldo_actual = $monto;
        for ($i = 1; $i <= $periodos; $i++) {
            echo "<tr>";
            echo "  <td> $i </td>";
            echo "  <td>", round($amortizacion,2), "</td>";
            $monto_interes = $interes*$saldo_actual;
            echo "  <td>", round($monto_interes,2), "</td>";
            echo "  <td>", round($amortizacion,2) ,"</td>";
            $saldo_actual = $saldo_actual - $amortizacion;
            echo "  <td>", round($saldo_actual,2) ,"</td>";
            echo "</tr>";
        }
    }
    else if (isset($_POST["btnIngles"]))
    {
        $monto =  $_POST['txtMonto'];
        $periodos =  $_POST['txtPeriodos'];
        $interes =  $_POST['txtInteres']/100;
        $monto_interes = $monto*$interes;
        echo "El interés constante es de ", round($monto_interes,2);
        echo "</p>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "  <th> Periodos </th>";
        echo "  <th> Interés </th>";
        echo "  <th> Renta </th>";
        echo "  <th> Amortización </th>";
        echo "  <th> Saldo </th>";
        echo "</tr>";

        echo "<tr>";
            echo "  <td>0</td><td><td><td><td>$monto</td> ";
        echo "</tr>";
        $saldo_actual = $monto;
        for ($i = 1; $i <= $periodos; $i++) {
            echo "<tr>";
            echo "  <td> $i </td>";
            echo "  <td>", round($monto_interes,2), "</td>";
            $amortizacion = 0;
            if ($i == $periodos)
                $amortizacion = $monto;
            $renta = $amortizacion + $monto_interes;
            echo "  <td>", round($renta,2), "</td>";
            echo "  <td>", round($amortizacion,2) ,"</td>";
            $saldo_actual = $saldo_actual - $amortizacion;
            echo "  <td>", round($saldo_actual,2) ,"</td>";
            echo "</tr>";
        }
    }
    else if (isset($_POST["btnFiat"]))
    {
        $monto =  $_POST['txtMonto'];
        $periodos =  $_POST['txtPeriodos'];
        $interes =  $_POST['txtInteres']/100;
        $monto_interes = $monto*$interes;
        echo "El interés constante es de ", round($monto_interes,2);
        echo "</p>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "  <th> Periodos </th>";
        echo "  <th> Interés </th>";
        echo "  <th> Renta </th>";
        echo "  <th> Amortización </th>";
        echo "  <th> Saldo </th>";
        echo "</tr>";

        echo "<tr>";
            echo "  <td>0</td><td><td><td><td>$monto</td> ";
        echo "</tr>";
        $saldo_actual = $monto;
        for ($i = 1; $i <= $periodos; $i++) {
            echo "<tr>";
            echo "  <td> $i </td>";
            echo "  <td>", round($monto_interes,2), "</td>";
            $amortizacion = $monto/$periodos;
            $renta = $amortizacion + $monto_interes;
            echo "  <td>", round($renta,2), "</td>";
            echo "  <td>", round($amortizacion,2) ,"</td>";
            $saldo_actual = $saldo_actual - $amortizacion;
            echo "  <td>", round($saldo_actual,2) ,"</td>";
            echo "</tr>";
        }
    }
    ?>


</body>
</html>