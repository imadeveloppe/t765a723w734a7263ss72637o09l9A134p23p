<div class="content-header">
  <h2 class="content-header-title">Historique des envois</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>  
    <li class="active">Historique</li>
  </ol>
</div> <!-- /.content-header --> 
<ul id="myTab1" class="nav nav-tabs">

  
  <?php if( hasAccess('historique_prof_parents') ): ?>
    <li class="active">
      <a href="#prof" data-toggle="tab">Professeurs -> Parents</a>
    </li>
  <?php endif; ?> 
  <?php if( hasAccess('historique_admin_parents') ): ?> 
    <li>
      <a href="#admin-parent" data-toggle="tab">Administration -> Parents</a>
    </li> 
  <?php endif; ?> 
  <?php if( hasAccess('historique_admin_prof') ): ?> 
    <li>
      <a href="#admin-prof" data-toggle="tab">Administration -> Professeurs </a>
    </li> 
  <?php endif; ?>  


</ul> 
<div id="myTab1Content" class="tab-content">

  
  <?php if( hasAccess('historique_prof_parents') ): ?>
      <div class="tab-pane fade in active" id="prof">
        <?php if( $MessagesProf ): ?> 
        <div style="padding: 20px 0;text-align: right;">
          <button class="btn btn-warning btn-lg" data-toggle="modal" href="#exportMessages-prof-parent">Exporter l'historique <i class="fa fa-download"></i> </button>
        </div>
        <form id="support-search" class="form">
                  <div class="form-group">
                     <label class="form-label">
                      Rechercher par Nom du Prof, de l'élève, Classe/Groupe, Matière et contenu du message
                    </label>
                    <div class="input-group"> 
                      <input id="support-search-field" type="text" class="form-control input-lg input-filter" name="input-filter" />
                      <span class="input-group-btn">
                            <button id="support-search-btn" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search"></i></button>
                          </span>
                    </div>

                  </div>
          </form> 
        <?php foreach ($MessagesProf as $MessageProf):?>
          <?php $MessageProf->content = nl2br($MessageProf->content) ?>
        <div class="item-to-send" data-id="<?= $MessageProf->idMessage ?>">
        <div class="loader"></div>
           <div class="list-group"> 
              <div href="javascript:;" class="list-group-item">
                <div class="row"> 
                    <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-3 info-sender">
                            <h5><i class="fa fa-calendar"></i> &nbsp;&nbsp;<?= date('d/m/Y', $MessageProf->time) ?></h5> 
                            <h5><i class="fa fa-user"></i> &nbsp;&nbsp;Prof.  <?= $MessageProf->prof ?></h5>  
                            <h5><i class="fa fa-book"></i> &nbsp;&nbsp;<?= $MessageProf->matiere ?></h5>  
                          </div>
                          <div class="col-sm-9">
                            <h5> 
                              Destinataires : 
                              <?php 
                              foreach ($MessageProf->destination as $key => $destinataires) {
                                $MessageProf->destination[$key] = '<span class="item-destinataire">'.$destinataires.'</span>';
                              }
                              ?> 
                                <?= implode(' ', $MessageProf->destination) ?> 
         
                            </h5>  
                            <div class="content-message" dir="<?= (strpos($MessageProf->content, 'dir="rtl"') > 0)?'rtl':'' ?>">
                                <span><?= strip_tags($MessageProf->content) ?></span>
                                <div style="display: none;" class="contentMessage">
                                  <div dir="<?= (strpos($MessageProf->content, 'dir="rtl"') > 0)?'rtl':'' ?>">
                                    <?=  str_replace("<br /><br />", "<br>", $MessageProf->content) ?>   
                                  </div>
                                  <?php if(!empty($MessageProf->date)): ?>
                                    <br><em style="display: block;">Pour le: <?= $MessageProf->date ?> </em>
                                  <?php endif; ?>
                                </div>
                                <a data-toggle="modal" href="#more-info" class="read-more" data-id="<?= $MessageProf->idMessage ?>">Lire la suite</a>
                            </div> 
                            <?php if(!empty($MessageProf->file)): ?> 
                                <a href="<?php echo base_url() ?>assets/upload/<?= $MessageProf->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a>&nbsp; &nbsp; &nbsp;
                             <?php endif; ?>   
                                <a href="javascript:;" class="ui-popover" data-toggle="tooltip" data-placement="right" data-trigger="hover" data-html="true" data-content="<?= $MessageProf->vu ?>" title="">
                                    <i class="icon-li fa fa-eye text-secondary"></i> 
                                    <?= $MessageProf->nbrVu ?> personne(s)
                                </a> 
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2"  style="padding-left: 0;">
                      <div class="list-group">
                       <!--  <a  data-toggle="modal" href="sendToParent/<?= $MessageProf->idMessage ?>" class="list-group-item remove-row">
                          <i class="fa fa-share"></i>
                          &nbsp;&nbsp;<strong>Transférer</strong>
                        </a>  -->
                        <!-- <a href="javascript:;" class="list-group-item rejet-message" title="Annuler l'envoi de ce message">
                          <i class="fa fa-mail-reply"></i> 
                          &nbsp;&nbsp;<strong>Annuler</strong>
                        </a>  -->
                        <a  data-toggle="modal" href="#confirmation" class="list-group-item remove-row">
                          <i class="fa fa-times"></i>
                          &nbsp;&nbsp;<strong>Supprimer</strong>
                        </a> 
                      </div>
                    </div>
                    </div>  
              </div> 
            </div>
        </div> 
        <?php endforeach; ?>

        <?php else: ?> 
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
            <strong>Aucun envoi pour l'instant</strong>
        </div>
        <?php endif; ?> 
      </div>
  <?php endif; ?> 

  
  <?php if( hasAccess('historique_admin_parents') ): ?>
      <div class="tab-pane fade" id="admin-parent"> 
        <?php if( $MessagesCentre ): ?> 
          <div style="padding: 20px 0;text-align: right;">
            <button class="btn btn-warning btn-lg" data-toggle="modal" href="#exportMessages-admin-parent">Exporter l'historique <i class="fa fa-download"></i> </button>
          </div>
        <form id="support-search" class="form">
                  <div class="form-group">
                     <label class="form-label">
                       Rechercher par Nom de l'élève, Classe/Groupe et contenu du message
                    </label>
                    <div class="input-group"> 
                      <input id="support-search-field" type="text" class="form-control input-lg input-filter" name="input-filter" />
                      <span class="input-group-btn">
                            <button id="support-search-btn" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search"></i></button>
                          </span>
                    </div>

                  </div>
          </form> 
        <?php foreach ($MessagesCentre as $MessageCentre):?>
          <?php $MessageCentre->content = nl2br($MessageCentre->content) ?>
          <?php if( $MessageCentre->categorie == 'parent'): ?>
            <?php //$MessageCentre->content = nl2br($MessageCentre->content) ?>
           <div class="item-to-send" data-id="<?= $MessageCentre->idMessage ?>">
              <div class="loader"></div>
                 <div class="list-group"> 
                    <div href="javascript:;" class="list-group-item">
                      <div class="row"> 
                          <div class="col-sm-9 col-md-10">
                              <div class="row">
                                <div class="col-sm-3 info-sender">
                                  <h5><i class="fa fa-calendar"></i> &nbsp;&nbsp;<?= date('d/m/Y', $MessageCentre->time) ?></h5> 
                                  <h5>
                                  <?php if( $MessageCentre->categorie == 'prof' ): ?>
                                    <i class="fa fa-user"></i> &nbsp;&nbsp;Enseignants
                                  <?php else: ?>
                                    <i class="fa fa-users"></i> &nbsp;&nbsp;Parents
                                  <?php endif; ?>
                                  </h5>  
                                </div>
                                <div class="col-sm-9">
                                  <h5> 
                                    Destinataires : 
                                    <?php 
                                    foreach ($MessageCentre->destination as $key => $destinataires) {
                                      $MessageCentre->destination[$key] = '<span class="item-destinataire">'.$destinataires.'</span>';
                                    }
                                    ?> 
                                      <?= implode(' ', $MessageCentre->destination) ?> 
               
                                  </h5>  
                                  <div class="content-message" dir="<?= (strpos($MessageCentre->content, 'dir="rtl"') > 0)?'rtl':'' ?>"> 
                                    <span><?= strip_tags($MessageCentre->content) ?></span>
                                     <div style="display: none;" class="contentMessage">
                                      <div dir="<?= (strpos($MessageCentre->content, 'dir="rtl"') > 0)?'rtl':'' ?>">
                                        <?=  str_replace("<br /><br />", "<br>", $MessageCentre->content) ?> 
                                      </div>
                                      <?php if(!empty($MessageCentre->date)): ?>
                                        <em>Pour le: <?= $MessageCentre->date ?> </em>
                                      <?php endif; ?>

                                    </div>
                                  <a data-toggle="modal" href="#more-info" class="read-more" data-id="<?= $MessageCentre->idMessage ?>">Lire la suite</a>
                                  </div> 
                                  <?php if(!empty($MessageCentre->file)): ?> 
                                      <a href="<?php echo base_url() ?>assets/upload/<?= $MessageCentre->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a> &nbsp; &nbsp; &nbsp;
                                   <?php endif; ?>   
                                      <a href="javascript:;" class="ui-popover" data-toggle="tooltip" data-placement="right" data-trigger="hover" data-html="true" data-content="<?= $MessageCentre->vu ?>" title="">
                                          <i class="icon-li fa fa-eye text-secondary"></i> 
                                          <?= $MessageCentre->nbrVu ?> personne(s)
                                      </a>
                                </div>
                              </div>
                          </div>
                          <div class="col-sm-3 col-md-2" style="padding-left: 0;">
                            <div class="list-group">
                              <a  data-toggle="modal" href="sendToParent/<?= $MessageCentre->idMessage ?>" class="list-group-item remove-row">
                                <i class="fa fa-share"></i>
                                &nbsp;&nbsp;<strong>Transférer</strong>
                              </a> 
                              <a  data-toggle="modal" href="#confirmation" class="list-group-item remove-row">
                                <i class="fa fa-times"></i>
                                &nbsp;&nbsp;<strong>Supprimer</strong>
                              </a> 
                            </div>
                          </div>
                          </div>  
                    </div> 
                  </div>
           </div> 
          <?php endif; ?>
        <?php endforeach; ?>

          <?php else: ?> 
          <div class="alert alert-danger">
              <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
              <strong>Aucun envoi pour l'instant</strong>
          </div>
        <?php endif; ?>
      </div>
  <?php endif; ?> 

  
  <?php if( hasAccess('historique_admin_prof') ): ?>
      <div class="tab-pane fade" id="admin-prof"> 
        <?php if( $MessagesCentre ): ?> 

          <div style="padding: 20px 0;text-align: right;">
            <button class="btn btn-warning btn-lg" data-toggle="modal" href="#exportMessages-admin-prof">Exporter l'historique <i class="fa fa-download"></i> </button>
          </div>
        <form id="support-search" class="form">
                  <div class="form-group">
                     <label class="form-label">
                       Rechercher par Nom du Prof, Classe/Groupe, Matière et contenu du message
                    </label>
                    <div class="input-group"> 
                      <input id="support-search-field" type="text" class="form-control input-lg input-filter" name="input-filter" />
                      <span class="input-group-btn">
                            <button id="support-search-btn" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search"></i></button>
                          </span>
                    </div>

                  </div>
          </form> 
        <?php foreach ($MessagesCentre as $MessageCentre):?> 
          <?php $MessageCentre->content = nl2br($MessageCentre->content) ?>
          <?php if( $MessageCentre->categorie == 'prof'): ?>
            <?php //$MessageCentre->content = nl2br($MessageCentre->content) ?>
           <div class="item-to-send" data-id="<?= $MessageCentre->idMessage ?>">
              <div class="loader"></div>
                 <div class="list-group"> 
                    <div href="javascript:;" class="list-group-item">
                      <div class="row"> 
                          <div class="col-sm-9 col-md-10">
                              <div class="row">
                                <div class="col-sm-3 info-sender">
                                  <h5><i class="fa fa-calendar"></i> &nbsp;&nbsp;<?= date('d/m/Y', $MessageCentre->time) ?></h5> 
                                  <h5>
                                  <?php if( $MessageCentre->categorie == 'prof' ): ?>
                                    <i class="fa fa-user"></i> &nbsp;&nbsp;Enseignants
                                  <?php else: ?>
                                    <i class="fa fa-users"></i> &nbsp;&nbsp;Parents
                                  <?php endif; ?>
                                  </h5>  
                                </div>
                                <div class="col-sm-9">
                                  <h5> 
                                    Destinataires : 
                                    <?php 
                                    foreach ($MessageCentre->destination as $key => $destinataires) {
                                      $MessageCentre->destination[$key] = '<span class="item-destinataire">'.$destinataires.'</span>';
                                    }
                                    ?> 
                                      <?= implode(' ', $MessageCentre->destination) ?> 
               
                                  </h5>  
                                  <div class="content-message" dir="<?= (strpos($MessageCentre->content, 'dir="rtl"') > 0 && strpos($MessageCentre->content, "class='deletedMessage'") < 0 )?'rtl':'' ?>"> 
                                  <span><?= strip_tags($MessageCentre->content) ?></span>
                                  <div style="display: none;" class="contentMessage">
                                    <div dir="<?= (strpos($MessageCentre->content, 'dir="rtl"') > 0 && strpos($MessageCentre->content, "class='deletedMessage'") < 0)?'rtl':'' ?>">
                                      <?=  str_replace("<br /><br />", "<br>", $MessageCentre->content) ?> 
                                    </div>
                                    <?php if(!empty($MessageCentre->date)): ?>
                                      <em>Pour le: <?= $MessageCentre->date ?> </em>
                                    <?php endif; ?>
                                  </div>
                                  <a data-toggle="modal" href="#more-info" class="read-more" data-id="<?= $MessageCentre->idMessage ?>">Lire la suite</a>
                                  </div> 
                                  <?php if(!empty($MessageCentre->file)): ?> 
                                    <a href="<?php echo base_url() ?>assets/upload/<?= $MessageCentre->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a> &nbsp; &nbsp; &nbsp;
                                   <?php endif; ?>   
                                      <a href="javascript:;" class="ui-popover" data-toggle="tooltip" data-placement="right" data-trigger="hover" data-html="true" data-content="<?= $MessageCentre->vu ?>" title="">
                                          <i class="icon-li fa fa-eye text-secondary"></i> 
                                          <?= $MessageCentre->nbrVu ?> personne(s)
                                      </a>
                                </div>
                              </div>
                          </div>
                          <div class="col-sm-3 col-md-2"  style="padding-left: 0;">
                            <div class="list-group">
                              <a  data-toggle="modal" href="sendToProf/<?= $MessageCentre->idMessage ?>" class="list-group-item remove-row">
                                <i class="fa fa-share"></i>
                                &nbsp;&nbsp;<strong>Transférer</strong>
                              </a>
                              <a  data-toggle="modal" href="#confirmation" class="list-group-item remove-row">
                                <i class="fa fa-times"></i>
                                &nbsp;&nbsp;<strong>Supprimer</strong>
                              </a> 
                            </div>
                          </div>
                          </div>  
                    </div> 
                  </div>
           </div> 
          <?php endif; ?>
        <?php endforeach; ?>

          <?php else: ?> 
          <div class="alert alert-danger">
              <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
              <strong>Aucun envoi pour l'instant</strong>
          </div>
        <?php endif; ?>
      </div>
  <?php endif; ?> 



</div>

<style type="text/css">
  .deletedMessage {
      font-style: italic;
      background: #eee;
      padding: 10px 10px;
      margin-top: 10px; 
  }
  .deletedMessage > strong{
      display: block;
  }
  .deletedMessage span.item-destination {
      background: #a2a2a2;
      color: #fff;
      margin-right: 10px;
      padding: 2px 10px;
      border-radius: 12px;
  }
</style>

<script type="text/javascript">
  var selectRow;
  $('.remove-row').click(function() { 
    selectRow = $(this).parents('.item-to-send') 
  })
  $('body').on('click','#confirmation .confirm',function() { 
    var idMessage = selectRow.attr('data-id');
    selectRow.find('.loader').fadeIn();
    $.get(
          '<?php echo base_url() ?>Administration/removeMessage/'+idMessage,
          function (data) {
            if(data == 'true'){
              selectRow.slideUp('slow',function () {
                selectRow.remove();
              }); 
            }
          } 
    );

  })
  $('.rejet-message').click(function (argument) {
    var selectRow = $(this).parents('.item-to-send');
    var idMessage = selectRow.attr('data-id');
    $(this).parents('.item-to-send').find('.loader').fadeIn();
    $.get(
          '<?php echo base_url() ?>Administration/sendMessage/'+idMessage+'/0',
          function (data) {
            if(data == 'true'){
              selectRow.slideUp('slow',function () {
                selectRow.remove();
              }); 
            }
          } 
    );

  })

  

  $('.read-more').click(function () { 
    var content = $(this).parent().find('.contentMessage').html(); 
    $('#more-info .modal-body').html(content);
  })

  $(".input-filter").on('keyup', function(){
    var continer = $(this).parents('.tab-pane');
    var valThis = $(this).val().toLowerCase();
    if(valThis === ""){
        continer.find('.item-to-send').show();
    } else {
        continer.find('.item-to-send').each(function(){
            var text = $(this).text().toLowerCase();
            if (text.indexOf(valThis) >= 0) { $(this).show(); }
            else { $(this).hide(); }
        });
   }

  });

  // exportation Prof -> parent
  var intituleClasse = <?php echo json_encode($intituleClasse) ?>;
  var intituleGroupe =  <?php echo json_encode($intituleGroupe) ?>;
  var nbrClassesByNiveau =  <?php echo json_encode($nbrClassesByNiveau) ?>;


  ///********************************************************************************************************************************************
  $("body").on('change','.modal select[name=classe]',function () {
    var form = $(this).parents('form')
    var classe = $(this).val();
    form.find("select[name=groupe]").html('');
    form.find("select[name=groupe]").append('<option value="">Choisir</option>');
    for (var i = 0; i < nbrClassesByNiveau[classe]; i++) {
       form.find("select[name=groupe]").append('<option value="'+ (i+1) +'">G'+intituleGroupe[i]+'</option>');
    }

  }) 


  $("body").on('change','select[name=groupe]',function () {
      var form = $(this).parents('form')
      var data = {
        classe: form.find('select[name=classe]').val(),
        groupe: form.find('select[name=groupe]').val()
      }
      $.ajax({
        url: "<?php echo base_url() ?>Administration/getElevesByGroupe",
        method: 'post',
        data: data,
        dataType: 'json'
      }).done(function (eleves) {
          form.find("select[name=eleve]").html('');
          form.find("select[name=eleve]").append('<option value="">Choisir</option>');
          $.each(eleves, function (index, eleve) { 
               form.find("select[name=eleve]").append('<option value="'+ eleve.idClient +'">'+eleve.fname+' '+eleve.lname+'</option>');
          })
      })
  })

  $("body").on('change','select[name=matiere]',function () {
      var form = $(this).parents('form');
      var idMatiere = $(this).val();

      $.ajax({
        url: "<?php echo base_url() ?>Administration/getListProfsByMatiere/"+idMatiere,
        method: 'post', 
        dataType: 'json'
      }).done(function (profs) {
          form.find("select[name=prof]").html('');
          form.find("select[name=prof]").append('<option value="">Choisir</option>');
          $.each(profs, function (index, prof) { 
               form.find("select[name=prof]").append('<option value="'+ prof.idProf +'">'+prof.name+'</option>');
          })
      })
  })

  $("body").on('submit','.modal form',function (e) {
    e.preventDefault();
    var classe = $(this).find('select[name=classe]').val()
    var groupe = $(this).find('select[name=groupe]').val()
 

    if($(this).attr('id') == 'prof-to-parent'){
        window.location.href = '<?php echo base_url() ?>Administration/export/prof-to-parent/'+classe+'/'+groupe;
    }

    if($(this).attr('id') == 'prof-to-one-parent'){
      var eleve  = $(this).find('select[name=eleve]').val();
      window.location.href = '<?php echo base_url() ?>Administration/export/prof-to-one-parent/'+classe+'/'+groupe+"/"+eleve;
    }

    if($(this).attr('id') == 'admin-to-one-parent'){
      var idEleve  = $(this).find('select[name=eleve]').val();
      window.location.href = '<?php echo base_url() ?>Administration/export/admin-to-one-parent/'+classe+'/'+groupe+"/"+idEleve;
    }

    if($(this).attr('id') == 'admin-to-one-prof'){
      var idProf  = $(this).find('select[name=prof]').val();
      window.location.href = '<?php echo base_url() ?>Administration/export/admin-to-one-prof/0/0/'+idProf;
    }

  })


  ///********************************************************************************************************************************************

 
</script>