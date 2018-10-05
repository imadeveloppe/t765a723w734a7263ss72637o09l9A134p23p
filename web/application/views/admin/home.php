<div class="icons-home">
   

  <?php if( hasAccess('sendtoparent') ): ?>
    <div class="col-sm-3 center">
      <a href="<?= base_url() ?>Administration/sendToParent" class="btn btn-app"> 
        <i class="fa fa-users"></i> Communiquer avec<br> les parents
      </a>
    </div> 
  <?php endif; ?>


  <?php if( hasAccess('sendtoprof') ): ?>
    <div class="col-sm-3 center">
      <a href="<?= base_url() ?>Administration/sendToProf" class="btn btn-app"> 
        <i class="fa fa-user"></i> Communiquer avec <br>les professeurs
      </a> 
    </div> 
  <?php endif; ?> 


   
  <?php if( hasAccess('validsent') ): ?>
    <div class="col-sm-3 center">
      <a href="<?= base_url() ?>Administration/valideSent" class="btn btn-app"> 
        <i class="fa fa-check"></i> Valider les envois<br> des professeurs
        <?php if( $nbrMessages > 0 ): ?>
          <span class="notif"><?= $nbrMessages ?></span>
        <?php endif; ?>
      </a>
    </div> 
  <?php endif; ?>  

  <?php if( hasAccess('absence') ): ?>
    <div class="col-sm-3 center">
      <a href="<?= base_url() ?>Administration/absence" class="btn btn-app"> 
        <i class="fa fa-calendar"></i> Absence / Retard<br>&nbsp;
        <?php if( $countAbsence > 0 ): ?>
          <span class="notif"><?= $countAbsence ?></span>
        <?php endif; ?>
      </a>
    </div> 
  <?php endif; ?>  


  <!-- <div class="col-sm-3 center">
    <a href="<?= base_url() ?>Administration/bulletins" class="btn btn-app"> 
      <i class="fa fa-file"></i> Envoyer <br>des bulletins
    </a>
  </div>  -->

</div>
