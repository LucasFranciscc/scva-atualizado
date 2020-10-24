<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/res/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/res/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>SCVA</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <?php if( $userError != '' ){ ?>
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i>Aviso</h5>
        <?php echo htmlspecialchars( $userError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
      </div>
      <?php } ?>

      <p class="login-box-msg"> Faça login para iniciar sua sessão</p>

      <form action="/" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="registration" placeholder="Usuário" value="<?php echo htmlspecialchars( $registerValueLogin["registration"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

<!--      <div class="social-auth-links text-center mb-3">-->
<!--        <p>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>-->
<!--      </div>-->
<!--      &lt;!&ndash; /.social-auth-links &ndash;&gt;-->

<!--      <p class="mb-1">-->
<!--        <a href="forgot-password.html"> Esqueci a minha senha</a>-->
<!--      </p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/res/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/res/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/res/dist/js/adminlte.min.js"></script>

</body>
</html>
