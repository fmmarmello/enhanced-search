<?php
	
	namespace Model;

	use Controller;
	use Lib\Util;

	class Cliente extends \ActiveRecord\Model {

		// static $table_name = 'gapo_pessoa';


        public static function findCliente() {

			$Cliente = new \stdClass;
			$Cliente->name = utf8_decode("Nova Época");
			$Cliente->name_full = "Nova Época Imóveis";
			$Cliente->description = "";
			$Cliente->logo = "assets/img/custom/logo.png";
			$Cliente->linkChatOnline = "";
			$Cliente->telefone1 = "(021) 3559-6710"; //afonso pena 
			$Cliente->telefone2 = "(021) 3559-6730"; //botafogo
			$Cliente->telefone3 = "(021) 3559-6740"; //copacabana
			$Cliente->telefone4 = "(021) 3559-6720"; //flamengo
			$Cliente->telefone5 = "(021) 3559-6750"; //saens pena
			$Cliente->telefone6 = "(021) 3559-6700"; //saens pena

			$Cliente->email1 = "novaepoca@novaepoca.com.br"; //lancamentos
			$Cliente->email2 = "novaepoca@novaepoca.com.br"; //prontos
			$Cliente->email321 = "novaepoca@novaepoca.com.br"; //locacao
			$Cliente->estado = "RJ";
			$Cliente->cidade = "Rio de Janeiro";
			$Cliente->bairro = "Tijuca";
			$Cliente->logradouro = "Rua Doutor Satamini, 172/ Loja B (Praça Afonso Pena)";
			$Cliente->cep = "22793-082";
			$Cliente->endereco_full = "<p>".$Cliente->logradouro."</p> <p>".$Cliente->bairro." - ".$Cliente->cidade." - ".$Cliente->estado."</p>";

			$Cliente->title = "Casas, apartamentos e imóveis à venda no Rio de Janeiro - Nova Época Imóveis";
			$Cliente->meta_descricao = "A mais moderna imobiliária de prontos do Rio de Janeiro! Casas, apartamentos e imóveis à venda em Botafogo, Flamengo, Copacabana, Tijuca e outros.";
			$Cliente->meta_keywords = "Imobiliária, Imóveis, Imóveis à venda, Imóveis prontos para morar, Casas, Apartamentos, Rio de Janeiro, Flamengo, Botafogo, Copacabana, Tijuca";
			$Cliente->GACOD = "";
			$Cliente->GRID = NULL;
			// $Cliente->facebook = "https://www.facebook.com/sharer/sharer.php?u=http://www.aquirj.com.br/";

			$Cliente->facebook = "";
			$Cliente->facebookPage = "";
			$Cliente->facebookAppID = "";
			$Cliente->twitter = "";
			$Cliente->gplus = "http://www.plus.google.com/";
			$Cliente->pinterest = "";
			$Cliente->youtube = "";
			$Cliente->linkedin = "";
			$Cliente->instagram = "";

			return $Cliente;
            
        }


	}
		