      
      <div class="content-header">
        <h2 class="content-header-title">Gérer les professeurs</h2>
        <ol class="breadcrumb">
          <li><a href="./">Home</a></li> 
          <li><a href="#">Gérer</a></li>
          <li class="active">Gérer les professeurs</li>
        </ol>
      </div> <!-- /.content-header --> 


       <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Liste des professeurs
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">          
              <div class="table-responsive"> 

              
              <?php if( !hasAccess('gerer_profs_readonly') or !$info['subAdmin'] ): ?> 
                  <div class="block-buttons" style="text-align: right; margin-bottom: -29px;">
                     
                      <a data-toggle="modal" href="#tousSuspendre"  class="btn btn-danger hidden-xs"> 
                        <strong>
                          <i class="fa fa-times-circle" aria-hidden="true" style="font-size: 20px;position: relative;bottom: -2px;"></i> 
                          Tout suspendre 
                        </strong>
                      </a>

                       <a data-toggle="modal" href="#tousValider" class="btn btn-success hidden-xs"> 
                        <strong>
                          <i class="fa fa-check-circle" aria-hidden="true" style="font-size: 20px;position: relative;bottom: -2px;"></i> 
                          Tout valider
                        </strong>
                      </a>

                  </div>
              <?php endif; ?> 


              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                data-provide="datatable" 
                data-display-rows="10"
                data-info="true"
                data-search="false"
                data-length-change="true"
                data-paginate="true"
              >   
               <?php 
                  $validateUsers = 0; 
                  foreach ($profs as $key => $value) {
                    $validateUsers = ($value->state == 1) ? $validateUsers+1 : $validateUsers;
                  }?>
                  <thead>
                    <tr> 
                      <th data-filterable="true" data-sortable="true">Professeurs</th>
                      <th data-filterable="true" data-sortable="true">Téléphone</th>
                      <th >Matière</th>
                      <th data-filterable="false">Classe/Groupe</th>

                      <?php if( !hasAccess('gerer_profs_readonly') or !$info['subAdmin'] ): ?> 
                        <th data-filterable="false" >Valider Compte <span class="badge btn-primary"><?= $validateUsers ?>/<?= count($profs) ?></span></th> 
                        <th data-filterable="false" class="hidden-xs">Mot de passe</th>
                        <th data-filterable="false" class="hidden-xs">Auto Envois</th> 
                        <th data-filterable="false" class="hidden-xs">Supprimer</th>
                      <?php endif; ?> 

                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($profs as $prof ) : ?>
                    <tr 
                      data-id='<?= $prof->idProf ?>'
                      data-classes='<?= $prof->classe ?>'
                      data-matieres='<?= $prof->matieres ?>'
                      data-state='<?= $prof->state ?>'
                      data-appellationClasses='<?= $prof->appellationClasses ?>'
                      data-appellationGroupe='<?= $prof->appellationGroupe ?>'
                      data-nbrClassesByNiveau='<?= $prof->classes ?>'
                      >  
                      <td class="nomProf"><?= $prof->nom ?></td>
                      <td class="nomProf"><?= $prof->email ?></td>
                      <td class="center">
                        <a  data-toggle="modal" href="#view-matiere"  class="btn btn-secondary view-matiere">
                          <i class="fa fa-search"></i>
                        </a> 
                        <?php if( !hasAccess('gerer_profs_readonly') or !$info['subAdmin'] ): ?> 
                         <a  data-toggle="modal" href="#edit-matiere" class="btn btn-warning edit-matiere hidden-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <?php endif; ?> 
                      </td>

                      <td class="center"> 
                       <a  data-toggle="modal" href="#view-group" class="btn btn-secondary view-group">
                          <i class="fa fa-search"></i>
                        </a> 
                        <?php if( !hasAccess('gerer_profs_readonly') or !$info['subAdmin'] ): ?> 
                         <a  data-toggle="modal" href="#edit-group" class="btn btn-warning edit-group hidden-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <?php endif; ?> 
                      </td>  

                      <?php if( !hasAccess('gerer_profs_readonly') or !$info['subAdmin'] ): ?> 
                        <td class="center">
                          <a href="#" class="valid-row <?= ($prof->state == '1') ? 'active' : '' ?>"></a> 
                        </td> 
                        <td  class="center hidden-xs">
                          <a  data-toggle="modal" href="#edit-pwd" class="btn btn-warning edit-pwd">
                            <i class="fa fa-pencil"></i>
                        </td>
                        <td class="center hidden-xs">
                          <a href="#" class="validtoggle prof-fidele <?= ($prof->fidele == '1') ? 'active' : '' ?>"></a> 
                        </td> 
                        <td class="center hidden-xs">
                          <a  data-toggle="modal" href="#confirmation" class="btn btn-danger remove-row">
                            <i class="fa fa-trash-o"></i>
                          </a>
                        </td>
                      <?php endif; ?> 
                    </tr>
                  <?php endforeach; ?>
                      
 


                     
                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->
              

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet --> 
              

        </div> <!-- /.col -->

      </div> <!-- /.row -->

<script type="text/javascript"> 
var editRow;
function updateMatiersProf() { 
    $('#edit-matiere').find('.alert').slideUp()
    $('#edit-matiere .loader').fadeIn(); 
    var formData = { 
            'dataMatieres'   : $('#edit-matiere form').serialize()
        }; 
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/updateMatiersProf/',
        data        : formData ,
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data != "false" ){ 
           $('#edit-matiere').find('.alert').slideDown()
           $('#edit-matiere .loader').fadeOut(); 

           editRow.attr('data-matieres',data);
           editRow.find('.nomProf').text( $('#edit-matiere').find('input[name=nom]').val() );
       }
    }); 
}
function updateClassesProf() { 
    $('#edit-group').find('.alert').slideUp()
    $('#edit-group .loader').fadeIn(); 
    var formData = { 
            'dataClasses'   : $('#edit-group form').serialize()
        }; 
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/updateClassesProf/',
        data        : formData ,
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data != "false" ){ 
           $('#edit-group').find('.alert').slideDown()
           $('#edit-group .loader').fadeOut();
            
           editRow.attr('data-classes',data);
           editRow.find('.nomProf').text( $('#edit-group').find('input[name=nom]').val() );
       }
    }); 
}
function updatePwdProf() { 
    $('#edit-pwd').find('.alert').slideUp()
    $('#edit-pwd .loader').fadeIn(); 
    var formData = { 
            'dataPwd'   : $('#edit-pwd form').serialize()
        }; 
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/updatePwdProf/',
        data        : formData ,
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data != "false" ){ 
           $('#edit-pwd').find('.alert').slideDown()
           $('#edit-pwd .loader').fadeOut();
           $('#edit-pwd #pwd').val(''); 
             
       }
    }); 
}
$(document).ready(function() { 

  $('.valid-row').click(function() {
    var self = $(this);
    self.toggleClass('active');
    var idProf = self.parents('tr').attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/editStateProf/'+idProf,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          if( !self.hasClass('active') ){
            self.addClass('active')
          }

          //////////////////////////////////////////////////////
          if( self.parents('tr').attr('data-nomParent') != '' ){
            var tab = $('th .badge').text().split('/'); 
            $('th .badge').text( parseInt(tab[0]) + 1 +"/"+ tab[1] )
 
          }
          //////////////////////////////////////////////////////


          checkNotif = false;
          notification();
       }else{
          if( self.hasClass('active') ){
            self.removeClass('active')
          }

          //////////////////////////////////////////////////////
          if( self.parents('tr').attr('data-nomParent') != '' ){
            var tab = $('th .badge').text().split('/'); 
            $('th .badge').text( parseInt(tab[0]) - 1 +"/"+ tab[1] )
          }
          //////////////////////////////////////////////////////
          
          checkNotif = false;
          notification(); 

       }
    }); 
    return false;
  })
  $('.prof-fidele').click(function() {
    var self = $(this);
    self.toggleClass('active');
    var idProf = self.parents('tr').attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/editFideliteProf/'+idProf,  
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          if( !self.hasClass('active') ){
            self.addClass('active')
          }
       }else{
          if( self.hasClass('active') ){
            self.removeClass('active')
          }
       }
    }); 
    return false;
  })
  var removeRow;
  $('body').on('click','.remove-row',function() { 
    removeRow = $(this).parent().parent();
  })
  $('body').on('click','.remove-row-popup',function() { 
    removeRow = $(this).parent().parent();
  })
  $('#confirmation-popup .confirm-popup').click(function() {
      removeRow.fadeOut('slow'); 
        setTimeout(function() {
        removeRow.remove();
      },1000) 
  })
  $('#confirmation .confirm').click(function() { 

    var idProf = removeRow.attr('data-id');
    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : '<?= base_url() ?>Administration/deleteProf/'+idProf, // the url where we want to POST 
        dataType    : 'text' // what type of data do we expect back from the server 
    }).done(function(data) { 
       if( data == "true" ){
          removeRow.fadeOut('slow'); 
          setTimeout(function() {
            removeRow.remove();
          },1000) 
       }
    }); 
    
  })


  ///////////View matiers
  $('body').on('click','.view-matiere',function () {
    idProf = $(this).parents('tr').attr('data-id');
    $('#view-matiere .row').html('');
    $('#view-matiere .loader').fadeIn('fast');
    $('#view-matiere .alert').fadeOut();

    $.ajax('<?= base_url() ?>Administration/jSonMatieresProf/'+idProf)
    .done(function(data) {
      if( data != '' ){
        $.each($.parseJSON(data), function (i, item) { 
          $('#view-matiere .loader').fadeOut('fast');
          col = '<div class="col-sm-6"><label class="form-group">'+item.intitule+'</label></div>'
          $('#view-matiere .row').append(col);
        });
      }else{
        $('#view-matiere .alert').fadeIn();
        $('#view-matiere .loader').fadeOut('fast');
      }
    });
    
  })
 
  ///////////Edit matiers
  $('body').on('click','.edit-matiere',function () {
      editRow = $(this).parents('tr');
      $('#edit-matiere').find('input[name=nom]').val(editRow.find('.nomProf').text());
      $('#edit-matiere').find('input[type=checkbox]').prop( "checked", false )
      $('#edit-matiere').find('label > div').removeClass('checked');

      var matieresProf = editRow.attr('data-matieres'); 
      var tabMatieres = matieresProf.split(',');
      $.each(tabMatieres,function(i, item) {
        $('#edit-matiere').find('input#check-'+item).prop( "checked", true ).parent().addClass('checked'); 
      })
      $('#edit-matiere').find('input[name=idProf]').val(editRow.attr('data-id'));
  })  
  ///////////Save matiers
  $('#edit-matiere .sumbit-form').click(function() {
    updateMatiersProf();
  })


///////////View Classes
  $('body').on('click','.view-group',function () { 
    $('#view-group .row').html(''); 
    $('#view-group .alert').fadeOut();

    var classes = $(this).parents('tr').attr('data-classes');
    var intituleClasse = $('#view-group .modal-body').attr('data-intituleClasse').split(',');
    var intituleGroupe = $('#view-group .modal-body').attr('data-intituleGroupe').split(',');
    var tabClasses;
     if(classes != ''){  
        classes = classes.split(',');
        $.each(classes,function (i,item) {
          tabClasses = item.split(':'); 
          col = '<div class="col-xs-6 col-sm-3"><label class="form-group">'+intituleClasse[parseInt(tabClasses[0]) - 1]+' - G'+intituleGroupe[parseInt(tabClasses[1]) - 1]+'</label></div>'
          $('#view-group .row').append(col); 

        }) 
    }else{
        $('#view-group .alert').fadeIn();
    }
    
  })


  ///////////Edit Classes
  $('body').on('click','.edit-group',function () { 
    editRow = $(this).parents('tr');
    $('#edit-group').find('input[name=nom]').val(editRow.find('.nomProf').text());
    $('#edit-group .content-classes').html('');  

    var classes = $(this).parents('tr').attr('data-classes');
    var intituleClasse = $('#edit-group .modal-body').attr('data-intituleClasse').split(',');
    var intituleGroupe = $('#edit-group .modal-body').attr('data-intituleGroupe').split(',');
    var nbrClassesByNiveau = $('#edit-group .modal-body').attr('data-nbrClassesByNiveau').split(',');
    var tabClasses;
     if(classes != ''){  
        classes = classes.split(',');
        $.each(classes,function (i,item) { 
          tabClasses = item.split(':');
          var contentClasses = $('.base-classes').html();  
          $('#edit-group .content-classes').append(contentClasses); 

          $('#edit-group .content-classes .row:last-child').find('select.selectGroupe').html('')
          $('#edit-group .content-classes .row:last-child').find('select.selectGroupe').append('<option value=""></option>').val(tabClasses[1]);
          for (var i = 1; i <= nbrClassesByNiveau[tabClasses[0] - 1]; i++) {
            $('#edit-group .content-classes .row:last-child').find('select.selectGroupe').append('<option value="'+i+'">'+intituleGroupe[i-1]+'</option>').val(tabClasses[1]);
            $('#edit-group .content-classes .row:last-child').find('select.selectClasses').val(tabClasses[0]);
          }
        }) 

      $('#edit-group').find('input[name=idProf]').val(editRow.attr('data-id'));
    } 
    
  })

//////edit pwd
 $('body').on('click','.edit-pwd',function () {
      editRow = $(this).parents('tr');
      $('#edit-pwd').find('input[name=idProf]').val(editRow.attr('data-id'));
})

  // Change Classes
  $('#edit-group form').on('change','select.selectClasses',function() {

    var intituleGroupe = $('#edit-group .modal-body').attr('data-intituleGroupe').split(',');
    var nbrClassesByNiveau = $('#edit-group .modal-body').attr('data-nbrClassesByNiveau').split(',');

      classe = $(this).val();
      $(this).parents('.row').find('select.selectGroupe').html('');
      $(this).parents('.row').find('select.selectGroupe').append('<option value=""></option>')
      for (var i = 1; i <= nbrClassesByNiveau[classe-1] ; i++) {
        $(this).parents('.row').find('select.selectGroupe').append('<option value="'+i+'">'+intituleGroupe[i-1]+'</option>')
      } 
  })

  //Add classe/groupe 
  $('#edit-group button.add-row').click(function () {
      var contentClasses = $('.base-classes').html(); 
      var validateSelect = 0;
      $('.content-classes .row').each(function (item) {
        if( $(this).find('.selectClasses').val()=='' ){
          $(this).find('.selectClasses').focus();
          validateSelect++;
        }else if( $(this).find('.selectGroupe').val()=='' ){
          $(this).find('.selectGroupe').focus();
          validateSelect++;
        }
      }) 
      if(validateSelect == 0){
        $('#edit-group .content-classes').append(contentClasses);
      }
  });
   
  ///////////Save Classes
  $('#edit-group .sumbit-form').click(function() {
    var validateSelect = 0;
    $('.content-classes .row').each(function (item) {
      if( $(this).find('.selectClasses').val()=='' ){
        $(this).find('.selectClasses').focus();
        validateSelect++;
      }else if( $(this).find('.selectGroupe').val()=='' ){
        $(this).find('.selectGroupe').focus();
        validateSelect++;
      }
    }) 
    if(validateSelect == 0){
      updateClassesProf();
    }
  })
  $('#edit-pwd form').submit(function(e) {
    e.preventDefault()
    updatePwdProf(); 
  })

  $(document).ready(function () {
    $('table tr[cls=dataTable-filter-row] th').each(function () {
        $(this).find('input').attr('placeholder','Recherche par '+$(this).find('input').attr('placeholder') )
    })
  })

})
</script>