{% set params = content %}

	<script type="text/javascript">

	// asset para popular os filtros selecionados 
	// através da barra de busca

	$(document).ready(function(){
		{% for key, param in params %}
			{% set tipo = key %}
			{% set id = param %}

			var tipo = '{{tipo}}';
			var id = ('{{id}}');
			var idx = "";
			
			console.log('tipo -> ' + tipo);
			console.log('id -> '+ id);			

			if( (tipo=='bairro') || (tipo=='tipo') || (tipo=='quartos') || (tipo=='valor') || (tipo=='status') || (tipo=='cidade')){
				if (filter[tipo]==undefined){
					filter[tipo] = "0,"+id;				
				}else{
					filter[tipo] = filter[tipo]+","+id;
				}
				
				// pega o idx do elemento pelo id do banco
				// idx necessario para remover o item da lista
				// e colocar na caixa de selecionados
				//$("li.{{tipo}}").each(function(){
				console.log('{{tipo}}');			

				$('select[name=select_{{tipo}}]').find('option').each(function(){
					var idLoop = $(this).attr("data-id");
					var eachId = id.split(','); //array com itens selecionados
					var bool = false;
					var myIndex = eachId.indexOf(idLoop);
					if(myIndex > -1){
						idx = $(this).attr("data-index");
						bool = true;
					}else{
						bool = false;
					}
					/*if(idLoop==id){
						idx = $(this).attr("data-index");
					}*/
					
					var seletor = ("#"+tipo+"_"+idx).replace(/\//g,"");
					seletor = seletor.replace(/ /g,"");
					seletor = seletor.replace("(","");
					seletor = seletor.replace(")","");

					valor = $(seletor).attr("data-valor");
					
					if(valor!=undefined && bool){
						console.log('{{id}}');
						$("#tags_container").append('<span class="tag" data_index="'+idx+'" data-tipo="{{tipo}}" data-valor="'+valor+'" data-id="'+eachId[myIndex]+'">'+valor+'</span>');
						$(seletor).css("display","none");
					}
				});
				/* SÓ FUNCIONA SE NÃO FOR MULTISELECT!!!!! */				
					if (tipo=='tipo') { var tipoProduto = id; }
					if (tipo=='cidade') { var cidadeProduto = id; }
					if (typeof cidadeProduto != undefined){
						mostraBairros(tipoProduto, cidadeProduto);	
					}					
				/* SÓ FUNCIONA SE NÃO FOR MULTISELECT!!!!! */
			}

			// limpa o nome do seletor
			

		{% endfor %}
	});

	</script>