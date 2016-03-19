    <!-- BEGIN BRANDS -->
        {% if (content.descricao != "") or (content.array_imgs | length > 0) %}
        <div class="brands galeria-grade-obra">
            <h4>{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}
                <select name="ano-fotos" id="ano-fotos">
                    <option id="0" value="" >Selecione o ano</option>
                    {% for i in ("now"|date("Y"))..2010 %}
                    <option id="{{i}}" value="{{i}}">{{i}}</option>
                    {% endfor %}
                </select>
                <script>$('#ano-fotos').on('change',function(){  
                    var anoSelect = $(this).val();

                    if (anoSelect > 0){                        
                        $(".product-list .product-item").css("display","none");
                        $(".product-list .product-item").each(function(){
                            var eleAno = $(this).attr("data-image-ano");
                            if(anoSelect==eleAno){
                                $(this).css("display","block");                            
                            }
                        });
                    }else{
                        $(".product-list .product-item").css("display","block");
                    }
                });</script>

            </h4>
            <div class="descricao">{{content.descricao|raw}}</div>
            <div class="row product-list">
                {% for key, entry in content.array_imgs %}
                    <div class="product-item col-md-2 col-sm-2 col-sm-2 item-index-{{key}}" data-image-ano="{{entry.ano}}" data-image-mes="{{entry.mes}}">
                        <a href="#">
                            <div class="pi-img-wrapper" style="background: url('{{entry.imgurl}}')">
                                <img src="{{entry.imgurl}}" alt="{{entry.descricao}}" title="{{entry.descricao}}" class="img-responsive" style="visibility:hidden;">
                                <div><a href="{{entry.imgfullurl}}" class="btn btn-default btn-zoom fancybox-button"><i class="fa fa-search-plus"></i></a></div>
                            </div>
                            <div class="pi-info-wrapper"><h5>{{entry.descricao|convert_encoding('UTF-8','iso-8859-1')}}</h5></div>
                        </a>
                    </div>
                {% endfor %}
            </div>
        </div>
        {% endif %}
    <!-- END BRANDS -->