    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container --> 
<audio id="notif" style="display: none;">
	<source src="<?= base_url() ?>assets/sound/bip.wav" type="audio/wav">
</audio>

<style type="text/css">
	.toasts {
	    margin-left: 0;
	    position: fixed;
	    z-index: 9999999999;
	    left: 30px;
	    bottom: 30px;
	    max-height: 413px;
	    overflow: auto;
	    width: 308px;
	}
	.snackbar {
	    visibility: hidden;
	    background-color: rgb(255, 255, 255);
	    color: rgb(0, 0, 0);
	    text-align: left;
	    border-radius: 2px;
	    padding: 16px 30px;
	    padding-left: 26px;
	    border-left: 70px solid rgb(255, 162, 0);
	    box-shadow: 0 0 15px #aaa;
	    width: 290px;
	    cursor: pointer;
	    position: relative;
	    margin-top: 16px;
	    -webkit-animation: fadeout 0.5s 2.5s;
	    animation: fadeout 0.5s 2.5s;
	    display: none;
	}
	.snackbar:hover { 
	    border-left: 70px solid rgb(22, 160, 133);
	    box-shadow: 0 0 15px rgb(84, 78, 78); 
	}
	.snackbar i {
	    font-size: 30px;
	    position: absolute;
	    left: -47px;
	    top: 35px;
	    color: rgb(255, 255, 255);
	}

	.snackbar .badge{
		position: absolute;
		top: 8px;
		right: 8px;
		background: rgb(222, 14, 14);
		height: 20px;
		line-height: 15px;
	}
	.noticebar-menu > li,
	p.noNotif {
	    display: none;
	}
	.noticebar-menu > li.show {
	    display: block;
	    position: relative;
	}
	.noticebar-item-body span.badge {
	    position: absolute;
	    top: 2px;
	    right: 4px;
	}
	.navbar .noticebar > li > a:hover {
	    color: #fff;
	}
	.navbar .noticebar > li > a { 
	    color: #dfdfdf; 
	}
	/* Show the snackbar when clicking on a button (class added with JavaScript) */
	.snackbar.show {
	    visibility: visible; /* Show the snackbar */

	/* Add animation: Take 0.5 seconds to fade in and out the snackbar.
	However, delay the fade out process for 2.5 seconds */
	    -webkit-animation: fadein 0.5s;
	    animation: fadein 0.5s;
	}

	/* Animations to fade the snackbar in and out */
	@-webkit-keyframes fadein {
	    from {bottom: -30px; opacity: 0;}
	    to {bottom: 0px; opacity: 1;}
	}

	@keyframes fadein {
	    from {bottom: -30px; opacity: 0;}
	    to {bottom: 0px; opacity: 1;}
	}

	@-webkit-keyframes fadeout {
	    from {bottom: 30px; opacity: 1;}
	    to {bottom: 0; opacity: 0;}
	}

	@keyframes fadeout {
	    from {bottom: 30px; opacity: 1;}
	    to {bottom: 0; opacity: 0;}
	}
</style>

<div class="toasts"> 
		<!-- /// New Messages From Prof //  -->
			<div class="snackbar newMsg notif0" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/0'" >
				   
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Préscolaire</strong><br>
				  Message(s) en attente<br>de validation.
			</div>
			<div class="snackbar newMsg notif1" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/1'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Primaire</strong><br>
				  Message(s) en attente<br>de validation.
			</div> 
			<div class="snackbar newMsg notif2" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/2'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Collège</strong><br>
				  Message(s) en attente<br>de validation.
			</div> 
			<div class="snackbar newMsg notif3" onclick="javascript:window.location.href='<?= base_url() ?>Administration/valideSent/3'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Lycée</strong><br>
				  Message(s) en attente<br>de validation.
			</div>  
		<!-- /// ////////////////// //  -->

		<!-- /// New inscription Parent //  -->
			<div class="snackbar newParent notif0" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/0'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Préscolaire</strong><br>
				  Parent(s) en attente<br>de validation.
			</div>
			<div class="snackbar newParent notif1" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/1'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Primaire</strong><br>
				  Parent(s) en attente<br>de validation.
			</div> 
			<div class="snackbar newParent notif2" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/2'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Collège</strong><br>
				  Parent(s) en attente<br>de validation.
			</div> 
			<div class="snackbar newParent notif3" onclick="javascript:window.location.href='<?= base_url() ?>Administration/eleves/3'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Lycée</strong><br>
				  Parent(s) en attente<br>de validation.
			</div>  
		<!-- /// ////////////////// //  -->

		<!-- /// New inscription Prof //  -->
			<div class="snackbar newProf notif0" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/0'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Préscolaire</strong><br>
				  Professeur(s) en attente<br>de validation.
			</div>
			<div class="snackbar newProf notif1" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/1'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Primaire</strong><br>
				  Professeur(s) en attente<br>de validation.
			</div> 
			<div class="snackbar newProf notif2" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/2'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Collège</strong><br>
				  Professeur(s) en attente<br>de validation.
			</div> 
			<div class="snackbar newProf notif3" onclick="javascript:window.location.href='<?= base_url() ?>Administration/prof/3'" >
				  
				  <i class="fa fa-bullhorn"></i> 
				  <strong>Lycée</strong><br>
				  Professeur(s) en attente<br>de validation.
			</div>  
		<!-- /// ////////////////// //  -->
	<!-- <div class="snackbar show">
		  
				  <i class="fa fa-bullhorn"></i> 
		  Nouvelle inscription parent
	</div> -->
</div>


<script src="<?= base_url() ?>assets/js/libs/bootstrap.min.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/datatables/DT_bootstrap.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/icheck/jquery.icheck.js"></script> 

<!--[if lt IE 9]>
  <script src="<?= base_url() ?>./assets/js/libs/excanvas.compiled.js"></script>
  <![endif]--> 
<!-- App JS -->  
<script src="<?= base_url() ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"></script> 
<script type="text/javascript">
	$.fn.datepicker.dates['fr'] = {
	    days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
	    daysShort: ["Dim.", "Lun.", "Mar.", "Mer.", "Jeu.", "Ven.", "Sam."],
	    daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
	    months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
	    monthsShort: ["Janv.", "Févr.", "Mars", "Avril", "Mai", "Juin", "Juil.", "Août", "Sept.", "Oct.", "Nov.", "Déc."],
	    today: "Aujourd'hui",
	    monthsTitle: "Mois",
	    clear: "Effacer",
	    weekStart: 1,
	    format: "dd/mm/yyyy"
	  };
</script> 



<script src="<?= base_url() ?>assets/js/plugins/timepicker/bootstrap-timepicker.js"></script> 
<script src="<?= base_url() ?>assets/js/plugins/fileupload/bootstrap-fileupload.js"></script> 

<script src="<?= base_url() ?>assets/sweet-alert/sweetalert.min.js"></script>
<!-- App JS --> 
<script src="<?= base_url() ?>assets/js/target-admin.js"></script> 

<!-- Plugin JS --> 

<script type="text/javascript">

var data = {
	messages: [0, 0, 0, 0],
	parents:  [0, 0, 0, 0],
	profs:    [0, 0, 0, 0]
}

var checkNotif = false;
var OldTotalNotif = 0;

function notification() { 
	$.ajax({
        type        : 'GET',
        url         : '<?= base_url().'Administration/GetNofifByAjax/'.$this->session->id ?>', 
        dataType    : 'json' // what type of data do we expect back from the server 
    }).done(function( success ) {  
    	var i = 0;
    	var TotalNotif = 0;
    	$.each(success.messages, function ( i, val ) { 
    		

    		if( !checkNotif ){
    			if( parseInt(val) > 0){ 
    				data.messages[ i ] = val;
		    		$('.noticebar .newMsg.notif'+i).addClass("show").find('.badge').text(val);  
					TotalNotif++;
		    	}
		    	if( parseInt(val) == 0 ){
		    		$('.newMsg.notif'+i).removeClass("show"); 
		    	}
    		}else{
    			if( parseInt(val) > 0 && val > data.messages[ i ]){
    				data.messages[ i ] = val; 
		    		$('.newMsg.notif'+i).addClass("show").find('.badge').text(val); 
					$('#notif')[0].play();  
		    	}

		    	if( parseInt(val) > 0){
		    		TotalNotif++;
		    	}

		    	if( parseInt(val) == 0 ){
		    		$('.newMsg.notif'+i).removeClass("show"); 
		    	}
    		} 
	    	i++;
    	})

    	var j = 0;
    	$.each(success.parents, function ( key, val ) {
    		

    		if( !checkNotif ){ 
    			if( parseInt(val) > 0){ 
    				data.parents[ j ] = val; 
		    		$('.noticebar .newParent.notif'+j).addClass("show").find('.badge').text(val);  
					TotalNotif++;
		    	}
		    	if( parseInt(val) == 0 ){
		    		$('.newParent.notif'+j).removeClass("show"); 
		    	}
    		}else{
    			if( parseInt(val) > 0  && val > data.parents[ j ] ){  
    				data.parents[ j ] = val; 
					$('.newParent.notif'+j).addClass("show").find('.badge').text(val); 
					$('#notif')[0].play();   	 
		    	}

		    	if( parseInt(val) > 0){
		    		TotalNotif++;
		    	} 

		    	if( parseInt(val) == 0 ){
		    		$('.newParent.notif'+j).removeClass("show"); 
		    	}
			}  

	    	j++;
    	})

    	var k = 0;
    	$.each(success.profs, function ( key, val ) { 
    		

    		if( !checkNotif ){
    			if( parseInt(val) > 0){ 
    				data.profs[ k ] = val;
		    		$('.noticebar .newProf.notif'+k).addClass("show").find('.badge').text(val);  
					TotalNotif++;
		    	}
		    	if( parseInt(val) == 0 ){
		    		$('.newProf.notif'+k).removeClass("show"); 
		    	}
    		}else{
    			if( parseInt(val) > 0  && val > data.profs[ k ]){
    				data.profs[ k ] = val; 
		    		$('.newProf.notif'+k).addClass("show").find('.badge').text(val); 
					$('#notif')[0].play();  
		    	}

		    	if( parseInt(val) > 0){
		    		TotalNotif++;
		    	}

		    	if( parseInt(val) == 0 ){
		    		$('.newProf.notif'+k).removeClass("show"); 
		    	}
			}
    		
	    	k++;
    	})
    	setTimeout(function () {
    		if( !checkNotif ){
    			checkNotif = true; 
    		} 

    		
    		if(TotalNotif > 0){
    			OldTotalNotif = TotalNotif;
    			$('.navbar .noticebar > li > a .badge, #globalgadge').text(OldTotalNotif).show();
    			$('.noNotif').hide()

    			setTimeout(function () {
					$('.snackbar').removeClass("show")
				},7000)
    		}

    		if( TotalNotif == 0 ){
				$('.navbar .noticebar > li > a .badge, #globalgadge').text(0).hide()
				$('.noNotif').show()
    		}
    	})

    })
}
$(document).ready(function() {   
	notification();
	setTimeout(function () {
		setInterval( notification, 12000);
	},0)  

    $('.header-continer').on('click','.openMenuListe',function () {
      $('.navbar-collapse').removeClass('in')
    })
    $('.header-continer').on('click','.openNotifListe',function () {
      $('.mainbar-collapse').removeClass('in')
    })
  })
</script>
</body>
</html>
