<?php include("../view/header.php") ?>
    <h1>Clientes</h1>
    <div class="container-fluid">
        <div class="row text-right">
            <div class="col col-lg-12">
                <a class="btn btn-success" href="cliente.php?action=form" role="button">Nuevo Cliente</a>
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
                    <th scope="col">Cliente</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nacimiento</th>
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
                        <td>
                            <img class="rounded-circle" alt="100x100" src="../fotos/<?php echo ($row['foto'] != null)  ? $row['foto'] : 'profile.jpg'  ?>" width="70" height="70">
                        </td>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $row["apaterno"]; ?></td>
                        <td><?php echo $row["amaterno"]; ?></td>
                        <td><?php echo $row["nombre"]; ?></td>
                        <td><?php echo $row["nacimiento"]; ?></td>
                        <td><?php echo $row["rfc"]; ?></td>
                        <td><?php echo $row["domicilio"]; ?></td>

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

    </div>
    
        

<?php include("../view/footer.php")?>
