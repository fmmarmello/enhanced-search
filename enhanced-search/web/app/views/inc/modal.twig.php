<!-- modal de chat -->
<div id="bg_dhtml3" onclick="FechaDHTML(3);"></div>
<div id="conteudo_dhtml3" >
  <a href=""><img src="_custom/dhtml/atendimento_online_v3_r1.png" width="628" usemap="#Map" border="0" /></a>
  <map name="Map" id="Map">
    <area alt="" title="" href="javascript:FechaDHTML(3);" shape="rect" coords="545,39,588,82" />
    <area alt="Lançamento" title="Lançamento" href="javascript:abreChat(3, '<?php echo $id ?>', '_blank', '<?php echo $ref?>');" shape="rect" coords="0,241,317,428" />
    <area alt="Pronto para morar" title="Pronto para morar" href="javascript:abreChat(2, '<?php echo $Codigo ?>', '_blank', '<?php echo $ref?>');" shape="rect" coords="628,235,320,427" />
  </map>
</div>

<!-- modal de chat -->
<style type="text/css">
#conteudo_dhtml3 {
  display: none;
  position: fixed;
  width: 628px; 
  height: 435px;
  left: 50%;
  top: 50%;
  margin-left: -327px;
  margin-top: -207px; 
  cursor: pointer;
  z-index: 999999999999999999;
  outline:none;
  
}
#bg_dhtml3{
    display: none;
    position: fixed;
    top: 0px;
    left: 0px;
    width:100%;
    height:100%;
    background-color: #000;
    -moz-opacity: 0.7;
    opacity:.70;
    filter: alpha(opacity=70);
    z-index: 99999;
    outline:none;
    cursor:pointer;
}
</style>