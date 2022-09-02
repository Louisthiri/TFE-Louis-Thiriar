<?php
session_start();
include('include/header.php');
include('php/calandarControler.php');

?>

    <link rel="stylesheet" href="calendrier/CalendarPicker.style.css">

</head>
<header id="page-header" class="page-header" style="background-image: url('https://placeimg.com/1920/1024/nature');">
				<div class="page-header-inner">
					<div class="container">
					
						<!-- ===== PAGE HEADER CONTENT ===== -->
						<div class="page-header-content text-center">
							<h2>Rendez-vous</h2>
						</div>
						
					</div>
				</div>
			</header>
<body >
<form class="formRendezVous" method="post">
    <div>
        <h1 class="text-center">Calendrier de réservations</h1>
            
        <div id="showcase-wrapper">
            <div id="myCalendarWrapper"></div>
            <p class="text-center">Cliquez sur une date avec un créneau disponnible pour prendre rendez-vous</p>
            <h2 class="textAlign">Créneaux disponnibles</h2>
            <div id="creneaux-content"></div>
        </div>


        <script src="calendrier/Calendar.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <div >
            <section>
            <div id="form-reservation" style="display:none">
            
                <h2 style="margin-bottom: 2em;text-align:center;">Formulaire de réservation</h2>
                <h5 id="date_info"></h5>
                <br>
                <fieldset>
                <div class="mb-20">
                    <label  class="label-control"for="prenom">Prénom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom"required><br><br>
                </div>
                <div>
                <label for="nom"class="label-control">Nom :</label>
                <input type="text"class="form-control" id="nom" name="nom"required><br><br>
                </div>
                <label for="email"class="label-control">email :</label>
                <input type="email"class="form-control" id="email" name="email"required><br><br>
                <label for="tel"class="label-control">telephone :</label>
                <input type="text"class="form-control" id="tel" name="tel" required><br><br>
                
                <input type="hidden" value="" id="creaneauId" name="creaneauId" />
                
                <div class="mb-20 text-right">
                <button id="return"class="btn btn-info btn-lg " type="button">Retour</button>
                    <input type="submit" class="btn btn-info btn-lg" value="envoyer" />
                </div>
                </fieldset>
            </section>
        </div>
    </div>
</form>

</body>
/µ
<script>
    const nextYear = new Date().getFullYear() + 1;
    const myCalender = new CalendarPicker('#myCalendarWrapper', {
        // If max < min or min > max then the only available day will be today.
        min: new Date(),
        max: new Date(nextYear, 10) // NOTE: new Date(nextYear, 10) is \"Sun Nov 01 <nextYear>\"
    });
//ma partie du code commence ici, le reste appartient au créateur du calendrier
    myCalender.onValueChange((currentValue) => {

        // On transforme la date en timestamp
        var timestamp = Math.round(myCalender.value.getTime()/1000);
        var dateString = myCalender.value.getDate() +'/'+ myCalender.value.getMonth() +'/' + myCalender.value.getFullYear();
        
        $.ajax({
            type: 'post',
            url:'admin/controler/getCreneaux.php',
            dataType: "json",
            data:
            {
                "dateCrenaux":timestamp
            },
            success: function(data){
                
                $('#creneaux-content').html('');
                $('#date_info').html('');

                // Traitement des données recues
                $.each(data, function(i, item) {
                    $('#creneaux-content').append('<input type="radio" class="creneau_radio" name="creneau" id="creneau'+item[0]+'" value="'+item[0]+'" data-heures="'+item[2]+' à '+item[3]+'" /><label class="labelcreneauradio" for="creneau'+item[0]+'">'+item[2]+' à '+item[3]+'</label>');
                });

                $('.creneau_radio').on('click', function(){

                    $('#date_info').html(dateString + '<br>' + $(this).data().heures);
                    $('#creaneauId').val(this.value);
                    //fadeout du calendrier
                    $('#showcase-wrapper').fadeOut(function(){
                        $('#form-reservation').fadeIn('slow');
                    });
                });
            }
        });

    });
    //fadein/fadeOut via bouton return
    $('#return').on('click', function(){
        $('.creaneau_radio').prop('checked', false);
        $('#form-reservation').fadeOut(function(){
                $('#showcase-wrapper').fadeIn('slow');
        });
    });
</script>
<?php
	include('include/footer.php');	       
?>

</html>