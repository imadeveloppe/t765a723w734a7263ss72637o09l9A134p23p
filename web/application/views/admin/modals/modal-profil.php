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
             <p>Voulez-vous vraiment supprimer ce responsable ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm" data-dismiss="modal">Oui</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->

<!-- ******************************************Confirmation suppression****************************************** -->
<div id="addNew" class="modal modal-styled fade">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="addSubAdmin">


      <div class="loader"></div>
      <div class="modal-header">
        <a href="<?= base_url() ?>Administration/profil/4" class="close">&times;</a>
        <h3 class="modal-title">Responsable administratif</h3>
      </div>
      <div class="modal-body">
        
        <div class="alert alert-warning msg" style="display: none;">
          <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
          <strong></strong>
        </div> <!-- /.alert -->
        <div class="alert alert-success msg" style="display: none;">
          <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
          <strong></strong>
        </div>
        

        <div class="row">
            <div class="form-group  col-xs-12">
              <label for="text-input">Nom et prénom</label>
              <input  name="name" class="form-control" type="text" value="" required> 
            </div>
        </div>

        <div class="row">
            <div class="form-group  col-xs-12">
              <label for="text-input">Téléphone</label>
              <input  name="tel" class="form-control" type="text" value="" required> 
            </div>
        </div>

        <div class="row">
            <div class="form-group pwdFeield col-xs-12">
              <label for="text-input">Mot de passe</label>
              <input  name="pwd" class="form-control" type="text" value="" required> 
            </div>
            <div class="form-group showPwdFeield col-xs-12" style="display: none;">
               <a href="#">Modifier le mot de passe</a>
            </div>
        </div>
          
          <h3 style="margin:20px 0 25px">Les droits d'accés</h3>

          <ul id="myTab1" class="nav nav-tabs">


          <?php $niveaux = explode(':', $centre->niveau) ?>


            <?php if( in_array(0, $niveaux) ): ?>
              <li class="active">
                <a href="#prescolaire" data-toggle="tab"><strong>Préscolaire</strong></a>
              </li>
            <?php endif ?>



            <?php if( in_array(1, $niveaux) ): ?>

            <li>
              <a href="#primaires" data-toggle="tab"><strong>Primaire</strong></a>
            </li> 

            <?php endif ?>




            <?php if( in_array(2, $niveaux) ): ?>

            <li>
              <a href="#college" data-toggle="tab"><strong>Collège</strong></a>
            </li> 

            <?php endif ?>



            <?php if( in_array(3, $niveaux) ): ?>

            <li>
              <a href="#lycee" data-toggle="tab"><strong>Lycée</strong></a>
            </li> 

            <?php endif ?>
          </ul>
  
          <div id="myTab1Content" class="tab-content">


          

          



          <?php if( in_array(0, $niveaux) ): ?>

            <div class="tab-pane fade in active" id="prescolaire">
              <h4>
                Communiqer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="sendtoparent"> <span>Communiquer avec les parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="sendtoprof"> <span>Communiquer avec les professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="validsent"> <span>Valider les envois des professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="absence"> <span>Absence</span>
                </label>
              </div>

              <h4 style="margin-top: 20px">
                Messages reçus
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="reception_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="reception_parent"> <span>Parents</span>
                </label>
              </div> 
              <h4 style="margin-top: 20px">
                Emplois du temps
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="emplois_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="emplois_classe"> <span>Classes</span>
                </label>
              </div> 

              <h4 style="margin-top: 20px">
                Gérer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="gerer_classes"> <span>Gérer les classes</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="gerer_matieres"> <span>Gérer les matières</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="gerer_eleves"> <span>Gérer les élèves</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="gerer_profs"> <span>Gérer les professeurs</span>
                </label>
              </div> 

               <h4 style="margin-top: 20px">
                Historique des envois
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="historique_prof_parents"> <span>Professeurs -> Parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="historique_admin_parents"> <span>Administration -> Parents</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[prescolaire][]" value="historique_admin_prof"> <span>Administration -> Professeurs</span>
                </label>
              </div> 

            </div>

          <?php endif ?>











          <?php if( in_array(1, $niveaux) ): ?>  



          <div class="tab-pane fade in" id="primaires">
            <h4>
                Communiqer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="sendtoparent"> <span>Communiquer avec les parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="sendtoprof"> <span>Communiquer avec les professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="validsent"> <span>Valider les envois des professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="absence"> <span>Absence</span>
                </label>
              </div>

              <h4 style="margin-top: 20px">
                Messages reçus
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="reception_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="reception_parent"> <span>Parents</span>
                </label>
              </div> 
              <h4 style="margin-top: 20px">
                Emplois du temps
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="emplois_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="emplois_classe"> <span>Classes</span>
                </label>
              </div> 

              <h4 style="margin-top: 20px">
                Gérer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="gerer_classes"> <span>Gérer les classes</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="gerer_matieres"> <span>Gérer les matières</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="gerer_eleves"> <span>Gérer les élèves</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="gerer_profs"> <span>Gérer les professeurs</span>
                </label>
              </div> 

               <h4 style="margin-top: 20px">
                Historique des envois
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="historique_prof_parents"> <span>Professeurs -> Parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="historique_admin_parents"> <span>Administration -> Parents</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[primaire][]" value="historique_admin_prof"> <span>Administration -> Professeurs</span>
                </label>
              </div> 
            </div>

          <?php endif ?>
  













          <?php if( in_array(2, $niveaux) ): ?>


            <div class="tab-pane fade in" id="college">
              <h4>
                Communiqer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="sendtoparent"> <span>Communiquer avec les parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="sendtoprof"> <span>Communiquer avec les professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="validsent"> <span>Valider les envois des professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="absence"> <span>Absence</span>
                </label>
              </div>

              <h4 style="margin-top: 20px">
                Messages reçus
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="reception_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="reception_parent"> <span>Parents</span>
                </label>
              </div> 
              <h4 style="margin-top: 20px">
                Emplois du temps
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="emplois_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="emplois_classe"> <span>Classes</span>
                </label>
              </div> 

              <h4 style="margin-top: 20px">
                Gérer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="gerer_classes"> <span>Gérer les classes</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="gerer_matieres"> <span>Gérer les matières</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="gerer_eleves"> <span>Gérer les élèves</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="gerer_profs"> <span>Gérer les professeurs</span>
                </label>
              </div> 

               <h4 style="margin-top: 20px">
                Historique des envois
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="historique_prof_parents"> <span>Professeurs -> Parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="historique_admin_parents"> <span>Administration -> Parents</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[college][]" value="historique_admin_prof"> <span>Administration -> Professeurs</span>
                </label>
              </div> 
            </div>


          <?php endif ?>










          

          <?php if( in_array(3, $niveaux) ): ?>

            <div class="tab-pane fade in" id="lycee"> 
              <h4>
                Communiqer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="sendtoparent"> <span>Communiquer avec les parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="sendtoprof"> <span>Communiquer avec les professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="validsent"> <span>Valider les envois des professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="absence"> <span>Absence</span>
                </label>
              </div>

              <h4 style="margin-top: 20px">
                Messages reçus
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="reception_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="reception_parent"> <span>Parents</span>
                </label>
              </div> 
              <h4 style="margin-top: 20px">
                Emplois du temps
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="emplois_prof"> <span>Professeurs</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="emplois_classe"> <span>Classes</span>
                </label>
              </div> 

              <h4 style="margin-top: 20px">
                Gérer
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="gerer_classes"> <span>Gérer les classes</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="gerer_matieres"> <span>Gérer les matières</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="gerer_eleves"> <span>Gérer les élèves</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="gerer_profs"> <span>Gérer les professeurs</span>
                </label>
              </div> 

               <h4 style="margin-top: 20px">
                Historique des envois
              </h4>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="historique_prof_parents"> <span>Professeurs -> Parents</span>
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="historique_admin_parents"> <span>Administration -> Parents</span>
                </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="access[lycee][]" value="historique_admin_prof"> <span>Administration -> Professeurs</span>
                </label>
              </div> 
            </div>

          <?php endif ?>


          </div>
           


      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value="0">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="submit" class="btn btn-primary confirm">Valider</button>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->