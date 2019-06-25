@extends('admin.layout._layout')

@section('content')
@php $type = ( isset( $_GET['type'] ) && $_GET['type'] != '') ? $_GET['type'] : 'user'; @endphp
<div class="top-menu">
      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-plus"></i> Add new {{ $type }}</h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li class="active"><a href="#"><i class="fa fa-plus"></i> Add new</a></li>
              <li><a href="{{ route('roles.index') }}"><i class="fa fa-user-tag"></i> Roles</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
              <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-user-secret"></i> Administrators</a></li>
            </ul>
      </div>
      <div class="clearfix"></div>
</div>
      <form action="{{ route('dashboard.user.store') }}" method="POST" accept="utf8">
        @csrf
        <div class="col-sm-7 pt-3">
            <!-- <h4>Personal Info</h4><hr /> -->
            <div class="form-group">
              <label form="">Name</label>
              <div class="input-group @if($errors->has('name')) ? form-error @endif">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" name="name" value="{{old('name')}}" placeholder="Your Name" class="form-control">
              </div>
              @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <label form="">Email Address</label>
              <div class="input-group @if($errors->has('email')) ? form-error @endif">
                <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email" name="email" value="{{old('email')}}" placeholder="Your Email" class="form-control">
              </div>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>

            <!-- <div class="form-group">
              <label form="">Date of Birth</label><br />
              <div class="row">
                <div class="col-sm-4">
                  <input type="text" name="dobDay" placeholder="Your Email" class="form-control">
                </div>
                <div class="col-sm-4">
                  <input type="text" name="dobDay" placeholder="Your Email" class="form-control">
                </div>
                <div class="col-sm-4">
                  <input type="text" name="dobDay" placeholder="Your Email" class="form-control">
                </div>
                <div class="clearfix"></div>
              </div>
            </div> -->

            <div class="form-group">
              <label form="">Counter Number</label>
              <div class="input-group @if($errors->has('counter')) ? form-error @endif">
                <span class="input-group-addon">
                  <i class="fa fa-circle-o"></i>
                </span>
                <input type="number" name="counter" value="{{old('counter')}}" placeholder="Counter number" class="form-control">
              </div>
                <!-- <select name="gender" class="form-control">
                  <option value="">Select gender</option>
                  <option value="male" selected="<?php echo ( isset( $_POST['gender'] ) && $_POST['gender'] == 'male') ? 'selected' : ''; ?>">Male</option>
                  <option value="female" selected="<?php echo ( isset( $_POST['gender'] ) && $_POST['gender'] == 'female') ? 'selected' : ''; ?>">Female</option>
                </select> -->
              @if ($errors->has('counter'))
                <span class="help-block">
                  <strong>{{ $errors->first('counter') }}</strong>
                </span>
              @endif
            </div>
          
          <div class="clearfix"></div>
        </div><!--/col-->
        <div class="col-sm-5">
          
          <div class="" style="position: relative;">
            <!-- <h4>Login credentials</h4><hr> -->

            <div class="form-group">
              <label form="">Roles</label>
              <div class="input-group @if($errors->has('role')) ? form-error @endif">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <select name="role" class="form-control">
                  <option value="">Select Role</option>
                  <option value="1"  {{ (old("role") == 1 ? "selected":"") }}>Super Admin</option>
                  <option value="2"  {{ (old("role") == 2 ? "selected":"") }}>Admin</option>
                  <option value="3"  {{ (old("role") == 3 || $type == 'artist') ? "selected" : "" }}>Artist</option>
                </select>
              </div>
              @if ($errors->has('role'))
                <span class="help-block">
                  <strong>{{ $errors->first('role') }}</strong>
                </span>
              @endif
            </div>
              
            <div class="form-group">
              <label form="">Password</label>
              <div class="input-group @if($errors->has('password')) ? form-error @endif">
                <span class="input-group-addon">
                    <i class="fa fa-circle"></i>
                </span>
                <input type="password" name="password" placeholder="Password" class="form-control">
              </div>
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <label form="">Confirm Password</label>
              <div class="input-group @if($errors->has('password_confirm')) ? form-error @endif">
                <span class="input-group-addon">
                    <i class="fa fa-circle"></i>
                </span>
                <input type="password" name="password_confirm" placeholder="Password" class="form-control">
              </div>
              @if ($errors->has('password_confirm'))
                <span class="help-block">
                  <strong>{{ $errors->first('password_confirm') }}</strong>
                </span>
              @endif
            </div>
              
            <hr>
              
            <div class="form-group">
              <button type="submit" class="btn btn-lg btn-primary btn-block">Create user</button>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      </form>
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