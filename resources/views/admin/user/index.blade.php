@extends('admin.layout._layout')

@section('content')

<div class="top-menu">
      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-user-secret"></i> {{ $title }}</h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li><a href="{{ route('dashboard.user.create', ['type' => Request::segment(2)]) }}"><i class="fa fa-plus"></i> Add new</a></li>
              <li><a href="{{ route('roles.index') }}"><i class="fa fa-user-tag"></i> Roles</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
              <li class="active"><a href="#"><i class="fa fa-user-secret"></i> Administrators</a></li>
            </ul>
      </div>
      <div class="clearfix"></div>
</div>
        <div class="col-sm-12">
        <div class="clearfix"></div>
          
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Counter</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if(count($users)): foreach($users as $user): ?> 
              <tr>
                <td>{{ $user->name }}</td>
                <td><a href="{{ route('dashboard.user.show', $user->id) }}">{{ $user->email }}</a></td>
                <td>
                  {{ $user->counter }}
                </td>
                <td>
                  @foreach( $user->roles as $role )
                    <span class="badge badge-info">{{ ucwords( str_replace('_', ' ', $role['name'] ) ) }}</span>
                  @endforeach
                </td>
                <td id="'.$user->id.'">
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
                <td>
                  <a href="{{ route('dashboard.user.show', $user->id) }}" class="btn btn-xs btn-default"><i class="fa fa-eye"></i> View</a>
                  @if( $user->id != 1 )
                  <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                  <form action="{{ route('dashboard.user.delete', $user->id) }}" method="POST" class="form-inline" style="display: inline-block;">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger form-inline"><i class="fa fa-times"></i> Delete</button>
                  </form>
                  @endif
                </td>
              </tr>
              <?php endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="4">We could not find any users.</td>
              </tr>
              <?php endif; ?> 
              </tbody>
            </table>

          <div class="pagination">
          </div>
          
          <div class="clearfix"></div>
        </div><!--/col-->
        <div class="clearfix"></div>
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