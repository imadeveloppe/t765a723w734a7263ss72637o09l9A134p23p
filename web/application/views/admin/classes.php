

      <div class="content-header">
        <h2 class="content-header-title">Gérer les classes</h2>
        <ol class="breadcrumb">
          <li><a href="./">Home</a></li> 
          <li><a href="#">Gérer</a></li>
          <li class="active">Gérer les classes</li>
        </ol>
      </div> <!-- /.content-header --> 

<?php if($info['niveau'] == 0 || $info['niveau'] == 1 || $info['niveau'] == 2): ?>
      <div class="row">
        <div class="col-md-12">
          <div class="portlet appellation-groupe">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-check"></i>
                Groupes / Classes
              </h3> 
            </div> <!-- /.portlet-header -->

            <div class="portlet-content"> 
              <div class="row">

               <form class="form-horizontal" action="<?= base_url() ?>Administration/classesEcole" method="post">
                
                <div class="col-md-6 no-padding">
                  <div class="col-md-12">
                  <h4>Choisir l’appellation des niveaux d’enseignement</h4>
                  <div class="form-group appellationClasses">
                      <?php foreach ($intituleNiveau as $key => $value): ?>
                        <div class="radio">
                          <label data-value="<?= implode(', ', $value) ?>">
                            <input id="appellationClasses-<?= $key ?>" type="radio" name="appellationClasses" value="<?= $key ?>" 
                            <?= ($key == $appellationClasses) ? 'checked' : '' ?>>
                            <span><?= implode(', ', $value) ?></span>
                          </label>
                        </div> 
                      <?php endforeach ?>  
                    </div> <!-- /.form-group -->
                </div> 
                <div class="col-md-12"> 
                <br>
                  <h4>Choisir l’appellation des groupes d’enseignement</h4>
                  <div class="form-group">
                  
                      <div class="radio">
                        <label>
                          <input type="radio" name="appellationGroupe" value="1" <?= ($appellationGroupe == 1) ? 'checked' : '' ?>>
                          <span>Numérique ( G1,G2,G3 ...)</span>
                        </label>
                      </div> 
                       <div class="radio">
                        <label>
                          <input type="radio" name="appellationGroupe" value="2" <?= ($appellationGroupe == 2) ? 'checked' : '' ?>>
                          <span>Alphabétique ( GA,GB,GC ...)</span>
                        </label>
                      </div>  

                    </div> <!-- /.form-group -->
                </div>
                </div>
                <div class="col-sm-6 nbrClassesByNiveau"> 
                 
                <h4>Choisir le nombre de classes par niveau</h4> 

                    <?php $index = ( $appellationClasses ) ? $appellationClasses : 1 ?>
                    <?php $nbr = 0; ?>
                    <?php foreach ( $intituleNiveau[$index] as  $value ): ?> 

                      <div class="form-group" style="display: <?= ( $value ) ? 'block' : 'none' ?>">
                        <label class="col-sm-3 col-xs-6"><span id="nameNiveau"><?= $value ?></span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[$nbr]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>

                      <?php $nbr++; ?>
                    <?php endforeach; ?>  
                    </div>
                    <div class="col-sm-10">
                    </div>
                    <div class="col-sm-2 btn-submit">
                      <button type="submit" class="btn btn-secondary btn-block">Enregistrer</button>
                    </div>
                  </form>
              </div>  <!-- /.row --> 
            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->
        </div> 
      </div>
<?php endif; ?>
<?php if($info['niveau'] == 3): ?>
        <div class="row">
        <div class="col-md-12">
          <div class="portlet appellation-groupe">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-check"></i>
                Groupes / Classes
              </h3> 
            </div> <!-- /.portlet-header -->

            <div class="portlet-content"> 
              <div class="row">

               <form class="form-horizontal" action="<?= base_url() ?>Administration/classesEcole" method="post" style="padding: 10px 20px;">
                
                
                <div class="col-sm-7 nbrClassesByNiveau">  
                 
                <h3>Choisir le nombre de groupes par classe</h3> 

                      <h3 style="margin-top: 30px;">Tronc commun </h3>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Lettres et sciences humaines</span></label> 
                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[0]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences</span></label> 
                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[1]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>

                      <h3 style="margin-top: 40px;">1ère année</h3>
                      <div class="form-group"> 
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences expérimentales</span></label> 
                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[2]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences mathématiques</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[3]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences économiques et gestion</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[4]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>

                      <h3 style="margin-top: 40px;">2ème année </h3>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences Physiques</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[5]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">SVT</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[6]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences mathématiques A</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[7]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences mathématiques B</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[8]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Sciences économiques</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[9]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-6 col-xs-12"><span id="nameNiveau">Techniques de gestion et comptabilité</span></label>

                        <div class="col-xs-6">
                          <select name="classes[]" class="form-control">
                            <?php for ($i=0; $i <= 26 ; $i++): ?>
                              <option 
                                value="<?= $i ?>" 
                                <?= ($i == $nbrClassesByNiveau[10]) ? 'selected' : '' ?>>
                                    <?= $i ?>
                              </option> 
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                                                                 
                      
                    </div>


                    <div class="col-md-5 no-padding">
                  <div class="col-md-12">  
                     <input type="hidden" name="appellationClasses" value="1">
                  </div> 
                  <div class="col-md-12"> 
                    
                    <h3>Choisir l’appellation des groupes d’enseignement</h3>
                    <div class="form-group">
                    
                        <div class="radio">
                          <label>
                            <input type="radio" name="appellationGroupe" value="1" <?= ($appellationGroupe == 1) ? 'checked' : '' ?>>
                            <span>Numérique ( G1,G2,G3 ...)</span>
                          </label>
                        </div> 
                         <div class="radio">
                          <label>
                            <input type="radio" name="appellationGroupe" value="2" <?= ($appellationGroupe == 2) ? 'checked' : '' ?>>
                            <span>Alphabétique ( GA,GB,GC ...)</span>
                          </label>
                        </div>  

                      </div> <!-- /.form-group -->  
                  </div>
                  <div class="col-sm-10">
                  </div>
                  <div class="col-sm-12 btn-submit">
                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                  </div>

                </div> 


                </form>
              </div>  <!-- /.row --> 
 
            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->
        </div> 
      </div> 
<?php endif; ?> 

<div class="portlet appellation-groupe" id="importation">

  <div class="portlet-header">

    <h3>
      <i class="fa fa-table"></i>
      Importation des listes des élèves
    </h3> 
  </div> <!-- /.portlet-header -->

  <div class="portlet-content" id="importXls"> 
    <div class="loader"></div>
    <h4>
      Choisir la classe/groupe et le fichier à importer 
        <a href="<?php echo base_url() ?>assets/img/import-liste.png" target="_blank" class="ui-popover thumbnail-view-hover ui-lightbox" data-toggle="tooltip" data-trigger="hover"  data-placement="right" title="" data-original-title="Comment ça marche ?" data-content="Clique pour voir le modèle"><i class="fa fa-question-circle" style="font-size: 20px;"></i></a>
    </h4> 
 

    <?php $index = ( $appellationClasses ) ? $appellationClasses : 1 ?>

    <form action="importXls" method="post"  class="row"  enctype="multipart/form-data"> 
      <!-- <div class="col-sm-4" style="padding: 0;"> -->
 
        

        <?php if( $info['niveau'] != 3 ): ?>
          <!-- ////////////////////////////////////////////////////////////////////// -->
          <div class="col-sm-2  form-group">
            <select name="classe" class="form-control" id="classes" required  data-state="add">
              <option value="">Classe</option>
              <?php foreach ($intituleNiveau[$index] as $key => $value): ?>
                <?php if($value): ?>
                  <option value="<?= $key+1 ?>"><?= $value ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <!-- ////////////////////////////////////////////////////////////////////// -->
        <?php else: ?>
          <div class="col-sm-4 form-group">
           <select name="classe" class="form-control" id="classes"   data-state="add" required>
            <option value="">Classe</option> 

              <optgroup label="Tronc commun">
                <option value="1">Lettres et sciences humaines</option> 
                <option value="2">Sciences</option> 
              </optgroup">

              <optgroup label="1ère année">
                <option value="3">Sciences expérimentales</option> 
                <option value="4">Sciences mathématiques</option> 
                <option value="5">Sciences économiques et gestion</option> 
              </optgroup">

              <optgroup label="2ème année"> 
                <option value="6">Sciences Physiques</option> 
                <option value="7">SVT</option> 
                <option value="8">Sciences mathématiques A</option> 
                <option value="9">Sciences mathématiques B</option> 
                <option value="10">Sciences économiques</option> 
                <option value="11">Techniques de gestion et comptabilité</option>  
              </optgroup">
          </select> 
        </div>
        <?php endif; ?> 

        <div class="col-sm-2 form-group">
          <select name="groupe" class="form-control" id="groupes" required>
            <option value="">Groupe</option> 
          </select>
        </div>
      <!-- </div> /.col -->
      <div class="col-sm-<?=  ($info['niveau'] == 3) ? 4 : 6 ?> form-group">
        <div class="fileupload fileupload-new" data-provides="fileupload">
          <div class="input-group">
            <div class="form-control" style="white-space: nowrap;overflow: hidden;">
                <i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview" style="position: absolute;left: 31px;top: 7px"></span>
            </div>
            <div class="input-group-btn">
              <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
              <span class="btn btn-default btn-file">
                <span class="fileupload-new">Parcourir</span>
                <span class="fileupload-exists">Changer</span>
                <input name="file" type="file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" style="transform: none;" />
              </span>
            </div>
          </div>
        </div>  
      </div> <!-- /.col -->
      <div class="col-sm-2 form-group">
       <input type="hidden" name="importExcel" value="true">
       <button type="submit" class="btn btn-secondary btn-block">Importer</button>
      </div> <!-- /.col -->
    </form>
  </div>
</div>

<button class="btn btn-warning btn-large" id="deleteGroupe" style="cursor: pointer;margin-bottom: 30px;"> <strong>Envie de supprimer tous les élèves d'un groupe ?</strong></button>

<div id="deleteGroupeContinner" class="portlet appellation-groupe" style="display: none;">

  <div class="portlet-header">

    <h3>
      <i class="fa fa-table"></i>
        Suppression des éléves
    </h3> 
  </div> <!-- /.portlet-header -->

  <div class="portlet-content"> 
    <div class="loader"></div>
    <h4>
      Choisir la classe/groupe des élèves à supprimer
    </h4>

    <?php $index = ( $appellationClasses ) ? $appellationClasses : 1 ?>

    <form id="deleteEleves"  class="row"  enctype="multipart/form-data"> 
      <!-- <div class="col-sm-4" style="padding: 0;"> -->
 
        

        <?php if( $info['niveau'] != 3 ): ?>
          <!-- ////////////////////////////////////////////////////////////////////// -->
          <div class="col-sm-2 form-group">
            <select name="classe" class="form-control" id="classes" required data-state="delete">
              <option value="">Classe</option>
              <?php foreach ($intituleNiveau[$index] as $key => $value): ?>
                <?php if($value): ?>
                   <option value="<?= $key+1 ?>"><?= $value ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <!-- ////////////////////////////////////////////////////////////////////// -->
        <?php else: ?>
          <div class="col-sm-4 form-group">
           <select name="classe" class="form-control" id="classes"  data-state="delete" required>
            <option value="">Classe</option> 

              <optgroup label="Tronc commun">
                <option value="1">Lettres et sciences humaines</option> 
                <option value="2">Sciences</option> 
              </optgroup">

              <optgroup label="1ère année">
                <option value="3">Sciences expérimentales</option> 
                <option value="4">Sciences mathématiques</option> 
                <option value="5">Sciences économiques et gestion</option> 
              </optgroup">

              <optgroup label="2ème année"> 
                <option value="6">Sciences Physiques</option> 
                <option value="7">SVT</option> 
                <option value="8">Sciences mathématiques A</option> 
                <option value="9">Sciences mathématiques B</option> 
                <option value="10">Sciences économiques</option> 
                <option value="11">Techniques de gestion et comptabilité</option>  
              </optgroup">
          </select>
        </div>
        <?php endif; ?>

        
        <div class="col-sm-2 form-group">
          <select name="groupe" class="form-control" id="groupes" required>
            <option value="">Groupe</option> 
          </select>
        </div>
      <!-- </div> /.col --> 
      <div class="col-sm-2 form-group">
       <input type="hidden" name="importExcel" value="true">
       <button type="submit" class="btn btn-danger btn-block">Supprimer</button>
      </div> <!-- /.col -->
    </form>
  </div>
</div>
 
      
<script src="<?= base_url() ?>assets/js/demos/form-extended.js"></script>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/magnific/magnific-popup.css">
<script src="<?php echo base_url() ?>assets/js/plugins/magnific/jquery.magnific-popup.min.js"></script>

<script type="text/javascript"> 

$(document).ready(function () {
  $('input:checkbox, input:radio').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue',
    inheritClass: true
  }) 
  $('input#appellationClasses-1,input#appellationClasses-2,input#appellationClasses-3').on('ifChanged', function(event){ 
    setTimeout(function() {
     var tab = $('.appellationClasses > div label > div.checked').parent().attr('data-value').split(', ');
     var i = 0;
     $('.nbrClassesByNiveau .form-group').each(function () {
      $(this).find('span#nameNiveau').text(tab[i]);
      if( tab[i] ){
        $(this).show();
      }else{
        $(this).hide().find('select').val(0);
      }
     i++; 
     })
   },500) 
  }); 

  $('select#classes').on('change', function(event){ 
     var nbrClassesByNiveau = <?= json_encode($nbrClassesByNiveau) ?>;
     var intituleGroupe = <?= json_encode($intituleGroupe) ?>;
     var GetNbrClientsByGroupe = <?=  (count($GetNbrClientsByGroupe) == 0)? '{}' : json_encode($GetNbrClientsByGroupe) ?>;

     console.log(GetNbrClientsByGroupe)

     var dataState = $(this).attr("data-state");

     var classe = $(this).val();
     $('select#groupes').html('').append('<option value="">Groupe</option>');
     for (var i = 1; i <= nbrClassesByNiveau[classe-1]; i++) {

        if( !GetNbrClientsByGroupe.hasOwnProperty( classe+i ) && dataState == 'add' ){
          $('select#groupes').append('<option value="'+i+'"> G'+ intituleGroupe[i-1] +' </option>');
        }

        if( GetNbrClientsByGroupe.hasOwnProperty( classe+i ) && dataState == 'delete' ){
          $('select#groupes').append('<option value="'+i+'"> G'+ intituleGroupe[i-1] +' </option>');
        }
     }
  }); 

  $('#importXls form').submit(function () {
      $(this).parent().find('.loader').fadeIn();
  })

  $('#deleteGroupe').click(function () {
    $(this).slideUp().next().slideDown();
    $("html, body").animate({ scrollTop: $(document).height() }, 500);
  })

  $('form#deleteEleves').submit(function (event) {
    event.preventDefault();
    var groupe = $('#deleteGroupeContinner').find("select#classes :selected").text()+" "+ $('#deleteGroupeContinner').find("select#groupes :selected").text()
    swal({
      title: "Confirmation",
      text: "Saisir votre mot de passe pour confirmer la suppression des élèves du "+ groupe,
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Valider",
      cancelButtonText: "Annuler",
      animation: "slide-from-top",
      inputPlaceholder: "Mot de passe",
      showLoaderOnConfirm: true,
    },
    function(password){
      if (password === false) return false;
      
      if (password === "") {
        swal.showInputError("Tapez votre mot de passe");
        return false
      }
      
      $.ajax({
          type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
          url         : '<?= base_url() ?>Administration/deleteClientFromGroupe', // the url where we want to POST
          data        : {
              classe: $('#deleteGroupeContinner').find("select#classes").val(),
              groupe: $('#deleteGroupeContinner').find("select#groupes").val(),
              password: password
          }, // our data object
          dataType    : 'json' // what type of data do we expect back from the server 
      }).done(function(data) {  
        if( data == 1){  


          swal({
            title: "Succès",
            text: "Les élèves du "+groupe +"sont bien supprimés",
            type: "success",
            showCancelButton: true, 
            showConfirmButton: false, 
            cancelButtonText: "Fermer"
          },
          function(isConfirm){
            if (!isConfirm) {
              window.location.href = window.location.href;
            }
          });

        }
        if( data == 0){  
          swal.showInputError("Mot de passe incorrect");
        }
      })
      
    });
  })

})
</script>
<style type="text/css">
  .nbrClassesByNiveau .form-group:hover {
    background: #53bfaa;
  }
</style>


