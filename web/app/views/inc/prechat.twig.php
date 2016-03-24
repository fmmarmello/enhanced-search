{# 
    <!--
    *   Registra o dados no CRM Inforce e depois envia para o CRM SuaHouse
    *   O processo e feito através de um post via ajax para o GAPO Inforce e depois
    *   um post html para o CRM da House.
    *
    -->
#}
 

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <base href="http://crm..com.br/"> -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Atendimento {{Config.Cliente}}</title>
    

    <!-- FONTS -->    
    
    <!-- CSSs -->
    <link rel="stylesheet" type="text/css" href="{{Config.base_url}}theme/css/doc.css" />    
    <script src="{{Config.base_url}}assets/jvs/jquery.min.js"></script>    
    <script src="{{Config.base_url}}assets/jvs/jquery.mask.js"></script>
    


    <!-- ACCORDION -->
    <!--
    <link rel="stylesheet" href="scripts/jquery.ui/css/no-theme/jquery-ui-1.10.4.custom.min.css">
    -->   

    <!-- JS -->

    <style type="text/css">
        *{
            margin:0;
            padding: 0; 
        }
        #loader-spinner-chat{
            position: absolute;
            z-index: 200;
            top: 35%;
            left: 40%;
        }
        #bg-locker{
            position: absolute;
            display: none;
            top: 0;
            left: 0;
            background-color: #fff;
            width: 100%;
            height: 612px;
            z-index: 180;
            opacity: 0.8;
        }
        .hcCl{
            background-color: #ee262d;
            margin: 0;
            padding: 10px;   
            height: 70px;         
        }

        .logo_chat{
            background: url('{{Config.base_url}}theme/images/logo.png') no-repeat; 
            width: 221px; 
            height: 65px; 
            margin: 0 auto; 
        }

        .chHd h1{
            text-align: center;
            margin-top: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dotted #ccc;
        }

        .form{
            width: 300px;
            margin: 20px auto;
            height: 200px;
        }

        .form input[type=text], .form input[type=email]{
            width: 100%;
            height: 25px;
            border: 1px solid #EAE9E9;
            border-radius: 2px;
        } 

        .form input[type=text]:active, .form input[type=email]:active{
            border: 1px solid #F3ECCE;
        }
        
        .form label{
            font-size: 13px;
            color: #000;
        }

        .form .btEntrar{
            width: 100px;
            height: 30px;
            background: red;
            border: none;
            color: #FFFFFF;
            font-size: 10px;
            text-transform: uppercase;
            float: right;
            margin-top: 15px;
            cursor: pointer; 
        }
        
        .form .btEntrar:hover{
            background: #AD3F3F; 
        }

        .hcFt{
            text-align: center;
            width: 100%;
        }

        .hcFt h1{
            font-size: 14px; 
        }

        .ftCr{
            font-size: 9px; 
        }


    </style>

    <script type="text/javascript">
        //var hc_dominio_chat="crm.morada.com.br";
    </script>

</head>

<body class="hcChat" onload="javascript:OnLoad();">

    <!--<script src="http://crm.morada.com.br/track/origem.js"></script>-->

    <img src="{{Config.base_url}}assets/img/spinner.svg" alt="loader" id="loader-spinner-chat" style="display: none;">
    <div id="bg-locker"></div>
    <div class="hcContent">
        <!-- CLIENTE -->    
        <div class="hcCl">
            <div class="logo_chat"></div>
        </div>
  
        <div class="chHd mnColor">
            <h1>Atendimento Online</h1>
        </div>
        
        <div class="chCt" >
        
        <form action="{{Config.base_url}}ws/chat/" method="post" class="form" name="frmcad" id="frmcad">
            <input type="hidden" name="codusuario" value="">
            <input type="hidden" name="veiculo" value="">
            <input type="hidden" name="origem" value="">
            <input type="hidden" name="linkfrom" value="{{params.enterlink}}">

            <input type="hidden" name="token" value="{{token}}">

            {# <!-- parametros dos produtos  --> #}
            <input type="hidden" name="tokenAdr" value="{{Config.base}}{{params.enterlink|e[1:]}}">
            <input type="hidden" name="id" value="{{params.id}}">
            <input type="hidden" name="produto" value="{{params.produto}}">
            {# <!-- parametros dos produtos  --> #}
            
            {#
            <!-- <input type="hidden" name="codempreendimento" value="{{params.id}}"> -->
            <!-- <input type="hidden" name="filial" value="{{params.filial}}"> -->
            <!-- <input type="hidden" name="hotsite" value="{{params.hotsite}}"> -->
            #}
            {# <!--
            <input type="hidden" name="pro" value="{{params.pro}}">
            <input type="hidden" name="source" value="{{params.source}}">
            <input type="hidden" name="media" value="{{params.media}}">
            <input type="hidden" name="campaign" value="{{params.campaign}}">
            <input type="hidden" name="referrer" value="{{params.referrer}}">
            <input type="hidden" name="keyword" value="{{params.keyword}}">
            <input type="hidden" name="host" value="{{params.host}}">
            <input type="hidden" name="enterlink" value="{{params.enterlink}}">
            --> #}

                    <!-- NOME -->
                <div class="fmLine form-group col-md-12">
                    <label for="iptNome">Seu nome</label>
                    <input type="text" name="nome" id="iptNome" value="{{params.nome}}" />
                </div>
                
                <!-- EMAIL -->
                <div class="fmLine form-group col-md-12">
                    <label for="iptEmail">Seu email</label>
                    <input type="text" name="email" id="iptEmail" value="{{params.email}}" />
                </div>
                <div class="fmLine form-group col-md-12">
                    <label for="iptDDD">Seu Telefone </label>
                    <input type="text" value="{{params.telefone}}" name="telresidencial" id="iptTelefone" maxlength="20" class="input-telefone" />
                </div>
                <!-- ENTRAR -->
                <div class="fmBtn form-group col-md-12">            
                    <input type="button" value="entrar" class="btEntrar btColor" id="btEntrar"  />            
                </div>
            
            </form>
            
        </div>
        <div class="hcFt">
        
            <h1>{{Customer.name_full}}</h1>
            <span class="ftCr">COPYRIGHT &copy; 2016, {{Customer.name_full}} TODOS OS DIREITOS RESERVADOS</span>
            
            <img src="/images/loading-24x24.GIF" id="imgloading" alt="" class="chLoading" />
        
        </div>
        <!-- end FOOTER -->

    </div>
    <script language="javascript">
        var oRegEmail = /^[a-z0-9\._\-]+\@[a-z0-9\._\-]+\.[a-z]{2,3}$/i;
        // function logar(){
        //     if(document.frmcad.nome.value == ""){
        //         alert("Entre com o seu nome.");
        //         document.frmcad.nome.focus();
        //         return false;
        //     }
        //     if(document.frmcad.email.value == ""){
        //         alert("Entre com o seu email.");
        //         document.frmcad.email.focus();
        //         return false;
        //     }
        //     if (!oRegEmail.test(document.frmcad.email.value)){
        //         alert('Por favor, confira seu endereço de e-mail.');
        //         document.frmcad.email.focus();
        //         return false;
        //     }
        //     if(document.frmcad.telefone.value != ""){
        //         if(document.frmcad.ddd.value == ""){
        //         alert("Entre com o seu ddd.");
        //         document.frmcad.ddd.focus();
        //         return false;
        //         }
        //     }
        //     if(document.frmcad.ddd.value != ""){
        //         if(document.frmcad.ddd.value.length < 2 || document.frmcad.ddd.value.length > 2){
        //         alert("Verifique o DDD informado.");
        //         document.frmcad.ddd.focus();
        //         return false;
        //         }
        //     }
        //     if(document.frmcad.ddd.value != ""){
        //         if(document.frmcad.telefone.value == ""){
        //         alert("Entre com o seu Telefone.");
        //         document.frmcad.telefone.focus();
        //         return false;
        //         }
        //     }
        //     if(document.frmcad.telefone.value != ""){
        //         if(document.frmcad.telefone.value.length < 8 || document.frmcad.telefone.value.length > 9){
        //         alert("Verifique o Telefone informado.");
        //         document.frmcad.telefone.focus();
        //         return false;
        //         }
        //     }
        
        //     $("#imgloading").show();

        //     return true;
        // }

        function OnLoad() {
            window.resizeTo(700, 690);
        }

        OnLoad();

        $("#imgloading").hide();
        $("#iptTelefone").mask('(99) Z9999-9999', {
            translation: {
              'Z': { pattern: /[0-9]/, optional: true }
            }
         });            


        document.frmcad.nome.focus();


        $(document).ready(function () {
            $('#Selector').bind('copy paste', function (e) {
                e.preventDefault();
            });

            $('.btEntrar').click(function(event) {

                var status = true; 

                if ($("#iptNome").val()=="") {
                    alert("Preencha o nome"); 
                    $("#iptNome").focus(); 
                    return false;  
                }

                // if(/^[a-z0-9\.\-]*$/.test($("#iptNome").val()) == false) {
                //     alert("O nome não pode conter caracteres especiais."); 
                //     $("#iptNome").focus().val(""); 
                //     return false; 
                // }

                if ($("#iptEmail").val()=="") {
                    alert("Preencha o e-mail."); 
                    $("#iptEmail").focus(); 
                    return false;  
                }

                if (!oRegEmail.test($("#iptEmail").val())) {
                    alert("Digite um e-mail válido."); 
                    $("#iptEmail").focus(); 
                    return false;  
                }

                if ($("#iptTelefone").val()=="") {
                    alert("Preencha o telefone"); 
                    $("#iptTelefone").focus(); 
                    return false;  
                }

                $(".btEntrar").val("Entrando...").attr('disabled','disabled');                
                $("#frmcad").submit(); 
            });

        });

    </script>

</body>
</html>