<div class="content-header">
        <h2 class="content-header-title">Problèmes signalés</h2>
        <ol class="breadcrumb">
          <li><a href="./">Accueil</a></li> 
          <li><a href="#">Problèmes signalés</a></li> 
        </ol>
      </div> <!-- /.content-header --> 


       <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Liste des Problèmes
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">     
              <div class="table-responsive">  
              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                data-provide="datatable" 
                data-display-rows="10"
                data-info="true"
                data-search="false"
                data-length-change="true"
                data-paginate="true"
              >
                  <thead>
                    <tr>  
                      <th  data-filterable="true" style="width: 140px">Emetteur</th>
                      <th class="hidden-xs center" data-sortable="false" data-filterable="true" width="82">Date</th> 
                      <th data-filterable="true" class="hidden-xs" >Message</th>
                      <th data-filterable="false" class="hidden-xs" width="55">Pièce jointe</th>
                      <th data-filterable="false" class="hidden-xs" width="57">Corrigé</th>
                      <th data-filterable="false" class="hidden-xs" width="42">Supprimer</th>
                    </tr>
                  </thead> 
                  <tbody> 
                  <?php foreach ($problemes as $probleme ) : ?>
                    <tr data-id='<?= $probleme->idProbleme ?>'>  
                      <td style="vertical-align: middle;"> 

                          <?php if($probleme->from == 'centre'): ?>
                              <a  data-toggle="modal" data-id="<?= $probleme->idFrom ?>" href="#infoecole" class="btn btn-block btn-info view-info-ecole">
                                <i class="fa fa-building-o"></i> 
                                <span style="text-transform: capitalize;"><?= ($probleme->from == 'centre') ? 'Ecole' : $probleme->from ?></span>
                              </a>
                          <?php elseif ($probleme->from == 'prof'):?>
                              <a  data-toggle="modal" data-id="<?= $probleme->idFrom ?>" href="#infoprof" class="btn btn-block btn-info view-info-prof">
                                <i class="fa fa-user"></i> 
                                <span style="text-transform: capitalize;"><?= ($probleme->from == 'centre') ? 'Ecole' : $probleme->from ?></span> 
                              </a>
                          <?php elseif ($probleme->from == 'parent'):?>
                              <a  data-toggle="modal" data-id="<?= $probleme->idFrom ?>" href="#infoparent" class="btn btn-block btn-info view-info-parent">
                                <i class="fa fa-users"></i> 
                                <span style="text-transform: capitalize;"><?= ($probleme->from == 'centre') ? 'Ecole' : $probleme->from ?></span> 
                              </a>  
                          <?php endif ?>


                          
                      </td>
                      <td style="vertical-align: middle;"><?= date('d/m/Y', $probleme->time) ?></td>
                      <td style="vertical-align: middle;"><?= nl2br($probleme->content) ?></td>
                      <td style="vertical-align: middle;">
                        <?php if( !empty($probleme->file) ): ?>
                          <a href="<?= base_url() ?>assets/upload/<?= $probleme->file ?>" class="ui-lightbox">
                              <img src="<?= base_url() ?>assets/upload/<?= $probleme->file ?>" width="50">
                          </a>
                        <?php endif; ?>
                      </td>
                       <td class="center">
                        <a href="#" class="valid-row <?= ($probleme->state == '1') ? 'active' : '' ?>"></a> 
                      </td> 
                      <td class="hidden-xs center">
                        <a data-toggle="modal"  href="#confirmation"  class="btn btn-danger remove-row">
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
<div id="infoecole" class="modal modal-styled fade">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Coordonnées</h3>
      </div> 
      <div class="modal-body"> 
        <!-- ********************************************************** -->
        <div class="info-utilisateur">
          <b>Etablissement :</b> <span class="nom"></span> <br>
          <b>Ville :</b> <span class="ville"></span> <br>
          <b>Téléphone :</b> <span class="tel"></span>
        </div>
        <div class="noResult">
           Cet utilisateur n'existe plus
        </div>
        <div class="progressText">
           Chargement...
        </div>
        <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="infoprof" class="modal modal-styled fade">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Coordonnées</h3>
      </div> 
      <div class="modal-body"> 
        <!-- ********************************************************** -->
        <div class="info-utilisateur">
           <b>Nom :</b> <span class="nom"></span> <br>
           <b>Ville :</b> <span class="ville"></span> <br>
           <b>Etablissement :</b> <span class="ecole"></span> <br>
           <b>Téléphone : </b><span class="tel"></span>
        </div>
        <div class="noResult">
           Cet utilisateur n'existe plus
        </div>
        <div class="progressText">
           Chargement...
        </div>
        <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="infoparent" class="modal modal-styled fade">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Coordonnées</h3>
      </div> 
      <div class="modal-body"> 
        <!-- ********************************************************** -->
        <div class="info-utilisateur">
           <b>Nom :</b> <span class="nom"></span> <br>
           <b>Ville :</b> <span class="ville"></span> <br>
           <b>Etablissement :</b> <span class="ecole"></span> <br> 
           <b>Téléphone :</b> <span class="tel"></span> <br> 
          </div>
        <div class="noResult">
           Cet utilisateur n'existe plus
        </div>
        <div class="progressText">
           Chargement...
        </div>
        <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="confirmation" class="modal modal-styled fade">
  <div class="modal-dialog">
  <div class="loader"></div>
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p class='notSolved'></p>
             <p>Vous voulez vraiment faire cette action ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm" >Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">

  var removeRow;
  $('body').on('click','.remove-row',function() { 
    removeRow = $(this).parents('tr') 
    if( !removeRow.find('.valid-row').hasClass('active') ){
      $('#confirmation').find('.notSolved').text("Le Problème n'est pas encore résolu !").show();
    }else{
      $('#confirmation').find('.notSolved').text('').hide();
    }
  })

  $('body').on('click','#confirmation .confirm', function() { 
    var self = $(this)
    
    self.parents('.modal').find('.loader').fadeIn();
    var dataId = removeRow.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Superadmin/deleteProbleme/'+dataId, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          $('.modal .close').click();
          self.parents('.modal').find('.loader').fadeOut();
          removeRow.fadeOut('slow'); 
          setTimeout(function() {
            removeRow.remove();
          },1000) 
          if( !removeRow.find('.valid-row').hasClass('active') ){
            $('.notif-probleme').text( parseInt($('.notif-probleme').text()) - 1 );
          }
          
       }
    }); 
    
  })


  $('.valid-row').click(function() {
    var self = $(this);
    self.toggleClass('active');
    var idProbleme = self.parents('tr').attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Superadmin/editStateProbleme/'+idProbleme,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          if( !self.hasClass('active') ){
            self.addClass('active')
          }
          $('.notif-probleme').text( parseInt($('.notif-probleme').text() ) - 1 );
       }else{
          if( self.hasClass('active') ){
            self.removeClass('active')
          } 
          $('.notif-probleme').text( parseInt($('.notif-probleme').text()) + 1 );
       }
    }); 
    return false;
  })

  $('.view-info-ecole').click(function() {
    $('#infoecole').addClass('Progressing');
    var self = $(this);
    var idCentre = self.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Superadmin/selectCenter/'+idCentre,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) {  
        $('#infoecole').removeClass('Progressing');
        if(data != "0"){
          data = JSON.parse(data);
          $('#infoecole').removeClass('Nodata');

          $('#infoecole').find('.nom').text( data.nom );
          $('#infoecole').find('.ville').text( data.ville );
          $('#infoecole').find('.tel').text( data.tel );
        }else{
          $('#infoecole').addClass('NoData');
        } 
    });  
  })

  $('.view-info-prof').click(function() {
    $('#infoprof').addClass('Progressing');
    var self = $(this);
    var idProf = self.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Superadmin/selectProf/'+idProf,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
      $('#infoprof').removeClass('Progressing');
      if(data != "0"){
        data = JSON.parse(data);
        $('#infoecole').removeClass('Nodata');

        $('#infoprof').find('.nom').text( data.nom );
        $('#infoprof').find('.ville').text( data.ville );
        $('#infoprof').find('.ecole').text( data.ecole );
        $('#infoprof').find('.tel').text( data.tel );
      }else{
          $('#infoprof').addClass('NoData');
      } 
    });  
  })

$('.view-info-parent').click(function() {
    $('#infoparent').addClass('Progressing');
    var self = $(this);
    var idClient = self.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Superadmin/selectClient/'+idClient,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) {   
      $('#infoparent').removeClass('Progressing');
      if(data != "0"){
        data = JSON.parse(data);
        $('#infoparent').removeClass('NoData');

        $('#infoparent').find('.nom').text( data.nom );
        $('#infoparent').find('.ville').text( data.ville );
        $('#infoparent').find('.ecole').text( data.ecole );
        $('#infoparent').find('.tel').text( data.tel );
      }else{
          $('#infoparent').addClass('NoData');
      } 
    });  
  })




  $(document).ready(function () {
    $('.dataTable tr[cls=dataTable-filter-row] th').each(function () {
      $(this).find('input').attr('placeholder','Recherche par '+$(this).find('input').attr('placeholder') )
    })
    $( "#infoecole,#infoprof,#infoparent, #confirmation" ).appendTo( "body" );
  })
</script>


<style type="text/css">
  .noResult{
    display: none;
  }
  .progressText{
    display: none;
  }
  .NoData .noResult{
    display: block;
  }
  .NoData .info-utilisateur{
    display: none;
  }
  .Progressing .progressText{
    display: block;
  }
  .Progressing .noResult,
  .Progressing .info-utilisateur{
    display: none;
  }
</style>