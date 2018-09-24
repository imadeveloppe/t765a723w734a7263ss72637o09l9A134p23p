<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd"> 
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
<title><?= $title ?></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/js/plugins/icheck/skins/minimal/blue.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/js/plugins/fileupload/bootstrap-fileupload.css">

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/sweet-alert/sweetalert.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/target-admin.css">
<!-- App CSS --> 
<script src="<?= base_url() ?>/assets/js/libs/jquery-1.10.1.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

</head>

<body>

<div class="account-wrapper"> 

  <div class="account-logo">
    <img src="<?= base_url() ?>/assets/img/logo-login.png" alt="Target Admin">
  </div>


    <div class="account-body">
    <div class="loader"></div>
      <h3 class="account-body-title">Inscrivez-vous pour profiter de ce service</h3> 

      <form action="<?= base_url() ?>Administration/addCentre" class="form account-form register-form" method="post">

        <div class="form-group">
          <label for="code" class="placeholder-hidden">Code d'inscription</label>
          <input type="text" class="form-control required" id="code" name="code" placeholder="Code d'inscription" minlength="5">
          <span class="error">Code invalide</span>
        </div> <!-- /.form-group -->
        <div class="next-step"> 

          <div class="form-group">
            <label for="signup-fullname" class="placeholder-hidden">Etablissement</label>
            <input type="text" class="form-control required" name="nom" placeholder="Etablissement" tabindex="2" >
          </div> <!-- /.form-group -->

          <div>
              <strong>Niveaux enseignés</strong>
                <div class="form-group">

                  <div class="checkbox">
                    <label>
                        <input type="checkbox" name="niveau[]" value ="0" checked>
                        Préscolaire
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                        <input type="checkbox" name="niveau[]" value ="1" checked>
                        primaire
                    </label>
                  </div>
                  
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="niveau[]" value ="2" checked>
                      Collège
                    </label>
                  </div>
                  
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="niveau[]" value ="3" checked>
                      Lycée
                    </label>
                  </div>
              </div> <!-- /.form-group -->

            </div> <!-- /.col -->

          <div class="form-group">
            <label for="signup-fullname" class="placeholder-hidden">Ville</label>
            <select class="form-control required" name="ville">
              <option value="">Choisir une ville</option>
              <?php foreach ($villes as $key => $ville) : ?>
                <option value="<?= $ville->id ?>"><?= $ville->intitule ?></option>
              <?php endforeach; ?>
            </select>
          </div> <!-- /.form-group -->
          <div class="form-group">
            <label for="signup-username" class="placeholder-hidden">Adresse</label>
            <input type="text" class="form-control" name="adress" id="adress" placeholder="Adresse">
          </div> <!-- /.form-group --> 
          <div class="form-group" style="position: relative;margin-bottom: 14px;">
            <label for="signup-username" class="placeholder-hidden">Adresse e-mail</label>
            <input type="text" class="form-control" name="tel" id="tel" placeholder="Adresse e-mail" style="margin-bottom: 4px;">
            <em style="font-size: 12px; color: rgb(173, 165, 165);">Cette adresse e-mail vous aide à recupérer votre mot de passe</em>
            <label style="font-weight: normal;
                          color: rgb(255, 0, 0);
                          font-size: 11px;
                          bottom: -17px;
                          margin: 0px; 
                          font-style: italic;
                          margin-left: 2px;
                          display: none;
                          width: 100%;" class="tel-existe">
            Cette adresse e-mail est déjà utilisée
            </label>
          </div> <!-- /.form-group --> 
          
          <div class="form-group" style="margin-bottom: 23px;">
            <label for="signup-username" class="placeholder-hidden">Numéro de téléphone</label>
            <input type="tel" class="form-control required" name="email" id="email" placeholder="Numéro de téléphone" tabindex="3" pattern="\d+" >
            <label style="font-weight: normal; color: red; font-size: 11px; bottom: -17px; margin: 0px; position: absolute; font-style: italic;margin-left: 2px; display: none;" class="mail-existe">Ce numéro de téléphone existe déjà</label>
          </div> <!-- /.form-group --> 

           <div class="form-group">
            <label for="login-password" class="placeholder-hidden">Mot de passe</label>
            <input type="password" class="form-control required" id="pwd" name="pwd" placeholder="Mot de passe" >
          </div> <!-- /.form-group --> 
          <div class="form-group" style="margin-bottom: 14px;">
            <label for="login-password" class="placeholder-hidden">Confirmez votre mot de passe</label>
            <input type="password" class="form-control required" id="pwd-confirm" name="pwd-confirm" placeholder="Confirmez votre mot de passe" style="margin-bottom: 4px;">
            <em style="font-size: 12px; color: rgb(255, 81, 0);display: none;" class="confirm-pwd-text">Mots de passe non identiques</em>
          </div> <!-- /.form-group --> 

          <p>
            En cliquant sur S'INSCRIRE, vous acceptez nos <a data-toggle="modal" href="#cgu">Conditions d'utilisation</a> et notre <a data-toggle="modal" href="#pdc">Politique de confidentialité</a>.

        </div>
        <div class="form-group"> 
          <button type="button" class="btn btn-secondary btn-block btn-lg verifcode" tabindex="6">
          Valider <i class="fa fa-play-circle"></i>
          </button>
          <button type="button" class="btn btn-secondary btn-block btn-lg submit" tabindex="6" style="display: none;">
          S'inscrire <i class="fa fa-play-circle"></i>
          </button>
        </div> <!-- /.form-group -->

      </form>

    </div> <!-- /.account-body -->

    <div class="account-footer">
      <p> 
      <a href="<?= base_url() ?>Administration/login" class="">Connectez-Vous</a>
      </p>
    </div> <!-- /.account-footer -->

  </div> <!-- /.account-wrapper -->



<div id="cgu" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #16a085">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Conditions d'utilisation</h3>
      </div>
      <div class="modal-body">
         <!--  -->
             <p>Ces conditions s’appliquent à l’utilisation de TawassolApp quelle que soit la formule d’acquisition, même pour un essai gratuit.</p>
              <p>Ces conditions définissent les droits et/ou restrictions que vous acceptez lors de votre inscription.</p>

              <h4>Limitations</h4>
              <p>Vous n'êtes pas autorisé à :</p>
              <ul>
                <li>
                  Octroyer les droits (vente ou offre) de l’utilisation de la totalité ou une partie de TawassolApp à des tiers.
                </li>
                <li>
                  Faire usage de TawassolApp en dehors de sa fonction unique qu’est la communication entre l’établissement scolaire et les élèves et/ou parents d’élèves.
                </li>
              </ul>  

              <h4>Conformité aux spécifications</h4>
              <ul>
                <li>TawassolApp, en raison de sa technicité, est tenu à une obligation de moyens.</li>
                <li>Nous nous efforcerons de corriger toute erreur qui aura été communiquée et qui serait révélatrice d'un défaut de conformité.</li>
                <li>Le prestataire n’est pas responsable des défauts imputables à l’équipement de l’utilisateur.</li>
                <li>L’utilisateur accepte de supporter, dans des limites raisonnables, les risques d’imperfection ou d'indisponibilité du service d’hébergement.</li>
                <li>Le Prestataire se réserve le droit d'interrompre le service pour une opération de maintenance. Ces interruptions de Service ne pourront donner lieu à une quelconque indemnisation de l’utilisateur.</li>
              </ul>
               
              <h4>Confidentialité</h4> 
              <p>L’utilisateur est seul responsable de ses identifiants. </p>
              <p>En aucun cas, le prestataire ne serait tenue responsable de quelque dommage suite à leurs pertes ou vol.</p>
              
         <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="pdc" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #16a085">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Politique de confidentialité</h3>
      </div>
      <div class="modal-body">
         <!--  -->
             <p>
              Nous utilisons des technologies telles que des cookies (petits fichiers stockés sur votre navigateur), des balises web ou des identifiants de périphériques uniques pour identifier votre téléphone afin que nous puissions offrir une meilleure expérience. Nos systèmes enregistrent également des informations comme votre navigateur, votre système d'exploitation et votre adresse IP.
            </p>
            

            <p>
              Nous pouvons également recueillir des informations personnelles identifiables que vous nous fournissez, telles que votre nom, votre numéro de téléphone ou votre adresse électronique. Avec votre permission, nous pouvons également accéder à d'autres informations personnelles sur votre appareil, telles que votre appareil photo, votre galerie de photo, est ça également avec votre permission, afin de vous fournir des services.
            </p>

            <p>
              Nos systèmes peuvent associer ces informations personnelles à vos activités dans le cadre de la prestation de services (telles que les pages que vous visualisez ou les choses auxquelles vous cliquez ou recherchez). 
            </p>
            <p>
              Nous ne communiquons pas ou ne recueillons pas de renseignements personnels auprès d'enfants de moins de 13 ans. Si vous pensez avoir collecté par inadvertance ces informations, veuillez nous contacter afin que nous puissions obtenir immédiatement le consentement des parents ou retirer les informations.
            </p>
              
         <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

        

  <script src="<?= base_url() ?>/assets/js/libs/jquery-1.10.1.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/libs/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/icheck/jquery.icheck.js"></script> 

  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->
  <!-- App JS -->
  <script src="<?= base_url() ?>/assets/js/target-admin.js"></script> 
  <!-- Plugin JS -->
  <script src="<?= base_url() ?>/assets/js/target-account.js"></script>

<script src="<?= base_url() ?>assets/sweet-alert/sweetalert.min.js"></script>
 <script type="text/javascript">
 
 $(document).ready(function () {
  $('input:checkbox, input:radio').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue',
    inheritClass: true
  })

   $('button[type=button].verifcode').click(function () { 
        var button = $(this);
        if($('#code').val().length >= 5){
          $('#code').addClass('loading');
          var code =  $('#code').val();
          $.get( "<?= base_url() ?>Administration/verifCode/"+code, function( data ) {
            if(data == '1'){ 
              $('.next-step').slideDown(); 
              button.slideUp(); 
              $('button[type=button].submit.submit').slideDown(); 
              $('#code').removeClass('error').addClass('valid').next().fadeOut();
            }else{
              $('#code').addClass('error').removeClass('valid').next().fadeIn();
            }
            $('#code').removeClass('loading');
          });
          
        }else{
          $('#code').addClass('error');
        }

    return false;
    }) 
    $('#code').keyup(function () {  
        $('#code').removeClass('error').removeClass('valid').removeClass('loading').next().fadeOut();
        $('.verif-code').text("Valider");
        $('.next-step').slideUp();
        $('.next-step').find('input').not('input[type=checkbox]').val('');
        $('button[type=button].verifcode').slideDown();
        $('button[type=button].submit.submit').slideUp();
    })

    $('button.submit').click(function(e) {
      e.preventDefault(); 
      var validForm = true;
      
      $('.form-group').each(function () { 
          if( $(this).find('input, select').hasClass('required') && $(this).find('input.required, select.required').val() == '' && validForm ){
            $(this).find('input.required, select.required').focus();
            validForm = false;
          }  
      }) 


          var validTel = true;
          var validPwd = true;
          
          if( $('#email').val().length < 10 ){
            swal("Veuillez saisir un numéro de téléphone valide");
            validTel = false;
          }else{
            validTel = true;
          }
          if( validTel ){
              if( $('#pwd').val().length < 6 ){
                swal("Veuillez saisir un mot de passe supérieur à 6 caractères");
                validTel = false;
              }else{
                validTel = true;
              }
          } 

          if( validTel &&  validPwd){ 

                if( $('#pwd').val() != $('#pwd-confirm').val() ){
                      $('#pwd-confirm').focus();
                      $('.confirm-pwd-text').slideDown(); 
                      validForm = false;
                }else{
                      $('.confirm-pwd-text').slideUp(); 
                }
                if( validForm ){

                  $('#email').removeClass('error');
                  $('#tel').removeClass('error');
                  $('label.mail-existe').fadeOut(); 
                  $('label.tel-existe').fadeOut(); 

                    $('.loader').fadeIn(); 
                    var formData = { 
                          'email'   : $('#email').val(),
                          'tel'     : $('#tel').val()
                    };  
                    // process the form
                    $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url         : '<?= base_url() ?>Administration/verifUser', // the url where we want to POST
                        data        : formData, // our data object
                        dataType    : 'json' // what type of data do we expect back from the server 
                    }).done(function(data) { 
                      if( data.email == true && data.tel == true ){ 

                          if( $('#pwd').val() != '' ){
                            $('form.register-form')[0].submit(); 
                          }else{
                            $('#pwd').focus();
                            $('.loader').fadeOut(); 
                          } 
                      }
                      if( data.tel == false ){
                        $('#email').addClass('error'); 
                        $('label.mail-existe').fadeIn();
                        $('.loader').fadeOut(); 
                      } 
                      if( data.email == false ){
                        $('#tel').addClass('error'); 
                        $('label.tel-existe').fadeIn();
                        $('.loader').fadeOut(); 
                      } 
                    }); 
                  }
          }
      })

    $('input[type=tel]').keypress(function ( evt ) { 
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    })



  });
 </script>
</body>
</html>
