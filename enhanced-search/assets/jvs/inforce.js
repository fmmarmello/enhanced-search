function MultiChat(){
	var width_aux 	= jQuery("html").width();
	var height_aux 	= jQuery("html").height();
	jQuery("#bg_dhtml3").attr("width",width_aux).attr("height",height_aux).attr("display","block");
	jQuery("#conteudo_dhtml3").attr("display","block");
	jQuery("#bg_dhtml3").show();
	jQuery("#conteudo_dhtml3").show();			
}
function FechaDHTML(id){
	if(id == undefined){
		id='';
		jQuery("#bg_dhtml, #conteudo_dhtml").remove(); // #3219 evita que modal principal sobreponha modais de contato mesmo estando "display:none"
	}
	jQuery("#bg_dhtml"+id).fadeOut(300);
	jQuery("#bg_dthml"+id).fadeOut(300);
	jQuery("#conteudo_dhtml"+id).fadeOut(300);
	jQuery("#div-main").show();
	jQuery("#conteudo_dhtml_new,#fechar").fadeOut(300);
}

/*function abreChat(tipo, produto, target, ref, largura, altura){
	/*
		TIPOS: 

		1 - Chat normal 
		2 - Chat especial para imóveis prontos
		3 - Chat especial para imóveis prontos
	*/
	/*
	tipo 	= typeof tipo 		!== 'undefined' ? tipo 		: 1;
	produto = typeof produto 	!== 'undefined' ? produto 	: "";
	target 	= typeof target 	!== 'undefined' ? target 	: "_blank";
	altura 	= typeof altura 	!== 'undefined' ? altura 	: "586";
	largura = typeof largura 	!== 'undefined' ? largura	: "502";
	ref		= typeof ref	 	!== 'undefined' ? ref		: "";

	switch(tipo) {
	    case 1:
	        window.open('pop_atendimentoonline.asp?produto='+produto+'&ref='+ref, target, 'width='+largura+', height='+altura); 
	        break;
	    case 2:
	        window.open('pop_atendimentoonline.asp?imovel_chat=imovel_chat&produto='+produto+'&ref='+ref, target, 'width='+largura+', height='+altura); 
	        break;
		case 3:
	      	window.open('pop_atendimentoonline.asp?empreendimento_chat=empreendimento_chat&produto='+produto+'&ref='+ref, target, 'width='+largura+', height='+altura); 
	        break;		
	}
}*/