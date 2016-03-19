$(document).ready(function(){
	init(); 
});


// Inicia os plugins necessários
function init() {

	//colorbox
	$('.colorbox').colorbox(); 

	//maskedinput
	$('.telefone').mask('(99) 9999-9999?9'); 

    $("#outros-empreendimentos").change(function(){ 
        linkEmpreendimentos($(this)); 
    }); 

    //inicia a inimação do selo
    animaSelo(); 
}

//valida o formulário
function validar(){
    if($("input[name=nome]").val()=="" ){
        alert("Nome é um campo obrigatório!");
        $("input[name=nome]").focus();
        return false;
    }
    if($("input[name=email]").val()=="" ){
        alert("Email é um campo obrigatório!");
        $("input[name=email]").focus();
        return false;
    }

    if($("input[name=telefone]").val()=="" ){
        alert("Email é um campo obrigatório!");
        $("input[name=telefone]").focus();
        return false;
    }

    return true; 
}

//função para chamar o chat da sawala
function chat() {
    window.open('http://www.sawala.com.br/pop_atendimentoonline.asp?land=Frames', 'c2c', 'width=530,height=590,scroolbars=0,status=0,location=0,location=0,toolbar=0,menubar=0');
}

//link para a combo de empreendimentos
function linkEmpreendimentos(param) {
    if($(param).val()!=""){
        if(isFinite($(param).val())==true){
            window.open ("../../empreendimento_detalhe.php?id="+$(param).val());
        }else{
            window.location = "empreendimento.php?lanCidade="+$(param).val().replace("emp","");
        }
    }
}

function animaSelo() {
    setInterval(function(){
        $('.selo').animate({'left':'220'}, 1000); 
        $('.selo').animate({'left':'240'}, 1000); 
    }, 2000);
}




