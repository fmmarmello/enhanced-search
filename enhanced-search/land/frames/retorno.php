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
        <div class="corretor-online corretor">       
        </div>
        <div class="middle">
            <div class="texto"></div>
            <div class="formulario_principal" >
                <h1>Sua mensagem foi enviada com sucesso</h1>
                <img src="images/ico_success.png" style="margin:14px 0 0 195px;"/>
                <p style="margin:0;">&nbsp;</p>
                <a href="<?php echo HOST_SITE ?>land/frames/" style="margin-left: 191px;font-size:20px; color:#749dcb">Voltar</a>
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php' ?>
   
</body>
</html>