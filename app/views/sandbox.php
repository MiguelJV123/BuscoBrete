<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscoBrete - SandBox</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Inter font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-dark a white-text">
    <h1 class="titulares">BuscoBrete</h1>
    <div class="mt-3 col-3">
        <a style="font-size: 20px;" href="<?= BASE_URL ?>/app/views/home.php">Ir al inicio</a>


        <?php echo $_SERVER['DOCUMENT_ROOT'];    ?>
        <?php echo __DIR__;    ?>
        <!-- Para que un boton ejecute una accion tiene que pasar por un metodo POST o getAll
        La forma más cómoda y sencillo que encontré es mediante un form y darle el 
        atributo type='submit' al boton para que ejecute el metodo
        el atributo name del boton es el valor que se pasará meiante el POST -->
        <form method="POST">
            <input type="hidden" name="option" value="getAll">
            <button type="submit" name="hola" class="btn btn-primary">
                Hola Mundo
            </button>
        </form>

        <form method="POST">
            <input type="hidden" name="option" value="getAll">
            <button type="submit" name="adios" class="btn btn-primary">
                Adios Mundo
            </button>
        </form>

        <form method="POST">
            <input type="hidden" name="option" value="getAll">
            <button type="submit" name="cargar" class="btn btn-primary">
                Cargar Mundo
            </button>
        </form>


        <!--Aqui probe varias formas de hacer funcionar la logica php bien en medio de html 
    con solo poner < ? para abrir y ?> para cerrar funciona entonces se logra mezclar bien
    -->
        <? if (isset($_POST['hola'])) {
            echo "<h1 id='mensaje' style='color: white'>Hola Mundo</h1>";
        } ?>

        <!-- En estos if basicamente estan esperando escuchar el boton respectivo,
     segun sea 'hola', 'adios' o 'cargar'-->
        <? if (isset($_POST['adios'])) {
            echo "<h1 id='mensaje' style='color: white'>Adios Mundo</h1>";
        } ?>
        <!-- Aqui si se recibe el POST cargar entonces  prepara una tabla
    y procede a cargarla con la informacion de nuestra base de datos
    
    Algo que me costo mucho entender es porque solo poner $nombres funcionaba, es porque en el
    index del controller se creo esta variable que trae el resultado del query sacado del modelo

    Ademas en el mismo index del controller se le dijo que iba a usar esta ruta de este .php,
    es asi como logra acceder a esta informacion.
-->
        <? if (isset($_POST['cargar'])) { ?>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($nombres as $n) { ?>
                        <tr>
                            <td><?= $n['id'] ?></td>
                            <td><?= $n['nombre'] ?></td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        <? } ?>


</body>
<footer>
    <div class="mt-3">
        <h3 id="derechosFooter">Todos los derechos reservados</h3>
    </div>

    <script src="../../public/js/script.js"></script>
</footer>