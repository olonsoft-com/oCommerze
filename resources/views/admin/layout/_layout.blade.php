<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>LaraBills</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
    <link href="{{ asset('admin/assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/custom.css') }}" rel="stylesheet">
    
    <!-- script references -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    @yield('header')
	</head>
	<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="{{ route('dashboard.index') }}">ControlPanel</a>
    </div>
    <div class="navbar-collapse collapse">
      <a href="#menu-toggle" class="btn" id="menu-toggle"><i class="fa fa-th"></i></a>
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
            <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">
            <li><a href="{{ route('dashboard.user.profile') }}"><i class="fa fa-user"></i> My Profile</a></li>
            <li><a href="{{ route('dashboard.user.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container" style="margin-top: 50px;">
  
  <!-- upper section -->
  <div id="wrapper">
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav" id="menu">

        <li>
            <a href="{{ route('dashboard.index') }}" style="background: whitesmoke;border-bottom: 1px solid khaki;">
            <i class="fa fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        @can('customer-list')
        <li @if(in_array(Request::segment(2), ['customer', 'area'])) class="active" @endif>
          <a href="{{ route('dashboard.customer.index') }}"><i class="fa fa-user"></i> Customers</a>
          <ul id="menu" @if(in_array(Request::segment(2), ['customer', 'area'])) style="display:block" @endif>
            @can('customer-create')
            <li>
              <a href="{{route('dashboard.customer.create')}}">
                <i class="fa fa-plus"></i> Add new
              </a>
            </li>
            @endcan
            <li>
              <a href="{{route('dashboard.customer.index')}}">
                <i class="fa fa-user"></i> Customers
              </a>
            </li>
            @can('package-list')
            <li>
              <a href="{{ route('dashboard.package.index') }}">
                <i class="fa fa-tag"></i> Packages
              </a>
            </li>
            @endcan
            @can('area-list')
            <li>
              <a href="{{ route('dashboard.area.index') }}">
                <i class="fa fa-code-branch"></i> Areas
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan

        @php //if(Gate::check('customer-list') || Gate::check('permission2')) @endphp

        <li  @if(in_array(Request::segment(2), ['billing', 'payment'])) class="active" @endif><a href="{{ route('dashboard.billing.index') }}"><i class="fa fa-shopping-cart"></i> Billings</a>
          <ul id="menu" @if(in_array(Request::segment(2), ['billing', 'payment'])) style="display:block" @endif>
            <li>
              <a href="{{route('dashboard.billing.index')}}">
                <i class="fa fa-star"></i> Summary
              </a>
            </li>
            <li>
              <a href="{{route('dashboard.payment.index')}}">
                <i class="fa fa-money-bill-alt"></i> Payments
              </a>
            </li>
          </ul>
        </li>
        <li  @if(Request::segment(2) == 'report') class="active" @endif><a href="{{ route('dashboard.support.index') }}"><i class="fa fa-chart-bar"></i> Reports</a>
          <ul id="menu" @if(Request::segment(2) == 'report') style="display:block" @endif>
            <li>
              <a href="{{route('dashboard.report.index')}}">
                <i class="fa fa-info"></i> Billing reports
              </a>
            </li>
            <li>
              <a href="{{route('dashboard.report.index')}}">
                <i class="fa fa-info"></i> Payment reports
              </a>
            </li>
            <li>
              <a href="{{route('dashboard.report.index')}}">
                <i class="fa fa-info"></i> Customer reports
              </a>
            </li>
          </ul>
        </li>
        <li  @if(Request::segment(2) == 'support') class="active" @endif><a href="{{ route('dashboard.support.index') }}"><i class="fa fa-comments"></i> Supports</a>
          <ul id="menu" @if(Request::segment(2) == 'support') style="display:block" @endif>
            <li>
              <a href="{{route('dashboard.support.create')}}">
                <i class="fa fa-plus"></i> Add new
              </a>
            </li>
            <li>
              <a href="{{route('dashboard.support.index')}}">
                <i class="fa fa-bars"></i> Tickets
              </a>
            </li>
          </ul>
        </li>
        @hasanyrole('super_admin|admin')
        <li @if( in_array( Request::segment(2), ['user', 'role', 'permission', 'option'])) class="active" @endif><a href="#"><i class="fa fa-cog"></i> Manage</a>
          <ul id="menu" @if( in_array( Request::segment(2), ['user', 'role', 'permission', 'option'])) style="display:block" @endif>
            @can('user-list')
            <li>
              <a href="{{ route('dashboard.user.index') }}">
                <i class="fa fa-user-secret"></i> Administrators
              </a>
            </li>
            @endcan
            @can('permission-list')
            <li>
              <a href="{{ route('dashboard.permissions.index') }}">
                <i class="fa fa-wrench"></i> Permissions
              </a>
            </li>
            @endcan
            @can('role-list')
            <li>
              <a href="{{ route('roles.index') }}">
                <i class="fa fa-user-tag"></i> Roles
              </a>
            </li>
            @endcan
            @role('super_admin')
            <li>
              <a href="{{ route('dashboard.option.index') }}">
                <i class="fa fa-star"></i> Options
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endrole
        <li><a href="{{ route('dashboard.user.logout') }}"><i class="fa fa-power-off"></i> Logout</a><li>
        @role('artist')
        <li><a href="{{ route('dashboard.serve') }}"><button class="btn btn-warning" style="height: 15rem; width: 90%; margin-top: 4rem;">Serve Now</button> </a><li>
          @endrole
      </ul>
  	</div><!-- /span-3 -->
    <div id="page-content-wrapper">
        @if(session()->has('message.label'))
            <div class="global-message alert alert-{{ session('message.label') }}" role="alert">
               <strong>@if( session('message.label') == 'success' ) Success @else Failed @endif</strong> 
               {!! session('message.content') !!}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
          @endif
      <div class="row">
         @yield('content')
      </div>
         
  	</div><!--/col-span-9-->
    <footer class="text-center">
      <div class="col-sm-6">
        All rights reserved &reg; <a href="/" target="_blank">Rajtika</a>
      </div>
      <div class="">
        Developer - Jewel Rana
      </div>
      <div class="clearfix"></div>
    </footer>
  </div><!--/Wrapper-->
  <!-- /upper section -->
  </div>


<div class="modal" id="addWidgetModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Widget</h4>
      </div>
      <div class="modal-body">
        <p>Add a widget stuff here..</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dalog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Widget</h4>
      </div>
      <div class="modal-body">
        <p>Add a widget stuff here..</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-sm">Save changes</a>
      </div>
    </div>
  </div>
</div>

<?php if(isset($_GET['action']) || isset($_GET['permission'])) : ?>
      <script type="text/javascript">
        $(function(){
          var permission = "<?php echo $_GET['permission']; ?>";
          var action = "<?=$_GET['action']; ?>";
          if(action == 'true'){
            $('.global-error').hide();
            $('.global-success').show();
            $('.global-success').delay( 3000 ).fadeOut( 500 );
          }else{
            $('.global-success').hide();
            $('.global-error').show();
            $('.global-error').delay( 3000 ).fadeOut( 500 );
          }

          if(permission =='no'){
            $('.global-success').hide();
            $('.global-error').show();
            $('.global-error').delay( 3000 ).fadeOut( 500 );
          }



        });
      </script>
    <?php endif; ?>
  
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/sidebar-menu.js') }}"></script>
  <?php if('test' =='page' && 'test'=='edit') : ?>
    <script src="{{ asset('admin/assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/ckeditor/samples/js/sample.js') }}"></script>
  <?php endif; ?>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
  $('#MybtnModalPreventScript').click(function(){
      $('#MymodalPreventScript').modal({
        backdrop: 'static',
        keyboard: false
    });
  });
});
</script>
@yield('footer')
	</body>
</html>