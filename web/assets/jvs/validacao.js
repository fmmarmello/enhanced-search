function validaEmail(email) {
	var achou_ponto = false;
	var achou_arroba = false;
	var achou_caracter = false;
	var sem_espaco = true;
	
	for (var i = 0; i < email.length; i++)
	{
		if (email.charAt(i) == "@")
			achou_arroba = true;
		else if (email.charAt(i) == ".")
			achou_ponto = true;
		else if (email.charAt(i) != " ")
			achou_caracter = true;
	}
	
	if (email.indexOf(' ') >= 0)
		sem_espaco = false;
	if (email.indexOf("@") < 1)
		achou_arroba = false;
	if (email.lastIndexOf(".") < email.indexOf("@") + 2)
		achou_ponto = false;
	if (email.lastIndexOf(".") + 2 >= email.length)
		achou_ponto = false;
	return (achou_ponto & achou_arroba & achou_caracter & sem_espaco);
}
function validarCPF(cpf){
	cpf = cpf.replace(/[^\d]+/g,'');
	if(cpf == '') return false;
	// Elimina CPFs invalidos conhecidos
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
		return false;
	// Valida 1o digito
	add = 0;
	for (i=0; i < 9; i ++)
		add += parseInt(cpf.charAt(i)) * (10 - i);
	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(9)))
		return false;
	// Valida 2o digito
	add = 0;
	for (i = 0; i < 10; i ++)
		add += parseInt(cpf.charAt(i)) * (11 - i);
	rev = 11 - (add % 11);
	if (rev == 10 || rev == 11)
		rev = 0;
	if (rev != parseInt(cpf.charAt(10)))
		return false;
	return true;
}

function validaFormCPF(element){
	if((element.value!="")&&(element.value!="___.___.___-__")){
		if(validarCPF(element.value)==false){
			element.value = "";
			element.focus();
			alert("CPF inválido!");
		}else{
			return true;
		}
	}
	return false;
}

function validaForm(){
	var error = false;
	$('select').each(function(){
		if($(this).attr('required') && $(this).val() == ''){						
			alert('Favor preencher campo - '+$(this).parent().prev().text());
			error = true;
			console.log($(this));
			$(this).focus();
			$(this+' .chosen-single').mousedown();			
			console.log('erro no campo'+$(this).attr('id'));
			return false;
		}
	});

	if(!error){
		$('input').each(function(){
			if($(this).attr('required') && $(this).val() == ''){
				$(this).focus();
				alert('Favor preencher campo - '+$(this).parent().prev().text());
				error = true;
				console.log('erro no campo'+$(this).attr('id'));
				return false;
			}
		});
	}
	if(!error){
		if (!($('#minAlunos').val() < $('#maxAlunos').val())){
			alert('Número Mínimo de Alunos tem que ser menor que número Máximo');
			$('#minAlunos').focus();
			error = true;
			return false;
		}
	}
	if(!error){
		$('textarea').each(function(){
			if($(this).attr('required') && $(this).val() == ''){
				$(this).focus();
				console.log($(this).parent().prev().text());
				alert('Favor preencher campo - '+$('label[for='+$(this).attr('id')+']').text());
				error = true;
				console.log('erro no campo '+$(this).attr('id'));
				return false;
			}
		});
	}

	if(!validaEmail($('#emailProfessor').val()) && !error)
	{
		alert('Email Inválido');
		$('#emailProfessor').val('');
		$('#emailProfessor').focus();
		error = true;
		console.log('erro email');
	}	

	if(error){
		console.log('errou');
		return false;
	}else{
		console.log('manda');
		$('form').submit();
	}
}