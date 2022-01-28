<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="sidenav">
         <div class="login-main-text">
            <h2><br> Inicio de Sesion </h2>
            <p>Login or register from here to access.</p>
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
               <form action="login.php?action=validate" method="POST">
                  <div class="form-group">
                     <label>Correo Electronico</label>
                     <input type="email" class="form-control" name="correo" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <label>Contraseña</label>
                     <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
                  </div>
                  <button type="submit" class="btn btn-black">Iniciar Sesion</button>
                  <a href="login.php?action=recuperar" class="btn btn-default">Recuperar Contraseña</a>
               </form>
            </div>
         </div>
      </div>