<!DOCTYPE html>

<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Nuevo Proveedor</title>
  </head>
<body>
    <h1>Nuevo Proveedor</h1>
    <form action="proveedor_alta.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Razón Social</label>
        <input name="razon_social" type="text" class="form-control" id="exampleInputEmail1" >
        
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">RFC</label>
        <input name="rfc" type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Domicilio</label>
        <input name="domicilio" type="text" class="form-control" id="exampleInputPassword1">
    </div>
    
    <input value="Crear" type="submit" class="btn btn-primary">
    </form>


</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
</html>

