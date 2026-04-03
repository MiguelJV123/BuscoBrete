<?php
/*Aquí viene a caer todo por default al entrar al sitio web
Con este require de linea 5 es que se asigna el controlador que lo va a arrancar
*/
require_once __DIR__ . '/app/controllers/TestController.php';
/*Entonces se crea el objeto de la ruta que se le dio y con
$controller->index(); se accede al metodo y este por default 
abre la vista que le decimos en el index
*/
$controller = new TestController();
$controller->index();







