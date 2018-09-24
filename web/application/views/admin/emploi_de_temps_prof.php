<div class="content-header">
  <h2 class="content-header-title">Emplois du temps des professeurs</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li><a href="#">Emplois du temps</a></li>
    <li class="active">Professeurs</li>
  </ol>
</div>
<!-- /.content-header -->

<div class="portlet">
  <div class="portlet-header">
    <h3>Emploi du temps</h3>
  </div>
  <!-- /.portlet-header -->
  
  <div class="portlet-content">
  <form action="import_emplois" method="post"  class="row"  enctype="multipart/form-data"> 
    <div class="loader"></div>
    <!-- <div class="row"> --> 
       

      <div class="col-sm-4 form-group">
        <select name="idprof" class="form-control" id="idprof" required>
          <option value="">Choisir un professeur</option> 
          <?php foreach ($profs as $key => $prof):?>
            <option value="<?= $prof->idProf ?>"><?= $prof->nom ?></option> 
          <?php endforeach; ?>
        </select>
      </div>

    <!-- </div> -->

      <!-- <div class="row"> -->
        <div class="col-sm-10 form-group">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-group">
              <div class="form-control" style="white-space: nowrap;overflow: hidden;">
                  <i class="fa fa-file fileupload-exists" style="display: inline;"></i> <span class="fileupload-preview" style="position: absolute;left: 31px;top: 7px;color:#a2a2a2">PDF ou Image</span>
              </div>
              <div class="input-group-btn">
                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                <span class="btn btn-default btn-file">
                  <span class="fileupload-new">Parcourir</span>
                  <span class="fileupload-exists">Changer</span>
                  <input name="file" type="file" required accept="image/*, application/pdf" style="transform: none;" />
                </span>
              </div>
            </div>
          </div>  
        </div> <!-- /.col -->
        <div class="col-sm-2 form-group"> 
         <input type="hidden" name="type" value="prof">
         <input type="hidden" name="redirect" value="emploi_de_temps_prof">
         <button type="submit" class="btn btn-secondary btn-block">Envoyer</button>
        </div> <!-- /.col -->
      <!-- </div> -->
    </form>
  </div> <!-- /.col -->
</div>
 

<div class="portlet">
  <div class="portlet-header">
    <h3> </h3>
  </div>
  <!-- /.portlet-header -->
  
  <div class="portlet-content">
      
      <table 
          class="table table-striped table-bordered table-hover table-highlight table-checkable" 
          data-provide="datatable" 
          data-display-rows="50"
          data-info="true"
          data-search="false"
          data-length-change="true"
          data-paginate="true" 
          id="DataTable">  
          <thead>
            <tr>  
              <th data-filterable="true" data-sortable="true" data-direction="asc">Professeurs</th> 
              <th style="text-align: center;">Aperçu</th> 
              <th style="text-align: center;">Supprimer</th> 
            </tr>
          </thead>
          <tbody>
          <?php foreach ($emplois as $key => $emploi): ?> 
            <tr>  
              <td><?= $arrayProfs[$emploi->value] ?></td> 
              <td align="center">
                <a  href="<?= base_url().$emploi->file ?>" 
                    class="btn btn-info thumbnail-view-hover ui-lightbox"  
                    style="padding: 0 5px;font-size: 21px;">
                  <i class="fa fa-eye" aria-hidden="true"></i> 
                </a>
              </td> 
              <td align="center"> 
                <a  data-toggle="modal" data-id="<?= $emploi->id ?>" href="#confirmation" class="btn btn-danger remove-row">
                  <i class="fa fa-trash-o"></i>
                </a>
              </td> 
            </tr>
          <?php endforeach ?>
          </tbody>
        </table> 

  </div>
</div>




<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/magnific/magnific-popup.css">
<script src="<?php echo base_url() ?>assets/js/plugins/magnific/jquery.magnific-popup.min.js"></script>
<script type="text/javascript">  
$(document).ready(function () {
  var removeRow, idEmploi;
  $('.remove-row').click(function() { 
    removeRow = $(this).parents('tr') 
    idEmploi = $(this).attr('data-id') 
  })

  $('form').submit(function () {
    $(this).find('.loader').show()
  })

  $('#confirmation .confirm').click(function() { 
 
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/deleteEmploi/'+idEmploi, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          removeRow.fadeOut('slow'); 
          setTimeout(function() {
            removeRow.remove();  
          },1000) 
       }
    }); 
  });
})
</script>