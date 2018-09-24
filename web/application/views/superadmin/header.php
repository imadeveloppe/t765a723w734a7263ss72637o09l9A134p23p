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
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css"> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/magnific/magnific-popup.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css"> 
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/target-admin.css">
<!-- App CSS --> 
<script src="<?php echo base_url() ?>assets/js/libs/jquery-1.10.1.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <div class="navbar">

  <div class="container">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <i class="fa fa-cogs"></i>
      </button>

      <a class="navbar-brand navbar-brand-image" href="./">
        <img src="<?php echo base_url() ?>assets/img/logo.png" alt="Site Logo">
      </a>

    </div> <!-- /.navbar-header -->

    <div class="navbar-collapse collapse"> 

      <ul class="nav navbar-nav navbar-right">    
        <li class="dropdown navbar-profile"> 
          <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;"> 
            <?= $info['nom'] ?>
            <i class="fa fa-caret-down"></i>
          </a> 
          <ul class="dropdown-menu" role="menu">

            <li>
              <a href="<?= base_url() ?>Superadmin/profile">
                <i class="fa fa-user"></i> 
                &nbsp;&nbsp;Profil
              </a>
            </li> 
            <li class="divider"></li>

            <li>
              <a href="<?= base_url() ?>Superadmin/logout">
                <i class="fa fa-sign-out"></i> 
                &nbsp;&nbsp;Déconnexion
              </a>
            </li>

          </ul>

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
    <button type="button" class="btn mainbar-toggle collapsed" data-toggle="collapse" data-target=".mainbar-collapse"> <i class="fa fa-bars"></i> 
    </button>
    <div class="mainbar-collapse collapse">
      <ul class="nav navbar-nav mainbar-nav">
        <li class="<?= ($page == 'home') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>Superadmin/home">
          <i class="fa fa-dashboard"></i> Accueil 
        </a> 
        </li>
        <li class="<?= ($page == 'rep') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>Superadmin/representants">
            <i class="fa fa-users"></i>
            Représentants
          </a>
          
        </li>
        <li class="<?= ($page == 'ecole') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>Superadmin/Etablissements">
            <i class="fa fa-sitemap"></i>
            Etablissements
          </a>
          
        </li>
        <li class="dropdown <?= ($page == 'matieres') ? 'active' : '' ?>" >
          <a  href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-book"></i>
            Matières enseignées
          </a>
          <ul class="dropdown-menu">
              <li>
                <a href="<?= base_url() ?>Superadmin/matieres/0"><i class="fa fa-book nav-icon"></i> Préscolaire</a>
              </li>
              <li>
                <a href="<?= base_url() ?>Superadmin/matieres/1"><i class="fa fa-book nav-icon"></i> Primaire</a>
              </li>
              <li>
                <a href="<?= base_url() ?>Superadmin/matieres/2"><i class="fa fa-user nav-icon"></i> Collège</a>
              </li>
              <li>
                <a href="<?= base_url() ?>Superadmin/matieres/3"><i class="fa fa-user nav-icon"></i> Lycée</a>
              </li>
          </ul>
        </li>  
        <li class="<?= ($page == 'villes') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>Superadmin/villes">
            <i class="fa fa-building-o"></i>
            Villes
          </a>
        </li> 
        <li class="<?= ($page == 'modeles') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>Superadmin/modeles">
            <i class="fa fa-envelope-o"></i>
            Modèles de messages
          </a>
        </li> 
         <li class="li-probleme <?= ($page == 'probleme') ? 'active' : '' ?>">
          <a href="<?= base_url() ?>Superadmin/problemes">
            <i class="fa fa-info"></i>
            Problèmes signalés
            <?php $nbrProblemes = file_get_contents(base_url().'Superadmin/nbrProblemes') ?>
            <?php if($nbrProblemes > 0): ?>
              <span class="notif-probleme  notif"><?= file_get_contents(base_url().'Superadmin/nbrProblemes') ?></span>
            <?php endif; ?>
          </a>
        </li> 
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
    
  </div>
  <!-- /.container --> 
  
</div>
<!-- /.mainbar -->

<div class="container">
  <div class="content">
    <div class="content-container">