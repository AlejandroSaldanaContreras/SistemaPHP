<?php include("../view/header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-12">
                <h1>Nuevo Inventario</h1>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-12">
                <form action="<?php echo $script; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Folio</label>
                        <input name="folio" type="text" class="form-control" >
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fecha</label>
                        <input name="fecha"  type="date" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Proveedor</label>
                        <select name="id_proveedor" class="form-control" id="proveedor">
                            <?php foreach($data_proveedor as $prov): ?>
                            
                                
                            <option value="<?php echo $prov['id_proveedor'] ?>"> <?php echo $prov['razon_social'] ?></option>
                            
                            
                            <?php endforeach; ?>
                                
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Producto</label>
                        <select name="id_producto" class="form-control" id="proveedor">
                            <?php foreach($data_producto as $prod): ?>
                            
                                
                            <option value="<?php echo $prod['id_producto'] ?>"> <?php echo $prod['producto'] ?></option>
                            
                            
                            <?php endforeach; ?>
                                
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Cantidad</label>
                        <input name="cantidad" type="number" min="0" step=".01" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Precio</label>
                        <input name="precio_referencia" type="number" min="0" step=".01" class="form-control" >
                    </div>
                    
                    <button type="submit" type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

    </div>
<?php include("../view/footer.php")?>