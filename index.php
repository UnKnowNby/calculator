<?php

require_once 'Calculator.php';

if (isset($_POST['distance']) && !empty($_POST['distance'])) {
    $calculator = new Calculator();
    echo 'Стоимость перевозки груза = ' . $calculator->calculate($_POST['distance']) . ' р.';
}
?>
<html>
    <head>
        <title>Калькулятор рассчета стоимости услуг</title>
    </head>
    <body>
        <form name="calculator" method="post">
            Узнать стоимость:<br/>
            <input type="number" name="distance" placeholder="Расстояние в км" min="1" />
            <input type="submit" value="Рассчитать" />
        </form>
    </body>
</html>
