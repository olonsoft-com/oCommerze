@extends('admin.layout._layout')

@section('content')

<!-- column 2 --> 
<div class="col-sm-5">
   <h3><i class="fa fa-edit"></i> {{ $title }}</h3>  
</div>
<div class="col-sm-7">
  <ul class="nav nav-pills pull-right page-top-navigation">
    <li><a href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Add new</a></li>
    <li><a href="{{ route('roles.index') }}"><i class="fa fa-user-tag"></i> Roles</a></li>
    <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
    <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-wrench"></i> Users</a></li>
</ul>
</div>
<div class="clearfix border-top"></div>

<div class="box">
  <!-- Validation errors -->
            @if( count( $errors ) )
            <div class="alert alert-warning"> 
            @foreach( $errors->all() as $error )
              <p>{{ $error }}</p>
            @endforeach
            </div>
            @endif
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label>Role name</label>
            <input type="text" name="name" value="{{ $role->name }}" class="form-control" style="margin-bottom: 25px;">
        </div>
        <div class="row">
            @foreach( $permissions as $key => $lists )
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 box-item" id="permissionParent">

              <div class="box-part">
                <div class="title">
                  <h4><input type="checkbox" class="checkedAll" id="{{ $key }}"> {{ ucfirst( $key ) }}</h4>
              </div>

              <div class="text">
                  @foreach( $lists as $list )
                  <div class="form-check">
                      <label>
                        <input type="checkbox" class="checkedItem {{ $key }}" name="permission[]" value="{{ $list->id }}" @if( in_array($list->id, $rolePermissions) ) checked @endif> <span class="label-text">{{ ucwords( str_replace('-', ' ', $list->name ) ) }}</span>
                    </label>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    @endforeach

</div>
        <div class="form-group">
            <button class="btn btn-primary pull-right" type="submit">Update role</button>
        </div>
</form>
</div>
@endsection

@section('header')
<style type="text/css">

</style>
@endsection

@section('footer')
<script type="text/javascript">
  $(function(){
    $('.checkedAll').click(function(event) {
      var parent = $(this).parents('#permissionParent');
      console.log(parent);
      if( $(this).is(':checked') ) {
        $(parent).find('.checkedItem').prop('checked', true);
      } else {
        $(parent).find('.checkedItem').prop('checked', false);
      }
    });
  });
</script>
@endsection