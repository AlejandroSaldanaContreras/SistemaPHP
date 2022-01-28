<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <div class="sidenav">
        <div class="login-main-text">
            <h2><br> Recuperar Contraseña </h2>
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
            <form action="login.php?action=verificarCorreo" method="POST">
                <div class="form-group">
                    <label>Correo Electronico</label>
                    <input type="email" class="form-control" name="correo" placeholder="Email">
                </div>
                
                <button type="submit" class="btn btn-black">Enviar Correo de Recuperación</button>
            </form>
        </div>
        </div>
    </div>