      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-cubes"></i> <?php echo $title; ?></h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li><a href="<?php echo site_url('dashboard/options/'); ?>"><i class="fa fa-wrench"></i> Options</a></li>
            </ul>
      </div>
      <div class="clearfix border-top"></div>

      <div class="row"><!-- center left-->  
        <div class="col-sm-9 content">

          
                   <?=form_open(site_url('dashboard/user/permission'), 'class="general-settings"'); ?>
        <div class="col-md-12">
            <?php
                $user_add = $auths[0]->auth;
                $user_edit = $auths[1]->auth;
                $user_delete = $auths[2]->auth;
                $category_add = $auths[3]->auth;
                $category_edit = $auths[4]->auth;
                $category_delete = $auths[5]->auth;
                $product_add = $auths[6]->auth;
                $product_edit = $auths[7]->auth;
                $product_delete = $auths[8]->auth;
                $order_add = $auths[9]->auth;
                $order_edit = $auths[10]->auth;
                $order_delete = $auths[11]->auth;
                $page_add = $auths[12]->auth;
                $page_edit = $auths[13]->auth;
                $page_delete = $auths[14]->auth;
            ?>
        
                <table class="table">
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th>Add Permission</th>
                            <th>Edit Permission</th>
                            <th>Delete Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Users</th>
                            <td>
                                <?php
                                $auths = array(1=>'User', 3=>'Editor', 5=>'Modarator', 7=>'Admin', 9=>'Administrator');
                                echo form_dropdown('user_add', $auths, $this->input->post('user_add') ? $this->input->post('user_add') : $user_add, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('user_edit', $auths, $this->input->post('user_edit') ? $this->input->post('user_edit') : $user_edit, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('user_delete', $auths, $this->input->post('user_delete') ? $this->input->post('user_delete') : $user_delete, 'class="form-control authentication"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>
                                <?php
                                echo form_dropdown('category_add', $auths, $this->input->post('category_add') ? $this->input->post('category_add') : $category_add, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('category_edit', $auths, $this->input->post('category_edit') ? $this->input->post('category_edit') : $category_edit, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('category_delete', $auths, $this->input->post('category_delete') ? $this->input->post('category_delete') : $category_delete, 'class="form-control authentication"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Products</th>
                            <td>
                                <?php
                                echo form_dropdown('product_add', $auths, $this->input->post('product_add') ? $this->input->post('product_add') : $product_add, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('product_edit', $auths, $this->input->post('product_edit') ? $this->input->post('product_edit') : $product_edit, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('product_delete', $auths, $this->input->post('product_delete') ? $this->input->post('product_delete') : $product_delete, 'class="form-control authentication"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Orders</th>
                            <td>
                                <?php
                                echo form_dropdown('order_add', $auths, $this->input->post('order_add') ? $this->input->post('order_add') : $order_add, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('order_edit', $auths, $this->input->post('order_edit') ? $this->input->post('order_edit') : $order_edit, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('order_delete', $auths, $this->input->post('order_delete') ? $this->input->post('order_delete') : $order_delete, 'class="form-control authentication"');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Pages</th>
                            <td>
                                <?php
                                echo form_dropdown('page_add', $auths, $this->input->post('page_add') ? $this->input->post('page_add') : $page_add, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('page_edit', $auths, $this->input->post('page_edit') ? $this->input->post('page_edit') : $page_edit, 'class="form-control authentication"');
                                ?>
                            </td>
                            <td>
                                <?php
                                echo form_dropdown('page_delete', $auths, $this->input->post('page_delete') ? $this->input->post('page_delete') : $page_delete, 'class="form-control authentication"');
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?=form_close(); ?>

<script type="text/javascript">
  $(function(){
    $('.authentication').on('change', function(){
      var component = $(this).attr('name');
      var auth = $(this).val();
      var url = "<?=site_url('dashboard/ajax/update_permission'); ?>/?component="+component+"&auth="+auth;
      $.ajax({
        type: "get",
        url: url,
        success: function(msg){
          if(msg == 'ok'){
                  $('.global-error').hide();
                  $('.global-success').show();
                  $('.global-success').delay( 1000 ).fadeOut( 800 );
                    }else{
                  $('.global-success').hide();
                  $('.global-error').show();
                  $('.global-error').delay( 1000 ).fadeOut( 800 );
                    }
        }
      });
    });
  });
</script>
          
          <div class="clearfix"></div>
        </div><!--/col-->
        <div class="col-sm-3">
          
          <div class="" style="position: relative;">
            <h3>Attention please!!!</h3> 
              
            <hr>
              
            <div class="alert alert-info">
              You are not eligible to delete any packeges because a packeges has linked to many customer account. but you can edit / modify packege value or price as well.
            </div>
            <div class="alert alert-warning">
              So, you have to be carefull about creating packeges and modification.
            </div>
              
            <hr>
              
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>