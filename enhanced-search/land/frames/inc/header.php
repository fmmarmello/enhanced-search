
<div id="bg" class="bg_1">
  <div class="bg_barra">
	<div class="content_barra">
    	<a href="http://sawala.com.br/" target="_blank"><img src="images/logo_sawala_barra.png" style="float:left;" /></a>
        <div class="bts_barra">
        	<a href="javascript:chat();" target="_blank" class="bt_atendimento_barra">
            <span class="txt_barr">Atendimento<br /><strong>On-line</strong></span>
            </a>
            <a href="http://sawala.com.br/" target="_blank" class="bt_website_barra" style="margin: 0 35px 0 28px;">
            <span class="txt_barr">Acesso<br /><strong>Ao Website</strong></span>
            </a>
            <span class="txt_barr" style="float: left;"><img src="images/seta.png" style="float:left;margin:2px 0 0 -16px;"/>Conheça Mais<br /><strong>Empreendimentos</strong></span>
            <div id="organizar3" style="float: right;">
                <select name="outros-empreendimentos" id="outros-empreendimentos" class="styled" style="opacity:0;">
                	<option value="">Empreendimentos</option>
                     <?php
                            $query = "select e.sil_cidade_id, c.nome_customizado cidade
                                    from emp_empreendimento e
                                    join sil_cidade c on e.sil_cidade_id = c.id
                                    join emp_lancamento l on l.EmpreendimentoID = e.EmpreendimentoID
                                    where e.FlagPublico = -1
                                    group by e.sil_cidade_id order by c.flag_capital";
                            $result = mysql_query($query);
                            if (mysql_num_rows($result)) {
                                while ($l = mysql_fetch_array($result)) { 
                                    echo "<option value='emp" . $l['sil_cidade_id'] . "'>" . $l['cidade'] . "</option>";
                                    $query2 = "SELECT e.* FROM emp_empreendimento e join emp_lancamento l on e.EmpreendimentoID = l.EmpreendimentoID where l.FlagPublico = -1 and  e.FlagPublico = -1 AND sil_cidade_id = '" . $l['sil_cidade_id'] . "' ORDER BY nome ASC;";
                                    $result2 = mysql_query($query2);
                                    if ($_GET["localizacao"] != "") {
                                        $b_emp_loc = explode(",", $_GET['localizacao']);
                                    }
                                    while ($l2 = mysql_fetch_array($result2)) {
                                        if (isset($b_emp_loc)) {
                                            $checked = "";
                                            foreach ($b_emp_loc as $b_loc2) {
                                                if ($b_loc2 == $l2['sil_bairro_id']) {
                                                    $checked = "checked='checked'";
                                                }
                                            }
                                        }
                                        ?>
                                        <option <?php echo ($_GET['id']==$l2['EmpreendimentoID'])?"selected='selected'":"" ?> value="<?php echo $l2['EmpreendimentoID'] ?>"><?php echo "-&nbsp;" . $l2['Nome'] ?></option>
                                        <?php
                                    }
                                }
                            }
             
                        ?>
                </select>
                <span class="span_sel" style="float: left; position: absolute; top: 5px; left: 5px;">Empreendimentos</span>
            </div>
        </div>
    </div>
</div>