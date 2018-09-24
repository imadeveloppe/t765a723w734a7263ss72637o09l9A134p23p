<div class="content-header">
  <h2 class="content-header-title">Historique des envois</h2>
  <ol class="breadcrumb">
    <li><a href="./">Accueil</a></li>  
    <li class="active">Historique</li>
  </ol>
</div> <!-- /.content-header --> 
<ul id="myTab1" class="nav nav-tabs">
  <li class="active">
    <a href="#encours" data-toggle="tab">Messages en attente de validation</a>
  </li> 
  <li>
    <a href="#valide" data-toggle="tab">Messages validés</a>
  </li>
</ul> 

<div id="myTab1Content" class="tab-content">
 <div class="tab-pane fade in active" id="encours">
  <?php if( $MessagesProf ): ?> 
    <form id="support-search" class="form">
            <div class="form-group">
               <label class="form-label">
                Rechercher par Nom d'élève, Classe/Groupe, Matière et contenu du message
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
      <?php if($MessageProf->state == 0): ?>
        <div class="item-to-send" data-id="<?= $MessageProf->idMessage ?>">
          <div class="loader"></div>
           <div class="list-group"> 
              <div href="javascript:;" class="list-group-item">
                <div class="row"> 
                    <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-3 info-sender">
                            <h5><i class="fa fa-calendar"></i> &nbsp;&nbsp;<?= date('d/m/Y', $MessageProf->time) ?></h5>  
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
                            <div class="content-message" dir="<?= (strpos($MessageProf->content, 'dir="rtl"')) ? 'rtl':'' ?>">
                              <span><?= strip_tags($MessageProf->content) ?></span>
                              <div style="display: none;" class="contentMessage">
                                <div dir="<?= (strpos($MessageProf->content, 'dir="rtl"') > 0)?'rtl':'' ?>">
                                  <?=  str_replace("<br /><br />", "<br>", $MessageProf->content) ?>
                                    <?php if(!empty($MessageProf->date)): ?>
                                      <em>Pour le: <?= $MessageProf->date ?> </em>
                                    <?php endif; ?>
                                </div>
                              </div>
                              <a data-toggle="modal" href="#more-info" class="read-more" data-id="<?= $MessageProf->idMessage ?>">Lire la suite</a>
                            </div> 
                            <?php if(!empty($MessageProf->file)): ?> 
                              <a href="<?php echo base_url() ?>assets/upload/<?= $MessageProf->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a>
                             <?php endif; ?>

                             <?php if( $MessageProf->remarque != '' ): ?>
                                <div class="alert alert-warning"> 
                                    <strong>Remarque</strong>
                                    <p><?= $MessageProf->remarque ?></p>
                                </div>
                             <?php endif; ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                      <div class="list-group"> 
                        
                        <a  href="sendToParent/<?= $MessageProf->idMessage ?>/1" class="list-group-item remove-row">
                          <i class="fa fa-edit"></i>
                          &nbsp;&nbsp;<strong>Modifier</strong>
                        </a> 
                        <a  data-toggle="modal" href="sendToParent/<?= $MessageProf->idMessage ?>" class="list-group-item remove-row">
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
  <div class="tab-pane fade" id="valide">
    <?php if( $MessagesProf ): ?> 
    <form id="support-search" class="form">
            <div class="form-group">
               <label class="form-label">
                Rechercher par Nom d'élève, Classe/Groupe, Matière et contenu du message
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
      <?php $MessageProf->content = str_replace('\n\r', '<br>', $MessageProf->content) ?>
      <?php if($MessageProf->state == 1): ?> 
        <div class="item-to-send">
          <div class="loader"></div>
           <div class="list-group"> 
              <div href="javascript:;" class="list-group-item">
                <div class="row"> 
                    <div class="col-sm-9 col-md-10">
                        <div class="row">
                          <div class="col-sm-3 info-sender">
                            <h5><i class="fa fa-calendar"></i> &nbsp;&nbsp;<?= date('d/m/Y', $MessageProf->time) ?></h5>  
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
                           <div class="content-message" dir="<?= (strpos($MessageProf->content, 'dir="rtl"')) ? 'rtl':'' ?>">
                              <span><?= strip_tags($MessageProf->content) ?></span>
                              <div style="display: none;" class="contentMessage">
                                <div dir="<?= (strpos($MessageProf->content, 'dir="rtl"') > 0)?'rtl':'' ?>">
                                  <?=  str_replace("<br /><br />", "<br>", $MessageProf->content) ?>
                                </div>
                                  <?php if(!empty($MessageProf->date)): ?>
                                    <em>Pour le: <?= $MessageProf->date ?> </em>
                                  <?php endif; ?>
                              </div>
                              <a data-toggle="modal" href="#more-info" class="read-more" data-id="<?= $MessageProf->idMessage ?>">Lire la suite</a>
                            </div> 
                            <?php if(!empty($MessageProf->file)): ?> 
                              <a href="<?php echo base_url() ?>assets/upload/<?= $MessageProf->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a>
                             <?php endif; ?>
                          </div>
                        </div>
                    </div> 
                    <div class="col-sm-3 col-md-2">
                      <div class="list-group"> 
                        <a  data-toggle="modal" href="sendToParent/<?= $MessageProf->idMessage ?>" class="list-group-item remove-row">
                          <i class="fa fa-share"></i>
                          &nbsp;&nbsp;<strong>Transférer</strong>
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
</div>

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
</script>