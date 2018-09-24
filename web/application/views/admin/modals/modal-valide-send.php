<div id="more-info" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Contenu de message</h3>
      </div>
      <div class="modal-body">          
        <p>full content</p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- *****************************Confirmation suppression****************************************** -->
<div id="confirmation" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Voulez-vous vraiment supprimer cet envoi ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ********************************************************************************* -->
<!-- ******************************************Confirmation Envoi****************************************** -->
<div id="confirmation-send-all" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(14, 138, 15)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Vous voulez vraiment valider tous les envois ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-success confirm" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<!-- ******************************************Confirmation Envoi****************************************** -->
<div id="refaire" class="modal modal-styled fade">
  <div class="modal-dialog">
    <form class="modal-content" action="" id="sendRemarque">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Remarque sur ce message</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
          <div class="row"> 
             <div class="col-sm-12"> 

              <div class="form-group">
                <label for="textarea-input">Insérer votre remarque ici</label>
                <textarea name="content" cols="10" rows="6" class="form-control" required minlength="3" dir="ltr"></textarea>
              </div>

            </div>
          </div>

         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-success confirm">Envoyer</button>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

















<!-- ******************************************Exportation prof -> parents****************************************** -->
<div id="exportMessages-prof-parent" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Exportation des messages</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
              <h4>Messages pour un groupe</h4>
              <form role="form" id="prof-to-parent">
                <div class="rows"> 
                  <div class="row">
                    <div class="form-group col-xs-6 col-sm-5" style="margin: 0"> 
                      <label for="text-input">Classe</label>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4" style="margin: 0"> 
                      <label for="text-input">Groupe</label>
                    </div>
                  </div> 
                  <div class="content-classes">
                <div class="row">
                  <div class="form-group col-xs-6 col-sm-5"> 
                    <select class="form-control selectClasses" name="classe" required>
                        <option value="">Choisir</option>
                          <?php foreach ($intituleClasse as $key => $value) : ?>
                            <option value="<?= $key+1 ?>"><?= $value ?></option>
                          <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group col-xs-6 col-sm-4 no-padding"> 
                    <select class="form-control selectGroupe" name="groupe" required> 
                      <option value="">Choisir</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-3 btnExpotHistorique">
                   <button type="submit" class="btn btn-warning btn-block">Exporter</button>
                  </div>
                  </div>
                  </div> 
                </div>  
              </form>
              <br>
              <br>
              <h4>Messages pour un élève</h4>
              <form role="form" id="prof-to-one-parent">
                <div class="rows"> 
                  <div class="row">
                    <div class="form-group col-xs-3 col-sm-3" style="margin: 0"> 
                      <label for="text-input">Classe</label>
                    </div>
                    <div class="form-group col-xs-3 col-sm-2" style="margin: 0"> 
                      <label for="text-input">Groupe</label>
                    </div>
                    <div class="form-group col-xs-6 col-sm-4" style="margin: 0"> 
                      <label for="text-input">Élève</label>
                    </div>
                  </div> 
                  <div class="content-classes">
                <div class="row">
                  <div class="form-group col-xs-3 col-sm-3"> 
                    <select class="form-control selectClasses" name="classe" required>
                        <option value="">Choisir</option>
                          <?php foreach ($intituleClasse as $key => $value) : ?>
                            <option value="<?= $key+1 ?>"><?= $value ?></option>
                          <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2" style="padding-left: 0;"> 
                    <select class="form-control selectGroupe" name="groupe" required> 
                      <option value="">Choisir</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-6  col-xs-6 no-padding"> 
                    <select class="form-control selectEleve" name="eleve" required> 
                      <option value="">Choisir</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-3 btnExpotHistorique">
                   <button type="submit" class="btn btn-warning btn-block">Exporter</button>
                  </div>
                  </div>
                  </div> 
                </div>  
              </form> 
         <!-- ********************************************************** -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-success confirm" data-dismiss="modal">Oui</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->



<!-- ******************************************Exportation admin -> parents****************************************** -->
<div id="exportMessages-admin-prof" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Exportation des messages</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** --> 
              <h4>Messages pour un professeur</h4>
              <form role="form" id="admin-to-one-prof">
                <div class="rows"> 
                  <div class="row">
                    <div class="form-group col-xs-4" style="margin: 0"> 
                      <label for="text-input">Matière</label>
                    </div>
                    <div class="form-group col-xs-5" style="margin: 0"> 
                      <label for="text-input">Professeur</label>
                    </div> 
                  </div> 
                  <div class="content-classes">
                <div class="row">
                  <div class="form-group col-xs-4 "> 
                    <select class="form-control selectClasses" name="matiere" required>
                        <option value="">Choisir</option>
                        <?php foreach ($matieres as $matiere) : ?> 
                            <?php if(in_array($matiere->id, $matiereEcole)): ?>
                                  <option value="<?= $matiere->id ?>"><?= $matiere->intitule ?></option> 
                            <?php endif; ?> 
                        <?php endforeach; ?> 
                    </select>
                  </div> 
                  <div class="form-group col-xs-4 no-padding"> 
                    <select class="form-control selectEleve" name="prof" required> 
                      <option value="">Choisir</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-3">
                   <button type="submit" class="btn btn-warning btn-block">Exporter</button>
                  </div>
                  </div>
                  </div> 
                </div>  
              </form> 
         <!-- ********************************************************** -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-success confirm" data-dismiss="modal">Oui</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->



<!-- ******************************************Exportation admin -> prof****************************************** -->
<div id="exportMessages-admin-parent" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Exportation des messages</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** --> 
              <h4>Messages pour un élève</h4>
              <form role="form" id="admin-to-one-parent">
                <div class="rows"> 
                  <div class="row">
                    <div class="form-group col-xs-3" style="margin: 0"> 
                      <label for="text-input">Classe</label>
                    </div>
                    <div class="form-group col-xs-2" style="margin: 0"> 
                      <label for="text-input">Groupe</label>
                    </div>
                    <div class="form-group col-xs-4" style="margin: 0"> 
                      <label for="text-input">Élève</label>
                    </div>
                  </div> 
                  <div class="content-classes">
                <div class="row">
                  <div class="form-group col-xs-3 "> 
                    <select class="form-control selectClasses" name="classe" required>
                        <option value="">Choisir</option>
                          <?php foreach ($intituleClasse as $key => $value) : ?>
                            <option value="<?= $key+1 ?>"><?= $value ?></option>
                          <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group col-xs-2" style="padding-left: 0;"> 
                    <select class="form-control selectGroupe" name="groupe" required> 
                      <option value="">Choisir</option>
                    </select>
                  </div>
                  <div class="form-group col-xs-4 no-padding"> 
                    <select class="form-control selectEleve" name="eleve" required> 
                      <option value="">Choisir</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-3">
                   <button type="submit" class="btn btn-warning btn-block">Exporter</button>
                  </div>
                  </div>
                  </div> 
                </div>  
              </form> 
         <!-- ********************************************************** -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-success confirm" data-dismiss="modal">Oui</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->


<div id="exportMessages-admin-parent" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
              
         <!-- ********************************************************** -->
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-success confirm" data-dismiss="modal">Oui</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<div id="exportMessages-admin-prof" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Vous voulez vraiment valider tous les envois ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-success confirm" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->