<div class="content-header" style="margin-bottom: 10px;">
  <h2 class="content-header-title">Communiquer avec l'administration</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li class="active">Communiquer avec l'administration</li>
  </ol>
</div>

<div class="row">
  <div class="col-sm-4">
    <div style="margin-bottom: 10px;">
      <button class="btn btn-secondary writeNewMsg"><i class="fa fa-envelope"></i> Nouveau</button>
    </div>
    <div class="list-group" style="height: 400px;overflow-y: scroll;">  
         
      <?php foreach ($MessagesProf as $key => $MessageProf): ?>
        <a href="#" class="list-group-item <?= empty($MessageProf->vu) ? 'notVu' : '' ?>" data-id="<?= $MessageProf->idMessage ?>">
          <i class="fa fa-building-o"></i> &nbsp;&nbsp;Administration
          <?php  
            $messages = json_decode($MessageProf->content);
            $lastMessage = $messages[ count($messages) -1 ];
          ?>
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
  <div class="col-sm-8 messagesViewer">
    <div class="loader"></div>
    <h2 class="newMsg">Nouveau message</h2>
    <div class="appendMessages" >
        



    </div>
    <div class="form-group" style="clear: both;padding-top: 30px;margin-bottom:0">
      <form class="form-response" action="prof/sendMessageToAdmin">
      <!-- <center style="margin-bottom: 20px;">
        <button type="button" class="btn btn-danger delete-message">Supprimer cette conversation</button>
      </center> -->
      <div class="input-group">
        <textarea class="form-control message" type="text" data-align="left" dir="ltr" style="height: 54px;"></textarea>
        <input class="form-control idMessage" type="hidden">
        <span class="input-group-btn" style="vertical-align: top;">
          <button class="btn btn-secondary" type="submit" style="background:#17a085;padding: 17px 25px;">Envoyer</button>
        </span>
      </div> 
      </form>
    </div>


  </div>
</div>
 
<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () { 
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

    $('.writeNewMsg').click(function (event) {
      $('form.form-response, .newMsg').show();
      $('.appendMessages').html('')
      $('textarea.message').focus()
    })

    $('body').on('click','.list-group-item',function (event) {
      event.preventDefault(); 
      $('form.form-response, .newMsg').hide();
      $('.list-group-item').removeClass('activee');
      $(this).addClass('activee');
      $('.form-response textarea.message').val('').attr('data-align','left');
      var messages = $(this).find('.content-message').html();
      $(this).parents('.row').find('.messagesViewer').fadeIn().find('.appendMessages').html(messages); 

      var idMessage = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: '<?php echo base_url() ?>prof/addVuToMessage/'+idMessage
      }); 

      $('a[data-id='+idMessage+']').removeClass('notVu')
    })

    $('.form-response').submit(function (event) {
      event.preventDefault(); 
      var input = $(this).find('textarea.message');
      var appendMessages = $(this).parents('.row').find('.appendMessages');
      var idMessage = $(this).find('input.idMessage').val()

      var row = $(this).parents('.row');
      
      if( input.val() != '' ){

        var messagetoAppend = '<div class="message from-prof"><span>'+input.val()+'</span></div>';
        appendMessages.append( messagetoAppend );
        $('.list-group-item[data-id='+idMessage+']').find('.content-message').append( messagetoAppend );
   
        $.ajax({
          type: "POST",
          url: '<?php echo base_url() ?>'+$(this).attr('action'),
          data: {   
            idProf: <?= $info['id'] ?>,
            idCentre: <?= $info['idCentre'] ?>,
            niveau: <?= $info['niveau'] ?>,
            message: input.val(),
            align: input.attr('data-align')
          },
          dataType: 'text',
          success: function (data) {
            if( parseInt(data) ){ 
              var dir = ( input.attr('data-align') =='left' ) ? 'ltr' : 'rtl';
              $('.list-group').prepend('<a href="#" class="list-group-item" data-id="'+data+'"><i class="fa fa-building-o"></i> &nbsp;&nbsp;Administration<p class="oneLine" dir="'+dir+'">'+input.val()+'</p> <div class="content-message" style="display: none"><div class="message from-prof" dir="'+dir+'"><span>'+input.val().split('\n').join('<br>')+'</span></div></div></a>');
              setTimeout(function() {
                row.find('.list-group-item')[0].click()
              })
              input.val('');
            }
          }
          
        }); 

        
      }  
    })

 

    // $('.delete-message').click(function () {
    //     if( confirm("Voulez vous vraiment supprimer cette conversation ?") ){
    //       var idMessage = $(this).parents('form').find('input.idMessage').val()
    //       var row = $(this).parents('.row');
    //       row.find('.loader').show()
    //       $.get(
    //             '<?php echo base_url() ?>Administration/removeMessage/'+idMessage,
    //             function (data) {
    //               row.find('.loader').hide()
    //               if(data == 'true'){ 
    //                 row.find('.appendMessages').html('');
    //                 $('.list-group-item[data-id='+idMessage+']').remove();
    //                 if( row.find('.list-group-item')[0] ){
    //                   row.find('.list-group-item')[0].click()
    //                 }else{
    //                   row.find('.messagesViewer').remove()
    //                 }
                    
    //               }
    //             } 
    //       );

    //     }
    // })

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
    min-height: 190px;
  }
  .messagesViewer{
    /*border-left: 1px solid #ddd;*/
  }
  .list-group-item{
    border-left: 0;
    border-right: 0;
  }

  .messagesViewer .message span{
    background-color: #17a085;
    color: #fff;
    margin: 1px 0;
    padding: 6px 12px;
    border-radius: 18px;
    display: inline-block;
    margin-top: 10px;
    max-width: 80%;
    float: right;
    clear: both;
  }
  .messagesViewer .message.from-admin span{
    background-color: #dad5d5;
    color: #000;
    float: left; 
  }

  .list-group .list-group-item.activee,
  .list-group .list-group-item.notvu.activee {
      background-color: #c6e1ef;
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
      background: #daf6ff;
      margin-bottom: 20px;
      border: 1px solid #88c5d6;
      border-radius: 6px;
  }
  .toogle-autorisation strong{
    position: relative;top: -7px;
  }
  .notVu {
      background: #e2f5ff;
      font-weight: bold;
  }
</style>