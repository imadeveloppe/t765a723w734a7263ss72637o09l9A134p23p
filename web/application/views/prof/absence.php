<div class="content-header">
  <h2 class="content-header-title">Absence / Retard</h2>
  <ol class="breadcrumb">
    <li><a href="./">Accueil</a></li>  
    <li class="active">Absence - Retard</li>
  </ol>
</div> <!-- /.content-header -->  

<form action="<?= base_url() ?>prof/insertAbsenceFromProf" method="post" id="form">
  <div class="row">
    <div class="col-sm-4">
          <label>Matière</label>
          <select class="form-control" name="matiere">
            <?php foreach ($matieres as $key => $matiere): ?>
                <option value="<?= $matiere->id ?>"><?= $matiere->intitule ?></option>
            <?php endforeach ?>
          </select>
    </div>
    <div class="col-sm-4">
          <label>Classe</label>
          <?php if( $info['niveau'] != 3 ): ?>
            <!-- ////////////////////////////////////////////////////////////////////// --> 
              <select name="classe" class="form-control" id="classes" required> 
                <option value="">Choisir</option> 
                <?php foreach ($intituleClasse as $key => $value): ?>
                  <?php if($value): ?>
                      <option value="<?= $key+1 ?>"><?= $value ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select> 
            <!-- ////////////////////////////////////////////////////////////////////// -->
          <?php else: ?>
            <div class="col-sm-4 form-group">
             <select name="classe" class="form-control" id="classes"  data-state="delete" required>
              <option value="">Choisir</option> 

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
          <select name="groupe" class="form-control" id="groupes" required>
            <option value="">Choisir</option>  
          </select>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      <label><br>Date</label>
       <div id="date" class="input-group date" data-auto-close="true" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
            <input name="date" class="form-control" type="text" value="<?= date('d-m-Y', time()) ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>

    <div class="col-sm-4">
      <label><br>Heure</label>
      <div class="input-group bootstrap-timepicker">
          <input id="time" name ="time" type="text" class="form-control" value="<?= date('H:00', time()) ?>">
          <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
      </div>
    </div>
  </div>

  <div class="row"> 
  <br>
    <div class="col-md-12">
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
          <!-- data eleve Here -->
        </tbody>
      </table>
    </div>
  </div> 

  <div style="text-align: right;">
     <button id="clonesubmitbtn" type="button"  class="btn btn-primary" style="display: none;">Envoyer <i class="fa fa-paper-plane"></i></button> 
     <button id="submitbtn" type="submit"  class="btn btn-primary" style="display: none;"></button> 
  </div>
</form>

<link href="<?= base_url() ?>assets/js/plugins/datepicker/datepicker.css" rel="stylesheet" >
<script src="<?= base_url() ?>assets/js/plugins/timepicker/bootstrap-timepicker.js"></script>
<link href="<?= base_url() ?>assets/js/plugins/timepicker/bootstrap-timepicker.css" rel="stylesheet" >

<style type="text/css">
  .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
      background-color: #fff6a4;
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

  function show_send_btn() {
    if( $("[type=checkbox]:checked").length > 0 ){
      $('#clonesubmitbtn').show();
      return true;
    }
    else{
      // $('#clonesubmitbtn').hide();
      return false;
    }
  }

  $(document).ready(function () {
    $('select#classes').on('change', function(event){ 
       var nbrClassesByNiveau = <?= json_encode($nbrClassesByNiveau) ?>;
       var intituleGroupe = <?= json_encode($intituleGroupe) ?>; 

       var dataState = $(this).attr("data-state");

       var classe = $(this).val();
       $('select#groupes').html('').append('<option value="">Choisir</option>');
       for (var i = 1; i <= nbrClassesByNiveau[classe-1]; i++) {
   
          $('select#groupes').append('<option value="'+i+'"> G'+ intituleGroupe[i-1] +' </option>'); 
       }
       $('table#students tbody').html('')
    });

    $('#date').datepicker({
      startDate: '0d',
      language: 'fr'
    })

    $('#time').timepicker({ 
      showMeridian: false
    }) 

    // $("form").on('change','[type=checkbox]',function () {
    //   show_send_btn();
    // }) 

    
    

    $("[name=groupe]").change(function () {
        
        var data = {
          classe: $("[name=classe]").val(),
          groupe: $(this).val()
        }
        if( $(this).val() ){

          var rowTemplate = '<tr><td>{{lname}}</td><td>{{fname}}</td><td class="absence" style="text-align: center;"><input type="checkbox" name="absence[]" value="{{idClient}}"></td><td  class="retard" style="text-align: center;"><input type="checkbox" name="retard[]" value="{{idClient}}"></td></tr>';  

          $.ajax({
            url: '<?= base_url() ?>prof/getElevesByGroupe',
            method: 'post',
            data: data,
            dataType: 'json'
          }).success(function (data) {
            
             $('table#students tbody').html('')
             $.each(data, function (index, student) { 

                $('table#students tbody').append(rowTemplate.replace(/{{fname}}/g, student.fname).replace(/{{lname}}/g, student.lname).replace(/{{idClient}}/g, student.idClient));

             })
             if(data.length > 0){
                $('#clonesubmitbtn').show()
                apply_iCheck()
             }else{
              $('#clonesubmitbtn').hide()
             }
             

          })

        }
    })

    $("#clonesubmitbtn").click(function () {
        if( show_send_btn() ){
          $("#form").submit()
        }else{
          $('#confirmation').modal('show')
        }
    }) 

    // $('#students').on('change','input',function(){
    //   console.log( "click" )
    // })

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


  })
 

</script> 