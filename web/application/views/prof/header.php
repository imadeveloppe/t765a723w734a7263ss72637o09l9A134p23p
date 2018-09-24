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
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/icheck/skins/minimal/blue.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/fileupload/bootstrap-fileupload.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/target-admin.css">
<!-- App CSS --> 
<script src="<?php echo base_url() ?>assets/js/libs/jquery-1.10.1.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/fav-prof.png" type="image/x-icon">

  <style type="text/css">
    .mainbar {
        background: #1373a7; 
    }
    .content-header-title { 
        color: #1373a7; 
    }
    li.li-messages, li.li-probleme, li.li-gerer { 
        border: 1px solid rgb(14, 98, 144);
    }
    .mainbar .mainbar-nav > .active, .mainbar .mainbar-nav > .active, .mainbar .mainbar-nav > .active { 
        background: #0f6190; 
    }
    .mainbar .mainbar-nav > .active > a::after, .mainbar .mainbar-nav > .active > a:hover::after, .mainbar .mainbar-nav > .active > a:focus::after { 
        border-top-color: #0f6190; 
    }
    .mainbar .mainbar-nav > li > a:hover, .mainbar .mainbar-nav > li > a:focus {
        background: #0f6190;
    } 


    @media (min-width: 768px){
      .mainbar .mainbar-nav > li > a:hover, .mainbar .mainbar-nav > li > a:focus {
        border-color: #0f6190;
        background: #1373a7;
      }
       .mainbar .mainbar-nav > .active > a, .mainbar .mainbar-nav > .active > a:hover, .mainbar .mainbar-nav > .active > a:focus {
          color: #fff;
          background: #0f6190;
          border-color: transparent;
      }
    }
    @media (max-width: 768px){ 
      li.li-messages, li.li-probleme, li.li-gerer{
        border:0;
      }
      .nav>li {
          border-top: 1px solid rgba(14, 98, 144, 0.64); 
          padding: 10px 0px;
      }
      .mainbar-collapse.collapsing {
          margin-left: -15px;
          margin-right: -15px;
          padding: 0 15px;
      } 
    }
    #back-to-top { 
        background-color: #1373a7;
        background-color: rgba(19, 115, 167,0.4); 
    }
    .btn-app > .fa, .btn-app > .glyphicon, .btn-app > .ion {
      color: #1373a7;
    }
    .item-destinataire { 
      background: #1373a7; 
  }

  </style>
</head>

<body class="espace-prof">
<div class="header-continer">

  <div class="navbar">

    <div class="container">

      <div class="navbar-header">

          <button type="button" class="navbar-toggle openMenuListe" data-toggle="collapse" data-target=".mainbar-collapse">
            <i class="fa fa-bars"></i>
          </button>

        <button type="button" class="navbar-toggle openNotifListe">
          <i class="fa fa-bell"></i>
          <?php if( $countMessage > 0 ): ?>
            <span class="badge" style="position: absolute;top: 0;left: 0;"><?= $countMessage ?></span>
          <?php endif; ?> 
        </button>

        <a class="navbar-brand navbar-brand-image" href="./">
          <img src="<?php echo base_url() ?>assets/img/logo.png" alt="Site Logo">
        </a>

      </div> <!-- /.navbar-header -->

      <div class="navbar-collapse collapse"> 

        <ul class="nav navbar-nav navbar-right">    
          <li class="dropdown navbar-profile"> 
            <a class="dropdown-toggle"  style="color: #fff"> 

   
              <?php if(!empty($info['photo']) ): ?>
                  <img src="<?= base_url() ?>assets/upload/<?= $info['photo'] ?>" class="navbar-profile-avatar" style="width: 28px;border-radius: 5px;"> 
              <?php else: ?>
                  <img src="https://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" style="width: 28px;border-radius: 5px;">
              <?php endif; ?>


              <?= $info['nom'] ?> 
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
          <li class="<?= ($page == 'home') ? 'active' : '' ?>">
            <a href="<?= base_url() ?>prof/home">
            <i class="fa fa-envelope"></i> Communiquer
          </a> 
          </li>

          <li class="<?= ($page == 'absence') ? 'active' : '' ?>">
            <a href="<?= base_url() ?>prof/absence">
            <i class="fa fa-calendar"></i> Absence / Retard
          </a> 
          </li>

          <li class="li-messages <?= ($page == 'messages') ? 'active' : '' ?>">
             <a href="<?= base_url() ?>prof/message">
              <i class="fa fa-envelope-o"></i> Messages reçus
              <?php if( $countMessage > 0 ): ?>
                <span class="notif"><?= $countMessage ?></span>
              <?php endif; ?>
            </a> 
          </li>
          <li class="li-messages <?= ($page == 'historique') ? 'active' : '' ?>">
            <a href="<?= base_url() ?>prof/historique">
              <i class="fa fa-clock-o"></i>
              Historique des envois
              <?php if( $HasMarks ): ?>
                <span class="notif" style="background: #f0ad4e"> ! </span>
              <?php endif; ?>
            </a>
          </li> 
           <li class="<?= ($page == 'probleme') ? 'active' : '' ?>">
             <a href="<?= base_url() ?>prof/probleme">
              <i class="fa fa-info"></i>
              Signaler un problème
            </a>
          </li> 

           <li>
            <a href="<?= base_url() ?>prof/profile">
              <i class="fa fa-user"></i> 
              &nbsp;&nbsp;Profil
            </a>
          </li>  
          <li>
            <a href="<?= base_url() ?>prof/logout">
              <i class="fa fa-sign-out"></i> 
              &nbsp;&nbsp;Déconnexion
            </a>
          </li>

        </ul>
      </div>
      <!-- /.navbar-collapse --> 
      
    </div>
    <!-- /.container -->  
  </div>

</div>
<!-- /.mainbar -->

<div class="container">
  <div class="content">
    <div class="content-container">