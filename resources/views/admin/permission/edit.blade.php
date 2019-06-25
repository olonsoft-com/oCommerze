@extends('admin.layout._layout')

@section('content')

      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-key"></i> Edit Permission</h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
            <li><a href="{{ route('dashboard.permissions.create') }}"><i class="fa fa-plus"></i> Add new</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-cog"></i> Permissions</a></li>
              <li><a href="{{ route('roles.index') }}"><i class="fa fa-bars"></i> Roles</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
        </ul>
      </div>
      <div class="clearfix border-top"></div>

      <div class="row"><!-- center left-->  
        <div class="col-sm-12">
          <?php
            if(isset($_GET['action'])) :
              if($_GET['action']=='true') :
                echo '
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Your request has been accepted.
                  </div>
                ';
              else :
                echo '
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Sorry!</strong> Your request cannot be processed.
                  </div>
                ';
              endif;
            endif;
          ?>
        <div class="clearfix"></div>
          
            
            
        <form action="{{ route('dashboard.permissions.update', $permission->id) }}" method="POST">
        {{ method_field('PUT') }}
        @csrf
        <div class="form-group">
            <label>Permission Name</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="form-control">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Edit Permission</button>

        </form>

          <div class="pagination">
          </div>
          
          <div class="clearfix"></div>
        </div><!--/col-->
        <div class="clearfix"></div>
      </div>
@endsection


@section('footer')
<script type="text/javascript">
$(function(){
  $('.activate').click(function(){
    var role = $(this).attr('role');
    if(role ==1){
      $(this).html('<i class="fa fa-check"></i> Active');
    }else{
      $(this).html('<i class="fa fa-ban"></i> Disabled');
    }
    var id = $(this).attr('id');
    var url = "dashboard/ajax/user_activate/"+id+"/"+role;
    $.get(url, function(msg){
      if(msg == 'ok'){
          alert($ok);
            
            $('.global-error').hide();
            $('.global-success').show();
            $('.global-success').delay( 1000 ).fadeOut( 800 );
          }else{
            $('.global-success').hide();
            $('.global-error').show();
            $('.global-error').delay( 1000 ).fadeOut( 800 );
          }
    });
    return false;
  });
});
</script>
@endsection