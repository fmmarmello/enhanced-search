<!-- modal de chat -->
<div id="bg_dhtml3" onclick="FechaDHTML(3);"></div>
<div id="conteudo_dhtml3" >
  <img src="theme/images/banner_corretor_online.png" width="405" usemap="#Map" border="0" />
  <map name="Map" id="Map">
    <area alt="" title="" href="javascript:FechaDHTML(3);" shape="rect" coords="545,39,588,82" />
    
    <area alt="Lançamento" title="Lançamento" href="javascript:abreChat(3, '{{id|default("") ? id : ""}}', '_blank', '{{Config.base}}{{Config.HOST_ROUTE}}');" shape="rect" coords="0,230,405,313"  />
    
    <area alt="Pronto para morar" title="Pronto para morar" href="javascript:abreChat(2, '{{id|default("") ? id : ""}}', '_blank', '{{Config.base}}{{Config.HOST_ROUTE}}');" shape="rect" coords="0,314,405,393" />
 
  </map>
</div>

<!-- modal de chat -->
<style type="text/css">
  #conteudo_dhtml3 {display: none;position: fixed;width: 408px;height: 435px;left: 50%;top: 50%;
    margin-left: -204px;
    margin-top: -207px;
    z-index: 999999999999999999;outline:none;  
  }
  #bg_dhtml3{
      display: none;position: fixed;top: 0px;left: 0px;width:100%;height:100%;
      background-color: #000;
      -moz-opacity: 0.7;
      opacity:.70;
      filter: alpha(opacity=70);
      z-index: 9999999999999;outline:none;cursor:pointer;
  }
</style>