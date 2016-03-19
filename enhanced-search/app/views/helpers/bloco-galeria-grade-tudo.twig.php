    <!-- BEGIN BRANDS X-->
        {% if (content.descricao != "") or (content.array_imgs | length > 0) %}
        <div class="brands {{content.template}}">
          <h2>{{content.titulo|convert_encoding('UTF-8','iso-8859-1')}}</h2>
            <div class="container">
                <div class="descricao">
                    {{content.descricao|raw}}
                </div>
                <div class="row product-list">
                    {% for key, entry in content.array_imgs %}
                        <div class="produto-item col-md-3 col-sm-4 col-xs-6 item-index-{{key}}">                        
                            <div class="product-item">
                                <a href="shop-product-list.html">
                                    <div class="pi-img-wrapper">
                                        <img src="{{entry.imgurl}}" alt="{{entry.descricao}}" title="{{entry.descricao}}" class="img-responsive" style="height: auto">
                                        <div>
                                            <a href="{{entry.imgurl}}" class="btn btn-default fancybox-button">Zoom</a>
                                        </div>
                                    </div>
                                    <div class="pi-info-wrapper">
                                        <h3>{{entry.descricao}}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    {% endfor %}
                </div>
            </div>            
        </div>
        {% endif %}
    <!-- END BRANDS -->