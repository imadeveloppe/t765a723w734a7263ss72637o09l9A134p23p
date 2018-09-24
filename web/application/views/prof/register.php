<!DOCTYPE html>
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

<body class="logout">

<div class="account-wrapper"> 

  <div class="account-logo">
    <img src="<?= base_url() ?>/assets/img/logo-login.png" alt="Target Admin">
  </div>


    <div class="account-body">
      <div class="loader"></div>
      <h3 class="account-body-title">Inscription</h3> 

      <form class="form account-form register-form" method="POST" action="<?= base_url() ?>prof/addProf">

        <div class="block-info">
          <div class="form-group">
            <label for="code" class="placeholder-hidden">Code d'inscription</label>
            <input type="text" class="form-control" id="code" name="code" placeholder="Code d'inscription" minlength="5" required>
            <span class="error">Code invalide</span>
          </div> <!-- /.form-group -->
        <div class="next-step"> 

          <div class="form-group">
            <label  class="placeholder-hidden">Votre prénom</label>
            <input type="text" class="form-control" id="prenom"  name="prenom" placeholder="Votre prénom"  required>
          </div> <!-- /.form-group -->

          <div class="form-group">
            <label class="placeholder-hidden">Votre Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom"  required>
          </div> <!-- /.form-group -->
            
          <div class="form-group">
            <label class="placeholder-hidden">Niveau ensiegné</label>
            <select class="form-control" id="niveau" name="niveau" required>
            </select>
          </div> <!-- /.form-group -->
          
          <div class="mateiresprof">
            <div class="row">
                  <div class="form-group col-xs-6" style="margin: 0"> 
                    <label for="text-input">Classe</label>
                  </div>
                  <div class="form-group col-xs-6" style="margin: 0"> 
                    <label for="text-input">Groupe</label>
                  </div>
            </div>
            <div id="OptionClassProf" class="classRow">  

            </div> 
            <button type="button" class="btn btn-warning add-row">
                <i class="fa fa-plus"></i>
            </button>
            <br><br>
          </div> 

          <div class="form-group"> 
            <button type="button" class="btn btn-default btn-block btn-md" data-toggle="modal" href="#matiere">Matières enseignées</button>
          </div> <!-- /.form-group -->
          <input type="hidden" name="matieres" id="matieres"></input>

          </div>
           
        </div>

        <div class="block-login next-step"> 
          <div class="form-group" style="margin-bottom: 23px;">
            <label for="signup-username" class="placeholder-hidden">Numéro de téléphone</label>
            <input type="tel" class="form-control" name="email" id="email" pattern="\d+" placeholder="Numéro de téléphone"  required>
            <label style="font-weight: normal; color: red; font-size: 11px; bottom: -17px; margin: 0px; position: absolute; font-style: italic;margin-left: 2px; display: none;" class="mail-existe">Ce numéro de téléphone existe déjà</label>
          </div> <!-- /.form-group --> 

           <div class="form-group">
            <label for="login-password" class="placeholder-hidden">Mot de passe</label>
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mot de passe" required>
          </div> <!-- /.form-group -->

           <div class="form-group">
            <label for="login-password" class="placeholder-hidden">Confirmer mot de passe</label>
            <input type="password" class="form-control" id="confirm-pwd" placeholder="Confirmer mot de passe" required>
          </div> <!-- /.form-group -->  
          <!-- <div class="form-group">
            <button type="submit" class="btn btn-secondary btn-block btn-lg" tabindex="6">
            S'INSCRIRE <i class="fa fa-play-circle"></i>
            </button>
          </div> --> <!-- /.form-group -->
          <p>
            En cliquant sur S'INSCRIRE, vous acceptez nos <a data-toggle="modal" href="#cgu">Conditions d'utilisation</a> et notre <a data-toggle="modal" href="#pdc">Politique de confidentialité</a>.
          </p>
        </div>
        <div class="form-group">
            <!-- <p class="required"><span>*</span>Champ obligatoire</p> -->
            <button type="button" class="btn btn-secondary btn-block btn-lg verifcode" tabindex="6">
            Valider <i class="fa fa-play-circle"></i>
            </button>
            <button type="submit" class="btn btn-secondary btn-block btn-lg InscriptionBTN" tabindex="6" style="display: none;">
            S'INSCRIRE <i class="fa fa-play-circle"></i>
            </button>
        </div> <!-- /.form-group -->

      </form>

    </div> <!-- /.account-body -->

    <div class="account-footer">
      <p>
      <a href="<?= base_url() ?>prof/login" class="">Connectez-Vous</a>
      </p>
    </div> <!-- /.account-footer -->

  </div> <!-- /.account-wrapper -->
<!-- /**************************************** Matieres ********************************************/ -->
<div id="matiere" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Matières enseignées</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** --> 
              <form  role="form" class="form-group">
                <div class="row">
                  <div class="col-xs-12 content-checkbox-matiere">
 
                  </div> 
                </div> 
              </form>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Valider</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /***********************************************************************************************/ -->
<!-- ******************************************Confirmation suppression****************************************** -->
<div id="confirmation" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Vous voulez vraiment faire cette action ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="cgu" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #16a085">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Conditions d'utilisation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
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
              
         <!-- ********************************************************** -->
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
         <!-- ********************************************************** -->
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
              
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="recap" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #16a085">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Récapitulatif d'inscription</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             
            <div class="form-group">
              <label>Nom et Prénom</label>
              <div class="name"></div>
            </div> <!-- /.form-group -->

            <div class="form-group">
              <label>Niveau</label>
              <div class="niveau"></div>
            </div> <!-- /.form-group -->

            <div class="form-group">
              <label>Classe(s) / Groupe(s)</label>
              <div class="classes"></div>
            </div> <!-- /.form-group -->

            <div class="form-group">
              <label>Matière(s)</label>
              <div class="matieres"></div>
            </div> <!-- /.form-group -->

            <div class="form-group">
              <label>Téléphone</label>
              <div class="tel"></div>
            </div> <!-- /.form-group -->

              
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-tertiary editData" data-dismiss="modal">Modifier</button>
        <button type="button" class="btn btn-primary sendData" data-dismiss="modal">Soumettre</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ************************************************************************************************************ -->

  <script type="text/javascript">
    
    var intituleClasse = [];
    var intituleGroupe = [];
    var nbrClassesByNiveau = [];


    var removeRow;
    $('body').on('click','.remove-row',function() { 
      removeRow = $(this).parent().parent();
    })

    $('#confirmation .confirm').click(function() { 
      removeRow.slideUp('slow').remove(); 
    })

    //Add classe/groupe 
    $('button.add-row').click(function () {
      var validateSelect = 0;
      $('.classRow').each(function (item) {
        if( $(this).find('.profClasse').val()=='' ){
          $(this).find('.profClasse').focus();
          validateSelect++;
        }else if( $(this).find('.profGroupe').val()=='' ){
          $(this).find('.profGroupe').focus();
          validateSelect++;
        }
      })
      var btn = $(this);
      if(validateSelect == 0){
        $('<div class="row classRow"><div class="form-group col-xs-6">  <select class="form-control profClasse" name="classe[]"><option></option></select></div><div class="form-group col-xs-4 no-padding">  <select class="form-control profGroupe"  name="groupe[]"><option></option></select></div><div class="form-group col-xs-2"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row" style="line-height: 27px;"><i class="fa fa-trash-o"></i></a></div></div>').insertAfter(btn.prev());

        $.each(intituleClasse,function (index, value) {
          if(value ){
            btn.prev().find('.profClasse').append('<option value="'+(index+1)+'">'+value+'</option>') 
          }

        })
        for (var i = 0; i < parseInt(nbrClassesByNiveau[0]) ; i++) {
          btn.prev().find('.profGroupe').append('<option value="'+(i+1)+'">'+intituleGroupe[i]+'</option>') 
        }
      }

    });  
   $('button[type=button].verifcode').click(function () { 
        var button = $(this);
        if($('#code').val().length >= 5){
          $('#code').addClass('loading');
          var code =  $('#code').val();
          $.get( "<?= base_url() ?>prof/verifCode/"+code, function( data ) {
            if(data == '1'){ 
              $('.next-step').slideDown(); 
              button.slideUp(); 
              $('button.InscriptionBTN').slideDown(); 
              $('#code').removeClass('error').addClass('valid').next().fadeOut();
              ///////////////////////////////////////////////////////////////////
                $.get( "<?= base_url() ?>prof/getMatieresByCode/"+code, function( data ){
                $('.content-checkbox-matiere').html('');
                  $.each($.parseJSON(data), function (i, item) { 
                    $('.content-checkbox-matiere').append('<div data-id="'+item.id+'" class="checkbox col-sm-6"> <label><input type="checkbox" name="checkbox-2" class="">'+item.intitule+'</label></div>');
                  });
                })
                $.get( "<?= base_url() ?>prof/getNiveauByCode/"+code, function( data ){
                  $('#niveau').html('')
                  $('#niveau').append('<option value="" >Niveau</option>');
                  $.each($.parseJSON(data), function (i, item) { 
                    $('#niveau').append('<option value="'+i+'" >'+item+'</option>');
                  });
                })
                $.get( "<?= base_url() ?>prof/getClassesByCode/"+code, function( data ){
                  
                  var json = $.parseJSON(data);
                  intituleClasse = json.intituleClasse;
                  intituleGroupe = json.intituleGroupe;
                  nbrClassesByNiveau = json.nbrClassesByNiveau;

                  $('.profClasse, .profGroupe').html('');

                  $('#OptionClassProf').html('<div class="row"><div class="form-group col-xs-6">  <select class="form-control profClasse" name="classe[]"><option></option></select></div><div class="form-group col-xs-4 no-padding">  <select class="form-control profGroupe"  name="groupe[]"><option></option></select></div><div class="form-group col-xs-2"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row" style="line-height: 27px;"><i class="fa fa-trash-o"></i></a></div></div>');
                  $.each(intituleClasse,function (index, value) {
                    $('#OptionClassProf .profClasse').append('<option value="'+(index+1)+'">'+value+'</option>') 
                  })
                  for (var i = 0; i < parseInt(nbrClassesByNiveau[0]) ; i++) {
                    $('#OptionClassProf .profGroupe').append('<option value="'+(i+1)+'">'+intituleGroupe[i]+'</option>') 
                  }

                })
              //////////////////////////////////////////////////////////////////
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
    //////////////////////////////////////
    
    $('#niveau').change(function () {
      var niveau = $(this).val();
      var CentreCode = $('#code').val();
      $.get( "<?= base_url() ?>prof/getMatieresByCode/"+CentreCode+"/"+niveau, function( data ){
        $('.content-checkbox-matiere').html('');
        $.each($.parseJSON(data), function (i, item) { 
          $('.content-checkbox-matiere').append('<div data-id="'+item.id+'" class="checkbox col-sm-6"> <label><input type="checkbox" name="checkbox-2" class="">'+item.intitule+'</label></div>');
        });
      })
       $.get( "<?= base_url() ?>prof/getClassesByCode/"+CentreCode+"/"+niveau, function( data ){ 
        var json = $.parseJSON(data);
        intituleClasse = json.intituleClasse;
        intituleGroupe = json.intituleGroupe;
        nbrClassesByNiveau = json.nbrClassesByNiveau;

        $('.profClasse, .profGroupe').html('');

        $('#OptionClassProf').html('<div class="row"><div class="form-group col-xs-6">  <select class="form-control profClasse" name="classe[]"><option></option></select></div><div class="form-group col-xs-4 no-padding">  <select class="form-control profGroupe"  name="groupe[]"><option></option></select></div><div class="form-group col-xs-2"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row" style="line-height: 27px;"><i class="fa fa-trash-o"></i></a></div></div>');
        $.each(intituleClasse,function (index, value) {
          if( value ){
            $('#OptionClassProf .profClasse').append('<option value="'+(index+1)+'">'+value+'</option>') 
          }
            
        })
        for (var i = 0; i < parseInt(nbrClassesByNiveau[0]) ; i++) {
          $('#OptionClassProf .profGroupe').append('<option value="'+(i+1)+'">'+intituleGroupe[i]+'</option>') 
        }

      })



    })
    ////////////////////////////

    $('body ').on('change','select.profClasse',function() { 

      classe = $(this).val();
      $(this).parents('.row').find('select.profGroupe').html('');
      $(this).parents('.row').find('select.profGroupe').append('<option value=""></option>')
      for (var i = 1; i <= nbrClassesByNiveau[classe-1] ; i++) {
        $(this).parents('.row').find('select.profGroupe').append('<option value="'+i+'">'+intituleGroupe[i-1]+'</option>')
      } 
  })

    $('#code').keyup(function () {  
        $('#code').removeClass('error').removeClass('valid').removeClass('loading').next().fadeOut();
        $('.verif-code').text("Valider");
        $('.next-step').slideUp();
        $('.next-step').find('input').val('');
        $('button[type=button].verifcode').slideDown();
        $('button[type=submit].InscriptionBTN').slideUp();
    })

    $('button.submit').click(function(e) {
      e.preventDefault(); 
      $('.msg').slideUp();
      var valid = false;
      $('.next-step .form-group').each(function() {
        if( !valid ){
          if( $(this).find('.form-control').val() == '' ){
            valid = true;
            $(this).find('.form-control').focus();
          }
        }
      })
      var validateSelect = 0;
      $('.classRow').each(function (item) {
        if( $(this).find('.profClasse').val()=='' ){
          $(this).find('.profClasse').focus();
          validateSelect++;
        }else if( $(this).find('.profGroupe').val()=='' ){
          $(this).find('.profGroupe').focus();
          validateSelect++;
        }
      })  
      if( !valid  && validateSelect == 0 ){
       $('.block-info').slideUp();
       $('.block-login').slideDown();
      }
    }) 
    var validForm = false;
    $('.register-form').submit(function(e) {  
       if( !validForm ){
          $('.msg').slideUp(); 
          e.preventDefault();  

          if( $('.profClasse').val() == '' || !$('select').hasClass('profClasse') ){
            swal("Veuillez choisir la classe enseignée"); 
            return false
          }

          if( $('.profGroupe').val() == '' || !$('select').hasClass('profGroupe') ){
            swal("Veuillez choisir le groupe enseigné"); 
            return false
          }

          var emptySelect = 0;
          $('.classRow').each(function (item) {
            if( $(this).find('.profClasse').val()=='' ){
              $(this).find('.profClasse').focus();
              emptySelect++
            }else if( $(this).find('.profGroupe').val()=='' ){
              $(this).find('.profGroupe').focus();
              emptySelect++
            }
          })

          if(emptySelect > 0){
            return false;
          }



          if( $('#matieres').val() == '' ){
            swal("Veuillez choisir la matière(s) enseignée(s)"); 
            return false
          }

          if( $('#email').val().length < 10 ){
            swal("Veuillez saisir un numéro de téléphone valide"); 
            return false
          }


          if( $('#pwd').val().length < 6 ){
            swal("Veuillez saisir un mot de passe supérieure à 6 chiffres"); 
            return false
          }

          if( $('#confirm-pwd').val() != $('#pwd').val() ){
            swal("Mots de passe non identiques"); 
            return false
          }
          
          $('.loader').fadeIn();
          var formData = { 
              'email'   : $('#email').val()
          };  
          // process the form
          $.ajax({
              type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
              url         : '<?= base_url() ?>prof/verifEmail', // the url where we want to POST
              data        : formData, // our data object
              dataType    : 'text' // what type of data do we expect back from the server 
          }).done(function(data) { 
             if( data == "true" ){
              $('.mail-existe').fadeOut();
              $('#email').removeClass('error');  

              $('#recap').modal('show');
              recaputilatif();
              
             }else{
              $('.loader').fadeOut();
              $('.mail-existe').fadeIn(); 
              $('#email').addClass('error');
             }
          }); 
       }
    }) 

    var matieres = []; 
    function matieresSelected() {
      matieres = []; 
           $('.modal#matiere').find('.checkbox').each(function(){ 

            if( $(this).find('input[type=checkbox]').is(':checked') ){
              matieres.push( $(this).attr('data-id') );  
            }

          }) 

          $('#matieres').val( matieres.join() );
    }
    
    $('body').on('click','.modal#matiere .checkbox > label',function(){
        matieresSelected();
    })  

    $('input[type=tel]').keypress(function ( evt ) { 
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    })


    function recaputilatif() {
      var data = {
        name : $('#prenom').val()+" "+$('#nom').val(),
        niveau: $('#niveau option:selected').text(),
        tel: $('#email').val()
      }
      var matieres = []
      $('.content-checkbox-matiere > div').each(function( index ) {
         var checked = $( this ).find('input').is(':checked') ? true : false
        if(checked){
          matieres.push($( this ).find('label').text())
        }
      });
      data.matieres = matieres;

      var classes = []
      $('.mateiresprof > div').each(function( index ) {
         var profClasse = $( this ).find('select.profClasse option:selected').text();
         var profGroupe = $( this ).find('select.profGroupe option:selected').text();
        if(profClasse && profGroupe){
          classes.push(profClasse+" G"+profGroupe);
        }
         
      });
      data.classes = classes;
      $('#recap').find('.classes').html('')
      $('#recap').find('.matieres').html('')
      setTimeout(function () {
          $('#recap').find('.name').text( data.name );
          $('#recap').find('.niveau').text( data.niveau );
          $('#recap').find('.tel').text( data.tel ); 
          $.each( data.classes, function (key, value) {
            $('#recap').find('.classes').append('<div>- '+ value +'</div>');
          })
          $.each( data.matieres, function (key, value) {
            $('#recap').find('.matieres').append('<div>- '+ value +'</div>');
          })
      })
 
    }
    $('#recap .editData').click(function () {
      validForm = false;
      $('.loader').fadeOut();
    })
    $('#recap .sendData').click(function () {
      validForm = true;
      $('.register-form')[0].submit();
    })

  </script>









<script src="<?= base_url() ?>assets/js/libs/bootstrap.min.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/datatables/DT_bootstrap.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/icheck/jquery.icheck.js"></script> 

<!--[if lt IE 9]>
  <script src="<?= base_url() ?>./assets/js/libs/excanvas.compiled.js"></script>
  <![endif]--> 
<!-- App JS --> 
<script src="<?= base_url() ?>assets/js/plugins/icheck/jquery.icheck.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/timepicker/bootstrap-timepicker.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/fileupload/bootstrap-fileupload.js"></script> 

<!-- App JS --> 
<script src="<?= base_url() ?>assets/js/target-admin.js"></script> 
<script src="<?= base_url() ?>assets/sweet-alert/sweetalert.min.js"></script>

<!-- Plugin JS -->  
</body>
</html>