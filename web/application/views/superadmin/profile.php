<div class="row">
      
<div class="col-md-3 col-sm-4">

  <ul id="myTab" class="nav nav-pills nav-stacked">
    <li class="active">
      <a href="#profile-tab" data-toggle="tab">
        <i class="fa fa-user"></i> 
        &nbsp;&nbsp;Informations personnelles
      </a>
    </li>
    <li>
      <a href="#password-tab" data-toggle="tab">
        <i class="fa fa-lock"></i> 
        &nbsp;&nbsp;Mot de passe
      </a>
    </li> 
  </ul>

  <br>

</div> <!-- /.col -->

<div class="col-md-9 col-sm-8">

  <div class="tab-content stacked-content">

    <div class="tab-pane fade in active" id="profile-tab">
      
      <h3 class="">Informations personnelles</h3> 
      <hr> 
      <form action="<?= base_url() ?>Superadmin/update" class="form-horizontal" method="post" enctype="multipart/form-data">
 
        <div class="form-group">

          <label class="col-md-3">Nom et prénom</label>

          <div class="col-md-7">
            <input type="text" name="nom" value="<?= $SuperAdmin->nom ?>" class="form-control" required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group --> 

        <div class="form-group">

          <label class="col-md-3">Numéro de téléphone</label>

          <div class="col-md-7">
            <input type="text" name="tel" value="<?= $SuperAdmin->tel ?>" class="form-control"  required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->  

        <br />

        <div class="form-group">

          <div class="col-md-7 col-md-push-3">
            <button type="submit" class="btn btn-primary">Enregister</button>
            &nbsp;
            <button type="reset" class="btn btn-default">Annuler</button>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

      </form>


    </div> <!-- /.tab-pane --> 

    <div class="tab-pane fade" id="password-tab">

      <h3 class="">Changement de mot de passe</h3>
 

      <br />
      <div class="alert alert-danger msg" style="display: none;">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>L'Ancien mot de passe est incorect</strong>
      </div> <!-- /.alert -->
      <div class="alert alert-warning msg" style="display: none;">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Merci de bien confirmer votre mot de passe</strong>
      </div> <!-- /.alert -->
      <div class="alert alert-success msg" style="display: none;">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Le mot de passe est bien modifié</strong>
      </div> <!-- /.alert -->
      <form action="#" class="form-horizontal change-pwd">
      <div class="loader"></div>
        <div class="form-group">

          <label class="col-md-3">Ancien mot de passe</label>

          <div class="col-md-7">
            <input type="password" id="old-password" name="old-password" class="form-control" required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

        <hr />

        <div class="form-group">

          <label class="col-md-3">Nouveau mot de passe</label>

          <div class="col-md-7">
            <input type="password" id="new-password-1"  pattern=".{6,}"   required title="6 characters minimum"  name="new-password-1" class="form-control" required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

        <div class="form-group">

          <label class="col-md-3">Retapez-le</label>

          <div class="col-md-7">
            <input type="password" id="new-password-2" pattern=".{6,}"   required title="6 characters minimum" name="new-password-2" class="form-control" required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

        <br />

        <div class="form-group">

          <div class="col-md-7 col-md-push-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            &nbsp;
            <button type="reset" class="btn btn-default">Anuller</button>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

      </form>
    </div> <!-- /.tab-pane -->


  </div> <!-- /.tab-content -->

</div> <!-- /.col -->


<script type="text/javascript">
    $('form.change-pwd').submit(function(event) {
        event.preventDefault();
        $('.loader').fadeIn(100);
        $('.msg.alert-success').slideUp();
        $('.msg.alert-danger').slideUp();
        $('.msg.alert-warning').slideUp();

        var Oldpwd = $('#old-password').val();
        var pwd1 = $('#new-password-1').val();
        var pwd2 = $('#new-password-2').val();

        if( pwd1 == pwd2 ){
          var formData = { 
              'oldPassword': Oldpwd,
              'NewPassword': pwd1
          };  
          // process the form
          $.ajax({
              type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
              url         : '<?= base_url() ?>Superadmin/changePwd', // the url where we want to POST
              data        : formData, // our data object
              dataType    : 'text' // what type of data do we expect back from the server 
          }).done(function(data) { 
              if( data == "true" ){
                $('.loader').fadeOut('100');
                $('.msg.alert-success').slideDown();
                $('form.change-pwd')[0].reset();
                setTimeout(function () {
                  $('.msg.alert-success').slideUp();
                },2000)
              }else{
                $('.loader').fadeOut('100');
                $('.msg.alert-danger').slideDown();
                $('#old-password').val('').focus();
              }
          })
        }else{
          $('.loader').fadeOut('100');
          $('.msg.alert-warning').slideDown();
          $('#new-password-2').val('').focus();
        }
         
    }) 
  </script>