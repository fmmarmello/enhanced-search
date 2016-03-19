

var clock;

	

$(document).ready(function() {

    // masks

    $('input[name="telefone"]').mask('(00) 00000-0000');



	var clock;



	clock = $('.clock').FlipClock({

        clockFace: 'DailyCounter',

        autoStart: false,

        callbacks: {

        	stop: function() {

        		$('.message').html('O relógio parou!')

        	}

        }

    });

		    

	var limitdate = new Date("2015-05-13").getTime() / 1000;

    var contdown  = new Date().getTime() / 1000;

	var seconds = limitdate - contdown;



    clock.setTime(seconds);

    clock.setCountdown(true);

    clock.start();





    $('.form_contato').submit(function(){

        console.log( $(this).serializeArray() );



        // return false;



    });



});

