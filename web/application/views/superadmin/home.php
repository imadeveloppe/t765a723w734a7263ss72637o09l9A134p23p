<div class="content-header">
        <h2 class="content-header-title">Statistique</h2> 
</div> <!-- /.content-header --> 


       <div class="row">

       <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label" style="font-size: 18px;">Total écoles</p>
            <h3 class="row-stat-value"><?= $nbrEcole ?></h3> 
          </div> <!-- /.row-stat -->
        </div> 

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label" style="font-size: 18px;">Total Importés</p>
            <h3 class="row-stat-value"><?= $nbrClient['imported'] ?></h3> 
          </div> <!-- /.row-stat -->
        </div> 

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label" style="font-size: 18px;">Total Inscrits</p>
            <h3 class="row-stat-value"><?= $nbrClient['regitred'] ?></h3> 
          </div> <!-- /.row-stat -->
        </div> 

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label" style="font-size: 18px;">Total Validés</p>
            <h3 class="row-stat-value"><?= $nbrClient['validated'] ?></h3> 
          </div> <!-- /.row-stat -->
        </div> 
        <div class="col-md-12">
          <div class="panel-group accordion" id="accordion">
          <?php $i = 1 ?>
          <?php foreach ($CentersByRep as  $Rep): ?> 

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapse-<?= $i ?>">
                     <?= $Rep['nom'] ?> ( <?= $Rep['tel'] ?> )  
                    </a>
                  </h4>
                </div>

                <div id="collapse-<?= $i ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="col-sm-6 col-md-3">
                      <div class="row-stat">
                        <p class="row-stat-label" style="font-size: 18px;">Ecoles</p>
                        <h3 class="row-stat-value"><?= $Rep['nbrCentre'] ?></h3> 
                      </div> <!-- /.row-stat -->
                    </div>

                    <div class="col-sm-6 col-md-3">
                      <div class="row-stat">
                        <p class="row-stat-label" style="font-size: 18px;">Importés</p>
                        <h3 class="row-stat-value"><?= $Rep['nbrClient']['imported'] ?></h3> 
                      </div> <!-- /.row-stat -->
                    </div>

                    <div class="col-sm-6 col-md-3">
                      <div class="row-stat">
                        <p class="row-stat-label" style="font-size: 18px;">Inscrits</p>
                        <h3 class="row-stat-value"><?= $Rep['nbrClient']['regitred'] ?></h3> 
                      </div> <!-- /.row-stat -->
                    </div>

                    <div class="col-sm-6 col-md-3">
                      <div class="row-stat">
                        <p class="row-stat-label" style="font-size: 18px;">Validés</p>
                        <h3 class="row-stat-value"><?= $Rep['nbrClient']['validated']  ?></h3> 
                      </div> <!-- /.row-stat -->
                    </div>
                    <!-- --------------------------------------------------------------------------------- -->

               
                 <div class="row">

                <div class="col-md-3 col-sm-5">
              
                  <ul id="myTab" class="nav nav-pills nav-stacked">
                      <?php $j = 1; ?>
                        <?php foreach ($Rep['villes'] as $key => $ville): ?>

                          <li class="<?= ($j == 1) ? 'active' : '' ?>">
                            <a href="#tab-<?= $Rep['id'] ?>-<?= $j ?>" data-toggle="tab">
                              <i class="fa fa-home"></i> &nbsp;&nbsp;<?= $villes[$key] ?>
                            </a>
                          </li>

                          <?php $j++; ?>
                        <?php endforeach ?>
                       
                    </ul>

              </div> <!-- /.col -->

              <div class="col-md-9 col-sm-7">

                <div id="myTabContent" class="tab-content stacked-content">

              <?php $k = 1; ?> 
              <?php foreach ($Rep['villes'] as $key => $ville): ?>

                  <div class="tab-pane fade <?= ($k == 1) ? 'active in' : '' ?>" id="tab-<?= $Rep['id'] ?>-<?= $k ?>">
                      <table class="table table-condensed">
                          <thead>
                            <tr> 
                              <th style="width: 60px">Statut</th>
                              <th>Ecole</th>
                              <th>Téléphone</th>
                              <th style="text-align: center">Importés</th> 
                              <th style="text-align: center">Inscrits</th> 
                              <th style="text-align: center">Validés</th> 
                              <th style="text-align: center">Supprimer</th> 
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($ville as $key => $value): ?> 
                            <tr data-id="<?= $value['idCentre'] ?>">  
                              <td>
                                <?php if( $value['state'] == 1 ): ?>
                                    <i class="fa fa-check-circle" style="color: green; font-size: 24px;"></i>
                                <?php else: ?>
                                    <i class="fa fa-ban" style="color: red; font-size: 24px;"></i>
                                <?php endif; ?>
                              </td>
                              <td><?= $value['nom'] ?></td>
                              <td><?= $value['tel'] ?></td>
                              <td align="center">
                                <span class="label label-info"><?= $value['nbrClient']['imported'] ?></span>
                              </td>
                              <td align="center">
                                <span class="label label-warning"><?= $value['nbrClient']['regitred'] ?></span>
                              </td>
                              <td align="center">
                                <span class="label label-success"><?= $value['nbrClient']['validated'] ?></span>
                              </td>
                              <td align="center">
                                <a data-toggle="modal"  href="#confirmation"  class="btn btn-danger remove-row">
                                  <i class="fa fa-trash-o"></i>
                                </a>
                              </td>
                            </tr>
                           <?php endforeach ?>
                          </tbody>
                        </table>
                        
                  </div> 
                  

                  <?php $k++ ?>
                <?php endforeach ?>
                </div>

              </div> <!-- /.col -->

            </div> <!-- /.row -->
                    <!-- --------------------------------------------------------------------------------- -->

                  </div>
                </div>
              </div> <!-- /.panel-default -->
              <?php $i++ ?>
            <?php endforeach ?>
            </div>
        </div>

      </div> <!-- /.row -->
<script type="text/javascript">
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
        url         : '<?= base_url() ?>Superadmin/deleteCenter/'+dataId, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       $('.modal .close').click();
        self.parents('.modal').find('.loader').fadeOut();
        removeRow.fadeOut('slow'); 
        setTimeout(function() {
          removeRow.remove();
        },1000) 
    }); 
    
  })
</script>