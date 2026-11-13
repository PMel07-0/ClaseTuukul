<?php

test('Comprobar una suma', function () { //Definir nombre del test
   $result = 1+2; //Ejercicio (Lo que se quiere probar)
 
   expect($result)->toBe(3); //Resultado esperado
});

test('Comprobar sí una persona es mayor de edad', function(){
    $edad = 16;

    $esMayor = $edad >= 18;

    expect($esMayor)->toBeFalse();
});

test('Comprobar la cantidad de productos', function(){
    $producto=['Pan', 'Leche', 'Azúcar'];

    expect($producto)->toHaveCount(3);
});

function calcularDescuento($precio, $descuento){
    return $precio - ($precio * $descuento/100);
}

test('Calcular correctamente un descuento', function(){
    $resultado = calcularDescuento(200,10);

    expect($resultado)->toEqual(180);
});

test('Calcular descuento de estudiante', function(){
    $resultado = calcularDescuento(200,50);

    expect($resultado)->toEqual(100);
});

test('Calcular descuento de profesor', function(){
    $resultado = calcularDescuento(200,0);

    expect($resultado)->toEqual(200);
});

//Tres al mismo tiempo
test('Calcular diferentes descuentos', function($precio, $descuento, $esperado){
    $resultado = calcularDescuento($precio, $descuento);

    expect($resultado)->toEqual($esperado);
}) ->with([
    'Descuento de 10%' => [200, 10, 180],
    'Descuento de 50%' => [200, 50, 100],
    'Sin descuento' => [200, 0, 200],
]);