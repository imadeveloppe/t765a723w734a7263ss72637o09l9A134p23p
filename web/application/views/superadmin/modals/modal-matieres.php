<div id="add-new" class="modal modal-styled fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Ajouter une nouvelle matière</h3>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="display: none;"> 
            <strong>Désolé, cette matière est déjà saisie</strong>
        </div>
        <div class="loader"></div>
         <!-- ********************************************************** -->
            <div class="form-group">
              <label >Intitulé</label>
              <input  type="text" class="form-control" id="intitule" name="intitule" required>
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
              <label >Intitulé</label>
              <input  type="text" class="form-control" id="edit-intitule" name="edit-intitule" required>
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
             <p>Voulez-vous vraiment supprimer cette matière ?</p>
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