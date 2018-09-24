<div class="row"> 
<div class="col-md-3 col-sm-4">

  <ul id="myTab" class="nav nav-pills nav-stacked">
    <li class="<?= $activeTab == 1 ? 'active' : ''  ?>">
      <a href="#profile-tab" data-toggle="tab">
        <i class="fa fa-user"></i> 
        &nbsp;&nbsp;Informations
      </a>
    </li>
    <li>
      <a href="#password-tab" data-toggle="tab">
        <i class="fa fa-lock"></i> 
        &nbsp;&nbsp;Mot de passe
      </a>
    </li> 

    <li class="<?= $activeTab == 3 ? 'active' : ''  ?>">
      <a href="#document-tab" data-toggle="tab">
        <i class="fa fa-file"></i> 
        &nbsp;&nbsp;Documentation
      </a>
    </li> 

     <li class="<?= $activeTab == 4 ? 'active' : ''  ?>">
      <a href="#sub-admin-tab" data-toggle="tab">
        <i class="fa fa-file"></i> 
        &nbsp;&nbsp;Responsables administratifs
      </a>
    </li> 

  </ul>

  <br>

</div> <!-- /.col -->

<div class="col-md-9 col-sm-8">

  <div class="tab-content stacked-content">

    <div class="tab-pane fade <?= $activeTab == 1 ? 'in active' : ''  ?>" id="profile-tab">
      
      <h3 class="">Informations</h3> 
      <hr> 
      <form action="<?= base_url() ?>Administration/update" class="form-horizontal" method="post" enctype="multipart/form-data">

        <div class="form-group">

          <label class="col-md-3">Logo</label>

          <div class="col-md-7">
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-new thumbnail" style="width: 100px; height: auto;">
                
                <?php if(!empty($info['photo']) ): ?>
                    <img src="<?= base_url() ?>assets/upload/logos/<?= $info['photo'] ?>" alt="<?= $info['nom'] ?>" />
                <?php else: ?>
                    <img src="https://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" alt="Pas de logo" />
                <?php endif; ?>
 

              </div>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"></div>
              <div>
                <span class="btn btn-default btn-file"><span class="fileupload-new">Choisir</span><span class="fileupload-exists">Changer</span>
                <input type="file" name="photo" />
                </span>
                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">supprimer</a>
              </div>
            </div>
          </div> <!-- /.col -->

        </div> <!-- /.form-group --> 
        <div class="form-group">

          <label class="col-md-3">Ville</label>

          <div class="col-md-7">
            <input type="text" name="nom" value="<?= $centre->ville ?>" class="form-control" disabled>
          </div> <!-- /.col -->

        </div> <!-- /.form-group --> 
        <div class="form-group">

          <label class="col-md-3">Nom de l'établissement</label>

          <div class="col-md-7">
            <input type="text" name="nom" value="<?= $centre->nom ?>" class="form-control" required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group --> 

        <div class="form-group">

          <label class="col-md-3">Numéro de téléphone</label>

          <div class="col-md-7">
            <input type="tel" name="email" value="<?= $centre->email ?>" pattern="\d+" class="form-control"  required>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->
        <div class="form-group">

          <label class="col-md-3">Adresse e-mail</label>

          <div class="col-md-7">
            <input type="email" name="tel" value="<?= $centre->tel ?>" class="form-control"  >
            <em style="font-size: 12px; color: rgb(255, 81, 0);">Cette adresse vous aide à recupérer votre mot de passe</em>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->
        <div class="form-group">
          <div class="col-md-3">
            <label>Niveaux enseignés</label>
          </div>
          <div class="col-md-7">
            <?php $niveaux = explode(':', $centre->niveau) ?>
            <div class="checkbox">
              <label>
                  <input type="checkbox" name="niveau_[]" class="icheck-input" value="0" <?= in_array('0', $niveaux) ? 'checked' : '' ?>>
                  Préscolaire
              </label>
            </div>

            <div class="checkbox">
              <label>
                  <input type="checkbox" name="niveau_[]" class="icheck-input" value="1" <?= in_array('1', $niveaux) ? 'checked' : '' ?>>
                  Primaire
              </label>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" name="niveau_[]" class="icheck-input" value="2" <?= in_array('2', $niveaux) ? 'checked' : '' ?>>
                Collège
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="niveau_[]" class="icheck-input" value="3" <?= in_array('3', $niveaux) ? 'checked' : '' ?>>
                Lycée
              </label>
            </div>
          </div>
        </div>  

        <br />

        <div class="form-group">

          <div class="col-md-7 col-md-push-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            &nbsp;
            <a href="/Administration/home" class="btn btn-default">Annuler</a>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

      </form>  
    </div> <!-- /.tab-pane --> 

    <div class="tab-pane fade" id="password-tab">

      <h3 class="">Changement de mot de passe</h3> 

      <br />
      <div class="alert alert-danger msg" style="display: none;">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>L'ancien mot de passe est incorrect</strong>
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
            <a  href="/Administration/home" class="btn btn-default">Annuler</a>
          </div> <!-- /.col -->

        </div> <!-- /.form-group -->

      </form>
    </div> <!-- /.tab-pane -->

    <div class="tab-pane fade <?= $activeTab == 3 ? 'in active' : ''  ?>" id="document-tab">
      <form action="<?= base_url() ?>Administration/updateDocs" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="loader"></div>
        <div class="form-group" style="">
          <div class="col-md-12">
            <label class="col-md-3">Qui somme nous</label>  
            <div class="col-md-9">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-group">
                  <div class="form-control" style="white-space: nowrap;overflow: hidden;">
                      <i class="fa fa-file fileupload-exists" style="display: inline;"></i> <span class="fileupload-preview" style="position: absolute;left: 31px;top: 7px;color:#a2a2a2">PDF : présentation de l'etablissement</span>
                  </div>
                  <div class="input-group-btn">
                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                    <span class="btn btn-default btn-file">
                      <span class="fileupload-new">Parcourir</span>
                      <span class="fileupload-exists">Changer</span>
                      <input name="about" type="file" accept="application/pdf" style="transform: none;" />
                    </span>
                  </div>
                </div>
              </div>  
            </div> <!-- /.col -->
          </div>
          <div class="col-md-12">
            <div class="col-md-3">
            </div>
            <div class="col-md-9 col">
              <?php if(!empty($centre->about)): ?>
                <a href="<?= base_url() ?>assets/upload/docs/<?= $centre->about ?>" target="_blank">
                  <img src="https://www.aafprs.org/wp-content/uploads/2017/06/pdf-icon.png" style="width: 70px">
                </a>
                <a class="delete" href="#" data-type="existeAbout">Supprimer</a>
              <?php endif ?>
              <input type="hidden" name="existeAbout" value="<?= $centre->about ?>">
            </div>  
        </div>

        </div> <!-- /.form-group -->

        <hr />

        <div class="form-group" style="">

          <div class="col-md-12" style="">
            <label class="col-md-3">Réglement interieur</label>
   

            <div class="col-md-9">
              <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="input-group">
                <div class="form-control" style="white-space: nowrap;overflow: hidden;">
                    <i class="fa fa-file fileupload-exists" style="display: inline;"></i> <span class="fileupload-preview" style="position: absolute;left: 31px;top: 7px;color:#a2a2a2">PDF</span>
                </div>
                <div class="input-group-btn">
                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                  <span class="btn btn-default btn-file">
                    <span class="fileupload-new">Parcourir</span>
                    <span class="fileupload-exists">Changer</span>
                    <input name="reglement_interieur" type="file" accept="application/pdf" style="transform: none;" />
                  </span>
                </div>
              </div>
            </div>  
            </div> <!-- /.col -->
          </div>
          <div class="">
            <div class="col-md-3"> 
            </div> 
            <div class="col-md-9 col">
              <?php if(!empty($centre->reglement_interieur)): ?>
                <a href="<?= base_url() ?>assets/upload/docs/<?= $centre->reglement_interieur ?>" target="_blank">
                  <img src="https://www.aafprs.org/wp-content/uploads/2017/06/pdf-icon.png" style="width: 70px">
                </a>
                <a class="delete" href="#" data-type="existeReglement_interieur">Supprimer</a>
              <?php endif ?>
              <input type="hidden" name="existeReglement_interieur" value="<?= $centre->reglement_interieur ?>">
            </div> 
          </div>
            
        </div> <!-- /.form-group -->

        <hr />

        <div class="form-group" style="">

          <div class="col-md-12" style="">
            <label class="col-md-3">Vacances scolaires</label> 
            <div class="col-md-9">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-group">
                  <div class="form-control" style="white-space: nowrap;overflow: hidden;">
                      <i class="fa fa-file fileupload-exists" style="display: inline;"></i> <span class="fileupload-preview" style="position: absolute;left: 31px;top: 7px;color:#a2a2a2">PDF</span>
                  </div>
                  <div class="input-group-btn">
                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                    <span class="btn btn-default btn-file">
                      <span class="fileupload-new">Parcourir</span>
                      <span class="fileupload-exists">Changer</span>
                      <input name="vacances_scolaires" type="file" accept="application/pdf" style="transform: none;" />
                    </span>
                  </div>
                </div>
              </div>  
            </div> <!-- /.col -->
          </div>



          <div class="col-md-12">
            <div class="col-md-3">
            </div>
            <div class="col-md-9 col">
              <?php if(!empty($centre->vacances_scolaires)): ?>
                <a href="<?= base_url() ?>assets/upload/docs/<?= $centre->vacances_scolaires ?>" target="_blank">
                  <img src="https://www.aafprs.org/wp-content/uploads/2017/06/pdf-icon.png" style="width: 70px">
                </a>
                <a class="delete" href="#" data-type="existeVacances_scolaires">Supprimer</a>
              <?php endif ?>
              <input type="hidden" name="existeVacances_scolaires" value="<?= $centre->vacances_scolaires ?>">
            </div>  
          </div>
        </div> <!-- /.form-group -->

        <hr />

        <div class="form-group">

          <div class="col-md-7 col-md-push-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            &nbsp;
            <a href="/Administration/home" class="btn btn-default">Annuler</a>
          </div> <!-- /.col --> 
        </div> <!-- /.form-group -->

      </form>
    </div>

    <div class="tab-pane fade <?= $activeTab == 4 ? 'in active' : ''  ?>" id="sub-admin-tab">

      <button class="btn btn-secondary" data-toggle="modal" href="#addNew">
        <strong>
          <i class="fa fa-plus-circle" style="font-size: 20px;""></i> 
          Nouveau responsable administratif
        </strong> 
      </button>
      <table 
        class="table table-striped table-bordered table-hover table-highlight table-checkable" 
        data-provide="datatable" 
        data-display-rows="100"
        data-info="false"
        data-search="false"
        data-length-change="false"
        data-paginate="false" 
        id="DataTable"
        style="margin-top: 20px" >
        <thead>
          <tr > 
            <th data-filterable="true" data-sortable="false" class="hidden-xs">Nom et prénom</th> 
            <th data-filterable="true" data-sortable="false" class="hidden-xs">Téléphone</th> 
            <th data-filterable="false" class="hidden-xs center">Modifier</th> 
            <th data-filterable="false" class="hidden-xs center">Supprimer</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($sous_administrateur as $key => $user): ?>
            <tr>
              <td><?= $user->name ?></td>
              <td><?= $user->tel ?></td>
              <td style="text-align: center;">
                  <a  
                    data-toggle="modal" 
                    href="#addNew"  
                    <?php $user->access = unserialize($user->access) ?>
                    data-user='<?= json_encode( $user ) ?>'
                    class="btn btn-warning edit-row">
                    <i class="fa fa-pencil"></i>
                  </a> 
              </td>
              <td style="text-align: center;"> 
                  <a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row">
                    <i class="fa fa-trash-o"></i>
                  </a>
              </td>
            </tr>
          <?php endforeach ?>
            
        </tbody>
      </table>
    </div> 


  </div> <!-- /.tab-content -->

</div> <!-- /.col -->


<script type="text/javascript">
  $(document).ready(function () {
    $('input:checkbox, input:radio').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue',
      inheritClass: true
    }) 

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
              url         : '<?= base_url() ?>Administration/changePwd', // the url where we want to POST
              data        : formData, // our data object
              dataType    : 'text' // what type of data do we expect back from the server 
          }).done(function(data) { 
              if( data == "true" ){
                $('.loader').fadeOut('100');
                $('.msg.alert-success').slideDown();
                $('form.change-pwd')[0].reset();
                 
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

    $('.delete').click(function (e) {
      e.preventDefault()
      $(this).parents('.col').remove()
      $('[name='+$(this).attr('dataType')+']').val('')
    })


    $('#addNew form').submit(function(event) {
          event.preventDefault();  
          var form = $(this);
          form.find('.msg').hide()
          console.log( $(this).serialize() )
          form.find('.loader').fadeIn('100');
          // 
          form.find('.loader').fadeIn('100');
          $.ajax({
              type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
              url         : '<?= base_url() ?>Administration/addSubAdmin', // the url where we want to POST
              data        : form.serialize(), // our data object
              dataType    : 'json' // what type of data do we expect back from the server 
          }).done(function(data) { 
              $('#addNew').scrollTop(0); 
              form.find('.loader').fadeOut('100');
              if( data.success == 1 ){ 
                 form.find('.alert-success').show().find('strong').text(data.message)

                 if( $('#addNew form [name=id]').val() == '0' ){
                  form[0].reset();
                 }
                 

                  $('input:checkbox').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue',
                    inheritClass: true
                  }) 
              } 
              if( data.success == 0 ){
                 form.find('[name=tel]').focus()
                 form.find('.alert-warning').show().find('strong').text(data.message)
              }

              if( data.success == 2 ){
                 form.find('.alert-warning').show().find('strong').text(data.message)
              }
          })
    }) 

    $('.edit-row').click(function () {
      var user = JSON.parse( $(this).attr('data-user') ); 

      $('#addNew form [name=name]').val(user.name)
      $('#addNew form [name=tel]').val(user.tel);
      $('#addNew form [name=id]').val(user.id);
      $('#addNew form [name=pwd]').removeAttr('required');
      $('#addNew form .pwdFeield').hide();
      $('#addNew form .showPwdFeield').show();

      $('input[type=checkbox]').prop('checked', false);

      console.log(user)

      if( user.access.prescolaire ){
        $.each(user.access.prescolaire, function (index, val) {
          $('#prescolaire input[value='+val+']').prop('checked', true);
        })
      }
        

      if( user.access.primaire ){
        $.each(user.access.primaire, function (index, val) {
          $('#primaires input[value='+val+']').prop('checked', true);
        })
      }


      if( user.access.college ){
        $.each(user.access.college, function (index, val) {
          $('#college input[value='+val+']').prop('checked', true);
        })
      }

      if( user.access.lycee ){
        $.each(user.access.lycee, function (index, val) {
          $('#lycee input[value='+val+']').prop('checked', true);
        })
      }

      setTimeout(function () {
        $('input:checkbox').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue',
          inheritClass: true
        }) 
      })
        

    })

    $('#addNew form .showPwdFeield').click(function (event) {
      event.preventDefault()
      $('#addNew form .pwdFeield').show();
      $('#addNew form .showPwdFeield').hide();
    })


    $('form').submit(function () {
      $(this).find('.loader').show()
    })


  })
  </script>