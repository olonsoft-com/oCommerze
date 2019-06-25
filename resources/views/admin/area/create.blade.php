@extends('admin.layout._layout')

@section('content')
<div class="top-menu">
    <!-- column 2 --> 
    <div class="col-sm-5">
     <h3><i class="fa fa-plus"></i> {{ $title }}</h3>  
 </div>
 <div class="col-sm-7">
  <ul class="nav nav-pills pull-right page-top-navigation">
    <li class="active"><a href="#"><i class="fa fa-plus"></i> Add new</a></li>
    <li><a href="{{ route('dashboard.customer.index') }}"><i class="fa fa-user"></i> Customers</a></li>
    <li><a href="{{ route('dashboard.request.index') }}"><i class="fa fa-random"></i> Requests <span class="badge @if( $count ) badge-info @endif">{{ $count }}</span></a></li>
    <li><a href="{{ route('dashboard.package.index') }}"><i class="fa fa-sitemap"></i> Packages</a></li>
    <li><a href="{{ route('dashboard.area.index') }}"><i class="fa fa-code-branch"></i> Areas</a></li>
</ul>
</div>
<div class="clearfix"></div>
</div>

<div class="col-sm-12" id="mainBoxShadow">
    <div class="clearfix"></div>
    <div class="box" style="margin-top:-5px;">
    
    <h4 class="page-header">Area Information</h4>

    <div class="row">
      <div class="col-sm-5">

        <div class="form-group float-label-control">
          <label for="">Name</label>
          <input type="name" class="form-control" placeholder="Name">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Area code</label>
          <input type="code" class="form-control" placeholder="Area Code">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Parent</label>
          <select name="parent" class="form-control" id="parentCategory">
            <option>No Parent</option>
          </select>
          <small id="emailHelp" class="form-text text-muted form-error"></small>
        </div>

        <div class="form-group float-label-control">
          <button class="btn btn-primary btn-block" type="submit">Create area</button>
        </div>

      </div>
      <div class="clearfix"></div>
    </div>

    </div>

    <div class="clearfix"></div>
</div><!--/col-->
<div class="clearfix"></div>
@endsection

@section('header')

@endsection

@section('footer')

@endsection