<div class="content-header">
        <?php 
          if( $niveau == 1 ) $etude = 'Primaire';
          if( $niveau == 2 ) $etude = 'Collège';
          if( $niveau == 3 ) $etude = 'Lycée';
         ?>
        <h2 class="content-header-title">Gérer les Matières du <?php echo $etude; ?></h2>
        <ol class="breadcrumb">
          <li><a href="./">Accueil</a></li> 
          <li><a href="#">Matieres</a></li>
          <li class="active"><?php echo $etude; ?></li>
        </ol>
      </div> <!-- /.content-header --> 


       <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Liste des matières enségnées
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">           
              <a  data-toggle="modal" href="#add-new" class="btn btn-success add-new right">
                <i class="fa fa-plus"></i> Ajouter
              </a>
               <!-- /////// Data apend //// -->
              <table class="item-matiere" style="display: none;"><tr data-id="_id_"><td class="intitule-matiere" style="vertical-align: middle;">_matiere_</td><td class="hidden-xs center"><a class="btn btn-warning edit-row" href="#edit-row" data-toggle="modal"><i class="fa fa-pencil"></i></a></td><td class="hidden-xs center"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row"><i class="fa fa-trash-o"></i></a></td></tr></table>
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
                      <th data-direction="asc" data-filterable="true" data-sortable="true">Matières</th>
                      <th data-filterable="false" class="hidden-xs center">Modifier</th> 
                      <th data-filterable="false" class="hidden-xs center">Supprimer</th>
                    </tr>
                  </thead> 
                  <tbody> 
                  <?php foreach ($matieres as $matiere ) : ?>
                    <tr data-id='<?= $matiere->id ?>'>  
                      <td style="vertical-align: middle;" class="intitule-matiere"><?= $matiere->intitule ?></td>
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
                  <?php endforeach; ?>

                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->
              

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet --> 

        </div> <!-- /.col -->

      </div> <!-- /.row -->

<script type="text/javascript">
  $('body').on('click','.add-new-db',function () {
    var self = $(this)
    var val = $('#intitule').val();

    if( val == '' ){
      $('#intitule').focus();
    }else{
      self.parents('.modal').find('.loader').fadeIn();
      $.ajax({
        url : '<?= base_url() ?>Superadmin/addMatiere',
        type : 'POST',
        data : { intitule: val, niveau : <?= $niveau ?> },
        dataType : 'json'
      }).done(function (data) {
        self.parents('.modal').find('.loader').fadeOut();
        if( data.state == 'true' ){
          $('.modal .close').click();
          setTimeout(function () {
            var tr = $('.item-matiere tbody').html();
            tr = tr.replace('_id_',data.id);
            tr = tr.replace('_matiere_',val);
            $('table.table tbody').prepend(tr);
            $('#intitule').val('')
          },800);
        }else{
          self.parents('.modal').find('.alert').slideDown();
          setTimeout(function () {
            self.parents('.modal').find('.alert').slideUp();
          },4000)
        }
      })
    }
     
  })

  $('body').on('click','.edit-row-db',function () {
    var self = $(this)
    var intitule = $('#edit-intitule').val();
    var id = $('#id').val();

    if( intitule == '' ){
      $('#intitule').focus();
    }else{
      self.parents('.modal').find('.loader').fadeIn();
      $.ajax({
        url : '<?= base_url() ?>Superadmin/editMatiere/'+id,
        type : 'POST',
        data : { intitule: intitule, niveau : <?= $niveau ?> },
        dataType : 'text'
      }).done(function (data) { 
        self.parents('.modal').find('.loader').fadeOut();
        if( data == 'true' ){ 
          $('.modal .close').click();
          setTimeout(function () {  
            $('tr[data-id='+id+']').find('.intitule-matiere').text( intitule );
          },800);
        }
      })
    }
     
  })

  $('body').on('click','.edit-row',function () {
     
    var val = $(this).parents('tr').find('.intitule-matiere').text();
    $('#edit-intitule').val( val );
    $('#id').val( $(this).parents('tr').attr('data-id') );

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
        url         : '<?= base_url() ?>Superadmin/deleteMatiere/'+dataId, // the url where we want to POST 
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
  })
</script>