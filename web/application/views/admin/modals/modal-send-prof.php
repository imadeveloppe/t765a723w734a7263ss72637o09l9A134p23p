<div id="destinations" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #16a085">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Destinataires</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
            <ul class="destinations"> 
               <li>
                 <span data-id="all" data-type="all">
                 Tous les professeurs
                 <?php  
                  switch ( $info['niveau'] ) {
                    case 0:
                       echo "du préscolaire";
                      break; 
                    case 1:
                       echo "du primaire";
                      break; 
                    case 2:
                      echo "du collège";
                      break; 
                    case 3:
                      echo "du lycée";
                      break; 
                  }
                 ?>
                 </span><i class="fa fa-caret-right"></i>
                 <ul>
                   <li>
                     Classes / Groupes<i class="fa fa-caret-right"></i>
                     <ul> 
                       <?php $i=0; foreach ($intituleClasse as $classe): ?> 
                          <?php if( $classe ): ?>
                            <li class="">
                             <span data-id="_<?= $i+1 ?>_" data-type="classe"><?= $classe ?></span><i class="fa fa-caret-right"></i>
                             <ul>
                             <?php for ($j=0; $j < $nbrClassesByNiveau[$i] ; $j++): ?>
                               <li class="">
                                 <span data-id="_<?= $i+1 ?>-<?= $j+1 ?>_" data-type="groupe"><?= $classe ?>-G<?= $intituleGroupe[$j] ?></span> 
                               </li> 
                              <?php endfor; ?>
                             </ul>
                           </li>
                          <?php endif ?>
                        <?php $i++; endforeach; ?>
                     </ul>
                   </li>
                   <li>
                     Matières<i class="fa fa-caret-right"></i>
                     <?php  
                     $tabMatieres = array();
                     foreach ($matieres as $key => $value) {
                       $tabMatieres[$value->id] = $value;
                     }
                     ?> 
                     <ul> 
                     <?php foreach ($ecoleMatieres as $idMatiere ): ?>
                       <li class="">
                         <span data-id="_<?= $idMatiere ?>_" data-type="matiere"><?= $tabMatieres[$idMatiere]->intitule ?></span><i class="fa fa-caret-right"></i>  
                            <ul>
                            <?php  
                            if( isset($ProfsByMatiere[ $idMatiere ]) and !empty($ProfsByMatiere[ $idMatiere ]) ) :
                              foreach ($ProfsByMatiere[ $idMatiere ] as $prof ) : ?>
                               <li class="">
                                 <span data-id="_<?= $prof['idProf'] ?>_" data-type="prof"><?= $prof['nom'] ?></span>
                               </li> 
                              <?php 
                              endforeach;
                            else: ?>
                            <!-- <li> -->
                              <div class="alert alert-danger" style="margin: 9px 0px 9px -44px; padding: 5px; display: inline-block; font-size: 12px;"> 
                                  <strong>Aucun enseignant n'est associé à cette matière </strong>
                              </div> 
                            <!-- </li> -->
                          <?php endif; ?>
                           </ul> 
                       </li> 
                       <?php endforeach; ?> 
                     </ul>
                   </li>
                 </ul>
               </li>
            </ul> 
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-tertiary" data-dismiss="modal">Anuller</button> -->
        <button type="button" class="btn btn-secondary confirm" data-dismiss="modal" style="background:#16a085">Valider</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->
<!-- ************************************************************************************************************ -->
<div id="modeles" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Modèles de messages</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->

              <ul id="myTab1" class="nav nav-tabs">
                <li class="active">
                  <a href="#freancais" data-toggle="tab">Français</a>
                </li>
                <li class="">
                  <a href="#arabe" data-toggle="tab">Arabe</a>
                </li> 
              </ul>
              <div id="myTab1Content" class="tab-content"  style="height: 295px;overflow-y: scroll;">
            <div class="tab-pane fade active in" id="freancais">
               <div class="panel-group accordion" id="accordion"> 
                <?php foreach ($modeles as $key => $modele):?>
                    <?php if( strpos($modele->content, 'dir="rtl"') == 0 ): ?>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title"> 
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".accordion" href="#collapse<?= $key ?>">
                            <?= $modele->title ?>
                            </a>
                          </h4>
                        </div>

                        <div id="collapse<?= $key ?>" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="content-model"><div style="text-align: left; "><?= nl2br($modele->content) ?></div></div>
                            <div style="text-align: right;">
                              <button data-dir="left" type="button" class="btn btn-secondary addModel" data-dismiss="modal">Je choisis</button> 
                            </div>
                          </div>
                        </div>
                      </div> <!-- /.panel-default --> 
                  <?php endif; ?>
                <?php endforeach ?>
              </div>
            </div>

            <div class="tab-pane fade" id="arabe">
                <div class="panel-group accordion" id="accordion"> 
                  <?php foreach ($modeles as $key => $modele):?>
                      <?php if( strpos($modele->content, 'dir="rtl"') > 0 ): ?>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title" dir="rtl"> 
                              <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".accordion" href="#collapse<?= $key ?>">
                              <?= $modele->title ?>
                              </a>
                            </h4>
                          </div>

                          <div id="collapse<?= $key ?>" class="panel-collapse collapse">
                            <div class="panel-body" dir="rtl">
                              <div class="content-model"><?= nl2br($modele->content) ?></div>
                              <div style="text-align: left; ">
                                <button data-dir="right" type="button" class="btn btn-secondary addModel" data-dismiss="modal">Je choisis</button> 
                              </div>
                            </div>
                          </div>
                        </div> <!-- /.panel-default --> 
                      <?php endif; ?>
                  <?php endforeach ?>
                </div>
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
<!-- ******************************************Confirmation Envoi****************************************** -->
<!-- ******************************************Confirmation Envoi****************************************** -->
<div id="confirmation" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(14, 138, 15)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Vous voulez vraiment envoyer ce message ?</p>
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
<div id="noDestination" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: red">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p class="noDestination">Votre message est sans destination</p>
             <p class="noMatiere">Matière non renseignée</p>
             <p class="noMessageVide">Message vide</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Retour</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->