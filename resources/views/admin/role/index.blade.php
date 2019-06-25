@extends('admin.layout._layout')

@section('content')
<div class="top-menu">

      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-user-tag"></i> Roles</h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li><a href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Add new</a></li>
              <li class="active"><a href="#"><i class="fa fa-user-tag"></i> Roles</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
              <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-user-secret"></i> Administrators</a></li>
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

  <tr>

     <th>No</th>

     <th>Name</th>

     <th width="280px">Action</th>

  </tr>

    @foreach ($roles as $key => $role)

    <tr>

        <td>{{ ++$i }}</td>

        <td>{{ ucwords( str_replace('_', ' ', $role->name ) ) }}</td>

        <td>

            <a class="btn btn-xs btn-default" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"></i> Show</a>

            @can('role-edit')

                <a class="btn btn-xs btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-edit"></i> Edit</a>

            @endcan

            @can('role-delete')

              <form action="{{ route('roles.delete', $role->id) }}" method="POST" style="display: inline-block;">
                @csrf
                {{ method_field('DELETE')}}
                <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Delete</button>
              </form>

            @endcan

        </td>

    </tr>

    @endforeach

</table>

          <div class="pagination">
          </div>
          
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