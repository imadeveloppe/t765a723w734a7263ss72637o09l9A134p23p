<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
<title>Espace prof</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/icheck/skins/minimal/blue.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/fileupload/bootstrap-fileupload.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/target-admin.css">
<!-- App CSS --> 
<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/fav-prof.png" type="image/x-icon">
<script src="<?= base_url() ?>assets/js/libs/jquery-1.10.1.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    .logout .account-logo { 
        background-color: #1373a7; 
    }
    .logout .account-logo::after { 
        border-top-color: #1373a7; 
    }
  </style>
</head>

<body class="logout">

<div class="account-wrapper">

  <div class="account-logo">
    <img src="<?= base_url() ?>assets/img/logo-login-prof.png" alt="Target Admin">
  </div>

    <div class="account-body form-login">
     <div class="loader"></div> 
      <h3 class="account-body-title">Espace Professeur</h3> 
      <div class="msg">
         Le numéro de téléphone et/ou le mot de passe sont incorrects
       </div>

      <form class="form account-form " method="POST" action="#">

        <div class="form-group">
          <label for="login-username" class="placeholder-hidden">Numéro de téléphone</label>
          <input type="tel" class="form-control" id="email" pattern="\d+" placeholder="Numéro de téléphone" tabindex="1">

        </div> <!-- /.form-group -->

        <div class="form-group">
          <label for="login-password" class="placeholder-hidden">Mot de passe</label>
          <input type="password" class="form-control" id="pwd" placeholder="Mot de passe" tabindex="2">
        </div> <!-- /.form-group -->

        <div class="form-group clearfix">
          <!-- <div class="pull-left">         
            <label class="checkbox-inline">
            <input type="checkbox" class="" value="" tabindex="3">garder la session
            </label>
          </div> -->

          <div class="pull-right">
            <a href="<?= base_url() ?>prof/forgetPwd">Mot de passe oublié ?</a>
          </div>
        </div> <!-- /.form-group -->

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="4">
            Se connecter &nbsp; <i class="fa fa-play-circle"></i>
          </button>
        </div> <!-- /.form-group -->

      </form>


    </div> <!-- /.account-body -->

    <div class="account-footer">
      <p> 
      <a href="<?= base_url() ?>prof/register" class="">Créer un compte</a>
      </p>
    </div> <!-- /.account-footer -->

  </div> <!-- /.account-wrapper -->



        

  <script src="<?= base_url() ?>assets/js/libs/jquery-1.10.1.min.js"></script>
  <script src="<?= base_url() ?>assets/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="<?= base_url() ?>assets/js/libs/bootstrap.min.js"></script>

  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->
  <!-- App JS -->
  <script src="<?= base_url() ?>assets/js/target-admin.js"></script>
  
  <!-- Plugin JS -->
  <script src="<?= base_url() ?>assets/js/target-account.js"></script> 
   <script type="text/javascript">
    $('form').submit(function(event) {
        event.preventDefault();
        $('.loader').fadeIn();
        $('.msg').slideUp();
        var formData = { 
            'email'   : $('#email').val(),
            'pwd': $('#pwd').val()
        };  
        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?= base_url() ?>prof/connecte', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'text' // what type of data do we expect back from the server 
        }).done(function(data) { 
           if( data == "true" ){
            window.location.href = "<?= base_url() ?>prof/home"
           }else{
            $('.loader').fadeOut();
            $('.msg').slideDown();
            $('#pwd').val('').focus();
           }
        }); 
    })
  </script>
</body>
</html>