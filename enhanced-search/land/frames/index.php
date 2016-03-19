<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php 
    include '../../_custom/config.php';
    include_once '../../_global/biblioteca/php/global.php'; 
    include_once '../../_global/biblioteca/php/vitrine.php';
    
    Conectar();

    include 'inc/metas.php';
    include 'inc/head.php'; 
?>

</head>
<body>
    
    <?php include 'inc/header.php' ?>
     
    <div class="conteudo" id="conteudo">
        <div class="casal"></div>
        <div class="corretor-online corretor" onclick="chat();"></div>
        <div class="selo"></div>
        <div class="middle">
            <div class="texto"></div>
            <div class="formulario_principal">
                <form id="form_" name="form" method="post" action="<?php echo HOST_SITE ?>_global/_crm/contato/registra_contato.php" onsubmit="return validar();">
                    
                    <!-- HIDDEN --> 
                    <input type="hidden" name="origemid" id="origemid" value="<?php echo cfg_tea_origemid ?>" />
                    <input type="hidden" name="lancamentonome" id="lancamentonome" value="Frames"/>
                    <input type="hidden" name="url" id="url" value="<?php echo HOST_SITE ?>land/frames/"/>
                    <!-- HIDDEN --> 

                    <input type="hidden" name="principal" value="Principal"/>
                    <input name="nome" type="text" size="47" placeholder="Digite seu nome:" value="" required/>
                    <input name="email" type="email" placeholder="Digite seu e-mail:" size="47" value="" required/>
                    <input name="telefone" type="text" placeholder="Digite seu telefone:" class="telefone" maxlength="13" value="" required/>
                    <input type="submit" value="" alt="enviar" class="bt_enviar" id="bt_enviar"/>

                    <label class="label_check" style="">
                        <input type="checkbox" checked="checked" id="check_nov"><span class="novidade"> Desejo receber email com novidades.</span>
                    </label>
                    <a href="images/politica.jpg" class="politica colorbox" rel="politica" title="Política de Privacidade">Política de Privacidade</a>    
                </form>  
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php' ?>
   
</body>
</html>