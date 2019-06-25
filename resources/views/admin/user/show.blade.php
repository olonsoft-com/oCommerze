@extends('admin.layout._layout')

@section('content')

<div class="top-menu">
      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-cubes"></i> Users</h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li><a href="{{ route('dashboard.user.create') }}"><i class="fa fa-edit"></i> Add new user</a></li>
              <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-users"></i> Users</a></li>
              <li><a href="{{ route('roles.index') }}"><i class="fa fa-bars"></i> Roles</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
            </ul>
      </div>
      <div class="clearfix"></div>
</div> 
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
        
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th>Name</th>
                  <td>{{ $user->name }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td>{{ ucwords( $user->gender ) }}</td>
                </tr>
                <tr>
                  <th>Date of Birth</th>
                  <td>{{ $user->dobDay . ' ' . $user->dobMonth . ' ' . $user->dobYear }}</td>
                </tr>
                <tr>
                  <th>Role</th>
                  <td>
                    @foreach( $user->roles as $role )
                      <span class="badge badge-info">{{ ucwords( str_replace('_', ' ', $role['name'] ) ) }}</span>
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>
                  <?php
                    switch ($user->status) {
                      case '1': echo '<button id="'.$user->id.'" class="btn btn-xs btn-default activate" role="2"><i class="fa fa-check"></i> Active</button>';
                        # code...
                        break;
                      case '0': echo '<button id="'.$user->id.'" class="btn btn-xs btn-default activate" role="1"><i class="fa fa-minus"></i> Pending</button>';
                        # code...
                        break;
                      default: echo '<button id="'.$user->id.'" class="btn btn-xs btn-default activate" role="1"><i class="fa fa-times"></i> Disabled</button>';
                        # code...
                        break;
                    }
                  ?>
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <td>
                    @if( $user->id != 1 )
                  <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a> | 
                  <a href="{{ route('dashboard.user.delete', $user->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Delete</a>
                  @endif
                  </td>
                </tr>
              </tbody>
            </table>

          <div class="pagination">
          </div>
          
          <div class="clearfix"></div>
        </div><!--/col-->
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