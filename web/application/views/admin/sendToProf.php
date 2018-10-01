<div class="content-header">
  <h2 class="content-header-title">Communiquer avec les professeurs</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li class="active">Communiquer avec les professeurs</li>
  </ol>
</div>
<!-- /.content-header -->
<div class="portlet">
  <!-- <div class="portlet-header">
    <h3> <i class="fa fa-bullhorn"></i> </h3>
  </div> -->
  <!-- /.portlet-header -->
  
  <div class="portlet-content"> 
    <form action="<?= base_url() ?>Administration/SendMessageToProf" method="post" class="col-md-12 no-padding" enctype="multipart/form-data" id="sendprof">  
    <div class="loader"></div>
      <div class="row">
        <div class="col-md-12">
          <label>Destination</label>
        </div>
        <div class="col-xs-10">
          <div class="destination"></div>
          <input id="destination" type="hidden" name="destination">
          <input id="destination-type" type="hidden" name="type">
        </div>
        <div class="col-xs-2 no-padding-left">
          <button type="button" class="btn btn-warning btn-block"  data-toggle="modal" href="#destinations" style="background: #16a085"><i class="fa fa-plus"></i> <span class="hidden-xs">Choisir</span></button>
        </div>
      </div> 
      <br>  
      <div class="row"> 

        <div class="col-sm-4" style="margin: 10px 0 30px;">
            <strong>Pour le</strong>
            <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="" data-date-format="dd/mm/yyyy" data-date-autoclose="true">
                <input class="form-control" type="text" name="date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div> 
        </div> <!-- /.col --> 
        <div class="col-md-12">
          <label>Message</label>
        </div> 
        <div class="col-sm-12"> 
            <div class="btn-toolbar" role="toolbar"> 
              <div class="btn-group" style="margin-bottom: -1px;"> 
                <button type="button" data-toggle="modal" href="#modeles" class="btn btn-default" style="border-bottom-left-radius: 0;">
                  <i class="fa fa-plus"></i> Modèles de messages
                </button>
                <input name="align" value="left" type="hidden">
               <!--  <button type="button" class="btn btn-default align-text active" aria-label="Left Align" data-align="left" data-dir="ltr" data-lang="data-fr">
                      Message en français
                </button>   
                <button type="button" class="btn btn-default align-text" aria-label="Right Align" data-align="right" data-dir="rtl" data-lang="data-ar">
                      Message en arabe 
                </button>   -->
              </div> 
            </div>
           <textarea  style="border-top-left-radius: 0;" id="message" name="content" class="form-control" rows="6" placeholder="Votre message ici..." required data-fr="Votre message ici..." data-ar="اكتب رسالتك هنا..."><?= urldecode($transfer) ?></textarea> 
        </div> 
      </div>
      <br>
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
        <button id="submitbtn" type="button"  class="btn btn-primary"  >Envoyer <i class="fa fa-angle-right"></i></button>

        <button id="confirm" type="button" class="btn btn-primary"  data-toggle="modal" href="#confirmation" style="display: none;"> <i class="fa fa-angle-right"></i></button>
        <button id="noDestinationbtn" type="button" class="btn btn-default"  data-toggle="modal" href="#noDestination" style="display: none;"> <i class="fa fa-angle-right"></i></button> 
      </div>
    </form>
  </div>
  <!-- /.portlet-content --> 
  
</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/datepicker/datepicker.css"> 

<script type="text/javascript">
$(document).ready(function () { 
  $('#dp-ex-3').datepicker({
    startDate: '0d',
    language: 'fr'
  })
  
  $('body').on('click','#confirmation .confirm',function() {
    $('.loader').fadeIn();
    setTimeout(function () {
      $('form#sendprof').submit();
    },1000)
  })  
  $('body').on('click','#sendprof #submitbtn',function() { 
    if( $('input[name=destination]').val() == '' ){
      $('#noDestinationbtn').click();
      $('#noDestination .noDestination').show();
      $('#noDestination .noMatiere').hide();
      $('#noDestination .noMessageVide').hide();
    } 
    else if( tinyMCE.activeEditor.getContent().replace( /<.*?>/g, '' ).replace(/[\t\n]+/g,'').replace(/&nbsp;/g,'') == ""  && document.getElementById("file").files.length == 0  ){
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