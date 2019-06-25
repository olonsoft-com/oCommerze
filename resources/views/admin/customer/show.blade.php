@extends('admin.layout._layout')

@section('content')
<div class="top-menu">
    <!-- column 2 --> 
    <div class="col-sm-5">
     <h3><i class="fa fa-user"></i> {{ $title }}</h3>  
 </div>
 <div class="col-sm-7">
  <ul class="nav nav-pills pull-right page-top-navigation">
    <li><a href="{{ route('dashboard.customer.create') }}"><i class="fa fa-plus"></i> Add new</a></li>
    <li><a href="#"><i class="fa fa-user"></i> Customers</a></li>
    <li class="active"><a href="{{ route('dashboard.request.index') }}"><i class="fa fa-random"></i> Requests <span class="badge @if( $count ) badge-info @endif">{{ $count }}</span></a></li>
    <li><a href="{{ route('dashboard.package.index') }}"><i class="fa fa-sitemap"></i> Packages</a></li>
    <li><a href="{{ route('dashboard.area.index') }}"><i class="fa fa-code-branch"></i> Areas</a></li>
</ul>
</div>
<div class="clearfix"></div>
</div>

<div class="col-sm-12" id="mainBoxShadow">
    <div class="clearfix"></div>
    <div class="box" style="margin-top:-5px;">


    </div>

    <div class="clearfix"></div>
</div><!--/col-->
<div class="clearfix"></div>
@endsection

@section('header')

@endsection

@section('footer')

@endsection