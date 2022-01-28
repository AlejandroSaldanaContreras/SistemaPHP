<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <div class="sidenav">
        <div class="login-main-text">
            <h2><br> Reestablecer Contraseña </h2>
        </div>
    </div>
    
    <?php if(!empty($mensaje)): ?>
    
    <div class="alert alert-danger" role="alert">
    <?php echo $mensaje ?>
    </div>

    <?php endif ?>
    <div class="main">
        <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <form action="login.php?action=cambiarcontrasena" method="POST">
                <div class="form-group">
                    <label>Nueva Contraseña</label>
                    <input type="password" class="form-control" name="contrasena" placeholder="Nueva Contraseña">
                </div>
                
                <button type="submit" class="btn btn-black">Enviar Correo de Recuperación</button>
                <input type="hidden" name="correo" value="<?php echo $correo; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
            </form>
        </div>
        </div>
    </div>