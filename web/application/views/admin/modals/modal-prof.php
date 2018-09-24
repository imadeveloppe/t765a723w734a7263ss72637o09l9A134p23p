<!-- ********************************************* edit-matiere ********************************************* -->
<div id="view-matiere" class="modal modal-styled fade">
  <div class="modal-dialog">
  <div class="loader"></div>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Matières enseignées</h3>
      </div> 
      <div class="modal-body">
      <div class="alert alert-danger" style="display: none;">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
        <strong>Aucune matière pour le moment</strong>
      </div>
        <!-- ********************************************************** -->
        
              <div class="row"> 
                  <!-- ...... -->
                  <!-- append matieres -->
                  <!-- ...... -->
              </div>
        <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<!-- ********************************************* edit-groupe ********************************************* -->
<div id="edit-matiere" class="modal modal-styled fade">
  <div class="modal-dialog">
  <div class="loader"></div>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Matières enseignées</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
              <div class="alert alert-success" style="display: none;">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                <strong>Les modifications sont bien enregistrées</strong>
              </div>
              <form  role="form" class="form-group"> 
                <div class="row">
                  <div class="col-xs-12">
                  <?php foreach ($matieres as $matiere) : ?>
                    <?php if(in_array($matiere->id, $ecoleMatieres)): ?>
                      <div class="checkbox col-sm-6"> 
                          <label>
                              <input type="checkbox" name="matieres[]" value="<?= $matiere->id ?>" id="check-<?= $matiere->id ?>">
                              <?= $matiere->intitule ?>
                          </label>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  </div>
                </div> 
                <input type="hidden" name="idProf" value="">
              </form>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-secondary sumbit-form">Enregistrer les modifications</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<!-- ********************************************* view-groupe ********************************************* -->
<div id="view-group" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Classe/Groupe</h3>
      </div>
      <div class="modal-body"
           data-intituleClasse="<?= implode(',', $intituleClasse) ?>"
           data-intituleGroupe="<?= implode(',', $intituleGroupe) ?>" 
        >
        <div class="alert alert-danger" style="display: none;">
          <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
          <strong>Aucune classe/groupe pour le moment</strong>
        </div>
      
         <!-- ********************************************************** --> 
              <div class="row">  
                  <div class="col-xs-3"> 
                        <label class="form-group">CP - G1</label>  
                  </div>    
              </div>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<!-- ********************************************* view-matiere ********************************************* -->
<div id="edit-group" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="loader"></div>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Classe/Groupe</h3>
      </div>
      <div class="modal-body"
           data-intituleClasse="<?= implode(',', $intituleClasse) ?>"
           data-intituleGroupe="<?= implode(',', $intituleGroupe) ?>"
           data-nbrClassesByNiveau="<?= implode(',', $nbrClassesByNiveau) ?>"
           >
         <!-- ********************************************************** -->
              <div class="alert alert-success" style="display: none;">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                <strong>Les modifications sont bien enregistrées</strong>
              </div> 
              <div class="base-classes" style="display: none;">
                <div class="row">
                  <div class="form-group col-xs-3"> 
                    <select class="form-control selectClasses" name="classe[]">
                    <option value=""></option>  
                      <?php $i = 1; ?>
                      <?php foreach ($intituleClasse as $value): ?>
                              <option value="<?= $i++ ?>"><?= $value ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group col-xs-3 no-padding"> 
                    <select class="form-control selectGroupe" name="groupe[]"> 
                    <option value=""></option>  
                      
                    </select>
                  </div>
                  <div class="form-group col-xs-3">
                   <a  data-toggle="modal" href="#confirmation-popup" class="btn btn-danger remove-row-popup">
                      <i class="fa fa-trash-o"></i>
                    </a>
                  </div>
                  </div>
              </div>
              <form  role="form">
                <div class="rows"> 
                  <div class="row">
                    <div class="form-group col-xs-3" style="margin: 0"> 
                      <label for="text-input">Classe</label>
                    </div>
                    <div class="form-group col-xs-3" style="margin: 0"> 
                      <label for="text-input">Groupe</label>
                    </div>
                  </div> 
                  <div class="content-classes"> 
                    
                    <!-- content classes -->
                     
                  </div>
                  <button type="button" class="btn btn-warning add-row">
                      <i class="fa fa-plus"></i>
                  </button> 
                     
                </div> 
               
                <input type="hidden" name="idProf" value="" >
              </form>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-secondary sumbit-form">Enregistrer les modifications</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->


<!-- ********************************************* edit-groupe ********************************************* -->
<div id="edit-pwd" class="modal modal-styled fade">
  <div class="modal-dialog">
  <div class="loader"></div>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Changement de mot de passe</h3>
      </div>
       <form  role="form" class="form-group">
      <div class="modal-body">
         <!-- ********************************************************** -->
              <div class="alert alert-success" style="display: none;">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                <strong>Le mot de passe est bien réinitialisé</strong>
              </div>
              
                <div class="row">
                  <div class="col-xs-12">
                    <label ><br>Nouveau mot de passe</label>
                    <input  type="text" class="form-control" name="pwd" id="pwd" required="">
                    
                  </div>
                </div>
                <input type="hidden" name="idProf" value="">
             
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-danger sumbit-form">Réinitialiser</button>
      </div>
       </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->




<!-- ******************************************Confirmation suppression****************************************** -->
<div id="tousSuspendre" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Êtes vous sûre de vouloir suspendre tous les professeurs ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <a href="valideAllProf/0" class="btn btn-primary">Oui</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<!-- ******************************************Confirmation suppression****************************************** -->
<div id="tousValider" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Êtes vous sûre de vouloir valider tous les professeurs ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <a href="valideAllProf/1" class="btn btn-primary" >Oui</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->



                


<!-- ******************************************Confirmation suppression****************************************** -->
<div id="confirmation" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Vous voulez vraiment faire cette action ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="confirmation-popup" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Vous voulez vraiment faire cette action ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm-popup" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->
<script src="<?= base_url() ?>assets/js/demos/form-extended.js"></script>