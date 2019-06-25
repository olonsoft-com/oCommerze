<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">

    <title>Larabills</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/font-awesome/css/all.css') }}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/dataTable/datatables.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  </head>

  <body>
    <?php /*
    if( isset( $_GET['action'] ) ) : 
      echo '<div class="global-message">';
      if( $_GET['action'] == 'true' ) :
        echo '<div class="alert alert-success global-success alert-dismissible fade show" role="alert">Your action successfully taken.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></div>';
      else :
        $errorMsg = 'Sorry! Cannot take action.';
        if( isset( $_GET['code'] ) && $_GET['code'] == 500 ) :
          $errorMsg = 'Sorry! you have no permission to access this page.';
        elseif( $_GET['code'] == 404 ) :
          $errorMsg = 'Sorry! Item not found.';
        endif;
        echo '<div class="alert alert-danger global-error alert-dismissible fade show" role="alert">' . $errorMsg . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></div>';
      endif;
      echo '</div>';
    endif; */
    ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard">Larabills</a>
      <a href="#menu-toggle" class="btn" id="menu-toggle"><i class="fa fa-th"></i></a>
      <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Guest</a>
        </li>
        <li class="nav-item text-nowrap">
          <a class="nav-link" href=""><i class="fa fa-sign-out-alt"></i> Sign Out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-md-block bg-light sidebar" id="sidebarMenu">
          @include('admin.elements.nav')
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10" id="main">
          @yield('content')
        </main>
      </div>
    </div>

    <!-- Modal
    ================================================== -->
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script>window.jQuery || document.write('<script src="{{ asset('assets/js/jquery-slim.min.js') }}"><\/script>')</script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    @yield('footer')
  </body>
</html>