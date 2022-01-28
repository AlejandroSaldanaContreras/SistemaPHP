<?php include("../view/header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-12">
                <h1><?php echo is_numeric($id_proveedor)? "Modificar Proveedor":"Nuevo Proveedor" ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-12">
                <form action="<?php echo $script; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Razón Social</label>
                        <input name="razon_social" value="<?php echo $data["razon_social"]; ?>" type="text" class="form-control" id="exampleInputEmail1" >
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">RFC</label>
                        <input name="rfc" type="text" value="<?php echo $data["rfc"]; ?>" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Domicilio</label>
                        <input name="domicilio" type="text" value="<?php echo$data["domicilio"]; ?>" class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Opinión Cumplimiento</label>
                        <input name="opinion_cumplimiento" type="file" class="form-control" id="exampleInputPassword1">
                    </div>
                    <?php
                        if(isset($id_proveedor )): 
                    ?>
                    <iframe width="500" height="500" src="proveedor.php?action=opinion_cumplimiento&id_proveedor=<?php echo $data['id_proveedor']; ?>"></iframe>
                    <?php endif; ?>        
                    <?php if(is_numeric($id_proveedor)){  ?>
                        <input type="hidden" name="id_proveedor" value="<?php echo $data["id_proveedor"]; ?>">
                    <?php } ?>    
                    <button type="submit" type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    
    
    
<?php  include("../view/footer.php") ?>