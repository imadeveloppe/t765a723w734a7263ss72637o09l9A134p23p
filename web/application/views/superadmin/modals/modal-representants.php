<div id="add-new" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Ajouter un Nouveau représentant </h3>
      </div>
      <div class="modal-body">
        <div class="loader"></div>
         <!-- ********************************************************** -->
            <div class="form-group">
              <label >Nom</label>
              <input  type="text" class="form-control" id="nom" required>
            </div>
            <div class="form-group">
              <label class="placeholder-hidden">Ville</label>
              <select class="form-control" id="ville" required>
                <option value="">Choisir une ville</option>
                <?php foreach ($villes as $key => $ville) : ?>
                  <option value="<?= $ville->id ?>"><?= $ville->intitule ?></option>
                <?php endforeach; ?>
              </select>
            </div> <!-- /.form-group -->
            <div class="form-group">
              <label >Téléphone</label>
              <input  type="tel" class="form-control" id="tel" id="tel" required>
            </div>
            <div class="form-group">
              <label >Mot de passe</label>
              <input  type="text" class="form-control" id="pwd" required>
            </div>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success add-new-db">Ajouter</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="edit-row" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Modification</h3>
      </div>
      <div class="modal-body">
        <div class="loader"></div>
         <!-- ********************************************************** -->
            <div class="form-group">
              <label >Nom</label>
              <input  type="text" class="form-control" id="edit-nom" required>
            </div>
            <div class="form-group">
              <label class="placeholder-hidden">Ville</label>
              <select class="form-control" id="edit-ville" required>
                <option value="">Choisir une ville</option>
                <?php foreach ($villes as $key => $ville) : ?>
                  <option value="<?= $ville->id ?>"><?= $ville->intitule ?></option>
                <?php endforeach; ?>
              </select>
            </div> <!-- /.form-group -->
            <div class="form-group">
              <label >Téléphone</label>
              <input  type="text" class="form-control" id="edit-tel" required>
            </div>
            <div class="form-group">
              <label >Mot de passe</label>
              <input  type="text" class="form-control" id="edit-pwd" >
              <span style="font-size: 11px"><em>Laisser le mot de passe vide si ne voulez pas le changer</em></span>
               <input type="hidden" name="id" id="id">
            </div>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-warning edit-row-db">Enregistrer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->
<div id="confirmation" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(219, 0, 0)">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Confirmation</h3>
      </div>
      <div class="modal-body">
      <div class="loader"></div>
         <!-- ********************************************************** -->
             <p>Voulez-vous vraiment supprimer ce représentant ?</p>
         <!-- ********************************************************** -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-tertiary" data-dismiss="modal">Non</button>
        <button type="button" class="btn btn-primary confirm">Supprimer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ************************************************************************************************************ -->