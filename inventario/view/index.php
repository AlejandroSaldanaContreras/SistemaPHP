<?php include("../view/header.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-12">
                <h1>Inventarios</h1>
            </div>
        </div>

        <div class="row text-right">
            <div class="col col-lg-12">
                <a class="btn btn-success" href="inventario.php?action=form" role="button">Nuevo Inventario</a>
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
                        <th scope="col">Folio</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
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
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $row["folio"]; ?></td>
                        <td><?php echo $row["fecha"]; ?></td>
                        <td><?php echo $row["id_proveedor"]; ?></td>
                        <td><?php echo $row["id_producto"]; ?></td>
                        <td><?php echo $row["cantidad"]; ?></td>
                        <td><?php echo $row["precio_referencia"]; ?></td>

                        <td><a class="btn btn-secondary" href="cliente.php?action=form&id_cliente=<?php echo $row["id_cliente"] ?>" role="button">Actualizar</a></td>
                        <td><a class="btn btn-danger" href="cliente.php?action=delete&id_cliente=<?php echo $row["id_cliente"] ?>" role="button">Eliminar</a></td>
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

<?php include("../view/footer.php")?>