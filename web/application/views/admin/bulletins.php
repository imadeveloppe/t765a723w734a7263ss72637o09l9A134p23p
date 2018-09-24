<div class="content-header">
  <h2 class="content-header-title">Envoyer des bulletins</h2>
  <ol class="breadcrumb">
    <li><a href="./">Accueil</a></li>
    <li class="active">Envoyer des bulletins</li>
  </ol>
</div>
<!-- /.content-header -->
<div class="portlet">
  <!-- <div class="portlet-header">
    <h3> <i class="fa fa-bullhorn"></i> </h3>
  </div> -->
  <!-- /.portlet-header -->
  
  <div class="portlet-content"> 
    <form action="<?= base_url() ?>Administration/sendBulletins" method="post" class="col-md-12 no-padding" enctype="multipart/form-data" id="sendBulletins"> 
    <div class="loader"></div>
      <div class="row"> 
        <div class="col-md-12">
          <label>Choisir le fichier PDF des bulletins scolaires</label>
        </div> 
        <div class="col-sm-12">
          <div class="fileupload fileupload-new" data-provides="fileupload">
          <div class="input-group">
            <div class="form-control" style="white-space: nowrap;overflow: hidden;">
                <i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview" style="position: absolute;left: 31px;top: 7px"></span>
            </div>
            <div class="input-group-btn">
              <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
              <span class="btn btn-default btn-file">
                <span class="fileupload-new">Parcourir</span>
                <span class="fileupload-exists">Changer</span>
                <input name="file" type="file" required accept="application/pdf" style="transform: none;" />
              </span>
            </div>
          </div>
        </div> 
        </div> <!-- /.col --> 
      </div>
      <div class="row">  
        <div class="col-md-12">
          <label>Message</label>
        </div> 
        <div class="col-sm-12">  
           <textarea  style="border-top-left-radius: 0;" id="message" name="content" class="form-control" rows="6" placeholder="Votre message ici..." required data-fr="Votre message ici..." data-ar="اكتب رسالتك هنا...">Bulletin scolaire</textarea> 
        </div> 
      </div>
      <br>
       
      <div class="" style="margin-top: 9px;text-align: right;">

        <button  type="submit"  class="btn btn-primary"  >Envoyer <i class="fa fa-angle-right"></i></button> 

      </div>
    </form>
  </div>
  <!-- /.portlet-content --> 
  
</div> 

<link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/datepicker/datepicker.css"> 

<script type="text/javascript"> 

$(document).ready(function () {   

    

})

</script> 
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<script>
  tinymce.init({
    selector: 'textarea',
    default_link_target: "_blank",
    height: 220,
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


















