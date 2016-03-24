          <!-- BEGIN CONTENT -->
          <div class="col-md-6 col-sm-6">
            <div class="content-block">
              {% if block.title is defined %}
              <h3>{{block.title}}</h3>
              {% endif %}
              <div class="body-block">{{block.content}}</div>
            </div>
          </div>
          <!-- END CONTENT -->