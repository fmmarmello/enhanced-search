{% if content is not null %}
    {% set banner  = content %}
    <style>
    .modal_box{
        background: url('assets/img/bg_fade.png');
        position: absolute;
        top: 0;
        z-index: 99999;
        width: 100%;
        display: none;
    }
    .modal_box .modal_content{
        z-index: 9999;
        margin: 10% auto 75%;
        width: 675px;
        /*cursor: pointer;*/
        position: relative;
    }
    .modal_box .fechar{
        position: absolute;
        top: 168px;
        z-index: 999999999999;
        height: 24px;
        width: 54px;
        /*left: 581px;*/
        cursor: pointer;
    }
    .modal_box .cadastro{
        position: absolute;
        top: 352px;
        z-index: 999999999999;
        height: 65px;
        width: 280px;
        left: 308px;
        cursor: pointer;
    }

    #modal_banner{
        width: 420px;
        visibility: hidden;
    }
    #modal_banner .fechar{
        height: 20px;
        width: 75px;
        top: -10px;
        right: 0px;
        border-radius: 8px !important;
        background: #eee;
        text-align: center;
    }
    #modal_banner .cadastro{
        z-index: 9999999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
    }

    </style>

    <script type="text/javascript">
        // funcao prototipo que gera o html do modal
        jQuery.fn.extend({

            bannerModal: function() {
                html = '';
                html += '   <div class="modal_content" id="modal_banner">';
                html += '       <img class="img_modal" src="{{Config.HOST_ADMIN}}{{banner.imgurl}}">';
                html += '       <div class="fechar">Fechar [x]</div>';
                html += '       <a class="cadastro" href="{{banner.link}}" target="{{banner.target}}");">&nbsp;</a>';
                html += '   </div>';

                return this.html(html);
            }

        });
    </script>

    <script type="text/javascript">
        // cookie functions
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }
        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
            }
            return "";
        }
        //

        $(document).ready(function(){

            // start modal 
            $('.modal_box').bannerModal();

            /*
            // modal com cookies para travar mais de uma visualizacao
            if(getCookie("pageCorretor")!="<?php echo $_SERVER['SCRIPT_NAME']; ?>"){
                window.setTimeout(function(){

                    setCookie("pageCorretor", "<?php echo $_SERVER['SCRIPT_NAME']; ?>", 999);
                    $('.modal_box').bannerModal();
                    $('.modal_box').css("display","block");

                    $('#modal_banner .fechar').click(function(){
                        $('.modal_box').css("display","none");
                        $('body').css("overflow","visible");
                    });
                    $('.modal_box').click(function(){
                        $('.modal_box').css("display","none");
                        $('body').css("overflow","visible");
                    });                
                },30000);

            }
            */


            // verify modal existence
            $(".modal_content").html(function(){

                $(".img_modal").load(function(){
                    $(".modal_box").css("top", $(window).scrollTop());
                    $("#modal_banner").css("width", $(this).width());
                });

                // show modal
                $("#modal_banner").css("visibility","visible");
                $(".modal_box").css("display","block");

                // block body overflow
                $('body').css("overflow","hidden");


                // click actions
                $('.modal_box').click(function(){
                    $('.modal_box').animate({
                        opacity: 0
                    }, 500, function() {
                        // Animation complete.
                        $('.modal_box').css("display","none");
                        $('body').css("overflow","visible");
                    });
                });

                $('.modal_content .fechar').click(function(){
                    $('.modal_box').animate({
                        opacity: 0
                    }, 500, function() {
                        // Animation complete.
                        $('.modal_box').css("display","none");
                        $('body').css("overflow","visible");
                    });
                });

                // $('.modal_content .cadastro').click(function(){
                    // window.location = "";
                    // window.open('http://brhouse.mysuite1.com.br/clientvivo.php?param=sochat_ulg&inf=&sl=bhu&idm=&redirect=http://brhouse.mysuite1.com.br/empresas/bhu/atendimento.php');
                // });

            });

             
        });
    </script>    

    <div class="modal_box"></div>
{% endif %}