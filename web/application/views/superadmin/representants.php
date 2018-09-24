<div class="content-header">
        <h2 class="content-header-title">Gérer les représentants</h2>
        <ol class="breadcrumb">
          <li><a href="./">Accueil</a></li> 
          <li><a href="#">représentants</a></li> 
        </ol>
      </div> <!-- /.content-header --> 


       <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Liste des représentants
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">           
              <a  data-toggle="modal" href="#add-new" class="btn btn-success add-new right">
                <i class="fa fa-plus"></i> Ajouter
              </a>
               <!-- /////// Data apend //// -->
              <table class="item-rep" style="display: none;"><tr data-id="_id_"><td class="ville-rep" style="vertical-align: middle;">_ville_</td><td class="nom-rep" style="vertical-align: middle;">_rep_</td><td class="tel-rep" style="vertical-align: middle;">_tel_</td><td style="vertical-align: middle;text-transform: uppercase;">_code_</td><td class="hidden-xs center"><a class="btn btn-warning edit-row" data-ville="_idville_" href="#edit-row" data-toggle="modal"><i class="fa fa-pencil"></i></a></td><td class="hidden-xs center"><a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row"><i class="fa fa-trash-o"></i></a></td></tr></table>
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
                      <th data-direction="asc" data-filterable="true" data-sortable="true">Ville</th>
                      <th data-direction="asc" data-filterable="true" data-sortable="true">Nom & prénom</th>
                      <th data-direction="asc" data-filterable="true">Téléphone</th>
                      <th data-direction="asc" data-filterable="true">Code</th>
                      <th data-filterable="false" class="hidden-xs center">Modifier</th> 
                      <th data-filterable="false" class="hidden-xs center">Supprimer</th>
                    </tr>
                  </thead> 
                  <tbody> 
                  <?php foreach ($representants as $representant ) : ?>
                    <tr data-id='<?= $representant->id ?>'>  
                      <td style="vertical-align: middle;" class="ville-rep"><?= $representant->intitule ?></td>
                      <td style="vertical-align: middle;" class="nom-rep"><?= $representant->nom ?></td>
                      <td style="vertical-align: middle;" class="tel-rep"><?= $representant->tel ?></td>
                      <td style="vertical-align: middle; text-transform: uppercase;"><?= $representant->code ?></td>
                      <td class="hidden-xs center"> 
                        <a data-ville="<?= $representant->ville ?>"
                          class="btn btn-warning edit-row" data-toggle="modal" href="#edit-row">
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
    var nom = $('#nom').val();
    var ville = $('#ville').val();
    var villeText = $('#ville option:selected').text();
    var tel = $('#tel').val();
    var pwd = $('#pwd').val();

    if( nom == '' ){
      $('#nom').focus();
    }else{
      self.parents('.modal').find('.loader').fadeIn();
      $.ajax({
        url : '<?= base_url() ?>Superadmin/addRep',
        type : 'POST',
        data : { 
                  nom: nom,
                  ville: ville,
                  tel: tel,
                  pwd: pwd,
              },
        dataType : 'json'
      }).done(function (data) {
        self.parents('.modal').find('.loader').fadeOut();
        if( data.state == 'true' ){
          $('.modal .close').click();
          setTimeout(function () {
            var tr = $('.item-rep tbody').html();
            tr = tr.replace('_id_',data.id);
            tr = tr.replace('_rep_',nom);
            tr = tr.replace('_tel_',tel);
            tr = tr.replace('_code_',data.code);
            tr = tr.replace('_ville_',villeText);
            tr = tr.replace('_idville_',ville);
            $('table.table tbody').prepend(tr);
            $('#nom').val('')
            $('#ville').val('')
            $('#tel').val('')
            $('#pwd').val('')
            window.location.reload();
          },800);
        }
      })
    }
     
  })

  $('body').on('click','.edit-row-db',function () {
    var self = $(this)
    var nom = $('#edit-nom').val();
    var ville = $('#edit-ville').val();
    var villeText = $('#edit-ville option:selected').text();
    var tel = $('#edit-tel').val();
    var pwd = $('#edit-pwd').val();
    var id = $('#id').val();

    if( nom == '' ){
      $('#edit-nom').focus();
    }else{
      self.parents('.modal').find('.loader').fadeIn();
      $.ajax({
        url : '<?= base_url() ?>Superadmin/editRep/'+id,
        type : 'POST',
        data : { 
                  nom: nom,
                  ville: ville,
                  tel: tel,
                  pwd: pwd,
              },
        dataType : 'text'
      }).done(function (data) { 
        self.parents('.modal').find('.loader').fadeOut();
        if( data == 'true' ){ 
          $('.modal .close').click();
          setTimeout(function () {  
            $('tr[data-id='+id+']').find('.ville-rep').text( villeText );
            $('tr[data-id='+id+']').find('.nom-rep').text( nom );
            $('tr[data-id='+id+']').find('.tel-rep').text( tel );
            $('tr[data-id='+id+']').find('a[data-ville]').attr('data-ville',ville);
          },800);
          window.location.reload();
        }
      })
    }
     
  })

  $('body').on('click','.edit-row',function () {
     
    var nom = $(this).parents('tr').find('.nom-rep').text();
    var tel = $(this).parents('tr').find('.tel-rep').text();
    var ville = $(this).attr('data-ville'); 

    $('#edit-nom').val( nom );
    $('#edit-tel').val( tel );
    $('#edit-ville').val( ville );

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
        url         : '<?= base_url() ?>Superadmin/deleteRep/'+dataId, // the url where we want to POST 
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

    $('input[type=tel]').keypress(function ( evt ) { 
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    })


  })
</script>