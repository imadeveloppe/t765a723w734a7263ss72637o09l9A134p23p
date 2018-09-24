<!-- ********************************************* New eleve ********************************************* -->
<div id="new-eleve" class="modal modal-styled fade">
  <div class="loader"></div>
  <div class="modal-dialog"> 
      <form id="addClient" class="modal-content" 
            data-appellationGroupe="<?= implode(',', $intituleGroupe) ?>"
            data-nbrClassesByNiveau="<?= implode(',', $nbrClassesByNiveau) ?>"
            role="form">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Nouveau élève</h3>
      </div>
      <div class="modal-body">

         <!-- ********************************************************** -->
              <div class="alert alert-success" style="display: none;">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                <strong></strong>
              </div>
              <div class="alert alert-danger" style="display: none;">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                <strong></strong>
              </div>
              
                <div class="row">
                    <div class="form-group  col-xs-12 photoEleve">
                         <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-preview thumbnail" style="width: 180px; height: 180px;position: relative;"> 

                          </div>  
                          <div>
                            <span class="btn btn-default btn-file">
                            <span class="fileupload-new">Ajouter une photo</span>
                            <span class="fileupload-exists">Changer</span>
                            <input type="file" /></span>
                            <input type="hidden" name="photo">
                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                          </div>
                        </div>
                    </div>
                    <div class="form-group  col-xs-12">
                      <label for="text-input">Prénom</label>
                      <input  name="fname" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group  col-xs-12">
                      <label for="text-input">Nom</label>
                      <input  name="lname" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group  col-xs-12">
                      <label for="text-input">Identifiant</label>
                      <input  name="code" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group  col-xs-12">
                      <label for="text-input">Mot de passe</label>
                      <input  name="password" class="form-control" type="text" value="<?= $generatedPassword ?>" required> 
                    </div>
                    <div class="form-group col-sm-6 no-padding">
                      <div class="form-group col-xs-6">
                          <label >Classe</label>
                          <select class="form-control"  name="classe" id="classe"  required> 
                            <option></option>  
                            <?php foreach ($intituleClasse as $key => $value): ?>
                              <option value="<?= $key+1 ?>"><?= $value ?></option> 
                            <?php endforeach ?> 

                          </select>
                      </div>
                      <div class="form-group col-xs-6">
                        <label >Groupe</label>
                        <select class="form-control"  name="groupe" id="groupe"  required>
                          <option></option>  
                        </select>
                      </div>
                    </div>

                    <br>
                    <br>
                     <div class="form-group col-xs-12">
                      <label for="text-input">État de santé</label>
                      <textarea  class="form-control" rows="3"  name="maladie"></textarea>  
                    </div>

                    <br>
                     <div class="form-group col-xs-12">
                      <label for="text-input">Remarques</label>
                      <textarea  class="form-control" rows="3" name="remarque" ></textarea>  
                    </div> 
 

                  </div> 
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-secondary sumbit-form">Ajouter</button>
      </div>
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->



<!-- ********************************************* edit info eleve ********************************************* -->
<div id="edit-info-eleve" class="modal modal-styled fade">
  <div class="loader"></div>
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Infos élève</h3>
      </div>
      <div class="modal-body">

         <!-- ********************************************************** -->
              <div class="alert alert-success" style="display: none;">
                <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                <strong>Les modifications sont bien enregistrées</strong>
              </div>
              <form  
                    data-appellationGroupe="<?= implode(',', $intituleGroupe) ?>"
                    data-nbrClassesByNiveau="<?= implode(',', $nbrClassesByNiveau) ?>"
                    role="form">
                <div class="row">
                    <div class="form-group  col-xs-12 photoEleve">
                         <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-preview thumbnail" style="width: 180px; height: 180px;position: relative;"> 

                          </div> 
                          <a href="#" class="valid-row" style="    position: absolute;
                                    left: 141px;
                                    bottom: 57px;
                                    border: 1px solid #fff;
                                    border-radius: 32px;
                                    height: 27px;"></a>
                          <div>
                            <span class="btn btn-default btn-file">
                            <span class="fileupload-new">Ajouter une photo</span>
                            <span class="fileupload-exists">Changer</span>
                            <input type="file" /></span>
                            <input type="hidden" name="photo" id="photo">
                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a>
                          </div>
                        </div>
                    </div>
                    <div class="form-group  col-xs-12 col-sm-6">
                      <label for="text-input">Prénom</label>
                      <input id="fname" name="fname" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group  col-xs-12 col-sm-6">
                      <label for="text-input">Nom</label>
                      <input id="lname" name="lname" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group  col-xs-12">
                      <label for="text-input">Identifiant</label>
                      <input id="code" name="code" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group  col-xs-12">
                      <label for="text-input">Mot de passe</label>
                      <input id="password" name="password" class="form-control" type="text" value="" required> 
                    </div>
                    <div class="form-group col-xs-3">
                      <label >Classe</label>
                      <select class="form-control" id="classe" name="classe" style="width: 100px;"> 

                        <?php foreach ($intituleClasse as $key => $value): ?>
                          <option value="<?= $key+1 ?>"><?= $value ?></option> 
                        <?php endforeach ?> 

                      </select>
                    </div>
                    <div class="form-group col-xs-9 no-padding">
                      <label >Groupe</label>
                      <select class="form-control" id="groupe" name="groupe" style="width: 100px;" required>  
                      </select>
                    </div>
                    

                    <br>
                    <br>
                     <div class="form-group col-xs-12">
                      <label for="text-input">État de santé</label>
                      <textarea  class="form-control" rows="3" id="maladie" name="maladie"></textarea>  
                    </div>

                    <br>
                     <div class="form-group col-xs-12">
                      <label for="text-input">Remarques</label>
                      <textarea  class="form-control" rows="3" name="remarque" id="remarque"></textarea>  
                    </div> 

                  <br>
                  <br>

                  <div class="block-parents">
                    <div class="form-group col-xs-12  col-sm-6 nomParentContainer">
                      <label for="text-input">Nom du parent</label>
                      <input  name="nomParent[]" class="form-control nomParent" type="text" value="" required>
                      <br>
                      <input   name="nomParent[]" class="form-control nomParent2" type="text" value="" required> 
                    </div> 

                     <div class="form-group col-xs-10 col-sm-5 telParentContainer">
                      <label for="text-input">Téléphone</label>
                      <input name="telParent[]" class="form-control telParent" type="text" value="" required> 
                      <br>
                      <input name="telParent[]" class="form-control telParent2" type="text" value="" required>
                      
                    </div>
                    <div class="form-group col-xs-2 col-sm-1 no-padding">
                      <label for="text-input" style="width: 100%;display: block;">&nbsp;</label>
                      <a href="#DeleteParent" data-toggle="modal" style="margin-top: 2px;" class="btn btn-danger remove-parent" data-parent="0">
                        <i class="fa fa-trash-o"></i>
                      </a>
                      <br>
                      <br>
                      <a href="#DeleteParent" data-toggle="modal" style="margin-top: 2px;" class="btn btn-danger remove-parent remove-parent2" data-parent="1">
                        <i class="fa fa-trash-o"></i>
                      </a>
                    </div>
                  </div>
                    

                  </div>

                  <input type="hidden" id="idClient" name="idClient" value="">
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

<!-- ******************************************Carte eleve****************************************** -->
<div id="carte-eleve" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Carte d'élève</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
        
          <div class="well">
            <div class="row"> 
              <div class="col-sm-3">
                <img id="carte-photoEleve" src="/assets/img/student.png" data-src="/assets/img/student.png" width="100%" style="border-radius: 10px; margin-bottom: 20px">
              </div>
              <div class="col-sm-9"> 
                <table class="table infosRows">
                  <tbody>
                    <tr>
                      <th  class="d_b" style="width: 124px;padding-right: 0;">Nom et prénom</th>
                      <td  class="d_b" id="carte-nomEleve"></td>
                    </tr>
                    <tr>
                      <th  class="d_b" style="width: 124px;padding-right: 0;">Identifiant</th>
                      <td  class="d_b" id="carte-codeEleve"></td>
                    </tr>  
                    <tr>
                      <th class="d_b" >Classe</th>
                      <td class="d_b"  id="carte-classeEleve"></td>
                    </tr> 
                    <tr class="block-parents">
                      <th class="d_b" >Parent</th>
                      <td class="d_b"  id="carte-nomParent"> 
                      </td>
                      <td class="d_b"  id="carte-nomParents" style="padding: 0; vertical-align: middle; height: 36px">
                        <table style="width: 100%;height: 36px;">
                          <tr>
                            <td class="parent1" style="width: 50%; border-right: 1px solid #ccc;"></td>
                            <td class="parent2" style="padding-left: 5px;"></td>
                          </tr>
                        </table>
                      </td>
                    </tr> 
                    <tr class="block-parents">
                      <th class="d_b" >Téléphone</th>
                      <td class="d_b"  id="carte-telParent"> 
                      </td>
                      <td class="d_b"  id="carte-telParents" style="padding: 0; vertical-align: middle; height: 36px">
                        <table style="width: 100%;height: 36px;">
                          <tr>
                            <td class="parent1" style="width: 50%; border-right: 1px solid #ccc;"></td>
                            <td class="parent2" style="padding-left: 5px;"></td>
                          </tr>
                        </table>
                      </td>
                    </tr> 
                  </tbody>
                </table>
              </div>
              <div class="col-sm-12">
                <h4 style="margin-bottom: 0"><span class="text-primary" style="color: rgb(22, 160, 133)">État de santé</span> </h4>
                <p id="carte-maladie" data-content="<em>pas d'information</em>"></p>   

                <h4 style="margin-bottom: 0"><span class="text-primary" style="color: rgb(22, 160, 133)">Remarques</span> </h4>
                <p id="carte-remartque" data-content="<em>pas d'information</em>"></p>   
                <br> 
              </div>
            </div>
          </div> <!-- /.well --> 
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Fermer</button> 
      </div>
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
             <p>Êtes vous sûre de vouloir suspendre tous les élèves ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <a href="valideAllClient/0" class="btn btn-primary">Oui</a>
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
             <p>Êtes vous sûre de vouloir valider tous les élèves ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <a href="valideAllClient/1" class="btn btn-primary" >Oui</a>
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
             <p>Voulez-vous vraiment supprimer cet élève ?</p>
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
<div id="DeleteParent" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
         <!-- ********************************************************** -->
             <p>Voulez-vous vraiment supprimer ce parent ?</p>
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