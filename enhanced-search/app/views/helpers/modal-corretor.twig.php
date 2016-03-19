{% if Corretor is null %} {% else %}
    <style>
    .modal_box_corretor{
        background: url('assets/img/bg_fade.png');
        position: absolute;
        top: 0;
        z-index: 99999;
        width: 100%;
        display: none;
    }
    .modal_box_corretor .modal_content{
        z-index: 9999;
        margin: 10% auto 75%;
        width: 675px;
        /*cursor: pointer;*/
        position: relative;
    }
    .modal_box_corretor .fechar{
        position: absolute;
        top: 168px;
        z-index: 999999999999;
        height: 24px;
        width: 54px;
        /*left: 581px;*/
        cursor: pointer;
    }
    .modal_box_corretor .cadastro{
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

    #modal_corretor{
        width: 480px;
        height: 540px;
        visibility: hidden;
        background: url('assets/img/bg_form_corretor.png') no-repeat;
    }
    #modal_corretor form{
        width: 80%;
        margin: 0 auto;
    }
    #modal_corretor form div{
        margin: 0 0 12px 0;
    }
    #modal_corretor form div label{
        padding: 0;
        margin-bottom: 0;
        font-size: 12px;
    }
    #modal_corretor form div input,
    #modal_corretor form div textarea{
        border: 0;
        background-color: #f1efed;
    }
    #modal_corretor form button{
        position: absolute;
        bottom: 38px;
        border-radius: 8px !important;
        font-weight: 800;
        padding: 10px 48px;
        right: 46px;
    }
    #modal_corretor form button:hover{
        background: #4b4b4b;
    }
    #modal_corretor .fechar{
        height: 20px;
        width: 75px;
        top: -10px;
        right: 0px;
        border-radius: 8px !important;
        background: #eee;
        text-align: center;
    }
    #modal_corretor .cadastro{
        position: absolute;
        bottom: 46px;
        top: inherit;
        left: 48px;
        z-index: 999999999999;
        height: auto; 
        width: auto; 
        cursor: pointer;
        background-color: #4b4b4b;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        padding: 6px 8px;
        border-radius: 8px !important;
    }    
    #modal_corretor .cadastro:hover{
        text-decoration: none;
        color: #e57630;
    }
    #modal_corretor .picture{
        background-size: 100%;
        background-repeat: no-repeat;
        border-radius: 50% !important;
        margin: 35px 10px 0 24px;
        float: left;
        height: 122px;
        width: 121px;        
    }
    #modal_corretor .corretor-info{
        float: left;
        color: #000;
        width: 200px;
        font-size: 16px;
        margin-left: 22px;
    }
    #modal_corretor .corretor-info.nome{
        margin-top: 100px;
        font-size: 20px;
        font-weight: 600;
    }
    #modal_corretor .corretor-info.email{
        margin-bottom: 18px;
    }
    </style>

    <script type="text/javascript">
        // funcao prototipo que gera o html do modal
        jQuery.fn.extend({

            corretorModal: function() {

                html = '';
                html += '   <div class="modal_content" id="modal_corretor">';
                html += '       <div class="picture" style="background-image: url(http://aqui.inforcecode.com.br/_custom/foto_pessoa/{{Corretor.pessoaid}}/{{Corretor.pessoaid}}.jpg)"></div>';
                html += '       <div class="corretor-info nome">{{Corretor.apelido}}</div>';
                html += '       <div class="corretor-info telefone">{{Corretor.telcelular}}</div>';
                html += '       <div class="corretor-info email">{{Corretor.email}}</div>';
                html += '       <form action="/contato/corretor/" method="POST">';
                html += '           <input data-value="contato" type="text" value="" name="{{Corretor.apelido}}">';
                html += '           <input data-value="contato" type="text" value="{{token}}" name="token">';
                html += '           <div class="col-md-6 col-lg-6"><label class="col-md-12 control-label" for="nome">Nome<span class="require">*</span></label><input type="text" name="nome" id="nw-nome" class="form-control" required></div>';
                html += '           <div class="col-md-6 col-lg-6"><label class="col-md-12 control-label" for="email">Email<span class="require">*</span></label><input type="text" name="email" id="nw-email" class="form-control" required></div>';
                html += '           <div class="col-md-6 col-lg-6"><label class="col-md-12 control-label" for="telresidencial">Telefone</label><input type="text" name="telresidencial" id="nw-telefone1" class="form-control input-telefone"></div>';
                html += '           <div class="col-md-6 col-lg-6"><label class="col-md-12 control-label" for="telcelular">Celular</label><input type="text" name="telcelular" id="nw-telefone1" class="form-control input-telefone"></div>';
                html += '           <div class="col-lg-12 div-textarea"><label class="col-md-12 control-label" for="mensagem">Mensagem<span class="require">*</span></label><textarea class="form-control" rows="6" name="mensagem" required></textarea></div>';
                html += '           <button class="btn btn-primary" type="submit">Enviar</button>';
                html += '       </form>';
                html += '       <div class="fechar">Fechar [x]</div>';
                html += '       <a class="cadastro" href="/corretor/limpar/">Desvincular Corretor</a>';
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

            // verify modal existence
            $(".modal_content").html(function(){

                $(".img_modal").load(function(){
                    $(".modal_box_corretor").css("top", $(window).scrollTop());
                    $("#modal_banner").css("width", $(this).width());
                });

                // show modal
                $("#modal_banner").css("visibility","visible");
                $(".modal_box_corretor").css("display","block");

                // block body overflow
                $('body').css("overflow","hidden");


                // click actions
                $('.modal_box_corretor').click(function(){
                    $('.modal_box_corretor').animate({
                        opacity: 0
                    }, 500, function() {
                        // Animation complete.
                        $('.modal_box_corretor').css("display","none");
                        $('body').css("overflow","visible");
                    });
                });

                $('.modal_content .fechar').click(function(){
                    $('.modal_box_corretor').animate({
                        opacity: 0
                    }, 500, function() {
                        // Animation complete.
                        $('.modal_box_corretor').css("display","none");
                        $('body').css("overflow","visible");
                    });
                });

                // $('.modal_content .cadastro').click(function(){
                    // window.location = "";
                    // window.open('http://brhouse.mysuite1.com.br/clientvivo.php?param=sochat_ulg&inf=&sl=bhu&idm=&redirect=http://brhouse.mysuite1.com.br/empresas/bhu/atendimento.php');
                // });

            });

            // abre modal do corretor
            $(".call-corretor").click(function(){
                // console.log("corretor");

                // dispara o clicke no topcontrol para ir para o topo
                $("#topcontrol").trigger("click");

                // start modal 
                $('.modal_box_corretor').corretorModal();                
                $('.modal_box_corretor').unbind('click');
                $('.modal_content .fechar').click(function(){
                    $('.modal_box_corretor').animate({
                        opacity: 0
                    }, 500, function() {
                        // Animation complete.
                        $('.modal_box_corretor').css("display","none");
                        $('body').css("overflow","visible");
                    });
                });

                // show modal
                $("#modal_corretor").css("visibility","visible");
                $(".modal_box_corretor").css("display","block");
                $(".modal_box_corretor").css("opacity","1");

                // block body overflow
                $('body').css("overflow","hidden");                

                $("input[data-value='contato']").each(function(){
                    $(this).css("display","none");
                });

            });
            
        });
    </script>    

    <div class="modal_box_corretor"></div>
{% endif %}