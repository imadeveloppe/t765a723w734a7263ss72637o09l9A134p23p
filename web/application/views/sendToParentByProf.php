<div class="content-header">
  <h2 class="content-header-title">Communiquer avec les élèves</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li class="active">Communiquer avec les élèves</li>
  </ol>
</div>
<!-- /.content-header -->
  

<?php if( $EditMessage && $Message->remarque != '' ): ?>
    <div class="alert alert-warning"> 
        <strong>Remarque</strong>
        <p><?= $Message->remarque ?></p>
    </div>
<?php endif; ?>


<div class="portlet form-send-parent">
  <!-- <div class="portlet-header">
    <h3> <i class="fa fa-bullhorn"></i> </h3>
  </div> -->
  <!-- /.portlet-header --> 

  <div class="portlet-content"> 
    <form action="<?= base_url() ?>prof/SendMessageToParentByProf" method="post" class="col-md-12 no-padding " enctype="multipart/form-data" id="sendparent"> 
    <div class="loader"></div>
 
      <div class="row">
        <div class="col-md-12">
          <label>Destination</label>
        </div>
        <div class="col-xs-10">
          <div class="destination">
            <?php 
              if( $EditMessage ):
                switch ( $Message->type ) {
                  case 'parent': 
                    $selectedParents = explode(',', $Message->destination);
                    foreach ($parents['eleve'] as $key => $parent):  

                      if(in_array($parent->idClient, $selectedParents)): ?>

                        <span class="parent_<?= $parent->idClient ?>_">
                          <?= $parent->nom ?>
                        </span>

                      <?php 
                      endif;
                    endforeach;
                  break; 
                  case 'groupe': 
                    $selectedGroupes = explode(',', $Message->destination);
                    foreach ($selectedGroupes as $key => $groupe): 
                      $currentGroup = explode('-', $groupe)  ; 
                      ?> 
                        <span class="groupe_<?= $groupe ?>_">
                          <?= $intituleClasse[$currentGroup[0]-1] ?>-G<?= $intituleGroupe[$currentGroup[1]-1] ?>
                        </span> 
                      <?php  
                    endforeach;
                  break; 
                }
              endif;
            ?>
          </div> 
          <input id="destination" type="hidden" name="destination" value="<?= ( $EditMessage )? $Message->destination : '' ?>">
          <input id="destination-type" type="hidden" name="type"   value="<?= ( $EditMessage )? $Message->type : '' ?>">
          <?php if( $EditMessage ): ?>
            <input type="hidden" name="old-file"   value="<?= $Message->file ?>">
          <?php endif ?>

        </div>
        <div class="col-xs-2 no-padding-left">
          <button type="button" class="btn btn-warning btn-block"  data-toggle="modal" href="#destinations" style="background: #16a085"><i class="fa fa-plus"></i> <span class="hidden-xs">Choisir</span></button>
        </div>
      </div> 
      <br>  
      <div class="row">
        <div class="col-md-12"> 
          <div class="form-group">
          <label>Matière</label>
          <?php $selectedMatire = ( count($matieres) > 1 ) ? 999999: 0 ?>
          <?php foreach ($matieres as $key => $matiere): ?>
              <div class="radio" style="margin: 5px 3px;">
                <label>
                <?php if( $EditMessage ): ?>
                  <input type="radio" name="matiere" value="<?= $matiere->intitule ?>" <?= ($Message->matiere == $matiere->intitule ) ? 'checked':'' ?>  required>
                  <?= $matiere->intitule ?>
                <?php else: ?>
                  <input type="radio" name="matiere" value="<?= $matiere->intitule ?>" <?= ($key == $selectedMatire ) ? 'checked':'' ?>  required>
                  <?= $matiere->intitule ?>
                <?php endif ?>
                </label>
              </div> 
          <?php endforeach; ?>
          </div> 
        </div>
        </div>  
      <div class="fixed-form--">
      <div class="row"> 
        <div class="col-sm-4" style="margin: 10px 0 20px;">
            <strong>Pour le</strong>
            <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="" data-date-format="dd/mm/yyyy" data-date-autoclose="true">
 
                <?php if( $EditMessage ): ?>
                  <input class="form-control" type="text" name="date" value="<?= $Message->date ?>">
                <?php else: ?>
                  <input class="form-control" type="text" name="date">
                <?php endif ?>

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div> 
        </div> <!-- /.col -->
        <div class="col-md-12">
          <label>Message</label>
        </div> 
        <div class="col-sm-12"> 
            <!-- <div class="btn-toolbar" role="toolbar"> 
              <div class="btn-group" style="margin-bottom: -1px;"> 
                <button type="button" data-toggle="modal" href="#modeles" class="btn btn-default" style="border-bottom-left-radius: 0;">
                  <i class="fa fa-plus"></i> Modèles de messages
                </button>  -->
                <input name="align" value="left" type="hidden">
                <!-- <button type="button" class="btn btn-default align-text active" aria-label="Left Align" data-align="left" data-dir="ltr" data-lang="data-fr">
                      Message en français
                </button>   
                <button type="button" class="btn btn-default align-text" aria-label="Right Align" data-align="right" data-dir="rtl" data-lang="data-ar">
                      Message en arabe 
                </button>   -->
              <!-- </div> 
            </div> --> 
          <?php if( $EditMessage ): ?>
            <textarea  style="border-top-left-radius: 0;" id="message" name="content" class="form-control" rows="6" placeholder="Votre message ici..." required data-fr="Votre message ici..." data-ar="اكتب رسالتك هنا..."><?= $Message->content ?></textarea>
            <input type="hidden" name="idMessage" value="<?= $Message->idMessage ?>">
          <?php else: ?>
            <textarea  style="border-top-left-radius: 0;" id="message" name="content" class="form-control" rows="6" placeholder="Votre message ici..." required data-fr="Votre message ici..." data-ar="اكتب رسالتك هنا..."><?= $transfer->content ?></textarea>
          <?php endif ?>
            
        </div> 
      </div>
      <br>
      <?php 
          if( $transfer ){
            $Message = $transfer;
          }
      ?>
      <?php if(!empty($Message->file)): ?>
        <div class="old-pj"> 
          <?php if($Message->typeFile =='image' ): ?>
            <span>
              <i class="fa fa-trash-o"></i>
            </span>
            <a href="<?php echo base_url() ?>assets/upload/<?= $Message->file ?>" target="_blank">
              <img src="<?php echo base_url() ?>assets/upload/<?= $Message->file ?>" style="max-width: 300px">
            </a>
          <?php else: ?>
            <a href="<?php echo base_url() ?>assets/upload/<?= $Message->file ?>" target="_blank"><i class="fa fa-paperclip"></i> <?= $Message->file ?></a>
          <?php endif ?>
        </div>
      <?php endif ?>
      <div class="row">
        <div class="col-sm-12">
        <div class="fileupload fileupload-new" data-provides="fileupload">
          <div class="input-group">
            <div class="form-control">
                <i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span> 
            </div>
            <div class="input-group-btn">
              <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">
                <span class="file-text hidden-xs">Supprimer</span>
                <i class="fa fa-trash-o file-icon"></i>
              </a>
              <span class="btn btn-default btn-file">
                <span class="fileupload-new">
                  <span class="file-text hidden-xs">Choisir un fichier joint</span>
                  <i class="fa fa-paperclip file-icon"></i>
                </span> 
                <span class="fileupload-exists">
                  <span class="file-text hidden-xs">Changer</span>
                  <i class="fa fa-refresh file-icon"></i>
                </span>
                <input id="file" type="file" name="file" />
              </span>
            </div>
          </div>
        </div>  
      </div> <!-- /.col -->
      </div>
        <br>
      <div style="text-align: right;">
         <button id="submitbtn" type="button"  class="btn btn-primary"  >Envoyer <i class="fa fa-paper-plane"></i></button>

        <button id="confirm" type="button" class="btn btn-primary"  data-toggle="modal" href="#confirmation" style="display: none;"> <i class="fa fa-angle-right"></i></button>
        <button id="noDestinationbtn" type="button" class="btn btn-default"  data-toggle="modal" href="#noDestination" style="display: none;"> <i class="fa fa-angle-right"></i></button> 
      </div>
      </div>
    </form>
  </div>
  <!-- /.portlet-content --> 
  
</div> 
<link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/datepicker/datepicker.css"> 
<script type="text/javascript">

    function textAreaAdjust(o) {
      if($(window).width() <= 767 ){
          o.style.height = "1px";
          o.style.height = (7+o.scrollHeight)+"px";
      }
    }

  $(document).ready(function () {
    $('#dp-ex-3').datepicker({
      startDate: '0d',
      language: 'fr'
    }) 

    $('input:checkbox, input:radio').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue',
      inheritClass: true
    }) 
      

    $('body').on('click','#confirmation .confirm',function() {
      $('.loader').fadeIn(); 
      setTimeout(function () {
        $('#sendparent')[0].submit();
      },1000)
    })
    $('body').on('click','#sendparent #submitbtn',function() { 
      if( $('input[name=destination]').val() == '' ){
        $('#noDestinationbtn').click();
        $('#noDestination .noDestination').show();
        $('#noDestination .noMatiere').hide();
        $('#noDestination .noMessageVide').hide();
      }
      else if( $('[name=matiere]:checked').val() == undefined ){
          $('#noDestinationbtn').click();
          $('#noDestination .noDestination').hide();
          $('#noDestination .noMatiere').show();
          $('#noDestination .noMessageVide').hide();
      } 
      else if( tinyMCE.activeEditor.getContent().replace( /<.*?>/g, '' ).replace(/[\t\n]+/g,'').replace(/&nbsp;/g,'') == ""  && document.getElementById("file").files.length == 0 ){
          $('#noDestinationbtn').click();
          $('#noDestination .noDestination').hide();
          $('#noDestination .noMatiere').hide();
          $('#noDestination .noMessageVide').show();
      } 
      else{
          $('#confirm').click();
      }
    })
    // ********************************************************************************************
    $('body').on('click','.destinations span',function() { 
      $(this).parent().toggleClass('active')
      $(this).parent().parent().parent().removeClass('active');
      if( $(this).parent().hasClass('active') ){

        if( $('#destination-type').val() != '' && $('#destination-type').val() == $(this).attr('data-type')  ){
          $(this).parent().addClass('active');
          $('.destination').append('<span class="'+$(this).attr('data-type')+$(this).attr('data-id')+'">'+$(this).text()+'</span>');
         
          $('#destination').val($('#destination').val()+","+$(this).attr('data-id')); 

        }
        else{
          $('.destinations').find('li').removeClass('active');
          $(this).parent().addClass('active');
          $('.destination').html('<span class="'+$(this).attr('data-type')+$(this).attr('data-id')+'">'+$(this).text()+'</span>'); 
          $('#destination').val($(this).attr('data-id')); 
          $('#destination-type').val($(this).attr('data-type'));  

        } 
        
      }else{

         $(this).find('li').addClass('active');
         $('.destination').find('span.'+$(this).attr('data-type')+$(this).attr('data-id')).remove();
         var newDestination = $('#destination').val().replace( ','+$(this).attr('data-id') ,'').replace($(this).attr('data-id') ,''); 
         $('#destination').val(newDestination);
         if( $('#destination').val() == '' ){
          $('#destination-type').val('');
         }
         
      }   
    })
    //*********************************************************************************************
    $('body').on('click','.destinations .fa',function() { 
      $(this).parent().parent().children('li').children('ul').not($(this).next()).slideUp();
      $(this).next().slideToggle();
      if( $(this).hasClass('fa-caret-right') ){
          $(this).removeClass('fa-caret-right').addClass('fa-caret-down');
      }else{
        $(this).removeClass('fa-caret-down').addClass('fa-caret-right');
      }
    })


    // var height = parseInt($("#message").css('height')); 
    
    // $('#message').keyup(function(){
    //   if($(window).width() <= 767 ){ 

    //     $('#message').style.height = "1px";
    //     $('#message').style.height = (25+o.scrollHeight)+"px";

    //     // var stringLength = document.getElementById("message").value.length;
    //     // var count = Math.ceil( stringLength / document.getElementById("message").cols ) - 1;  
    //     // if(count > 1 && parseInt($("#message").css('height')) <= 160 ){
    //     //   $("#message").css('height',(height + (15*(count))))
    //     // }else{
    //     //   $("#message").css('height',50)
    //     // }
    //   }
    // })

    $('.align-text').click(function () {
      $(this).parents('.btn-group').find('.align-text').removeClass('active');
      $(this).addClass('active');
      $('input[name=align]').val($(this).attr('data-align'));

      $("#message").css('text-align',$(this).attr('data-align'));
      $("#message").attr('placeholder',$("#message").attr($(this).attr('data-lang')));
      $("#message").css('direction',$(this).attr('data-dir'));
    })
   
    $('body').on('click','.addModel',function() { 
      var content = $( this ).parents( '.panel-body' ).find( '.content-model' ).html();
      $( "button[data-align="+$( this ).attr("data-dir")+"]" ).click() 
      tinyMCE.activeEditor.setContent(content, {format : 'raw'});   
    }) 

    $('.old-pj span').click(function() {
      $('[name=old-file]').val('');
      $(this).parent().remove();
    })

  })

</script> 
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    default_link_target: "_blank",
    height: 500,
    theme: 'modern', 
    statusbar:false,
    menubar:false,  
    language:"fr_FR", 
    language_url : '/assets/langs/fr_FR.js', 
    invalid_elements : "img",
    plugins: [
      'advlist autolink image lists link charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime nonbreaking save table directionality',
      'template paste textcolor colorpicker textpattern codesample toc'
    ],
    toolbar1: 'undo redo | bold italic | alignleft aligncenter alignright | forecolor backcolor | link | ltr rtl | preview fullscreen   ',
    image_advtab: false,  
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
    ]
   }); 

</script>

<style type="text/css">
  .old-pj{
    padding: 10px;
    border: 1px solid #ddd;
    width: auto;
    display: inline-block;
    margin-bottom: 20px;
    position: relative;
  }
  .old-pj span{
    font-size: 20px;
    background: #e94a3c;
    text-align: center;
    padding: 0 8px;
    color: white;
    position: absolute;
    right: -12px;
    top: -12px;
    border-radius: 50%;
    box-shadow: 0 0 6px #868686;
    cursor: pointer;
  }
</style>