<?php include("../view/header.php") ?>
<h1>Proveedores</h1>
    <div class="container-fluid">
        <div class="row text-right">
            <div class="col col-lg-12">
                <a class="btn btn-success" href="proveedor.php?action=form" role="button">Nuevo Proveedor</a>
                <a class="btn btn-primary" href="proveedor.php?action=reporteproveedor" role="button">Reporte Proveedor</a>
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
                    <th scope="col">Proveedor</th>
                    <th scope="col">Razón Social</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Domicilio</th>
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
                        <td><?php echo $row["razon_social"]; ?></td>
                        <td><?php echo $row["rfc"]; ?></td>
                        <td><?php echo $row["domicilio"]; ?></td>
                        <td><a class="btn btn-secondary" href="proveedor.php?action=form&id_proveedor=<?php echo $row["id_proveedor"] ?>" role="button">Actualizar</a></td>
                        <td><a class="btn btn-danger" href="proveedor.php?action=delete&id_proveedor=<?php echo $row["id_proveedor"] ?>" role="button">Eliminar</a></td>
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
    
        
<?php include("../view/footer.php") ?>