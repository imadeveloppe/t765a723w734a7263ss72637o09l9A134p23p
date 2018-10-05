<div class="content-header">
  <h2 class="content-header-title">Valider les envois  des professeurs</h2>
  <ol class="breadcrumb">
    <li><a href="./">Accueil</a></li>  
    <li class="active">Valider les envois  des professeurs</li>
  </ol>
</div> <!-- /.content-header --> 
<?php if( $Messages ): ?>
<div class="send-all">
  <div class="col-sm-10"></div>
  <div class="col-sm-2 no-padding">
    <!-- <a href="#confirmation-send-all" 
       class="list-group-item send-all" data-toggle="modal"> 
    <i class="fa fa-envelope"></i> 
    &nbsp;&nbsp;<strong>Envoyer Tous&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></strong> 
  </a> -->
  </div>
</div>
<div class="clear"></div>
<div class="items-to-send">

  <?php foreach ($Messages as $Message):?>
    <div class="item-to-send" data-id="<?= $Message->idMessage ?>">
      <div class="loader"></div>
      <div class="list-group"> 
        <div href="javascript:;" class="list-group-item">
          <div class="row"> 
              <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-3 info-sender">
                      <h5><i class="fa fa-calendar"></i> &nbsp;&nbsp;<?= date('d/m/Y', $Message->time) ?></h5> 
                      <h5><i class="fa fa-user"></i> &nbsp;&nbsp;Prof.  <?= $Message->prof ?></h5>  
                      <h5><i class="fa fa-book"></i> &nbsp;&nbsp;<?= $Message->matiere ?></h5>  
                      <h5>Auto Envois : <a href="#" class="validtoggle prof-fidele <?= ($Message->fidele == '1') ? 'active' : '' ?>" data-id="<?= $Message->idProf ?>" style="position: relative; top: 7px; left: 6px;" ></a> </h5>
                    </div>
                    <div class="col-sm-9">
                      <h5> 
                        Destinataires : 
                        <?php 
                        foreach ($Message->destination as $key => $destinataires) {
                          $Message->destination[$key] = '<span class="item-destinataire">'.$destinataires.'</span>';
                        }
                        ?> 
                          <?= implode(' ', $Message->destination) ?> 
   
                      </h5>  
                      <div class="content-message" dir="<?= (strpos($Message->content, 'dir="rtl"') > 0)?'rtl':'' ?>" >
                        <?= ($Message->content) ?>
                        <?php if( $Message->date ): ?>
                          <em><br>Pour le: <?= $Message->date ?></em>
                        <?php endif ?>
                      </div> 
                      <?php if(!empty($Message->file)): ?> 
                        <a href="<?php echo base_url() ?>assets/upload/<?= $Message->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a>
                       <?php endif; ?>
                    </div>
                  </div>
              </div>
              <div class="col-sm-2">
                <div class="list-group">

                  <a href="javascript:;" class="list-group-item send-message">
                    <i class="fa fa-envelope"></i> 
                    &nbsp;&nbsp;<strong>Envoyer</strong>
                  </a> 
                  <a  data-toggle="modal" href="#refaire" class="list-group-item remove-row">
                    <i class="fa fa-refresh"></i>
                    &nbsp;&nbsp;<strong>À refaire</strong>
                  </a> 
                  <a  data-toggle="modal" href="#confirmation" class="list-group-item send-remarque">
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
</div>

<?php endif; ?>
<div class="alert alert-danger noData" <?php if( $Messages ): ?> style="display: none;" <?php endif; ?>>
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
    <strong>Aucun envoi pour l'instant</strong>
</div>


<script type="text/javascript">
 

  $('body').on('keydown', 'textarea[name=content]',function () {
      var rtlChar = /[\u0590-\u083F]|[\u08A0-\u08FF]|[\uFB1D-\uFDFF]|[\uFE70-\uFEFF]/mg;
      var isRTL = $(this).val().match(rtlChar);
      if(isRTL !== null) { 
          $(this).attr('dir','rtl');  
      }
      else {
          $(this).attr('dir','ltr');    
      }
  })

  var selectRow;
  $('.remove-row, .send-remarque').click(function() { 
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

  $('body').on('submit','#refaire form#sendRemarque',function(event) { 
    event.preventDefault();
    $('#refaire').modal('hide');
    var idMessage = selectRow.attr('data-id');
    var content = $('#refaire [name=content]').val();
    var dir = $('#refaire [name=content]').attr('dir');

    content = '<div dir="'+dir+'">'+content+'</div>';

    selectRow.find('.loader').fadeIn(); 

    $.ajax({
        type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?php echo base_url() ?>Administration/addRemarqueToMessage/',
        data        : {
          idMessage : idMessage,
          remarque  : content
        },
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
        if(data == 'true'){
          selectRow.slideUp('slow',function () {
            selectRow.remove();
          }); 
          $('#refaire [name=content]').val('');
        }
    }); 

  })

  $('.send-message').click(function (argument) {
    var selectRow = $(this).parents('.item-to-send');
    var idMessage = selectRow.attr('data-id');
    $(this).parents('.item-to-send').find('.loader').fadeIn();
    window.notification();
    $.get(
          '<?php echo base_url() ?>Administration/sendMessage/'+idMessage,
          function (data) {
            if(data == 'true'){
              selectRow.slideUp('slow',function () {
                selectRow.remove(); 
                setTimeout(function () {
                  if( $('.items-to-send').text() == '' ){
                    $('.noData').fadeIn()
                  }
                })
              }); 
            }
          } 
    );

  })

  $('body').on('click','#confirmation-send-all .confirm',function() { 
    
    $('.loader').fadeIn();
    $.get(
          '<?php echo base_url() ?>Administration/sendMessage/all',
          function (data) {
            if(data == 'true'){
              $('.item-to-send').slideUp('slow',function () {
                $('.item-to-send').remove();
                $('div.send-all').fadeOut('slow',function () {
                  $('div.send-all').remove();
                })
              }); 
            }
          } 
    );
  });

  $('.read-more').click(function () {
    var content = $(this).parents('.item-to-send').find('.content-message').attr('data-content');
    $('#more-info .modal-body p').html(content);
  })

   $('.prof-fidele').click(function() {
    var self = $(this);
    self.toggleClass('active');
    var idProf = self.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/editFideliteProf/'+idProf,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          if( !self.hasClass('active') ){
            self.addClass('active')
          }
       }else{
          if( self.hasClass('active') ){
            self.removeClass('active')
          }
       }
    }); 
    return false;
  })



</script>
