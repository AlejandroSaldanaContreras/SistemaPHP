<?php include("../view/header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-12">
                <h1><?php echo is_numeric($id_cliente)? "Modificar Cliente":"Nuevo Cliente" ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-12">
                <form action="<?php echo $script; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apellido Paterno</label>
                        <input name="apaterno" value="<?php echo $data["apaterno"]; ?>" type="text" class="form-control" >
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Apellido Materno</label>
                        <input name="amaterno" value="<?php echo $data["amaterno"]; ?>" type="text" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nombre</label>
                        <input name="nombre" value="<?php echo $data["nombre"]; ?>" type="text" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Nacimiento</label>
                        <input name="nacimiento" value="<?php echo $data["nacimiento"]; ?>" type="date" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">RFC</label>
                        <input name="rfc" type="text" value="<?php echo $data["rfc"]; ?>" class="form-control" >
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Domicilio</label>
                        <input name="domicilio" value="<?php echo $data["domicilio"]; ?>" type="text" class="form-control" >
                    </div>
                    
                    <?php if(isset($id_cliente)): ?>
                        <img class="rounded-circle" alt="100x100" src="../fotos/<?php echo $data['foto'] ?>" width="210" height="210">
                    <?php endif; ?>
                            
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Foto</label>
                        <input name="foto" value="<?php echo $data["foto"]; ?>" type="file" class="form-control" >
                    </div>

                    <?php if(is_numeric($id_cliente)){  ?>
                    <input type="hidden" name="id_cliente" value="<?php echo $data["id_cliente"]; ?>">
                    <?php } ?>    
                    <button type="submit" type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    
    

<?php include("../view/footer.php")?>