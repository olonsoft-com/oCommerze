      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-cubes"></i> <?php echo $title; ?></h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li><a href="dashboard/options/permission"><i class="fa fa-cog"></i> Manage permission</a></li>
            </ul>
      </div>
      <div class="clearfix border-top"></div>

      <div class="row"><!-- center left-->  
        <div class="col-sm-9 content">

          <div class="col-xs-12 bhoechie-tab-container">
            <div class="col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item <?php if(!isset($_GET['tab']) || $_GET['tab']=='general') echo 'active'; ?> text-center">
                  <h4 class="fa fa-home"></h4><br/>General
                </a>
                <a href="#" class="list-group-item <?php if(isset($_GET['tab']) && $_GET['tab']=='contact') echo 'active'; ?> text-center">
                  <h4 class="fa fa-road"></h4><br/>Contact
                </a>
                <a href="#" class="list-group-item <?php if(isset($_GET['tab']) && $_GET['tab']=='seo') echo 'active'; ?> text-center">
                  <h4 class="fa fa-binocular"></h4><br/>SEO
                </a>
                <a href="#" class="list-group-item <?php if(isset($_GET['tab']) && $_GET['tab']=='header') echo 'active'; ?> text-center">
                  <h4 class="fa fa-image"></h4><br/>Headers
                </a>
                <a href="#" class="list-group-item <?php if(isset($_GET['tab']) && $_GET['tab']=='footer') echo 'active'; ?> text-center">
                  <h4 class="fa fa-code"></h4><br/>Footer
                </a>
                <a href="#" class="list-group-item <?php if(isset($_GET['tab']) && $_GET['tab']=='social') echo 'active'; ?> text-center">
                  <h4 class="fa fa-facebook"></h4><br/>Social
                </a>
                <a href="#" class="list-group-item <?php if(isset($_GET['tab']) && $_GET['tab']=='payment') echo 'active'; ?> text-center">
                  <h4 class="fa fa-credit-card"></h4><br/>Payment Gateway
                </a>
              </div>
            </div>
            <div class="col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content <?php if(!isset($_GET['tab']) || $_GET['tab']=='general') echo 'active'; ?>">
                    <!-- General Tab-->
                    <h2>General Options</h2>
                    <?php //$this->load->view('admin/options/general'); ?>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content <?php if(isset($_GET['tab']) && $_GET['tab']=='contact') echo 'active'; ?>">
                    <!-- Contact & About Tab-->
                    <h2>Contact Details</h2>
                    <?php //$this->load->view('admin/options/contact'); ?>
                </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content <?php if(isset($_GET['tab']) && $_GET['tab']=='seo') echo 'active'; ?>">
                    <!--SEO TAB-->
                    <h2>SEO Settings</h2>
                    <?php //$this->load->view('admin/options/seo'); ?>
                </div>
                <div class="bhoechie-tab-content <?php if(isset($_GET['tab']) && $_GET['tab']=='header') echo 'active'; ?>">
                    <!--Header Tab-->
                    <h2>Header Options</h2>
                    <?php //$this->load->view('admin/options/header'); ?>
                </div>
                <div class="bhoechie-tab-content <?php if(isset($_GET['tab']) && $_GET['tab']=='footer') echo 'active'; ?>">
                    <!--Footer Tab-->
                    <h2>Footer Options</h2>
                    <?php //$this->load->view('admin/options/footer'); ?>
                </div>
                <div class="bhoechie-tab-content <?php if(isset($_GET['tab']) && $_GET['tab']=='social') echo 'active'; ?>">
                    <!--Social setings Tab-->
                    <h2>Social Options</h2>
                    <?php //$this->load->view('admin/options/social'); ?>
                </div>
                <div class="bhoechie-tab-content <?php if(isset($_GET['tab']) && $_GET['tab']=='payment') echo 'active'; ?>">
                    <!--Social setings Tab-->
                    <h2>Payment Gateway settings</h2>
                    <?php //$this->load->view('admin/options/payment'); ?>
                </div>
              </div>
          </div>
          
          <div class="clearfix"></div>
        </div><!--/col-->
        <div class="col-sm-3">
          
          <div class="" style="position: relative;">
            <h3>Attention please!!!</h3> 
              
            <hr>
              
            <div class="alert alert-info">
              You have to fullfill mandatory options which marked by (*). So before using this billing software fillup the mandatory fields.
            </div>
            <div class="alert alert-warning">
              So, you have to be carefull about mandatory fields.
            </div>
              
            <hr>
              
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>

<script type='text/javascript'>
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>