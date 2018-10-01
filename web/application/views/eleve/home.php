<html lang="en">

<head>
  <title>TawassolApp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/web-app-eleve.css">
  <!-- Font Awesome File -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  
  <div class="container header" style="padding-top:20px">
      <img src="<?php echo base_url() ?>assets/img/logo.png" class="logoapp" alt="Site Logo">

      <a href="" class="openMenu">
        <i class="fa fa-bars fa-2x pull-right" aria-hidden="true"></i>
      </a>
  </div>
  <div class="container app">
    <div class="row app-one">

      <div class="col-sm-4 side">
        <div class="side-one">
           

          <!-- SearchBox -->
          <div class="row searchBox">
            <div class="col-sm-12 searchBox-inner">
              <div class="form-group has-feedback">
                <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Recherche">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
            </div>
          </div>

          <!-- Search Box End -->
          <!-- sideBar -->
          <div class="row sideBar">
            <?php if( $messages  ): ?>
              <?php foreach ($messages as $key => $message): $message = (object) $message; ?>
                <div class="row sideBar-body message-item <?= !$message->vu ? 'notVu' :'' ?>">
                    <div class="col-sm-3 col-xs-3 sideBar-avatar">
                      <div class="avatar-icon">
                        <?php if( $message->from == 'administration' ): ?>
                            <?php if( $message->profil ): ?>
                                <img src="<?php echo base_url() ?>assets/upload/<?= $message->profil ?>">
                            <?php else: ?>
                                <img src="https://www.daralber.ae/css/internet/no-image-available.png">
                            <?php endif; ?>
                        <?php else: ?>
                            <img src="<?php echo base_url() ?>assets/img/home-work.png">
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-sm-9 col-xs-9 sideBar-main">
                      

                      <div class="row">
                        <div class="col-sm-12 sideBar-name">
                          <span class="name-meta"><?= $message->from == 'administration' ? 'Administration' : $message->matiere ?></span>
                          <p class="messagecontent" dir="<?= (strpos($message->content, 'dir="rtl"') > 0)?'rtl':'' ?>">
                            <?= strip_tags($message->content) ?> 
                          </p>
                          <span class="time-meta pull-right"> 
                              <?php if( $message->file ): ?>
                                  <i class="fa fa-paperclip"></i> 
                              <?php endif ?>
                              <?= $message->time ?>
                          </span>
                          <div class="content" style="display: none;"><?= $message->content ?></div>
                          <?php $message->content =strip_tags($message->content) ?>
                          <div class="json" style="display: none;"><?= json_encode( $message ) ?></div>

                          <div class="searchArea" style="display: none;">
                            <?= strip_tags($message->content) ?>
                            <?= strip_tags($message->matiere) ?>
                          </div>
                        </div> 
                      </div>


                    </div>
                  </div> 
              <?php endforeach ?>
            <?php else: ?>
              <center style="color: #ababab;padding: 20px;">
                Aucun message
              </center>
            <?php endif; ?>
              
                
            
            
          </div>
          <!-- Sidebar End -->
        </div>

        
        
      </div>


      <!-- New Message Sidebar End -->

      <!-- Conversation Start -->
      <div class="col-sm-8 conversation">
        <!-- Heading -->
        <div class="row heading">

          <div class="col-sm-10 col-xs-10"> 
            <h4><?= $infos->ecole ?></h4>
          </div>
           
          <div class="col-sm-1 col-xs-1  heading-dot pull-right">
            <a href="" class="openMenu">
              <i class="fa fa-ellipsis-v fa-2x pull-right" aria-hidden="true"></i>
            </a> 
          </div>
        </div>
        <!-- Heading End -->

        <!-- Message Box -->
        <div class="row message" id="conversation" style="display: none;">

           <a class="mobile_close_message"><i class="fa fa-close"></i> Fermer</a>
          <div class="row message-body">
            <div class="col-sm-12">
              <div class="receiver">
                <span class="message-time pull-right">xx/xx/xxxx</span>
                <div class="message-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                <br> 
                <div><em>Pour le: <span class="for-time">xx/xx/xxxx</span></em></div>
              </div>
              <div class="pj" style="display: none;">
                <a href="" class="venobox">
                  <img src="https://guykawasaki.com/wp-content/uploads/2015/02/Stocksy_txp38b1499fkFK000_Small_485368.jpg">
                </a>
              </div>
              <div class="pj-file" style="display: none;">
                <a href="" target="_blank"><img src="http://icons.iconarchive.com/icons/pelfusion/flat-file-type/256/doc-icon.png"></a>
              </div>
            </div>
          </div> 

        </div>
        <!-- Message Box End -->

        

        
      </div>

      <div class="side-two">
  

           

          <!-- sideBar -->
          <div class="row compose-sideBar">
              <ul class="list-group">
                <?php if( $infos->about ): ?>
                  <a target="_blank" href="<?php echo base_url() ?>assets/upload/docs/<?= $infos->about ?>" class="list-group-item">
                      <i class="fa fa-chevron-right"></i>
                      À propos de l'établissement
                  </a> 
                <?php endif ?>
                <?php if( $infos->reglement_interieur ): ?>
                  <a target="_blank" href="<?php echo base_url() ?>assets/upload/docs/<?= $infos->reglement_interieur ?>" class="list-group-item">
                      <i class="fa fa-chevron-right"></i>
                      Réglement intérieur
                  </a> 
                <?php endif ?>
                <?php if( $infos->emplois ): ?>
                  <a href="<?= $infos->emplois ?>" class="list-group-item venobox">
                      <i class="fa fa-chevron-right"></i>
                      Emploi du temps
                  </a> 
                <?php endif ?>
                <?php if( $infos->vacances_scolaires ): ?>
                  <a target="_blank" href="<?php echo base_url() ?>assets/upload/docs/<?= $infos->vacances_scolaires ?>" class="list-group-item">
                      <i class="fa fa-chevron-right"></i>
                      Vacances scolaires
                  </a> 
                <?php endif ?>
                <a href="logout" class="list-group-item">
                    <i class="fa fa-chevron-right"></i>
                    Déconnexion
                </a> 
              </ul>
          </div>
        </div>
      <!-- Conversation End -->
    </div>
    <!-- App One End -->
  </div>

  <!-- App End -->

<link rel="stylesheet" type="text/css" href="/assets/venobox/venobox.css">
<script type="text/javascript" src="/assets/venobox/venobox.min.js"></script>

<script type="text/javascript">
    

  $(document).ready(function () {

    $('.venobox').venobox({
      spinner: "spinner-pulse",
      closeBackground: "transparent",
      autoplay: true
    }); 

    // setTimeout(function () {
    //   $('.message-item')[0].click();
    // })

    $('.message-item').click(function () {
      var currentItem = $(this);
      $('.message-item, .side-two').removeClass('active')

      $(this).addClass('active')

      $(this).removeClass('notVu') 
      var data = {
        messageObject: JSON.parse($(this).find('.json').html()),
        content: $(this).find('.content').html()
      }

      $('#conversation .message-time').text(data.messageObject.time);
      $('#conversation .message-text').html(data.content);
      if( data.messageObject.date ){
        $('#conversation .for-time').text(data.messageObject.date).parent().parent().show();
      }else{
        $('#conversation .for-time').parent().parent().hide();
      }

      if( data.messageObject.file != '' ){ 

        if( data.messageObject.typeFile == 'image' ){
          $('#conversation .pj-file').hide()
          $('#conversation .pj img').attr('src', data.messageObject.file)
          $('#conversation .pj a').attr('href', data.messageObject.file)
          $('#conversation .pj').show()
        }else{
          $('#conversation .pj').hide()
          $('#conversation .pj-file a').attr('href', data.messageObject.file).parent().show()
        }

      }else{
        $('#conversation .pj,#conversation .pj-file').hide();
      }

      $('#conversation,.conversation').fadeIn()

      if( !data.messageObject.vu ){
        $.ajax({
            type : 'get', // define the type of HTTP verb we want to use (POST for our form)
            url  : '<?= base_url() ?>Client_/addVuToMessage/'+data.messageObject.idMessage+'/<?= $idClient ?>', 
        }).done(function (result) {
          if(result == 'true'){
            data.messageObject.vu = 1;
            currentItem.find('.json').html(JSON.stringify(data.messageObject));
          }
        })
      }
        
 
       
    })


    $('a.openMenu').click(function (e) {
      e.preventDefault()
      $(".side-two").toggleClass('active');
    })

    $('a.mobile_close_message').click(function (e) {
      e.preventDefault()
      $('.message-item, .side-two').removeClass('active')
      $('#conversation,.conversation').fadeOut()
    })

    $("#conversation, .sideBar").click(function () {
      $(".side-two").removeClass('active');
    })

    $('#searchText').keyup(function (e) {
       $('.message-item').each(function () {
            var text = $(this).find('.searchArea').text().toLowerCase();
            var input = $('#searchText').val().toLowerCase();
            if( text.search(input) >= 0 ){
              $(this).show()
            }else{
              $(this).hide()
            }
       })
    })

  })

</script>
</body>
</html>