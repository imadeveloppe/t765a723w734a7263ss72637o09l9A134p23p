<html lang="en">

<head>
  <title>Tawassolapp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/web-app-eleve.css">
  <!-- Font Awesome File -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="login-page">
  
  <center class="container" >
      <img src="<?php echo base_url() ?>assets/img/logo.png" class="logoapp" alt="Site Logo">
  </center>
  <div class="container app">
     <form class="form account-form" method="post" action="home" style="padding: 50px; margin: 0">
          <div class="loader"></div>
          <center>
            <h3>
              Espace élève
            </h3>
          </center>  
          <div class="msg" style="text-align: center;background: #fff5c2;padding: 12px;margin: 15px 0;border: 1px solid #e8d98c;display: none;">
           Le numéro de téléphone et/ou le mot de passe sont incorrects
         </div>

          <div class="form-group">
            <label for="login-username" class="placeholder-hidden">Identifiant</label>
            <input type="text" class="form-control" id="code" placeholder="" required>

          </div> <!-- /.form-group -->

          <div class="form-group">
            <label for="login-password" class="placeholder-hidden">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="" required>
          </div> <!-- /.form-group -->
          <div class="form-group" style="margin: 0">
            <button type="submit" style="background: #19a085" class="btn btn-primary btn-block btn-lg" tabindex="4">
              Se connecter &nbsp; <i class="fa fa-play-circle"></i>
            </button>
          </div> <!-- /.form-group -->
        </form> 
  </div>

  <!-- App End -->
 

<script type="text/javascript">
    

  $(document).ready(function () {
    $('form').submit(function(event) {
        event.preventDefault();
        $('.loader').fadeIn();
        $('.msg').slideUp();
        var formData = { 
            'code'   : $('#code').val(),
            'password': $('#password').val()
        };  

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?= base_url() ?>Eleve/connecte', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'text' // what type of data do we expect back from the server 
        }).done(function(data) { 
           if( data == 1 ){
            window.location.href = "<?= base_url() ?>Eleve/home"
           }else{
            $('.loader').fadeOut();
            $('.msg').slideDown();
            $('#pwd').val('').focus();
           }
        }); 
    })
  })

</script>
</body>
</html>