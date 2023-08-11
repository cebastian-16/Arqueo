
		$(document).ready(function(){
			$("#circle").hide();
			$("#box").animate({height:"280px"},"slow");
			$("#box").animate({width:"450px"},"slow");
			$("#circle").fadeIn(1000);

		});
		function blinker(){
			$('#blinking').fadeOut("slow");
			$('#blinking').fadeIn("slow");
		}
		function blinker2(){
			$('#blinking2').fadeOut("slow");
			$('#blinking2').fadeIn("slow");
			$('#blinking3').fadeOut("slow");
			$('#blinking3').fadeIn("slow");
		}
		setInterval(blinker, 1000);
		setInterval(blinker2,1000);
