<div class="icons-home">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
      <a href="<?= base_url() ?>prof/sendToParent" class="btn btn-app"> 
        <i class="fa fa-users"></i> Communiquer avec<br> les élèves
      </a>
    </div>  

    <div class="col-sm-3">
      <a href="<?= base_url() ?>prof/sendToAdmin" class="btn btn-app"> 
        <i class="fa fa-building-o"></i> Communiquer avec <br>l'administration
      </a> 
      <?php if($countMessageProfToAdmin > 0): ?>
      <span class="badge" style="position: absolute;right: 0;top: -7px;"><?= $countMessageProfToAdmin ?></span>
      <?php endif; ?>
    </div> 
    <div class="col-sm-3"></div> 
</div> 
<div class="clear"></div>
<?php if( $emploiProf ): ?>
  <div class="portlet" style="clear: both; margin-top: 30px">
    <div class="portlet-header">
      <h3>Emploi du temps</h3>
    </div> 
    <div class="portlet-content">
    <img src="<?= $emploiProf ?>" style="width: 100%">
   </div>
  </div>
<?php endif; ?>