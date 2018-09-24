<div class="content-header">
        <h2 class="content-header-title">Modèles de messages</h2>
        <ol class="breadcrumb">
          <li><a href="./">Accueil</a></li> 
          <li><a href="#">Modèles de messages</a></li> 
        </ol>
      </div> <!-- /.content-header --> 


       <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Liste des Modèles
              </h3>

            </div> <!-- /.portlet-header -->
            <ul id="myTab1" class="nav nav-tabs">
              <li class="active">
                <a href="#ecole-to-parent" data-toggle="tab">Ecole -> Parents</a>
              </li>
              <li class="">
                <a href="#ecole-to-prof" data-toggle="tab">Ecole -> Prof</a>
              </li> 
              <li class="">
                <a href="#prof-to-parent" data-toggle="tab">Prof -> Parents</a>
              </li> 
            </ul>
            <div id="myTab1Content" class="tab-content">

              <div class="tab-pane fade active in" id="ecole-to-parent"> 
                  <div class="portlet-content">           
                      <a  data-toggle="modal" href="#add-new" class="btn btn-success add-new right">
                        <i class="fa fa-plus"></i> Ajouter
                      </a>
                       <!-- /////// Data apend //// -->
                      <table class="item-modele" style="display: none;"><tr data-id="_id_"><td class="intitule-modele" style="vertical-align: middle;">_modele_</td><td class="hidden-xs center"><a class="btn btn-warning edit-row" href="#edit-row" data-toggle="modal"><i class="fa fa-pencil"></i></a></td><td class="hidden-xs center"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row"><i class="fa fa-trash-o"></i></a></td></tr></table>
                       <!-- /////// end Data apend //// -->
                      <div class="table-responsive">  
                      <table 
                        class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                        data-provide="datatable" 
                        data-display-rows="50"
                        data-info="true"
                        data-search="false"
                        data-length-change="true"
                        data-paginate="true"
                      >
                          <thead>
                            <tr>  
                              <th data-direction="asc" data-filterable="true" data-sortable="true">Modèles</th>
                              <th data-filterable="false" class="hidden-xs center">Modifier</th> 
                              <th data-filterable="false" class="hidden-xs center">Supprimer</th>
                            </tr>
                          </thead> 
                          <tbody> 
                          <?php foreach ($modeles as $modele ) : ?>
                              <?php if($modele->type =="ecole-to-parent"): ?>
                                <tr data-id='<?= $modele->id ?>'>  
                                  <td style="vertical-align: middle;" class="intitule-modele"><?= $modele->title ?></td>
                                  <td class="hidden-xs center"> 
                                    <a class="btn btn-warning edit-row" data-toggle="modal" href="#edit-row">
                                      <i class="fa fa-pencil"></i>
                                    </a>
                                  </td>  
                                  <td class="hidden-xs center">
                                    <a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row">
                                      <i class="fa fa-trash-o"></i>
                                    </a>
                                  </td>
                                </tr> 
                              <?php endif; ?>
                          <?php endforeach; ?>

                          </tbody>
                        </table>
                      </div> <!-- /.table-responsive --> 
                  </div> <!-- /.portlet-content -->
              </div>
              <div class="tab-pane fade" id="ecole-to-prof">
                  <div class="portlet-content">           
                      <a  data-toggle="modal" href="#add-new" class="btn btn-success add-new right">
                        <i class="fa fa-plus"></i> Ajouter
                      </a>
                       <!-- /////// Data apend //// -->
                      <table class="item-modele" style="display: none;"><tr data-id="_id_"><td class="intitule-modele" style="vertical-align: middle;">_modele_</td><td class="hidden-xs center"><a class="btn btn-warning edit-row" href="#edit-row" data-toggle="modal"><i class="fa fa-pencil"></i></a></td><td class="hidden-xs center"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row"><i class="fa fa-trash-o"></i></a></td></tr></table>
                       <!-- /////// end Data apend //// -->
                      <div class="table-responsive">  
                      <table 
                        class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                        data-provide="datatable" 
                        data-display-rows="50"
                        data-info="true"
                        data-search="false"
                        data-length-change="true"
                        data-paginate="true"
                      >
                          <thead>
                            <tr>  
                              <th data-direction="asc" data-filterable="true" data-sortable="true">Modèles</th>
                              <th data-filterable="false" class="hidden-xs center">Modifier</th> 
                              <th data-filterable="false" class="hidden-xs center">Supprimer</th>
                            </tr>
                          </thead> 
                          <tbody> 
                          <?php foreach ($modeles as $modele ) : ?>
                              <?php if($modele->type =="ecole-to-prof"): ?>
                                <tr data-id='<?= $modele->id ?>'>  
                                  <td style="vertical-align: middle;" class="intitule-modele"><?= $modele->title ?></td>
                                  <td class="hidden-xs center"> 
                                    <a class="btn btn-warning edit-row" data-toggle="modal" href="#edit-row">
                                      <i class="fa fa-pencil"></i>
                                    </a>
                                  </td>  
                                  <td class="hidden-xs center">
                                    <a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row">
                                      <i class="fa fa-trash-o"></i>
                                    </a>
                                  </td>
                                </tr> 
                              <?php endif; ?>
                          <?php endforeach; ?>

                          </tbody>
                        </table>
                      </div> <!-- /.table-responsive --> 
                  </div> <!-- /.portlet-content -->
              </div>
              <div class="tab-pane fade" id="prof-to-parent">
                  <div class="portlet-content">           
                      <a  data-toggle="modal" href="#add-new" class="btn btn-success add-new right">
                        <i class="fa fa-plus"></i> Ajouter
                      </a>
                       <!-- /////// Data apend //// -->
                      <table class="item-modele" style="display: none;"><tr data-id="_id_"><td class="intitule-modele" style="vertical-align: middle;">_modele_</td><td class="hidden-xs center"><a class="btn btn-warning edit-row" href="#edit-row" data-toggle="modal"><i class="fa fa-pencil"></i></a></td><td class="hidden-xs center"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row"><i class="fa fa-trash-o"></i></a></td></tr></table>
                       <!-- /////// end Data apend //// -->
                      <div class="table-responsive">  
                      <table 
                        class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                        data-provide="datatable" 
                        data-display-rows="50"
                        data-info="true"
                        data-search="false"
                        data-length-change="true"
                        data-paginate="true"
                      >
                          <thead>
                            <tr>  
                              <th data-direction="asc" data-filterable="true" data-sortable="true">Modèles</th>
                              <th data-filterable="false" class="hidden-xs center">Modifier</th> 
                              <th data-filterable="false" class="hidden-xs center">Supprimer</th>
                            </tr>
                          </thead> 
                          <tbody> 
                          <?php foreach ($modeles as $modele ) : ?>
                              <?php if($modele->type =="prof-to-parent"): ?>
                                <tr data-id='<?= $modele->id ?>'>  
                                  <td style="vertical-align: middle;" class="intitule-modele"><?= $modele->title ?></td>
                                  <td class="hidden-xs center"> 
                                    <a class="btn btn-warning edit-row" data-toggle="modal" href="#edit-row">
                                      <i class="fa fa-pencil"></i>
                                    </a>
                                  </td>  
                                  <td class="hidden-xs center">
                                    <a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row">
                                      <i class="fa fa-trash-o"></i>
                                    </a>
                                  </td>
                                </tr> 
                              <?php endif; ?>
                          <?php endforeach; ?>

                          </tbody>
                        </table>
                      </div> <!-- /.table-responsive --> 
                  </div> <!-- /.portlet-content -->
              </div>
            </div>
               

          </div> <!-- /.portlet --> 

        </div> <!-- /.col -->

      </div> <!-- /.row -->
<style type="text/css">
  table th:nth-child(2),
  table td:nth-child(2){
    display: none;
  }
</style>
<script type="text/javascript">
  $('body').on('click','.add-new-db',function () {
    var self = $(this)
    var title = $('#title').val();
    var type = $('#type').val();
    var align = $('#align').val();
    var content = tinyMCE.activeEditor.getContent();
    

    if( title == '' ){
      $('#title').focus();
    }
    else if( content == '' ){
      alert('Message vide')
    }
    else{
      self.parents('.modal').find('.loader').fadeIn();
      $.ajax({
        url : '<?= base_url() ?>Superadmin/addmodele',
        type : 'POST',
        data : { 
                "title": title,
                "type": type,
                "align": align,
                "content": content
        },
        dataType : 'json'
      }).done(function (data) {
        self.parents('.modal').find('.loader').fadeOut();
        if( data.state == 'true' ){
          $('.modal .close').click();
          setTimeout(function () {
            var tr = $('.item-modele tbody').html();
            tr = tr.replace('_id_',data.id);
            tr = tr.replace('_modele_',title);
            $('div#'+type+' table.table tbody').prepend(tr);
            $('#title').val('')
            $('#type').val('ecole-to-parent') 
            $('#content').val('')
          },800);
        }
      })
    }
     
  })

  $('body').on('click','.edit-row-db',function () {
    // var self = $(this)
    // var intitule = $('#edit-intitule').val();
    // var id = $('#id').val();

    // if( intitule == '' ){
    //   $('#intitule').focus();
    // }else{
    //   self.parents('.modal').find('.loader').fadeIn();
    //   $.ajax({
    //     url : '<?= base_url() ?>Superadmin/editmodele/'+id,
    //     type : 'POST',
    //     data : { intitule: intitule},
    //     dataType : 'text'
    //   }).done(function (data) { 
    //     self.parents('.modal').find('.loader').fadeOut();
    //     if( data == 'true' ){ 
    //       $('.modal .close').click();
    //       setTimeout(function () {  
    //         $('tr[data-id='+id+']').find('.intitule-modele').text( intitule );
    //       },800);
    //     }
    //   })
    //}
     
  })

  $('body').on('click','.edit-row',function () {
     
    // var val = $(this).parents('tr').find('.intitule-modele').text();
    // $('#edit-intitule').val( val );
    // $('#id').val( $(this).parents('tr').attr('data-id') );

  })

  var removeRow;
  $('body').on('click','.remove-row',function() { 
    removeRow = $(this).parents('tr') 
  })
  $('body').on('click','#confirmation .confirm', function() { 
    var self = $(this)
    self.parents('.modal').find('.loader').fadeIn();
    var dataId = removeRow.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Superadmin/deletemodele/'+dataId, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          $('.modal .close').click();
          self.parents('.modal').find('.loader').fadeOut();
          removeRow.fadeOut('slow'); 
          setTimeout(function() {
            removeRow.remove();
          },1000) 
       }
    }); 
    
  })

  $(document).ready(function () {
    $('.dataTable tr[cls=dataTable-filter-row] th').each(function () {
      $(this).find('input').attr('placeholder','Recherche par '+$(this).find('input').attr('placeholder') )
    })

    $('.align-text').click(function () {
      $(this).parents('.btn-group').find('.align-text').removeClass('active');
      $(this).addClass('active');
      $('input[name=align]').val($(this).attr('data-align'));

      $("#content").css('text-align',$(this).attr('data-align'));
      $("#content").attr('placeholder',$("#content").attr($(this).attr('data-lang')));
      $("#content").css('direction',$(this).attr('data-dir'));
    })

  })
</script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern', 
  statusbar:false,
  menubar:false,
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
  ],
  toolbar1: 'undo redo | bold italic | alignleft aligncenter alignright | forecolor backcolor | ltr rtl | preview fullscreen  ', 
  image_advtab: false, 
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
</script>