<div class="content-header">
        <h2 class="content-header-title">Liste des école par ville</h2> 
</div> <!-- /.content-header --> 
 
       <div class="row">  
        <div class="col-md-12">
          <div class="panel-group accordion" id="accordion">
          <?php $i = 1 ?>
          <?php foreach ($villes as  $ville): ?> 

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapse-<?= $i ?>">
                     <?= $ville->intitule ?> 
                    </a>
                  </h4>
                </div>

                <div id="collapse-<?= $i ?>" class="panel-collapse collapse">
                  <div class="panel-body"> 

                <?php if( isset($ecoles[$ville->id]) && !empty($ecoles[$ville->id]) ): ?>
                  <table class="table table-condensed">
                          <thead>
                            <tr> 
                              <th>Ecole</th>
                              <th>Représentant</th>
                              <th>Modifier</th> 
                            </tr>
                          </thead>
                          <tbody>
                          
                            <?php foreach ($ecoles[$ville->id] as $key => $ecole): ?> 
                              <tr data-rep="<?= $ecole['idRep'] ?>" data-id="<?= $ecole['id'] ?>" >  
                                <td class="nom-ecole" ><?= $ecole['nom'] ?></td>
                                <td class="nom-rep"><?= $ecole['nomRep'] ?></td>
                                <td>
                                   <a class="btn btn-warning edit-row" data-toggle="modal" href="#edit-row">
                                      <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                              </tr>
                             <?php endforeach ?> 
                          </tbody>
                        </table>
                    <?php else: ?>
                      <div class="alert alert-warning"> 
                        <strong>Aucune école enregistrée dans cette ville</strong>
                      </div> <!-- /.alert -->
                    <?php endif; ?>
                  </div>
                </div>
              </div> <!-- /.panel-default -->
              <?php $i++ ?>
            <?php endforeach ?>
            </div>
        </div>

      </div> <!-- /.row -->

<script type="text/javascript">
  $('body').on('click','.edit-row',function () {
     
    var nom = $(this).parents('tr').find('.nom-ecole').text();
    var rep = $(this).parents('tr').attr('data-rep'); 
    var id = $(this).parents('tr').attr('data-id'); 

    $('#nomEcole').text( nom );
    $('select#rep').val( rep );
    $('#id').val( id ); 
    

  })

  $('body').on('click','.edit-row-db',function() { 
    var self = $(this);
    self.parents('.modal').find('.loader').fadeIn();
    var rep = $('select#rep').val(); 
    var id = $('#id').val(); 
    $.ajax({
        url : '<?= base_url() ?>Superadmin/updateEcoleRep/',
        type : 'POST',
        data : { 
                  id: id,
                  idRep: rep
              },
        dataType : 'text'
      }).done(function (data) { 
        self.parents('.modal').find('.loader').fadeOut();
        if( data == 'true' ){ 
          $('.modal .close').click();
          setTimeout(function () {  
            $('tr[data-id='+id+']').attr('data-rep', rep);
            $('tr[data-id='+id+']').find('.nom-rep').text( $('select#rep option:selected').text() ); 
          },800);
          
        }
      })
  })
</script>