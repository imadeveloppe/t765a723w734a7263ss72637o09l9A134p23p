<?php  
  function getNiveauByIndex($index){
    return array('prescolaire','primaire','college','lycee')[$index];
  } 
 

function hasAccess($access){
    $info = $GLOBALS['info'];

    if( !$info['subAdmin'] ){  
      return true;
    } 
    $currentNiveauName = getNiveauByIndex( $info['niveau'] );
    if( isset($info['access'][$currentNiveauName]) && in_array($access, $info['access'][$currentNiveauName]) ){  
      return true;
    } 
    return false;
  } 
 
  $GLOBALS['info'] = $info;
 
?>  

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
<title><?= $title ?></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
<!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">  -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/awesome/css/font-awesome.min.css"> 

<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/icheck/skins/minimal/blue.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/fileupload/bootstrap-fileupload.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/target-admin.css">
<!-- App CSS --> 
<script src="<?php echo base_url() ?>assets/js/libs/jquery-1.10.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/sweet-alert/sweetalert.css">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
<script type="text/javascript">
  $(document).ready(function () {
    $('.header-continer').on('click','.openMenuListe',function () {
      $('.navbar-header .navbar-collapse').removeClass('in')
    })
    $('.header-continer').on('click','.openNotifListe',function () {
      $('.mainbar .mainbar-collapse').removeClass('in')
    })
  })
</script>
</head>

<body>
  <div class="header-continer">
    <div class="navbar" style="z-index: 9;"> 
      <div class="container">

        <div class="navbar-header">
      

          <button type="button" class="navbar-toggle openMenuListe" data-toggle="collapse" data-target=".mainbar-collapse">
            <i class="fa fa-bars"></i>
          </button>

          <button type="button" class="navbar-toggle openNotifListe" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bell"></i>
            <span id="globalgadge" class="badge" style="position: absolute;top: 0;left: 0;"></span>
          </button>



          <a class="navbar-brand navbar-brand-image" href="./">
            <img src="<?php echo base_url() ?>assets/img/logo.png" alt="Site Logo">
          </a>

        </div> <!-- /.navbar-header --> 
        <div class="navbar-collapse collapse"> 


         <ul class="nav navbar-nav noticebar navbar-left">

            <li class="dropdown">
              <a href="#"  data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="navbar-visible-collapsed">&nbsp;Notifications&nbsp;</span>
                <span  class="badge" style="background: #e74c3c;"></span>
              </a> 
              <ul class="dropdown-menu noticebar-menu" role="menu" style="padding: 0;"> 
                  <!-- /// New Messages From Prof //  -->
                <li class="newMsg notif0"> 
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/0'" class="dropdown-toggle " class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-envelope text-success"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Préscolaire</strong>
                      <span class="noticebar-item-text">Message(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newMsg notif1">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/1'" class="dropdown-toggle " class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-envelope text-success"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Primaire</strong>
                      <span class="noticebar-item-text">Message(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newMsg notif2">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/2'" class="dropdown-toggle " class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-envelope text-success"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Collège</strong>
                      <span class="noticebar-item-text">Message(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newMsg notif3">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/3'" class="dropdown-toggle " class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-envelope text-success"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Lycée</strong>
                      <span class="noticebar-item-text">Message(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <!-- /// ////////////////// //  -->


                <!-- /// New inscription Parent //  -->
                 <li class="newParent notif0">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/0'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-users text-info"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Préscolaire</strong>
                      <span class="noticebar-item-text">Parent(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newParent notif1">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/1'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-users text-info"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Primaire</strong>
                      <span class="noticebar-item-text">Parent(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newParent notif2">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/2'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-users text-info"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Collège</strong>
                      <span class="noticebar-item-text">Parent(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newParent notif3">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/3'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-users text-info"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Lycée</strong>
                      <span class="noticebar-item-text">Parent(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
     
                <!-- /// ////////////////// //  -->

                <!-- /// New inscription Prof //  -->
                 <li class="newProf notif0">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/0'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-user text-warning"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Préscolaire</strong>
                      <span class="noticebar-item-text">Professeur(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newProf notif1">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/1'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-user text-warning"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Primaire</strong>
                      <span class="noticebar-item-text">Professeur(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
                <li class="newProf notif2">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/2'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-user text-warning"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Collège</strong>
                      <span class="noticebar-item-text">Professeur(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>


                <li class="newProf notif3">
                  <a href="#" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/3'" class="dropdown-toggle" class="noticebar-item">
                    <span class="noticebar-item-image">
                      <i class="fa fa-user text-warning"></i>
                    </span>
                    <span class="noticebar-item-body">
                      <strong class="noticebar-item-title">Lycée</strong>
                      <span class="noticebar-item-text">Professeur(s) en attente de validation.</span>
                      <span class="badge">7</span>
                    </span>
                  </a>
                </li>
     
                <!-- /// ////////////////// //  -->

                <p class="noticebar-empty-text noNotif" style="text-align: center;text-align: center;margin-top: 20px;">Pas de notification pour le moment</p>  

                 
              </ul>
            </li> 

          </ul>

          <?php  
            $idCentre = $this->session->id;
            $arrayNiveau = json_decode(file_get_contents(base_url().'Administration/GetNiveauCentre/'.$idCentre));  
          ?>
          <ul class="nav navbar-nav navbar-right hidden-xs hidden-sm ">    
            <li style="padding:14px 0 0"> 
                <div class="form-group" style="margin:0">   
                <form action="" method="post" id="changeNiveau"> 
                  <select name="niveau" class="form-control" onchange="this.form.submit()">
                    
                    <?php if( $info['subAdmin'] ): ?>
                      <!-- ////////////////////////////////////////////////////////////////// -->
                        <?php  if(in_array('0', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(0)])  ): ?>
                          <option value="0">Préscolaire</option>
                        <?php  endif; ?>

                        <?php  if(in_array('1', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(1)]) ): ?>
                          <option value="1">Primaire</option>
                        <?php  endif; ?>

                        <?php  if(in_array('2', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(2)]) ): ?>
                          <option value="2">Collège</option>
                        <?php  endif; ?>

                        <?php  if(in_array('3', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(3)]) ): ?>
                          <option value="3">Lycée</option> 
                        <?php  endif; ?>

                    <?php else: ?>

                        <!-- ////////////////////////////////////////////////////////////////// -->
                        <?php  if(in_array('0', $arrayNiveau)): ?>
                          <option value="0">Préscolaire</option>
                        <?php  endif; ?>

                        <?php  if(in_array('1', $arrayNiveau)): ?>
                          <option value="1">Primaire</option>
                        <?php  endif; ?>

                        <?php  if(in_array('2', $arrayNiveau)): ?>
                          <option value="2">Collège</option>
                        <?php  endif; ?>

                        <?php  if(in_array('3', $arrayNiveau)): ?>
                          <option value="3">Lycée</option> 
                        <?php  endif; ?>
                        <!-- ////////////////////////////////////////////////////////////////// -->
                    <?php endif; ?>

                  </select>
                </form>
              </div>
            </li>
            
            <li class="dropdown navbar-profile"> 
              <a class="dropdown-toggle" style="color: #fff;"> 

                  <?php if(!empty($info['photo']) ): ?>
                        <img src="<?= base_url() ?>assets/upload/<?= $info['photo'] ?>" class="navbar-profile-avatar" style="width: 28px;border-radius: 5px;"> 
                    <?php else: ?>
                        <img src="https://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" style="width: 28px;border-radius: 5px;">
                    <?php endif; ?> 

                <?= $info['nom'] ?> ( <span class="hidden-xs hidden-sm">Code d'établissement :</span> <span style="text-transform: uppercase;"><?= $info['code'] ?></span> )  
              </a>  
            </li>

          </ul>

        </div> <!--/.navbar-collapse --> 
      </div> <!-- /.container --> 
    </div> <!-- /.navbar --> 
      <?php if(isset($message)): ?>
        <?php foreach ($message as $msg): ?>
          <div class="alert alert-<?= $msg['type'] ?> compte-pas-valider">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            <strong><?= $msg['title'] ?> :</strong> <?= $msg['content'] ?>
          </div> <!-- /.alert -->
        <?php endforeach; ?>
      <?php endif; ?>
    <div class="mainbar">

      <div class="container"> 

      <div class="mainbar-collapse collapse">

        <ul class="nav navbar-nav mainbar-nav">

          <li class="hidden-lg hidden-md hidden-sm">
            <form action="" method="post" id="changeNiveau">
              <select name="niveau" class="form-control" onchange="this.form.submit()" style="margin: 0 2%;width: 96%;">
                      
                <?php if( $info['subAdmin'] ): ?>
                  <!-- ////////////////////////////////////////////////////////////////// -->
                    <?php  if(in_array('0', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(0)])  ): ?>
                      <option value="0">Préscolaire</option>
                    <?php  endif; ?>

                    <?php  if(in_array('1', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(1)]) ): ?>
                      <option value="1">Primaire</option>
                    <?php  endif; ?>

                    <?php  if(in_array('2', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(2)]) ): ?>
                      <option value="2">Collège</option>
                    <?php  endif; ?>

                    <?php  if(in_array('3', $arrayNiveau) &&  isset($info['access'][getNiveauByIndex(3)]) ): ?>
                      <option value="3">Lycée</option> 
                    <?php  endif; ?>

                <?php else: ?>

                    <!-- ////////////////////////////////////////////////////////////////// -->
                    <?php  if(in_array('0', $arrayNiveau)): ?>
                      <option value="0">Préscolaire</option>
                    <?php  endif; ?>

                    <?php  if(in_array('1', $arrayNiveau)): ?>
                      <option value="1">Primaire</option>
                    <?php  endif; ?>

                    <?php  if(in_array('2', $arrayNiveau)): ?>
                      <option value="2">Collège</option>
                    <?php  endif; ?>

                    <?php  if(in_array('3', $arrayNiveau)): ?>
                      <option value="3">Lycée</option> 
                    <?php  endif; ?>
                    <!-- ////////////////////////////////////////////////////////////////// -->
                <?php endif; ?>

              </select>
            </form>
          </li>


          <script type="text/javascript">  
            $('select[name=niveau]').val( <?= $info['niveau'] ?> )
          </script>

        <?php 
          $niveau = $info['niveau'];
          $notifHome = file_get_contents(base_url().'Administration/nbrMessageNotSend/'.$idCentre.'/'.$niveau);
         ?>
         <script type="text/javascript">var nbrMessageNotSent = <?= $notifHome ?></script>

         <?php if(hasAccess('sendtoparent') or hasAccess('sendtoprof') or hasAccess('validsent')): ?>

          <li class="<?= ($page == 'home') ? 'active' : '' ?>">
            <a href="<?= base_url() ?>Administration/home">
              <i class="fa fa-envelope"></i>
              Communiquer
              <?php if( $notifHome > 0 && $page != 'home' ): ?>
                <span class="notif" style="top: 3px;right: 64px;">
                <?= $notifHome  ?>
                </span>
              <?php endif; ?>
            </a>
          </li> 

        <?php endif ?>


          <?php   
             $nbrEleveNotVerified = file_get_contents(base_url().'Administration/nbrEleveNotVerified/'.$idCentre.'/'.$niveau); 
             $nbrProfNotVerified = file_get_contents(base_url().'Administration/nbrProfNotVerified/'.$idCentre.'/'.$niveau); 
             $sommeNotVerified = $nbrEleveNotVerified + $nbrProfNotVerified; 
          ?> 
          
          <?php if( hasAccess('reception_prof') or hasAccess('reception_parent') ): ?>
              <li class="li-gerer <?= ($page == 'reception') ? 'active' : '' ?>">
                <a href="<?= base_url() ?>Administration/reception">
                  <i class="fa fa-envelope-o"></i>
                  Messages reçus
                  <?php if( $countReceivedMessageNotVu > 0 && $page != 'reception' ): ?> 
                    <span class="notif">
                      <?= $countReceivedMessageNotVu ?>
                    </span>
                  <?php endif; ?>
                </a>
              </li> 
          <?php endif; ?>   
          

          <?php if( hasAccess('emplois_prof') or hasAccess('emplois_classe') ): ?>

            <li class="dropdown <?= ($page == 'emploi_de_temps') ? 'active' : '' ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                <i class="fa fa-table"></i>
                Emplois du temps
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu"> 

                  <?php if( hasAccess('emplois_classe') ): ?> 

                      <li>
                        <a href="<?= base_url() ?>Administration/emploi_de_temps_classe">
                        <i class="fa fa-angle-right nav-icon"></i> 
                          Classes
                        </a>
                      </li>

                  <?php endif; ?> 

                  <?php if( hasAccess('emplois_prof') ): ?> 

                      <li>
                        <a href="<?= base_url() ?>Administration/emploi_de_temps_prof">
                        <i class="fa fa-angle-right nav-icon"></i> 
                          Professeurs
                        </a>
                      </li> 

                   <?php endif; ?> 
                </ul>
            </li>  

          <?php endif; ?>   
          


          <?php if( hasAccess('gerer_classes') or hasAccess('gerer_matieres') or hasAccess('gerer_eleves') or hasAccess('gerer_profs') ): ?>

              <li class="li-gerer dropdown <?= ($page == 'gestion') ? 'active' : '' ?>">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                <i class="fa fa fa-cogs"></i> 
                Gérer
                  <span class="caret"></span>
                  <?php if($sommeNotVerified > 0): ?>
                    <span class="notif" id="sommeNotVerified" style="display: none;">
                      <?= $sommeNotVerified ?>
                    </span>
                  <?php endif; ?>
                </a>

                <ul class="dropdown-menu">  

                  <?php if( hasAccess('gerer_classes') ): ?>

                    <li>
                      <a href="<?= base_url() ?>Administration/classes">
                      <i class="fa fa-angle-right nav-icon"></i> 
                      Gérer les classes
                      </a>
                    </li>  

                  <?php endif; ?>  

                  <?php if( hasAccess('gerer_matieres') ): ?>

                    <li>
                      <a href="<?= base_url() ?>Administration/matieres">
                      <i class="fa fa-angle-right nav-icon"></i> 
                      Gérer les matières
                      </a>
                    </li> 

                  <?php endif; ?>  

                  <?php if( hasAccess('gerer_eleves') ): ?>

                    <li>
                        <a href="<?= base_url() ?>Administration/eleves">
                        <i class="fa fa-angle-right nav-icon"></i> 
                        Gérer les élèves
                        <?php if($nbrEleveNotVerified > 0): ?>
                          <span class="notif sub-notif" id="nbrEleveNotVerified" style="display: none;">
                            <?= $nbrEleveNotVerified ?>
                          </span>
                        <?php endif; ?>
                        </a>
                      </li>

                  <?php endif; ?>  
                      

                  
                  <?php if( hasAccess('gerer_profs') ): ?>

                    <li>
                      <a href="<?= base_url() ?>Administration/prof">
                      <i class="fa fa-angle-right nav-icon"></i> 
                      Gérer les professeurs
                      <?php if($nbrProfNotVerified > 0): ?>
                        <span class="notif sub-notif" id="nbrProfNotVerified" style="display: none;">
                          <?= $nbrProfNotVerified ?>
                        </span>
                      <?php endif; ?>
                      </a>
                    </li>

                  <?php endif; ?>  

                </ul>
              </li>

          <?php endif; ?>




          <?php if( hasAccess('historique_prof_parents') or  hasAccess('historique_admin_parents') or  hasAccess('historique_admin_prof')  ): ?>  

              <li class="<?= ($page == 'historique') ? 'active' : '' ?>">
                <a href="<?= base_url() ?>Administration/historique">
                  <i class="fa fa-clock-o"></i>
                  Historique
                </a>
              </li> 

          <?php endif; ?>

           <li class="<?= ($page == 'probleme') ? 'active' : '' ?>">
             <a href="<?= base_url() ?>Administration/probleme">
              <i class="fa fa-info"></i>
              Signaler un problème
            </a>
          </li> 

          <?php if(!$info['subAdmin']): ?>
          <li class="<?= ($page == 'profile') ? 'active' : '' ?>">
            <a href="<?= base_url() ?>Administration/profil">
              <i class="fa fa-user"></i> 
              &nbsp;&nbsp;Profil
            </a>
          </li>  
          <?php endif ?>
          

          <li class="hidden-md">
            <a href="<?= base_url() ?>Administration/logout">
              <i class="fa fa-sign-out"></i> 
              &nbsp;&nbsp;Déconnexion
            </a>
          </li>

        </ul>

      </div> <!-- /.navbar-collapse -->   

      </div> <!-- /.container -->  
    </div> <!-- /.mainbar -->
  </div>

<div class="container">

  <div class="content" style="z-index: 1;">

    <div class="content-container">