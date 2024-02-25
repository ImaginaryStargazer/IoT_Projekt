<?php

// Funkcia, ktorá prečíta konkrétnu hodnotu na pine

function readPinValue($pin) {
    return shell_exec("gpio -g read $pin");
}


// Nastavenie pinov, ktoré budeme používať

$GPIO_6 = 6;
$GPIO_13 = 13;
$GPIO_19 = 19;
$GPIO_26 = 26;



// Pole, v ktorom sú uložené hodnoty na používaných pinoch

$pinValues = array(
    readPinValue($GPIO_6),
    readPinValue($GPIO_13),
    readPinValue($GPIO_19),
    readPinValue($GPIO_26),
);


echo json_encode($pinValues);


?>