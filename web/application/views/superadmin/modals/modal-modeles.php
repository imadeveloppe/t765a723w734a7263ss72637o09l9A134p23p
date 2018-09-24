<div id="add-new" class="modal modal-styled fade">
  <div class="modal-dialog" style="width: 870px;">
    <div class="modal-content">
      <div class="modal-header" style="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Nouveau Moldèle</h3>
      </div>
      <div class="modal-body"> 
        <div class="loader"></div>
         <!-- ********************************************************** -->
            <div class="form-group">
              <label >Type</label>
              <select class="form-control" id="type" name="type">
                  <option value="ecole-to-parent">Ecole --> Parents</option>
                  <option value="ecole-to-prof">Ecole --> Prof</option>
                  <option value="prof-to-parent">Prof --> Parents</option>
              </select>
            </div>
            <div class="form-group">
              <label >Titre</label>
              <input  type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="row"> 
              <div class="col-md-12">
                <label>Message</label>
              </div> 
              <div class="col-sm-12"> 
                  <div class="btn-toolbar" role="toolbar"> 
                    <div class="btn-group" style="margin-bottom: -1px;">  
                      <input name="align" id="align" value="left" type="hidden">
                      <!-- <button type="button" class="btn btn-default align-text active" aria-label="Left Align" data-align="left" data-dir="ltr" data-lang="data-fr">
                          Message en français
                      </button>   
                      <button type="button" class="btn btn-default align-text" aria-label="Right Align" data-align="right" data-dir="rtl" data-lang="data-ar">
                            Message en arabe 
                      </button>   -->
                    </div> 
                  </div>
                 <textarea  style="border-top-left-radius: 0;" id="content" name="content" class="form-control" rows="6" placeholder="Votre message ici..." data-fr="Votre message ici..." data-ar="اكتب رسالتك هنا..."></textarea> 
              </div> 
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
             <p>Voulez-vous vraiment supprimer ce modèle ?</p>
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