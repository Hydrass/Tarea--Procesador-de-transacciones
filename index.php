<?php 
include_once("datos.php");
$file = array();

$obj = new Datos();

if(is_file('datos.dat')){
    $json = file_get_contents("datos.dat");
    $file = json_decode($json, true);
}


if(isset($_POST['crear_json'])){
    $txtHora = $_POST["txtHora"];
    $txtFecha = $_POST["txtFecha"];
    $txtMonto = $_POST["txtMonto"];
    $txtDescripcion = $_POST["txtDescripcion"];
    
    $datos_nuevos = array('Hora' => $txtHora, 'Fecha' => $txtFecha, 'Monto' => $txtMonto, 'Descripcion' => $txtDescripcion);

    $file[] = $datos_nuevos;
    $json = json_encode($file);
    file_put_contents("datos.dat",$json);
    $obj->creacionSerializacion($file);
}

if(isset($_POST['serializacion'])){
    $obj->creacionSerializacion($file);
}

if(isset($_POST['json'])){
    header('Location: http://localhost/TareaTransacion/json.php');
}
if(isset($_POST['subirCSV'])){
    header('Location: http://localhost/TareaTransacion/csv.php');
}

if(isset($_POST['descargarJSON'])){
    $obj->descargarJSON($file);
}

if(isset($_POST['descargarCSV'])){
    $obj->descargarCSV($file);
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Procesador de transacciones</title>
  </head>
  <body>

  <div class="container">
    <h1 class="p-5 text-center">Procesador de transacciones</h1>

    <form action="" method="post">
            <!-- Row -->
            <div class="form-row">
                <!-- Columna -->
                <div class="col-md-6">
                    
                    <div class="form-row p-2">
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="hora">Hora</span>
                            </div>
                            <input type="time" class="form-control" placeholder="hora" name="txtHora">
                        </div>
                    </div>

                    <div class="form-row p-2">
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="monto">Monto</span>
                            </div>
                            <input type="number" class="form-control" placeholder="monto" name="txtMonto">
                        </div>
                    </div>
    
                </div>

                <div class="col-md-6">
                    
                    <div class="form-row p-2">
                        <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="fecha">Fecha</span>
                                </div>
                                <input type="date" class="form-control" name="txtFecha">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    
                        <label for="txtDescripcion">Descripción </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="txtDescripcion" rows="3" placeholder="Porque realizo esta transacción"></textarea>
                    </div>
                </div>



                <div class="form-group pt-3">
                     <button class="btn btn-primary btn-sm" name="crear_json">Subir</button>
                     <button class="btn btn-warning btn-sm" name="json">JSON</button>
                     <button class="btn btn-warning btn-sm" name="serializacion">SERIALIZE </button>
                     <button class="btn btn-success btn-sm" name="subirCSV">CSV</button>

                     <button class="btn btn-warning btn-sm" name="descargarJSON">Descargar en JSON</button>
                     <button class="btn btn-success btn-sm" name="descargarCSV">Descargar en CSV</button>
                </div>
            </div>
    </form>


    <div class="container">
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Hora</th>
                <th scope="col">Fecha</th>
                <th scope="col">Monto</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>

        <tbody>
            <?php 
 foreach ($file as $datos_nuevo){
    echo "
    <tr>
         <td>{$datos_nuevo['Hora']}</td>
         <td>{$datos_nuevo['Fecha']}</td>
         <td>{$datos_nuevo['Monto']}</td>
         <td>{$datos_nuevo['Descripcion']}</td>
         <td>
            <button class='btn btn-primary btn-sm'>Edit</button>
            <button class='btn btn-danger btn-sm'>Edit</button>
        </td>
    </tr>
    ";
}
            ?>
        </tbody>
    </div>
</di>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>