//função básica para validação de formulários 
function validaFormBasic(element){
	var oRegEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
	var validaForm = true;

	
	/**
	*	se o parâmetro alert vier marcado como 1, então sobstituímos a exebição
	* 	das mensagens de um tooltip por um alert (isso serve para o formulário de
	*	pré-chat, por exemplo). 
	*/
	
	// verifica cada input do formulario
	$(element).find("input").each(function(e){
		// se tiver o atributo required
		console.log($(this)); 
		if($(this).attr('required') && validaForm){
			// verifica se esta vazio
			var eleValue = $.trim($(this).val());
			if( (eleValue==undefined) || (eleValue == "") ){
				alert("O preenchimento do campo "+$(this).attr('name')+" é obrigatório!"); 
				
				$(this).focus().empty(); 
				
				validaForm = false;
			}

			if ($(this).attr('name') == "email" && validaForm) {
				if (!oRegEmail.test($(this).val())) {
					alert("E-mail inválido!"); 
					$(this).focus().empty(); 
					validaForm = false;
				}
			}
		}
	});

	$(element).find("textarea").each(function(){
		// se tiver o atributo required
		if($(this).attr('required') && validaForm){
			// verifica se esta vazio
			var eleValue = $.trim($(this).val());
			if( (eleValue==undefined) || (eleValue == "") ){
				// se sim, invalida a submissao e apresenta o tooltip no(s) campo(s)
				alert("O preenchimento do campo "+$(this).attr('name')+" é obrigatório!"); 
				
				validaForm = false;
			}
		}
	});
		
	// verifica a validacao
	return validaForm ? true : false;

}