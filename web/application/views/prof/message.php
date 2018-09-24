<div class="content-header">
  <h2 class="content-header-title">Messages</h2>
  <ol class="breadcrumb">
    <li><a href="./">Accueil</a></li>  
    <li class="active">Messages</li>
  </ol>
</div> <!-- /.content-header -->  
 <?php if( $messages ): ?> 
    <div class="clear"></div>
    <?php foreach ($messages as $message):?> 
        <?php if( $message->categorie =='prof'): ?>
          <?php $message->content = nl2br($message->content) ?>
        <?php 
          $cssClass = ''; 
           
          if( !empty($message->vu) and strpos($message->vu, ',') === false ){ 
            
            $cssClass = ($info['id'] == $message->vu) ? 'item-vu' : 'item-non-vu';

          }else if( !empty($message->vu) and strpos($message->vu, ',') !== false ){ 

            $cssClass = (in_array($info['id'], explode(',', $message->vu))) ? 'item-vu' : 'item-non-vu';

          }else{ 
            $cssClass = 'item-non-vu';

          } 
        ?>
        <div class="item-to-send <?= $cssClass ?>" data-id="<?= $message->idMessage ?>">
          <div class="loader"></div>
           <div class="list-group"> 
              <div href="javascript:;" class="list-group-item">
                <div class="row"> 
                    <div class="col-sm-12">
                        <div class="row"> 
                          <div class="col-sm-1 col-xs-2 logo-ecole" style="text-align: center;"> 

                               <?php if( !empty($logoEcole) ): ?>
                                   <span style="background: url('<?= base_url() ?>assets/upload/<?=  $logoEcole ?>') center center / 100% auto;"></span>
                              <?php else: ?>
                                  <span style="background: url('http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png') center center / 100% auto;"></span> 
                              <?php endif; ?>
                              

                          </div>
                          <div class="col-sm-2 col-xs-10 col-date">
                          	<h5>
                            	<i class="fa fa-calendar"></i> 
                            	&nbsp;&nbsp;<?= date('d/m/Y', $message->time) ?>
                            </h5>
                            <?php if(!empty($message->file)): ?> 
                              <a href="<?php echo base_url() ?>assets/upload/<?= $message->file ?>" target="_blank"><i class="fa fa-paperclip"></i> Pièce jointe</a>
                             <?php endif; ?> 
                          </div>
                          <div class="col-sm-9 col-xs-12">    

                            <div class="content-message" dir="<?= (strpos($message->content, 'dir="rtl"') >= 0 && strpos($message->content, "class='deletedMessage'") < 0) ? 'rtl':'' ?>">
                                <span><?= strip_tags($message->content) ?></span>
                                 <div style="display: none;" class="contentMessage">
                                  <div dir="<?= (strpos($message->content, 'dir="rtl"') >= 0 && strpos($message->content, "class='deletedMessage'") < 0)?'rtl':'' ?>">
                                    <?= $message->content ?>
                                     <?php if(!empty($message->date)): ?>
                                      <em>Pour le: <?= $message->date ?> </em>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <a data-toggle="modal" href="#more-info" class="read-more" data-id="<?= $message->idMessage ?>">Lire la suite</a>
                            </div> 
                          </div> 
                          	
                        </div>
                    </div> 
                    </div>  
              </div> 
            </div>
        </div>  

      <?php endif ?>
    <?php endforeach; ?>

    <?php else: ?> 
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
        <strong>Aucun envoi pour l'instant</strong>
    </div>
  <?php endif; ?>

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
  $(document).ready(function () {
    $('.read-more').click(function () {
      var content = $(this).parent().find('.contentMessage').html(); 
      $('#more-info .modal-body').html(content); 
      var self = $(this).parents('.item-to-send');
      if( self.hasClass('item-non-vu') ){
        var idMessage = self.attr('data-id');
        $.ajax({
              type        : 'get', // define the type of HTTP verb we want to use (POST for our form)
              url         : '<?= base_url() ?>prof/addVuToMessage/'+idMessage, // the url where we want to POST 
              dataType    : 'text' // what type of data do we expect back from the server 
          }).done(function(data) { 
              self.removeClass('item-non-vu');
              var nbrmsg = parseInt( $('.li-messages .notif').text() );
              nbrmsg--;
              $('.notif').text(nbrmsg);
              if( nbrmsg == 0 ){
                $('.notif').remove();
              }
          });
      }
    })
  })
</script>