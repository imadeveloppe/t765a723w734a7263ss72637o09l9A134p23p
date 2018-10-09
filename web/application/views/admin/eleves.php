<div class="content-header">
        <h2 class="content-header-title">Gérer les élèves</h2>
        <ol class="breadcrumb">
          <li><a href="./">Home</a></li> 
          <li><a href="#">Gérer</a></li>
          <li class="active">Gérer les élèves</li>
        </ol>
      </div> <!-- /.content-header --> 


       <div class="row">

       <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Filtrer par classe/groupe
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">  

                <form action="" method="post"  class="row filterEleve"  enctype="multipart/form-data"> 
                  <!-- <div class="col-sm-4" style="padding: 0;"> -->
             
                    
                    <?php if( $info['niveau'] != 3 ): ?>
                      <!-- ////////////////////////////////////////////////////////////////////// -->
                      <?php $index = ( $appellationClasses ) ? $appellationClasses : 1 ?>
                      <div class="col-sm-2 form-group"> 
                        <select name="classe" class="form-control" id="classes" required  data-state="add">
                          <option value="">Classe</option>
                          <?php foreach ($intituleNiveau[$index] as $key => $value): ?>
                            <?php $selected = (isset($_POST['classe']) && $_POST['classe'] == $key+1 ) ? "selected" : '' ?>
                              <?php if($value): ?>
                                <option value="<?= $key+1 ?>" <?= $selected ?>><?= $value ?></option>
                              <?php endif ?>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <!-- ////////////////////////////////////////////////////////////////////// -->
                    <?php else: ?>
                      <div class="col-sm-4 form-group">
                       <select name="classe" class="form-control" id="classes" required>
                        <option value="">Classe</option> 

                          <optgroup label="Tronc commun">
                            <option value="1" <?= (isset($_POST['classe']) && $_POST['classe'] == 1 ) ? "selected" : '' ?>>Lettres et sciences humaines</option> 
                            <option value="2" <?= (isset($_POST['classe']) && $_POST['classe'] == 2 ) ? "selected" : '' ?>>Sciences</option> 
                          </optgroup">

                          <optgroup label="1ère année">
                            <option value="3" <?= (isset($_POST['classe']) && $_POST['classe'] == 3 ) ? "selected" : '' ?>>Sciences expérimentales</option> 
                            <option value="4" <?= (isset($_POST['classe']) && $_POST['classe'] == 4 ) ? "selected" : '' ?>>Sciences mathématiques</option> 
                            <option value="5" <?= (isset($_POST['classe']) && $_POST['classe'] == 5 ) ? "selected" : '' ?>>Sciences économiques et gestion</option> 
                          </optgroup">

                          <optgroup label="2ème année"> 
                            <option value="6" <?= (isset($_POST['classe']) && $_POST['classe'] == 6 ) ? "selected" : '' ?>>Sciences Physiques</option> 
                            <option value="7" <?= (isset($_POST['classe']) && $_POST['classe'] == 7 ) ? "selected" : '' ?>>SVT</option> 
                            <option value="8" <?= (isset($_POST['classe']) && $_POST['classe'] == 8 ) ? "selected" : '' ?>>Sciences mathématiques A</option> 
                            <option value="9" <?= (isset($_POST['classe']) && $_POST['classe'] == 9 ) ? "selected" : '' ?>>Sciences mathématiques B</option> 
                            <option value="10" <?= (isset($_POST['classe']) && $_POST['classe'] == 10 ) ? "selected" : '' ?>>Sciences économiques</option> 
                            <option value="11" <?= (isset($_POST['classe']) && $_POST['classe'] == 11 ) ? "selected" : '' ?>>Techniques de gestion et comptabilité</option>  
                          </optgroup">
                      </select>
                    </div>
                    <?php endif; ?>

                    
                    <div class="col-sm-2 form-group">
                      <select name="groupe" class="form-control" id="groupes" required>
                        <option value="">Groupe</option>
                        <?php for ($i=1; $i <= $nbrClassesByNiveau[0] ; $i++): ?>
                           
                              <?php $selectedGroupe = (isset($_POST['groupe']) && $_POST['groupe'] == $i ) ? "selected" : '' ?>
                              <option value="<?= $i ?>" <?= $selectedGroupe ?>>
                                  G<?= $intituleGroupe[$i-1] ?>
                              </option>  

                        <?php endfor; ?>
                      </select>
                    </div>
                  <!-- </div> /.col --> 
                  <div class="col-sm-2 form-group"> 
                   <button type="submit" class="btn btn-warning btn-block"><strong>Filtrer</strong></button>
                  </div> <!-- /.col -->
                  <?php if(isset($_POST['classe']) &&  isset($_POST['groupe'])): ?> 
                      <div class="col-sm-3 col-sm-6 form-group"> 
                       <a href="/Administration/eleves" class="btn btn-info btn-block"><strong>Afficher tous</strong></a>
                      </div> <!-- /.col -->
                  <?php endif; ?> 
                </form>

            </div>

          </div>
        </div>

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Liste des élèves
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">           

              <div class="table-responsive"> 



              <?php if( !hasAccess('gerer_eleves_readonly') or !$info['subAdmin'] ): ?> 
              
                <div class="block-buttons" style="text-align: right;">

                  <?php if(!isset($_POST['classe']) &&  !isset($_POST['groupe'])): ?> 
                    <a class="btn btn-danger hidden-xs" data-toggle="modal" href="#tousSuspendre"> 
                      <strong>
                        <i class="fa fa-times-circle" aria-hidden="true" style="font-size: 20px;position: relative;bottom: -2px;"></i>
                        Tout suspendre  
                      </strong>
                    </a>
                    <a class="btn btn-success hidden-xs" data-toggle="modal" href="#tousValider"> 
                      <strong>
                        <i class="fa fa-check-circle" aria-hidden="true" style="font-size: 20px;position: relative;bottom: -2px;"></i> 
                        Tout valider 
                      </strong>
                    </a>
                  <?php endif; ?> 

                  <button class="btn btn-secondary" data-toggle="modal" href="#new-eleve">
                    <strong>
                      <i class="fa fa-plus-circle" style="font-size: 20px;""></i> 
                      Nouvel élève
                    </strong> 
                  </button>
                </div>

              <?php endif; ?> 
              
              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                data-provide="datatable" 
                data-display-rows="50"
                data-info="true"
                data-search="false"
                data-length-change="true"
                data-paginate="true" 
                id="DataTable"
                >   
                  <?php 
                  $validateUsers = 0; 
                  foreach ($eleves as $key => $value) {
                    $validateUsers = ($value->state == 1 && !empty($value->nomParent) ) ? $validateUsers+1 : $validateUsers;
                  }?>
                  <thead>
                    <tr > 
                      <th data-filterable="true" data-sortable="false" class="hidden-xs">Classe/Groupe</th>
                      <th data-filterable="true" data-sortable="true" data-direction="asc">Elève</th>
                      <th data-filterable="true" data-sortable="false">Identifiant</th>
                      <th data-filterable="false" data-sortable="false">Mot de passe</th>
                      <th data-filterable="false" class="hidden-xs">Tel Parent</th>
                      <th data-filterable="false" class="center">Carte Elève</th>

                      
                      <?php if( !hasAccess('gerer_eleves_readonly') or !$info['subAdmin']): ?> 
                        <th data-filterable="false" class="hidden-xs center">Modifier</th>
                      <?php endif; ?> 
                        <th data-filterable="false" class="center">Valider <span class="badge btn-primary"><?= $validateUsers ?>/<?= count($eleves) ?></span> </th> 
                     <?php if( !hasAccess('gerer_eleves_readonly') or !$info['subAdmin']): ?> 
                        <th data-filterable="false" class="hidden-xs center">Supprimer</th>
                      <?php endif; ?> 


                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($eleves as $eleve ) : ?>
                    <tr 
                      data-id='<?= $eleve->idClient ?>' 
                      data-classe="<?= $eleve->classe ?>"
                      data-groupe="<?= $eleve->groupe ?>"

                      data-photo="<?= $eleve->photo ?>" 
                      data-statephoto="<?= $eleve->statePhoto ?>" 
                      data-fname="<?= $eleve->fname ?>" 
                      data-lname="<?= $eleve->lname ?>" 
                      data-code="<?= $eleve->code ?>" 
                      data-password="<?= $eleve->password ?>" 
                      data-ClassEleve="<?= $intituleClasse[ $eleve->classe - 1 ] ?>-G<?= $intituleGroupe[ $eleve->groupe - 1 ] ?>" 
                      data-nomParent="<?= $eleve->nomParent ?>"
                      data-telParent="<?= $eleve->telParent ?>"
                      data-maladie="<?= $eleve->maladie ?>"
                      data-remarque="<?= $eleve->remarque ?>"  

                      class="<?= ($eleve->state == 0 && !empty($eleve->telParent)) ? 'NewInscription' : '' ?>">

                      <td class="hidden-xs classeEleve" style="vertical-align: middle;">
                      <?= $intituleClasse[ $eleve->classe - 1 ] ?>-G<?= $intituleGroupe[ $eleve->groupe - 1 ] ?>
                      </td>
                      <td style="vertical-align: middle;" class="nameEleve"  > 
                           <?php if($eleve->state == 0 && !empty($eleve->telParent)): ?> 
                              <span style="display: none;">0123456789abcdefghi</span>
                          <?php endif ?>
                          <?= $eleve->lname ?> <?= $eleve->fname ?>  

                      </td>

                      <td style="vertical-align: middle;" class="codeEleve"> 

                          <?= $eleve->code ?>  

                      </td>
                      <td style="vertical-align: middle;" class="passwordEleve"> 

                          <?= $eleve->password ?>  

                      </td>
                      <td class="hidden-xs center telParent"  
                          style="vertical-align: middle;"><?= str_replace("/", "&nbsp;/&nbsp;", $eleve->telParent) ?></td>

                      <td class="center"> 
                        <a  href="#carte-eleve" 
                              class="btn btn-info infoEleve" 
                              data-toggle="modal"
                              style="padding: 0 5px;font-size: 21px;">
                            <i class="fa fa-id-card" aria-hidden="true"></i> 
                          </a>
                      </td> 
                      

                      <?php if( !hasAccess('gerer_eleves_readonly') or !$info['subAdmin']): ?> 
                          <td class="hidden-xs center"> 
                            <a  
                              data-toggle="modal" 
                              href="#edit-info-eleve"  

                              class="btn btn-warning edit-row">
                              <i class="fa fa-pencil"></i>
                            </a>
                          </td>  
                      <?php endif; ?> 

                          <td class="center">
                          <?php if( !hasAccess('gerer_eleves_readonly') or !$info['subAdmin']): ?> 
                            <a href="#" class="valid-row <?= ($eleve->state == '1') ? 'active' : '' ?>"></a> 
                           <?php else: ?> 
                              <span style="cursor: not-allowed;"  class="valid-row <?= ($eleve->state == '1') ? 'active' : '' ?>"></span> 
                            <?php endif; ?>
                          </td> 
                      <?php if( !hasAccess('gerer_eleves_readonly') or !$info['subAdmin']): ?>    
                          <td class="hidden-xs center">
                            <a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row">
                              <i class="fa fa-trash-o"></i>
                            </a>
                          </td> 
                      <?php endif; ?> 


                    </tr> 
                  <?php endforeach; ?>

                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->
              

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet --> 

        </div> <!-- /.col -->

      </div> <!-- /.row -->

 


<script type="text/javascript"> 

function addClient(){
    $('#new-eleve').find('.alert').slideUp()
    $('#new-eleve .loader').fadeIn();
    $('#new-eleve form').find('[name=photo]').val( $("#new-eleve").find('.fileupload-preview').find('img').attr('src') );
 
    var formData = { 
            'clientData'   : $('#new-eleve form').serialize()
    }; 
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/addClientFromAdmin/',
        data        : formData ,
        dataType    : 'json' // what type of data do we expect back from the server 
    }).done(function(data) {
      $('#new-eleve').scrollTop(0);
      $('#new-eleve .loader').fadeOut();
      if(data.success == 1){
        $('#new-eleve ').find('.alert.alert-success').slideDown().find('strong').text( data.message );
        setTimeout(function () {
          window.location.href = window.location.href;
        },2000)
      }else{
        $('#new-eleve ').find('.alert.alert-danger').slideDown().find('strong').html( data.message );
        $('#new-eleve form').find('[name=code]').focus();
      } 
    })

}
function updateClient() { 
    $('#edit-info-eleve').find('.alert').slideUp()
    $('#edit-info-eleve .loader').fadeIn();
    $('#edit-info-eleve form').find('#photo').val( $("#edit-info-eleve").find('.fileupload-preview').find('img').attr('src') );
    var formData = { 
            'clientData'   : $('#edit-info-eleve form').serialize()
    }; 
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/updateClient/',
        data        : formData ,
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
        $('#edit-info-eleve').scrollTop(0);
        $('#edit-info-eleve .loader').fadeOut();
       if( data != "false" ){ 
           $('#edit-info-eleve').find('.alert').slideDown()
           $('#edit-info-eleve .loader').fadeOut(); 
            var tr = $('tr[data-id='+$('#edit-info-eleve #idClient').val()+']');
            tr.attr('data-fname',$('#edit-info-eleve  #fname').val());
            tr.attr('data-lname',$('#edit-info-eleve  #lname').val());
            tr.attr('data-classe',$('#edit-info-eleve  #classe').val());
            tr.attr('data-groupe',$('#edit-info-eleve  #groupe').val());
            
            tr.attr('data-photo', data);
            tr.find('td.classeEleve').text($('#edit-info-eleve  #classe option:selected').text()+'-G'+$('#edit-info-eleve  #groupe option:selected').text());
            tr.find('td.nameEleve').text($('#edit-info-eleve  #fname').val()+" "+$('#edit-info-eleve  #lname').val()); 
            tr.find('td.codeEleve').text($('#edit-info-eleve  #code').val());
            tr.find('td.passwordEleve').text($('#edit-info-eleve  #password').val());
            

            if( $('#edit-info-eleve  .nomParent2').val() == "" &&  $('#edit-info-eleve  .telParent2').val() == ""){
              tr.attr('data-nomParent',$('#edit-info-eleve  .nomParent').val());
              tr.attr('data-telParent',$('#edit-info-eleve  .telParent').val());
              tr.find('td.telParent').text($('#edit-info-eleve  .telParent').val());
            }else{
              tr.attr('data-nomParent',$('#edit-info-eleve  .nomParent').val()+"/"+$('#edit-info-eleve  .nomParent2').val() );
              tr.attr('data-telParent',$('#edit-info-eleve  .telParent').val()+"/"+$('#edit-info-eleve  .telParent2').val() );
              tr.find('td.telParent').text($('#edit-info-eleve  .telParent').val()+" / "+$('#edit-info-eleve  .telParent2').val());
            }


            tr.attr('data-maladie',$('#edit-info-eleve  #maladie').val());
            tr.attr('data-remarque',$('#edit-info-eleve  #remarque').val());

  
       }
    }); 
}
$(document).ready(function() { 

  $('.infoEleve').click(function () {
     var data = {
      photo: $(this).parents('tr').attr('data-photo'),
      nom: $(this).parents('tr').attr('data-fname')+' '+$(this).parents('tr').attr('data-lname'),
      code: $(this).parents('tr').attr('data-code'),
      classe: $(this).parents('tr').attr('data-ClassEleve'),
      parent: $(this).parents('tr').attr('data-nomParent'),
      tel: $(this).parents('tr').attr('data-telParent'),
      maladie: $(this).parents('tr').attr('data-maladie'),
      remarque: $(this).parents('tr').attr('data-remarque'),
     } 
     var card = $('#carte-eleve');
     if(data.photo != '')  card.find("#carte-photoEleve").attr('src', data.photo); else card.find("#carte-photoEleve").attr('src', card.find("#carte-photoEleve").attr('data-src') );
     card.find("#carte-nomEleve").text(data.nom)
     card.find("#carte-codeEleve").text(data.code)
     card.find("#carte-classeEleve").text(data.classe)

     if(data.parent == ''){
      $('#carte-eleve tr.block-parents').hide();

     }else if( data.parent.search('/') > 0 ){
        $('#carte-eleve tr.block-parents').show();
        card.find("#carte-nomParent").hide()
        card.find("#carte-telParent").hide()
        card.find("#carte-nomParents").show().find('.parent1').text( data.parent.split('/')[0] )
        card.find("#carte-nomParents").show().find('.parent2').text( data.parent.split('/')[1] )
        card.find("#carte-telParents").show().find('.parent1').text( data.tel.split('/')[0] )
        card.find("#carte-telParents").show().find('.parent2').text( data.tel.split('/')[1] )
     }else{
        $('#carte-eleve tr.block-parents').show();
        card.find("#carte-nomParent").show().text(data.parent)
        card.find("#carte-telParent").show().text(data.tel)
        card.find("#carte-nomParents").hide();
        card.find("#carte-telParents").hide();
     } 

     if(data.maladie != '') card.find("#carte-maladie").html(data.maladie); else card.find("#carte-maladie").html( card.find("#carte-maladie").attr('data-content') ) 
     if(data.remarque != '') card.find("#carte-remartque").html(data.remarque); else card.find("#carte-remartque").html( card.find("#carte-remartque").attr('data-content') )
  })

  $('td a.valid-row').click(function() {
    var self = $(this);
    if( self.parents('tr').find('.telParent').text() != '' ){
      self.toggleClass('active').parents('tr').toggleClass('NewInscription');
    } 

    var idClient = self.parents('tr').attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/editStateClient/'+idClient,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          if( !self.hasClass('active') ){
            self.addClass('active')
          }

          //////////////////////////////////////////////////////
          if( self.parents('tr').attr('data-nomParent') != '' ){
            var tab = $('th .badge').text().split('/'); 
            $('th .badge').text( parseInt(tab[0]) + 1 +"/"+ tab[1] )
 
          }
          //////////////////////////////////////////////////////
          checkNotif = false;
          notification();

       }else{
          if( self.hasClass('active') ){
            self.removeClass('active')
          } 

          //////////////////////////////////////////////////////
          if( self.parents('tr').attr('data-nomParent') != '' ){
            var tab = $('th .badge').text().split('/'); 
            $('th .badge').text( parseInt(tab[0]) - 1 +"/"+ tab[1] )
          }
          //////////////////////////////////////////////////////

          checkNotif = false;
          notification();
       }
    }); 
    return false;
  })

  var removeRow;
  $('.remove-row').click(function() { 
    removeRow = $(this).parents('tr') 
  })

  var removeParent;
  $('.remove-parent').click(function() { 
    removeParent = $(this);
  })
  $('#confirmation .confirm').click(function() { 

    var idClient = removeRow.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/deleteClient/'+idClient, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          removeRow.fadeOut('slow'); 
          setTimeout(function() {
            removeRow.remove(); 
            ////////////////////////////////////////////////////// 
                var tab = $('th .badge').text().split('/'); 
                ///isValidated///
                var nbrValid = tab[0];
                if(removeRow.find('.valid-row').hasClass('active') && removeRow.attr('data-telparent') != ''){
                  nbrValid = parseInt(nbrValid) - 1;
                  console.log(nbrValid)
                }
                /////
                $('th .badge').text(  nbrValid+"/"+ (parseInt(tab[1]) - 1) ) 
            //////////////////////////////////////////////////////
          },1000) 
       }
    }); 

  })

  $('#DeleteParent .confirm').click(function() { 

    var idClient = $('#idClient').val();
    var indexParent = removeParent.attr('data-parent');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/deleteParent/'+idClient+"/"+indexParent, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          window.location.reload();  
       }
    }); 
    
  })


  $('.edit-row').click(function () {
    $('#edit-info-eleve').find('.alert').slideUp()
    var idClient = $(this).parents('tr').attr('data-id'); 
    var classe = parseInt($(this).parents('tr').attr('data-classe'));
    var groupe = parseInt($(this).parents('tr').attr('data-groupe'));

    var photo = $(this).parents('tr').attr('data-photo');
    var statePhoto = $(this).parents('tr').attr('data-statephoto');
    var nom = $(this).parents('tr').attr('data-nom');
    var fname = $(this).parents('tr').attr('data-fname');
    var lname = $(this).parents('tr').attr('data-lname');
    var code = $(this).parents('tr').attr('data-code');
    var password = $(this).parents('tr').attr('data-password');
    var nomParent = $(this).parents('tr').attr('data-nomParent');
    var tel = $(this).parents('tr').attr('data-telParent');
    var maladie = $(this).parents('tr').attr('data-maladie');
    var remarque = $(this).parents('tr').attr('data-remarque');

    if( photo != '' ){
      $('#edit-info-eleve').find('.photoEleve').find('.thumbnail').html('<img src="'+photo+'">')
      $('#edit-info-eleve').find('.photoEleve').find('.fileupload').addClass('fileupload-exists').removeClass('fileupload-new')
      if( parseInt(statePhoto) == 1 ){
        $('#edit-info-eleve').find('.photoEleve').find('.valid-row').addClass('active').show();
      }else{
        $('#edit-info-eleve').find('.photoEleve').find('.valid-row').removeClass('active').show();
      }

    }else{
      $('#edit-info-eleve').find('.photoEleve').find('.thumbnail').html('')
      $('#edit-info-eleve').find('.photoEleve').find('.fileupload').removeClass('fileupload-exists').addClass('fileupload-new')
      $('#edit-info-eleve').find('.photoEleve').find('.valid-row').hide();
    }
    $('#edit-info-eleve').find('#nomParent').val(photo);

    $('#edit-info-eleve').find('#classe').val(classe);
    $('#edit-info-eleve').find('#idClient').val(idClient); 
    $('#edit-info-eleve').find('#fname').val(fname); 
    $('#edit-info-eleve').find('#lname').val(lname); 
    $('#edit-info-eleve').find('#code').val(code); 
    $('#edit-info-eleve').find('#password').val(password); 

    if(nomParent == ''){
      $('#edit-info-eleve div.block-parents').hide();
      $('#edit-info-eleve').find('input.nomParent').val('');
      $('#edit-info-eleve').find('input.telParent').val('');
      $('#edit-info-eleve').find('input.nomParent2').hide().val('');
      $('#edit-info-eleve').find('input.telParent2').hide().val('');

    }else if( nomParent.search('/') > 0 ){
      $('#edit-info-eleve div.block-parents').show();
      $('#edit-info-eleve').find('input.nomParent').val(nomParent.split("/")[0]);
      $('#edit-info-eleve').find('input.telParent').val(tel.split("/")[0]);
      $('#edit-info-eleve').find('input.nomParent2').val(nomParent.split("/")[1]).show();
      $('#edit-info-eleve').find('input.telParent2').val(tel.split("/")[1]).show();
      $('.remove-parent2').show();

    }else{
      $('#edit-info-eleve div.block-parents').show();
      $('#edit-info-eleve').find('input.nomParent').val(nomParent);
      $('#edit-info-eleve').find('input.telParent').val(tel);
      $('#edit-info-eleve').find('input.nomParent2').hide().val('');
      $('#edit-info-eleve').find('input.telParent2').hide().val('');
      $('.remove-parent2').hide();
    }
    $('#edit-info-eleve').find('#nomParent').val(nomParent);
    $('#edit-info-eleve').find('#telParent').val(tel);

    $('#edit-info-eleve').find('#maladie').val(maladie);
    $('#edit-info-eleve').find('#remarque').val(remarque);
    

    //////////// Groupe ///////////////////
    var appellationGroupe = $('#edit-info-eleve form').attr('data-appellationGroupe').split(',');
    var nbrClassesByNiveau = $('#edit-info-eleve form').attr('data-nbrClassesByNiveau').split(',');

    $('#edit-info-eleve').find('#groupe').html('');
    for (var i = 1; i <= nbrClassesByNiveau[classe-1] ; i++) {
       $('#edit-info-eleve').find('#groupe').append('<option value="'+i+'">'+appellationGroupe[i-1]+'</option>')
    }
     $('#edit-info-eleve').find('#groupe').val(groupe);

  })

  $('#edit-info-eleve #classe').change(function() {

    var modal = $(this).parents('.modal');

    var appellationGroupe = modal.find('form').attr('data-appellationGroupe').split(',');
    var nbrClassesByNiveau = modal.find('form').attr('data-nbrClassesByNiveau').split(',');

      classe = $(this).val();
      modal.find('#groupe').html(''); 
      for (var i = 1; i <= nbrClassesByNiveau[classe-1] ; i++) {
        modal.find('#groupe').append('<option value="'+i+'">'+appellationGroupe[i-1]+'</option>')
      } 
  })

  $('#new-eleve #classe').change(function() {

    var modal = $(this).parents('.modal');

    var appellationGroupe = modal.find('form').attr('data-appellationGroupe').split(',');
    var nbrClassesByNiveau = modal.find('form').attr('data-nbrClassesByNiveau').split(',');

      classe = $(this).val();
      modal.find('#groupe').html(''); 

      modal.find('#groupe').append('<option></option>')
      for (var i = 1; i <= nbrClassesByNiveau[classe-1] ; i++) {
        modal.find('#groupe').append('<option value="'+i+'">'+appellationGroupe[i-1]+'</option>')
      } 
  })

  $('form#addClient').submit(function(e) {
    e.preventDefault();
    addClient();
  })

  $('#edit-info-eleve .sumbit-form').click(function() {
    updateClient();
  })

  
  $('table tr[cls=dataTable-filter-row] th').each(function () {
    $(this).find('input').attr('placeholder','Recherche par '+$(this).find('input').attr('placeholder') )
  })

  $('.photoEleve .valid-row').click(function(e) {
      e.preventDefault();
      var self = $(this);
      self.toggleClass('active');
      var idClient = $('#idClient').val();
      $.ajax({
          type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
          url         : '<?= base_url() ?>Administration/editStatePhotoClient/'+idClient,  
          dataType    : 'text' // what type of data do we expect back from the server 
      }).done(function(data) {  
        if(self.hasClass('active')){ 
          $('tr[data-id='+$('#idClient').val()+']').attr('data-statephoto', 1);
        }else{
          $('tr[data-id='+$('#idClient').val()+']').attr('data-statephoto', 0);
        }
      }); 
  })

  $('select#classes').on('change', function(event){ 
     var nbrClassesByNiveau = <?= json_encode($nbrClassesByNiveau) ?>;
     var intituleGroupe = <?= json_encode($intituleGroupe) ?>;
     var GetNbrClientsByGroupe = <?= json_encode($GetNbrClientsByGroupe) ?>;
 

     var classe = $(this).val();
     $('select#groupes').html('').append('<option value="">Groupe</option>');
     for (var i = 1; i <= nbrClassesByNiveau[classe-1]; i++) {
  
        $('select#groupes').append('<option value="'+i+'"> G'+ intituleGroupe[i-1] +' </option>');
        
     }
  });

  // $('#DataTable').dataTable({
  //   "aaSorting": [[ 0, 'asc' ]],
  //    "bFilter": true, 
  //    "bSort": true,
  //    "bInfo": true,
  //    "iDisplayLength": 50,
  //    "bProcessing": true,
  //  });

  
    
}) 
</script>
<style type="text/css">
  .fileupload .thumbnail > img { 
      display: block;
  }
  tr.NewInscription td {
      background: #fbe5e5 !important;
  }
</style>