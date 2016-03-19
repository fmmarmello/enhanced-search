<?php

	if(!empty($_POST)){

		

	

	date_default_timezone_set("America/Sao_Paulo");

	setlocale (LC_ALL, 'pt_BR');



	$valida = true;

	foreach ($_POST as $item) {

		if(empty($item)){

			$valida = false;

		}

	}



	if ($valida){



		$quebra_linha = "\n";

		$emailsender .= "suporte@inforce.com.br"; // remetente

		$nomeremetente = "AQUI SI";

		// $emaildestinatario = "turano@suahouse.com";

		$emaildestinatario = "raul@inforce.com.br";

		$comcopia = "";

		// $comcopiaoculta = "registro@inforce.com.br; dinah@inforce.com.br";

		$assunto = "Formulario de Contato Site Teaser Aqui SI - ".$_POST['finalidade']." - ".date("Y-m-d H:i:s");





		if($_POST['finalidade']=='rh'){



			$contentType = "Content-type: multipart/form-data; charset=UTF-8".$quebra_linha;

			$customMSG = "<br>Área de Interesse: ".$_POST['area_de_interesse'];





		    $file = $_FILES['curriculo']['tmp_name'];

		    $file_size = filesize($file);

		    $handle = fopen($file, "r");

		    $content = fread($handle, $file_size);

		    fclose($handle);

		    $content = chunk_split(base64_encode($content));

		    $filename = $_FILES["curriculo"]["name"];



			$mensagemHTML = "

			    <br><b>De: </b>".$emailsender ."[mailto:".$emailsender."]

			    <br>Enviada em: ". date("l , d \d\e F \d\e Y H:i") ."

			    <br>Finalidade: ".$_POST['finalidade']."

			    <br>Teaser Aqui SI

			    <br>

			    <br><b>Nome:</b> ".$_POST['nome']."

			    <br><b>Email:</b> ".$_POST['email']."

			    <br><b>Telefone:</b> ".$_POST['telefone']."

			    <br>

			    <br>Contato enviado pelo formulário Teaser - ".strtoupper($_POST['finalidade'])."

			    <br>

			    <br>Mensagem enviada pelo site http://www.aquisi.com.br/

			    <br>Browser: ".$_SERVER['HTTP_USER_AGENT']."|".$_SERVER['REMOTE_ADDR']."

			    <br>Data do envio: ".date("d-m-Y H:i:s")

			    ."";		    



			// echo "<pre>";

			// print_r($_POST);

			// print_r($_FILES);

			// echo "</pre>";

			// die;



		    // a random hash will be necessary to send mixed content

    		$separator = md5(time());



			// main header (multipart mandatory)

			$headers = "MIME-Version: 1.1" . $quebra_linha;

			$headers .= "From: ".$emailsender.$quebra_linha; // remetente

			$headers .= "Return-Path: ".$emailsender.$quebra_linha; // return-path

			$headers .= "Cc: ".$comcopia.$quebra_linha; // return-path

			$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha; // return-path

			$headers .= "Reply-To: ".$emailsender.$quebra_linha; // return-path

			

			$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $quebra_linha . $quebra_linha;

			$headers .= "Content-Transfer-Encoding: 7bit" . $quebra_linha;

			$headers .= "This is a MIME encoded message." . $quebra_linha . $quebra_linha;



			// message

			$headers .= "--" . $separator . $quebra_linha;

			$headers .= "Content-Type: text/html; charset=\"UTF-8\"" . $quebra_linha;

			$headers .= "Content-Transfer-Encoding: 8bit" . $quebra_linha . $quebra_linha;

			$headers .= "<br>".$mensagemHTML . $quebra_linha . $quebra_linha;



			// attachment

			$headers .= "--" . $separator . $quebra_linha;

			$headers .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $quebra_linha;

			$headers .= "Content-Transfer-Encoding: base64" . $quebra_linha;

			$headers .= "Content-Disposition: attachment" . $quebra_linha . $quebra_linha;

			$headers .= $content . $quebra_linha . $quebra_linha;

			$headers .= "--" . $separator . "--";    		



		}else{

			$contentType = "Content-type: text/html; charset=UTF-8".$quebra_linha;

		    $customMSG = "<br><b>Bairro:</b> ".$_POST['bairro']."

		    <br><b>Tipo:</b> ".$_POST['tipos'];



			$headers = "MIME-Version: 1.1".$quebra_linha;

			$headers .= $contentType;

			$headers .= "From: ".$emailsender.$quebra_linha; // remetente

			$headers .= "Return-Path: ".$emailsender.$quebra_linha; // return-path

			$headers .= "Cc: ".$comcopia.$quebra_linha; // return-path

			$headers .= "Cco: ".$comcopiaoculta.$quebra_linha; // return-path

			$headers .= "Reply-To: ".$emailsender.$quebra_linha; // return-path

		}



		$mensagemHTML = "

		    <br><b>De: </b>".$emailsender ."[mailto:".$emailsender."]

		    <br>Enviada em: ". date("l , d \d\e F \d\e Y H:i") ."

		    <br>Finalidade: ".$_POST['finalidade']."

		    <br>Teaser Aqui SI

		    <br>

		    <br><b>Nome:</b> ".$_POST['nome']."

		    <br><b>Email:</b> ".$_POST['email']."

		    <br><b>Telefone:</b> ".$_POST['telefone']."

		    <br>".$customMSG."

		    <br>

		    <br>Contato enviado pelo formulário Teaser - ".strtoupper($_POST['finalidade'])."

		    <br>

		    <br>Mensagem enviada pelo site http://www.aquisi.com.br/

		    <br>Browser: ".$_SERVER['HTTP_USER_AGENT']."|".$_SERVER['REMOTE_ADDR']."

		    <br>Data do envio: ".date("d-m-Y H:i:s")

		    ."";



		try{

		 	$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender);

		}catch(Exception $e){

			echo $e->getMessage();

		}



		if($envio){

			// echo "Mensagem enviada com sucesso";			

			include "/teaser/sucesso.php";

		}

		else{

			echo "A mensagem não pode ser enviada. Contate o administrador do site.";

		}



	}else{

		echo "A mensagem não pode ser enviada. Contate o administrador do site.";

	}



}

?>