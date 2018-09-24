

      

      <div class="content-header">
        <h2 class="content-header-title">Gérer les matières</h2>
        <ol class="breadcrumb">
          <li><a href="./">Home</a></li> 
          <li><a href="#">Gérer</a></li>
          <li class="active">Gérer les matières</li>
        </ol>
      </div> <!-- /.content-header --> 

      <div class="row"> 
        <div class="col-md-12">
          <div class="portlet matieres-enseignees">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-check"></i>
                Matières enseignées
              </h3> 
            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

              <div class="row"> 
                  
                    <form class="form-group col-sm-12" action="<?= base_url() ?>Administration/matiereEcole" method="post">
                      <div class="col-md-12">
                        <h4>Matières enseignées </h4>
                        <?php foreach ($matieres as $matiere) : ?>
                          <div class="checkbox col-md-4 col-sm-6" style="    margin-bottom: 20px;">
                            <label>
                                <input type="checkbox" name="matieres[]" value="<?= $matiere->id ?>" <?= (in_array($matiere->id, $matiereEcole)) ? 'checked' : '' ?>>
                                <span><?= $matiere->intitule ?></span>
                            </label>
                          </div> 
                        <?php endforeach; ?> 
                      </div> 
                      <div class="col-sm-10"> 
                      </div>
                      <div class="btn-submit col-sm-2">
                        <button type="submit" class="btn btn-secondary btn-block">Enregistrer</button>
                      </div>
                    </form> <!-- /.form-group --> 
                 
              </div>  <!-- /.row --> 
            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->
        </div>
      </div>

      

<script type="text/javascript"> 

$(document).ready(function () {
  $('input:checkbox, input:radio').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue',
    inheritClass: true
  })

  $('.appellationClasses > div label,.appellationClasses > div label .iCheck-helper').on('click', function() {
   setTimeout(function() {
     var tab = $('.appellationClasses > div label > div.checked').parent().attr('data-value').split(', ');
     var i = 0;
     $('.nbrClassesByNiveau .form-group').each(function () {
      $(this).find('span#nameNiveau').text(tab[i]);
     i++; 
     })
   },500) 
  });

})
</script>


<script src="<?= base_url() ?>assets/js/demos/form-extended.js"></script>