<div class="content-header">
  <h2 class="content-header-title">Signaler un problème</h2>
  <ol class="breadcrumb">
    <li><a href="./">Home</a></li>
    <li class="active">Signaler un problème</li>
  </ol>
</div>
<!-- /.content-header -->
<div class="portlet">
  <div class="portlet-header">
    <h3> <i class="fa fa-bullhorn"></i> Que s'est-il passé ? </h3>
  </div>
  <!-- /.portlet-header -->
  
  <div class="portlet-content">
    <form action="<?= base_url() ?>Administration/signalerProbleme" method="post" class="signaler-probleme"  enctype="multipart/form-data"> 
      <div class="col-sm-12 no-padding">
        <label>Expliquer brièvement votre problème et les étapes à suivre pour le reproduire...</label>
        <textarea id="content" name="content" class="form-control" rows="10" required></textarea>
      </div>
      <!-- /.col -->
      
      <div class="col-sm-12 no-padding">
        <div class="fileupload fileupload-new" data-provides="fileupload">
          <div>
            <label>Ajouter une capture</label>
          </div>
          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/82e0fb/AAAAAA&amp;text=Pas+d'image" alt="Placeholder" /> </div>
          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
          <div> <span class="btn btn-default btn-file"> <span class="fileupload-new">Choisir</span> <span class="fileupload-exists">Changer</span>
            <input type="file" name="file" />
            </span> <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Supprimer</a> </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="btn-submit">
        <button type="submit" class="btn btn-primary">Envoyer <i class="fa fa-angle-right"></i></button>
      </div>
    </form>
  </div>
  <!-- /.portlet-content --> 
  
</div>