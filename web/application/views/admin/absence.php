<div class="content-header">
  <h2 class="content-header-title">Absence / Retard</h2>
  <ol class="breadcrumb">
    <li><a href="./">Accueil</a></li>  
    <li class="active">Absence / Retard</li>
  </ol>
</div> <!-- /.content-header -->  
 

<ul id="myTab1" class="nav nav-tabs"> 
  <li class="<?= (!isset($_POST['classe'])) ? 'active' : '' ?>">
    <a href="#new" data-toggle="tab">Nouveaux</a>
  </li> 
  <li class="<?= (isset($_POST['classe'])) ? 'active' : '' ?>">
    <a href="#old" data-toggle="tab">Historique</a>
  </li>   
</ul>

<div id="myTab1Content" class="tab-content">
  <div class="tab-pane fade in <?= (!isset($_POST['classe'])) ? 'active' : '' ?>" id="new">
    <div class="panel-group accordion" id="accordion">
  
    <?php foreach ($absences as $key => $list): ?>
     <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapse-<?= $key ?>">
          <?= $intituleClasse[$list->classe-1] ?> - G<?= $intituleGroupe[$list->groupe-1] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= date('d-m-Y à H:i', strtotime( $list->date_time )) ?> 
          </a>
        </h4>
      </div>

      <div id="collapse-<?= $key ?>" class="panel-collapse collapse <?= $key == 0 ? 'in' : '' ?>">
        <form class="panel-body" action="/Administration/sendAbsence" method="post">
            <p>
              <strong>Date :</strong> <?= date('d-m-Y <b>à</b> H:i', strtotime( $list->date_time )) ?> 
            </p>
            <p> 
              <strong>Matière :</strong> <?= $list->intitule_matiere ?> 
            </p>
            <p> 
              <strong>Professeur :</strong> <?= $list->prof ?>
            </p>
            <table  class="table table-striped table-bordered table-hover table-highlight" id="students" >  
              <thead>
                <tr > 
                  <th>Nom</th> 
                  <th>Prénom</th> 
                  <th style="text-align: center;">Absence</th> 
                  <th style="text-align: center;">Retard</th>  
                </tr>
              </thead>
              <tbody>
                
                <?php  $students = $list->details;    ?>
                <?php foreach ($students as $key => $student): ?> 
                        <tr>
                          <td><?= $student->lname ?></td>
                          <td><?= $student->fname ?></td>
                          <td style="text-align: center;" class="absence">
                              <input type="checkbox" name="absence[]" value="<?= $student->idClient ?>" <?= $student->absence ? 'checked' : '' ?>>
                          </td>
                          <td style="text-align: center;" class="retard">
                              <input type="checkbox" name="retard[]" value="<?= $student->idClient ?>" <?= $student->retard ? 'checked' : '' ?>>
                          </td>
                        </tr>

                <?php endforeach ?> 
              </tbody>
            </table>

          <div style="text-align: right;">
            <input type="hidden" name="idAbsence" value="<?= $list->id ?>"> 
            <button  type="button"  class="btn btn-secondary printBtn">Imprimer <i class="fa fa-print"></i></button> 
            <button type="submit" type="button"  class="btn btn-primary">Envoyer <i class="fa fa-paper-plane"></i></button>  
          </div>

          <div class="printDiv" style="display: none;">
                    <div style="font-family: arial; padding: 30px 20px">
                      <style type="text/css" media="print">
                          @page 
                          {
                              size: auto;   /* auto is the current printer page size */
                              margin: 0mm;  /* this affects the margin in the printer settings */
                          } 
                          body 
                          {
                                background-color:#FFFFFF; 
                                border: solid 1px black ;
                                margin: 0px;  /* the margin on the content before printing */
                          }
                          h1{
                            color: #16a085
                          }
                          td{
                            padding: 10px;
                            border-bottom: 1px solid #ccc
                          }
                          th{
                            background:-color #ccc;
                            border-bottom: 2px solid #aaa
                          }
                      </style>
                        <center style="text-align: right;">
                          <img style="width:200px" src="<?php echo base_url() ?>assets/img/logo.png" alt="Site Logo">
                        </center>

                        <h2><u>Absence / Retard</u></h2>
                        <p>
                          <strong>Claase/Groupe :</strong> <?= $intituleClasse[$list->classe-1] ?> - G<?= $intituleGroupe[$list->groupe-1] ?> 
                        </p>

                        <p>
                          <strong>Date :</strong> <?= date('d-m-Y <b>à</b> H:i', strtotime( $list->date_time )) ?> 
                        </p>
                        <p> 
                          <strong>Matière :</strong> <?= $list->intitule_matiere ?> 
                        </p>
                        <p> 
                          <strong>Professeur :</strong> <?= $list->prof ?>
                        </p>
                        <table  class="" style="width: 100%" cellpadding="5" cellspacing="0">  
                          <thead>
                            <tr > 
                              <th style="text-align: left;">Nom</th> 
                              <th style="text-align: left;">Prénom</th> 
                              <th style="text-align: center;">Absence</th> 
                              <th style="text-align: center;">Retard</th>  
                            </tr>
                          </thead>
                          <tbody>
                            
                            <?php  $students = $list->details;    ?>
                            <?php foreach ($students as $key => $student): ?> 
                                    <tr>
                                      <td><?= $student->lname ?></td>
                                      <td><?= $student->fname ?></td>
                                      <td style="text-align: center;" class="absence">
                                          <?= $student->absence ? 'X' : '' ?>
                                      </td>
                                      <td style="text-align: center;" class="retard">
                                          <?= $student->retard ? 'X' : '' ?>
                                      </td>
                                    </tr>

                            <?php endforeach ?> 
                          </tbody>
                        </table>
                    </div> 
          </div>  
        </form>
      </div>
    </div> <!-- /.panel-default --> 
  <?php endforeach ?> 
</div> <!-- /.accordion -->
  </div>
  <div class="tab-pane fade in <?= (isset($_POST['classe'])) ? 'active' : '' ?>" id="old">

    <div class="portlet">
      <div class="portlet-header">
        <h3>Rechercher</h3>
      </div>
      <!-- /.portlet-header -->
      
      <div class="portlet-content">
        <form action="" method="post" id="form">
      <div class="row">
    
        <div class="col-sm-4">
          <label>Classe</label>
          <?php if( $info['niveau'] != 3 ): ?>
            <!-- ////////////////////////////////////////////////////////////////////// --> 
              <select name="classe" class="form-control" id="classes" > 
                <option value="">Tous</option> 
                <?php foreach ($intituleClasse as $key => $value): ?>
                  <?php if($value): ?>
                    <option value="<?= $key+1 ?>" <?= (isset($_POST['classe']) && $_POST['classe'] ==  $key+1) ? 'selected' : '' ?>><?= $value ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select> 
            <!-- ////////////////////////////////////////////////////////////////////// -->
          <?php else: ?>
            <div class="col-sm-4 form-group">
             <select name="classe" class="form-control" id="classes"  data-state="delete" >
              <option value="">Tous</option> 

                <optgroup label="Tronc commun">
                  <option value="1">Lettres et sciences humaines</option> 
                  <option value="2">Sciences</option> 
                </optgroup">

                <optgroup label="1ère année">
                  <option value="3">Sciences expérimentales</option> 
                  <option value="4">Sciences mathématiques</option> 
                  <option value="5">Sciences économiques et gestion</option> 
                </optgroup">

                <optgroup label="2ème année"> 
                  <option value="6">Sciences Physiques</option> 
                  <option value="7">SVT</option> 
                  <option value="8">Sciences mathématiques A</option> 
                  <option value="9">Sciences mathématiques B</option> 
                  <option value="10">Sciences économiques</option> 
                  <option value="11">Techniques de gestion et comptabilité</option>  
                </optgroup">
            </select>
          </div>
          <?php endif; ?>
        </div>
        <div class="col-sm-4" id="groupe">
              <label>Groupe</label>
              <select name="groupe" class="form-control" id="groupes">
                <option value="">Tous</option>  
              </select>
        </div>

        <div class="col-sm-4">
              <label>Matière</label>
              <select class="form-control" name="matiere">
                <option value="">Tous</option>
                <?php foreach ($matieres as $key => $matiere): ?>
                    <option value="<?= $matiere->id ?>" <?= (isset($_POST['matiere']) && $_POST['matiere'] ==  $matiere->id) ? 'selected' : '' ?>><?= $matiere->intitule ?></option>
                <?php endforeach ?>
              </select>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-4">
          <label><br>Date</label>
           <div id="date" class="input-group date" data-auto-close="true" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                <input name="date" class="form-control" type="text" value="">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>

        <!-- <div class="col-sm-4">
          <label><br>Heure</label>
          <div class="input-group bootstrap-timepicker">
              <input id="time" name="time" type="text" class="form-control" value="">
              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
          </div>
        </div> -->

      </div> 

      <div style="text-align: right;">
         <button id="clonesubmitbtn" type="submit"  class="btn btn-primary">Rechercher</button>  
      </div>
        </form>
      </div>
    </div>


<?php if( $searchData ): ?>
    <div class="row">  
      <div class="col-md-12 accordion-search">
         <?php foreach ($searchData as $key => $list): ?>
           <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion-search" href="#collapse-search-<?= $key ?>">
                <?= $intituleClasse[$list->classe-1] ?> - G<?= $intituleGroupe[$list->groupe-1] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= date('d-m-Y à H:i', strtotime( $list->date_time )) ?> 
                </a>
              </h4>
            </div>

            <div id="collapse-search-<?= $key ?>" class="panel-collapse collapse <?= $key == 0 ? 'in' : '' ?>">
              <div class="panel-body">
                  <p>
                    <strong>Date :</strong> <?= date('d-m-Y <b>à</b> H:i', strtotime( $list->date_time )) ?> 
                  </p>
                  <p> 
                    <strong>Matière :</strong> <?= $list->intitule_matiere ?> 
                  </p>
                  <p> 
                    <strong>Professeur :</strong> <?= $list->prof ?>
                  </p>
                  <table  class="table table-striped table-bordered table-hover table-highlight" id="students" >  
                    <thead>
                      <tr > 
                        <th>Nom</th> 
                        <th>Prénom</th> 
                        <th style="text-align: center;">Absence</th> 
                        <th style="text-align: center;">Retard</th>  
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php  $students = $list->details;    ?>
                      <?php foreach ($students as $key => $student): ?> 
                              <tr>
                                <td><?= $student->lname ?></td>
                                <td><?= $student->fname ?></td>
                                <td style="text-align: center;" class="absence">
                                    <input type="checkbox" name="absence[]" disabled value="<?= $student->idClient ?>" <?= $student->absence ? 'checked' : '' ?>>
                                </td>
                                <td style="text-align: center;" class="retard">
                                    <input type="checkbox" name="retard[]" disabled value="<?= $student->idClient ?>" <?= $student->retard ? 'checked' : '' ?>>
                                </td>
                              </tr>

                      <?php endforeach ?> 
                    </tbody>
                  </table>


                  <div class="printDiv" style="display: none;">
                    <div style="font-family: arial; padding: 30px 20px">
                      <style type="text/css" media="print">
                          @page 
                          {
                              size: auto;   /* auto is the current printer page size */
                              margin: 0mm;  /* this affects the margin in the printer settings */
                          } 
                          body 
                          {
                                background-color:#FFFFFF; 
                                border: solid 1px black ;
                                margin: 0px;  /* the margin on the content before printing */
                          }
                          h1{
                            color: #16a085
                          }
                          td{
                            padding: 10px;
                            border-bottom: 1px solid #ccc
                          }
                          th{
                            background:-color #ccc;
                            border-bottom: 2px solid #aaa
                          }
                      </style>
                        <center style="text-align: right;">
                          <img style="width:200px" src="<?php echo base_url() ?>assets/img/logo.png" alt="Site Logo">
                        </center>

                        <h2><u>Absence / Retard</u></h2>
                        <p>
                          <strong>Claase/Groupe :</strong> <?= $intituleClasse[$list->classe-1] ?> - G<?= $intituleGroupe[$list->groupe-1] ?> 
                        </p>

                        <p>
                          <strong>Date :</strong> <?= date('d-m-Y <b>à</b> H:i', strtotime( $list->date_time )) ?> 
                        </p>
                        <p> 
                          <strong>Matière :</strong> <?= $list->intitule_matiere ?> 
                        </p>
                        <p> 
                          <strong>Professeur :</strong> <?= $list->prof ?>
                        </p>
                        <table  class="" style="width: 100%" cellpadding="5" cellspacing="0">  
                          <thead>
                            <tr > 
                              <th style="text-align: left;">Nom</th> 
                              <th style="text-align: left;">Prénom</th> 
                              <th style="text-align: center;">Absence</th> 
                              <th style="text-align: center;">Retard</th>  
                            </tr>
                          </thead>
                          <tbody>
                            
                            <?php  $students = $list->details;    ?>
                            <?php foreach ($students as $key => $student): ?> 
                                    <tr>
                                      <td><?= $student->lname ?></td>
                                      <td><?= $student->fname ?></td>
                                      <td style="text-align: center;" class="absence">
                                          <?= $student->absence ? 'X' : '' ?>
                                      </td>
                                      <td style="text-align: center;" class="retard">
                                          <?= $student->retard ? 'X' : '' ?>
                                      </td>
                                    </tr>

                            <?php endforeach ?> 
                          </tbody>
                        </table>
                    </div> 
                  </div>

                  <div style="text-align: right;">
                      <button  type="button"  class="btn btn-secondary printBtn">Imprimer <i class="fa fa-print"></i></button> 
                  </div>
 
              </div>
            </div>
          </div> <!-- /.panel-default --> 
        <?php endforeach ?> 
      </div>
    </div>
  <?php endif ?> 

<link href="<?= base_url() ?>assets/js/plugins/datepicker/datepicker.css" rel="stylesheet" >
<script src="<?= base_url() ?>assets/js/plugins/timepicker/bootstrap-timepicker.js"></script>
<link href="<?= base_url() ?>assets/js/plugins/timepicker/bootstrap-timepicker.css" rel="stylesheet" >

<style type="text/css">
  .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
      background-color: #fff6a4;
  }
</style>


<script type="text/javascript"> 
  $(document).ready(function () {

    function PrintElem(elem) {
            var contents = elem.html();
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open(); 
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }

    $('.printBtn').click(function () {
      var elem = $(this).parents('.collapse').find('.printDiv')
      PrintElem(elem);
    })

    var nbrClassesByNiveau = <?= json_encode($nbrClassesByNiveau) ?>;
    var intituleGroupe = <?= json_encode($intituleGroupe) ?>; 

    $('select#classes').on('change', function(event){ 
       

       var dataState = $(this).attr("data-state");

       var classe = $(this).val();
       $('select#groupes').html('').append('<option value="">Tous</option>');
       for (var i = 1; i <= nbrClassesByNiveau[classe-1]; i++) {
          $('select#groupes').append('<option value="'+i+'"> G'+ intituleGroupe[i-1] +' </option>'); 
       }
       $('table#students tbody').html('')
    });

    <?php if(isset($_POST['classe'])): ?>

      for (var i = 1; i <= nbrClassesByNiveau[<?= $_POST['classe'] ?>-1]; i++) {
        $('select#groupes').append('<option value="'+i+'"> G'+ intituleGroupe[i-1] +' </option>'); 
      }

    <?php endif; ?>

    $('#date').datepicker({
      // startDate: '0d',
      language: 'fr'
    })

    $('#time').timepicker({ 
      showMeridian: false
    }) 

  }) 
</script>
  </div>
</div>



<!-- <pre>
  <?php print_r($absences) ?>
</pre> -->

<script src="<?= base_url() ?>assets/js/plugins/icheck/jquery.icheck.js"></script> 
<link rel="stylesheet" href="<?= base_url() ?>/assets/js/plugins/icheck/skins/minimal/blue.css">
<style type="text/css">
  .icheckbox_minimal-blue { 
      display: inline-block;
  }
  .icheckbox_minimal-blue.checked.disabled {
      background-position: -40px 0 !important;
  }
</style>

<script type="text/javascript"> 

  function apply_iCheck() {
    $('input:checkbox').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue',
      inheritClass: true
    }) 
  }

  apply_iCheck()


  $('#students').on('ifChanged', '.absence input', function (event) { 

      var retard = $(this).parents('tr').find('.retard input')
      if( retard.is(":checked") ){
        retard.prop('checked', false); 
        apply_iCheck()
      }

    });

    $('#students').on('ifChanged', '.retard input', function (event) {

      var absence = $(this).parents('tr').find('.absence input')
      if( absence.is(":checked") ){
        absence.prop('checked', false);
        apply_iCheck()
      }

    });
</script>