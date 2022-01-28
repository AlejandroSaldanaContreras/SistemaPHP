<?php include("../view/header.php") ?>
    <h1>Productos</h1>
    <div class="container-fluid">
        <div class="row text-right">
            <div class="col col-lg-12">
                <a class="btn btn-success" href="producto.php?action=form" role="button">Nuevo Producto</a>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-12">
                &nbsp;
            </div>
        </div>    

        <div class="row">
            <div class="col col-lg-12">
                <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th scope="col">Producto</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Actualizar</th>
                    <th scope="col">Eliminar</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach ($data as $resultado => $row) {
                    ?>
                        <tr>
                        <td>
                            <img class="rounded-circle" alt="100x100" src="../fotos/<?php echo ($row['foto'] != null)  ? $row['foto'] : 'profile.jpg'  ?>" width="70" height="70">
                        </td>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $row["producto"]; ?></td>
                        <td><?php echo $row["id_proveedor"]; ?></td>
                        <td><?php echo $row["precio"]; ?></td>
                    

                        <td><a class="btn btn-secondary" href="producto.php?action=form&id_producto=<?php echo $row["id_producto"] ?>" role="button">Actualizar</a></td>
                        <td><a class="btn btn-danger" href="producto.php?action=delete&id_producto=<?php echo $row["id_producto"] ?>" role="button">Eliminar</a></td>
                        </tr>

                    <?php
                        $i++;  
                        }
                    ?>            
                    
                </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
<?php include("../view/footer.php")?>