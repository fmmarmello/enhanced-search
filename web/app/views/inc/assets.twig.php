    <meta charset="utf-8">
	<base href="{{Config.base_url}}">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    
    <META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2016 11:12:01 GMT">    

	<meta name="generator"	content="http://www.inforce.com.br/">
	<meta name="author" 	content="Inforce Internet Solutions">

	<meta name="copyright" 	content="{{Config.Cliente}}">
	<meta name="url" 		content="{{Config.base_url}}">

	<meta name="title"			content="{{page_title}} - {{Customer.name_full}}">
	<meta name="description" 	content="{{Customer.meta_descricao}}">
	<meta name="keywords" 		content="{{Customer.meta_keywords}}" >


    <title>{{page_title}} - {{Customer.name_full}}</title>
    

    <!-- Bootstrap core CSS -->    
    <link href="{{Config.base_url}}theme/css/bootstrap.css" rel="stylesheet">    
 
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="{{Config.base_url}}theme/css/doc.css?{{'now'|date('H:i:s')}}" rel="stylesheet" type="text/css">
    <link href="{{Config.base_url}}theme/css/jquery.selectBox.css" rel="stylesheet" type="text/css" />
    <link href="{{Config.base_url}}theme/css/freshslider.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{Config.base_url}}theme/css/owl.carousel.css" rel="stylesheet">
    <link href="{{Config.base_url}}theme/css/nivo-lightbox.css" rel="stylesheet">
    <link href="{{Config.base_url}}theme/css/default.css" rel="stylesheet">
    <link href="{{Config.base_url}}theme/css/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
   
    <link href="{{Config.base_url}}assets/global/plugins/noUiSlider.8.2.1/nouislider.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!-- FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,500,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,800' rel='stylesheet' type='text/css'>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script type="text/javascript">
        function openpopup(t){
            //alert(t);
            document.getElementById('light10').style.display='block';
            document.getElementById('fade10').style.display='block';
        }
    </script>

    {# <!-- FORÇA UM CLICK NO TYPEAHEAD AO APERTAR ENTER --> #}
    <script type="text/javascript">
    function getKeypress(e) {
      if (e.keyCode == 13) {
            console.log('enter');
          // var link = $('.tt-suggestion').first().children('a');
          var link = $('.tt-is-under-cursor').children('a');
          console.log(link);

          // return false;
          link.trigger("click");
      }
    }
    </script>