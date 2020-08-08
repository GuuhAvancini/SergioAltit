$(document).ready(function() {
			$('#fullpage').fullpage({
				anchors: ['home', 'escritorio-de-arte', 'leiloes', 'contato'],
				sectionsColor: ['#231f20', '#FFFFFF', '#231f20', '#FFFFFF'],
				navigation: true,
				navigationPosition: 'right',
				navigationTooltips: ['Home', 'Escritório de Arte', 'Leilões', 'Entre em contato']
			});
		});
		
		$(document).ready(function(){
		$("#pisca").css("opacity","0.4");//define opacidade inicial
		setInterval(function() {
			   if($("#pisca").css("opacity") == 0){
		  $("#pisca").css("opacity","1");
		 }else{
		  $("#pisca").css("opacity","0");
		 }  }, 500);
		 $("#pisca2").css("opacity","0.4");//define opacidade inicial
		setInterval(function() {
			   if($("#pisca2").css("opacity") == 0){
		  $("#pisca2").css("opacity","1");
		 }else{
		  $("#pisca2").css("opacity","0");
		 }  }, 500);
		 $("#pisca3").css("opacity","0.4");//define opacidade inicial
		setInterval(function() {
			   if($("#pisca3").css("opacity") == 0){
		  $("#pisca3").css("opacity","1");
		 }else{
		  $("#pisca3").css("opacity","0");
		 }  }, 500);
		});
