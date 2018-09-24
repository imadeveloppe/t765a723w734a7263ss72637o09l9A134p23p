<div class="content-header">
  <h2 class="content-header-title">Boite de réception</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li class="active">Messages reçus </li>
  </ol>
</div> 

<ul id="myTab1" class="nav nav-tabs">
  
  <?php if( hasAccess('reception_prof')): ?>
    <li class="active notifProf">
      <a href="#prof" data-toggle="tab">Professeurs <span class="badge" style="display: none;">0</span></a>
      
    </li> 
  <?php endif; ?> 



  <?php if( hasAccess('reception_parent') ): ?>  
      <li class="notifParent">
        <a href="#parent" data-toggle="tab">Parents <span class="badge" style="display: none;">0</span></a>

      </li> 
  <?php endif; ?>  
  
</ul> 

<?php  
  $dataNotifs = array(
    "prof" =>0,
    "parent" =>0
  );
?>

<div id="myTab1Content" class="tab-content">

  <?php if( hasAccess('reception_prof') ): ?>  
      <div class="tab-pane fade in active" id="prof">
           
          <div class="toogle-autorisation">
            <a href="" class="validtoggle <?= $info['allowProfToSendMsg'] == 1 ? 'active' : '' ?>" data-value="<?= $info['allowProfToSendMsg'] ?>" data-type="prof" ></a>  
            <strong>
              Autoriser les professeurs à envoyer des messages a l'administration
            </strong>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="list-group" style="height: 400px;overflow-y: scroll;">  
                
                <?php foreach ($MessagesProf as $key => $MessageProf): ?>

                  <?php  
                    $messages = json_decode($MessageProf->content);
                    $lastMessage = $messages[ count($messages) -1 ];
 
                    if( count($messages) == 1 ){
                      $dataNotifs["prof"] += 1;
                    } 
                  ?>



                  <a href="#" class="list-group-item  <?= count($messages) == 1 ? 'notvu' : '' ?>" data-id="<?= $MessageProf->idMessage ?>">
                    <i class="fa fa-user"></i> &nbsp;&nbsp;<?= $MessageProf->prof ?>   
                    
                    <p class="oneLine" dir="<?= $lastMessage->align == 'right' ? 'rtl' : 'ltr' ?>"><?= $lastMessage->content ?></p> 
                    <div class="content-message" style="display: none">

                        <?php foreach (json_decode($MessageProf->content) as  $message): ?>
                          <div class="message from-<?= $message->from ?>" dir="<?= ($message->align == 'right') ? 'rtl' : 'ltr' ?>">
                            <span style="white-space: pre;"><?= $message->content ?></span>
                          </div>
                        <?php endforeach ?>

                        
                    </div> 
                  </a>
                <?php endforeach ?>  

              </div>
            </div>
            <div class="col-sm-8 messagesViewer" style="display: none;">
              <div class="loader"></div>
              <div class="appendMessages" >
                  
     


              </div>
              <div class="form-group" style="clear: both;padding-top: 30px;">
                <form class="form-response" action="Administration/responseMessageToAdminByParent">
                <center style="margin-bottom: 20px;">
                  <button type="button" class="btn btn-danger delete-message">Supprimer cette conversation</button>
                </center>
                <div class="input-group">
                  <textarea class="form-control message" type="text" data-align="left" dir="ltr" style="height: 54px;"></textarea>
                  <input class="form-control idMessage" type="hidden">
                  <input class="form-control type" type="hidden" value="prof">
                  <span class="input-group-btn" style="vertical-align: top;">
                    <button class="btn btn-secondary" type="submit" style="background:#17a085;padding: 17px 25px;">Envoyer</button>
                  </span>
                </div> 
                </form>
              </div>
            </div>
          </div> 
      </div>
  <?php endif; ?> 
  
  <?php if( hasAccess('reception_parent') ): ?>  
      <div class="tab-pane fade in" id="parent">
        

        <div class="toogle-autorisation">
          <a href="" class="validtoggle <?= $info['allowParentToSendMsg'] == 1 ? 'active' : '' ?>" data-value="<?= $info['allowParentToSendMsg'] ?>" data-type="parent"></a>  
          <strong>
            Autoriser les parents à envoyer des messages a l'administration
          </strong>
        </div>

        <div class="row">
            <div class="col-sm-4">
              <div class="list-group" style="height: 400px;overflow-y: scroll;">  
                <?php foreach ($MessagesParent as $key => $MessageParent): ?>

                  <?php  
                    $messages = json_decode($MessageParent->content);
                    $lastMessage = $messages[ count($messages) -1 ];

                    if( count($messages) == 1 ){
                      $dataNotifs["parent"] += 1;
                    } 
                  ?>

                  <a href="#" class="list-group-item  <?= count($messages) == 1 ? 'notvu' : '' ?>" data-id="<?= $MessageParent->idMessage ?>">
                    <i class="fa fa-user"></i> &nbsp;&nbsp;<?= $MessageParent->fname ?>  <?= $MessageParent->lname ?>   
                    
                    <p class="oneLine" dir="<?= $lastMessage->align == 'right' ? 'rtl' : 'ltr' ?>"><?= $lastMessage->content ?></p> 
                    <div class="content-message" style="display: none">
                        <div class="infos-eleve">
                            <strong>Classe: </strong><?= $intituleClasse[ $MessageParent->classe - 1 ] ?> - G<?= $intituleGroupe[ $MessageParent->groupe - 1 ] ?><br>
                            <strong>Parent(s): </strong><?= $MessageParent->nomParent ?><br>
                            <strong>Téléphones(s): </strong><?= $MessageParent->telParent ?>
                        </div>
                        <?php foreach (json_decode($MessageParent->content) as  $message): ?>
                          <div class="message from-<?= $message->from ?>" dir="<?= ($message->align == 'right') ? 'rtl' : 'ltr' ?>">
                            <span  style="white-space: pre;"><?= $message->content ?></span>
                          </div>
                        <?php endforeach ?>

                        
                    </div> 
                  </a> 
                <?php endforeach ?>  

              </div>
            </div>
            <div class="col-sm-8 messagesViewer" style="display: none;">
              <div class="loader"></div>
              <div class="appendMessages" >
                  
     


              </div>
              <div class="form-group" style="clear: both;padding-top: 30px;">
                <form class="form-response" action="Administration/responseMessageToAdminByParent">
                <center style="margin-bottom: 20px;">
                  <button type="button" class="btn btn-danger delete-message">Supprimer cette conversation</button>
                </center>
                <div class="input-group">
                  <textarea class="form-control message" type="text" data-align="left" dir="ltr" style="height: 54px;"></textarea>
                  <input class="form-control idMessage" type="hidden">
                  <input class="form-control type" type="hidden" value="parent">
                  <span class="input-group-btn" style="vertical-align: top;">
                    <button class="btn btn-secondary" type="submit" style="background:#17a085;padding: 17px 25px;">Envoyer</button>
                  </span>
                </div> 
                </form>
              </div>
            </div>
          </div> 
      </div> 
  <?php endif; ?>  

 
 
</div>
 
<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () { 

    var dataNotif = <?= json_encode($dataNotifs) ?>;
    console.log(dataNotif)

    if( dataNotif.prof ){
      $('li.notifProf .badge').text(dataNotif.prof).show()
    }
    if( dataNotif.parent ){
      $('li.notifParent .badge').text(dataNotif.parent).show()
    }

    autosize( $('textarea.message') ); 

    $('textarea.message').keyup(function (event) { 
     
        var rtlChar = /[\u0590-\u083F]|[\u08A0-\u08FF]|[\uFB1D-\uFDFF]|[\uFE70-\uFEFF]/mg;
        var isRTL = $(this).val().match(rtlChar);
        if(isRTL !== null) {
            $(this).attr('data-align', 'right');    
            $(this).attr('dir', 'rtl');    
        }else {
          $(this).attr('data-align', 'left');    
          $(this).attr('dir', 'ltr');    
        }
    })

    $('.list-group-item').click(function (event) {
      event.preventDefault(); 
      $('.list-group-item').removeClass('activee');
      $(this).addClass('activee');
      $('.form-response textarea.message').val('').attr('data-align','left');
      var messages = $(this).find('.content-message').html();
      $(this).parents('.row').find('.messagesViewer').fadeIn().find('.appendMessages').html(messages);
      $(this).parents('.row').find('.form-response').find('input.idMessage').val($(this).attr('data-id'))
    })

    $('.form-response').submit(function (event) {
      event.preventDefault(); 
      var form = $(this);
      var input = $(this).find('textarea.message');
      var appendMessages = $(this).parents('.row').find('.appendMessages');
      var idMessage = $(this).find('input.idMessage').val()
      if( input.val() != '' ){

        var messagetoAppend = '<div class="message from-admin" dir="'+input.attr('dir')+'"><span>'+input.val().split('\n').join('<br>')+'</span></div>';
        appendMessages.append( messagetoAppend );
        $('.list-group-item[data-id='+idMessage+']').find('.content-message').append( messagetoAppend );
   
        $.ajax({
          type: "POST",
          url: '<?php echo base_url() ?>'+$(this).attr('action'),
          data: {
            idMessage: idMessage,
            message: input.val(),
            align: input.attr('data-align')
          },
          dataType: 'text',
          success: function () {
              $('.list-group-item[data-id='+idMessage+']').removeClass('notvu') 
              if( form.parents('.messagesViewer').find('.from-admin').length == 1 ){

                if( form.find('.type').val() == "prof" ){
                  $('li.notifProf .badge').text( parseInt($('li.notifProf .badge').text()) - 1 )

                  if( parseInt($('li.notifProf .badge').text()) == 0 ){
                    $('li.notifProf .badge').hide()
                  } 
                }else{
                  $('li.notifParent .badge').text( parseInt($('li.notifParent .badge').text()) - 1 )

                  if( parseInt($('li.notifParent .badge').text()) == 0 ){
                    $('li.notifParent .badge').hide()
                  }
                  console.log(3)
                }
              }
                
              


          }
          
        }); 

        input.val('');
      }  
    })


    $('body').on('click','.validtoggle',function (e) {
        e.preventDefault();
        var self = $(this);
        self.toggleClass('active');
        var value = (self.attr('data-value') == '0') ? 1 : 0;

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Administration/allowSendMessages',
            data: {
              type: $(this).attr('data-type'),
              value: value,
            },
            dataType: 'text',
            success: function () {
              self.attr('data-value', value);
            } 
        });
    })

    var deletedRow;
    var form;

    $('.delete-message').click(function () {
        $('#confirmation').modal('show') 
        deletedRow = $(this).parents('.row');
        form = $(this).parents('form')
    })

    $('#confirmation .confirm').click(function () {
      var idMessage = form.find('input.idMessage').val()
      deletedRow.find('.loader').show()
      $.get(
            '<?php echo base_url() ?>Administration/removeMessage/'+idMessage,
            function (data) {
              deletedRow.find('.loader').hide()
              if(data == 'true'){ 
                deletedRow.find('.appendMessages').html('');
                $('.list-group-item[data-id='+idMessage+']').remove();
                if( deletedRow.find('.list-group-item')[0] ){
                  deletedRow.find('.list-group-item')[0].click()
                }else{
                  deletedRow.find('.messagesViewer').remove()
                }
                
              }
            } 
      );
    })

  })
</script>
 
<style type="text/css"> 

  .oneLine{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .list-group-item p{
    color: #a2a2a2;
  }
  .appendMessages{
    /*min-height: 480px;*/
  }
  .messagesViewer{
    border-left: 1px solid #ddd;
  }
  .list-group-item{
    border-left: 0;
    border-right: 0;
  }

  .messagesViewer .message span{
    background-color: #dad5d5;
    color: #000;
    margin: 1px 0;
    padding: 6px 12px;
    border-radius: 18px;
    display: inline-block;
    margin-top: 10px;
    max-width: 80%;
    float: left;
    clear: both;
  }
  .messagesViewer .message.from-admin span{
    background-color: #17a085;
    color: #fff;
    float: right; 
  }

  .list-group .list-group-item.activee,
  .list-group .list-group-item.notvu.activee {
      background-color: #ddd;
      border-color: #ddd;
  }

  .list-group .list-group-item.notvu{
    background-color: #fff5e6;
    border-color: #ffd89e;
    font-weight: bold;
  }
  .infos-eleve {
    background: #e2fff9;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ace4d9;
  }
  .toogle-autorisation {
      padding: 10px 10px 5px;
      background: rgba(23, 160, 133, 0.18823529411764706);
      margin-bottom: 20px;
      border: 1px solid #88c5d6;
      border-radius: 6px;
  }
  .toogle-autorisation strong{
    position: relative;top: -7px;
  }
</style>