@extends('admin.layout._layout')

@section('content')
<div class="top-menu">
<!-- column 2 --> 
<div class="col-sm-5">
 <h3><i class="fa fa-wrench"></i> Permissions</h3>  
</div>
<div class="col-sm-7">
  <ul class="nav nav-pills pull-right page-top-navigation">
    <li><a href="{{ route('dashboard.permissions.create') }}"><i class="fa fa-plus"></i> Add new</a></li>
    <li><a href="{{ route('roles.index') }}"><i class="fa fa-user-tag"></i> Roles</a></li>
    <li class="active"><a href="#"><i class="fa fa-wrench"></i> Permissions</a></li>
    <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-user-secret"></i> Administrators</a></li>
  </ul>
</div>
<div class="clearfix"></div>
</div>
<div class="box">
    @foreach( $permissions as $key => $lists )
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 box-item">

      <div class="box-part">
        <div class="title">
          <h4><i class="fa fa-cog"></i> {{ ucfirst( $key ) }}</h4>
        </div>

        <div class="text">
          @foreach( $lists as $list )
            <div class="form-check">
              <label>
                <!-- <input type="checkbox" name="check" value="" checked>  --><span class="label-text">{{ $list->name }}</span>
              </label>
            </div>
          @endforeach
        </div>

      </div>
    </div>
    @endforeach

</div>
@endsection

@section('header')
<style type="text/css">

</style>
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