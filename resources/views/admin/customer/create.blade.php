@extends('admin.layout._layout')

@section('content')
<div class="top-menu">
  <!-- column 2 --> 
  <div class="col-sm-5">
   <h3><i class="fa fa-user"></i> {{ $title }}</h3>  
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


    <div class="row">
      <div class="col-sm-4">

        <h4 class="page-header">Customer Information</h4>
        <div class="form-group float-label-control">
          <label for="">Name</label>
          <input type="name" class="form-control" placeholder="Name">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Password</label>
          <input type="password" class="form-control" placeholder="Password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Textarea</label>
          <textarea class="form-control" placeholder="Textarea" rows="1"></textarea>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>


        <h4 class="page-header">Bottom Labels</h4>
        <div class="form-group float-label-control label-bottom">
          <label for="">Username</label>
          <input type="email" class="form-control" placeholder="Username">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>


        <h4 class="page-header">Placeholder Overrides</h4>
        <div class="form-group float-label-control">
          <label for="">Email Address</label>
          <input type="email" class="form-control" placeholder="What's your email address?">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

      </div>
      <div class="col-sm-4">

        <h4 class="page-header">Billing Information</h4>
        <div class="form-group float-label-control">
          <label for="">Billing Area</label>
          <input type="name" class="form-control" placeholder="Name">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group float-label-control">
          <label for="">Package</label>
          <input type="password" class="form-control" placeholder="Password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group float-label-control">
          <label for="">Monthly Discount</label>
          <textarea class="form-control" placeholder="Textarea" rows="1"></textarea>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <h4 class="page-header">Cable Costs</h4>
        <div class="form-group float-label-control label-bottom">
          <label for="">Cable Costs</label>
          <input type="email" class="form-control" placeholder="Cable Costs">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <!-- <h4 class="page-header">Installation Fee</h4> -->
        <div class="form-group float-label-control">
          <label for="">Installation Fee</label>
          <input type="email" class="form-control" placeholder="What's your email address?">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

      </div>
      <div class="col-sm-4">

        <h4 class="page-header">Account Information</h4>
        <div class="form-group float-label-control">
          <label for="">Mikrotik ID / Name</label>
          <input type="email" class="form-control" placeholder="Mikrotik ID">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Email</label>
          <input type="email" class="form-control" placeholder="Email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Username</label>
          <input type="username" class="form-control" placeholder="Username">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Password</label>
          <input type="password" class="form-control" placeholder="Password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group float-label-control">
          <label for="">Confirm Password</label>
          <input type="password" class="form-control" placeholder="Confirm Password">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group float-label-control">
          <button class="btn btn-success btn-block btn-lg" type="submit">Create account</button>
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
<style type="text/css">
  .float-label-control { position: relative; margin-bottom: 1.5em; }
  .float-label-control ::-webkit-input-placeholder { color: transparent; }
  .float-label-control :-moz-placeholder { color: transparent; }
  .float-label-control ::-moz-placeholder { color: transparent; }
  .float-label-control :-ms-input-placeholder { color: transparent; }
  .float-label-control input:-webkit-autofill,
  .float-label-control textarea:-webkit-autofill { background-color: transparent !important; -webkit-box-shadow: 0 0 0 1000px white inset !important; -moz-box-shadow: 0 0 0 1000px white inset !important; box-shadow: 0 0 0 1000px white inset !important; }
  .float-label-control input, .float-label-control textarea, .float-label-control label { font-size: 1.3em; box-shadow: none; -webkit-box-shadow: none; }
  .float-label-control input:focus,
  .float-label-control textarea:focus { box-shadow: none; -webkit-box-shadow: none; border-bottom-width: 2px; padding-bottom: 0; }
  .float-label-control textarea:focus { padding-bottom: 4px; }
  .float-label-control input, .float-label-control textarea { display: block; width: 100%; padding: 0.1em 0em 1px 0em; border: none; border-radius: 0px; border-bottom: 1px solid #aaa; outline: none; margin: 0px; background: none; }
  .float-label-control textarea { padding: 0.1em 0em 5px 0em; }
  .float-label-control label { position: absolute; font-weight: normal; top: -1.0em; left: 0.08em; color: #aaaaaa; z-index: -1; font-size: 0.85em; -moz-animation: float-labels 300ms none ease-out; -webkit-animation: float-labels 300ms none ease-out; -o-animation: float-labels 300ms none ease-out; -ms-animation: float-labels 300ms none ease-out; -khtml-animation: float-labels 300ms none ease-out; animation: float-labels 300ms none ease-out; /* There is a bug sometimes pausing the animation. This avoids that.*/ animation-play-state: running !important; -webkit-animation-play-state: running !important; }
  .float-label-control input.empty + label,
  .float-label-control textarea.empty + label { top: 0.1em; font-size: 1.5em; animation: none; -webkit-animation: none; }
  .float-label-control input:not(.empty) + label,
  .float-label-control textarea:not(.empty) + label { z-index: 1; }
  .float-label-control input:not(.empty):focus + label,
  .float-label-control textarea:not(.empty):focus + label { color: #aaaaaa; }
  .float-label-control.label-bottom label { -moz-animation: float-labels-bottom 300ms none ease-out; -webkit-animation: float-labels-bottom 300ms none ease-out; -o-animation: float-labels-bottom 300ms none ease-out; -ms-animation: float-labels-bottom 300ms none ease-out; -khtml-animation: float-labels-bottom 300ms none ease-out; animation: float-labels-bottom 300ms none ease-out; }
  .float-label-control.label-bottom input:not(.empty) + label,
  .float-label-control.label-bottom textarea:not(.empty) + label { top: 3em; }


  @keyframes float-labels {
    0% { opacity: 1; color: #aaa; top: 0.1em; font-size: 1.5em; }
    20% { font-size: 1.5em; opacity: 0; }
    30% { top: 0.1em; }
    50% { opacity: 0; font-size: 0.85em; }
    100% { top: -1em; opacity: 1; }
  }

  @-webkit-keyframes float-labels {
    0% { opacity: 1; color: #aaa; top: 0.1em; font-size: 1.5em; }
    20% { font-size: 1.5em; opacity: 0; }
    30% { top: 0.1em; }
    50% { opacity: 0; font-size: 0.85em; }
    100% { top: -1em; opacity: 1; }
  }

  @keyframes float-labels-bottom {
    0% { opacity: 1; color: #aaa; top: 0.1em; font-size: 1.5em; }
    20% { font-size: 1.5em; opacity: 0; }
    30% { top: 0.1em; }
    50% { opacity: 0; font-size: 0.85em; }
    100% { top: 3em; opacity: 1; }
  }

  @-webkit-keyframes float-labels-bottom {
    0% { opacity: 1; color: #aaa; top: 0.1em; font-size: 1.5em; }
    20% { font-size: 1.5em; opacity: 0; }
    30% { top: 0.1em; }
    50% { opacity: 0; font-size: 0.85em; }
    100% { top: 3em; opacity: 1; }
  }

</style>
@endsection

@section('footer')
<script type="text/javascript">
/* Float Label Pattern Plugin for Bootstrap 3.1.0 by Travis Wilson
**************************************************/

(function ($) {
  $.fn.floatLabels = function (options) {

        // Settings
        var self = this;
        var settings = $.extend({}, options);


        // Event Handlers
        function registerEventHandlers() {
          self.on('input keyup change', 'input, textarea', function () {
            actions.swapLabels(this);
          });
        }


        // Actions
        var actions = {
          initialize: function() {
            self.each(function () {
              var $this = $(this);
              var $label = $this.children('label');
              var $field = $this.find('input,textarea').first();

              if ($this.children().first().is('label')) {
                $this.children().first().remove();
                $this.append($label);
              }

              var placeholderText = ($field.attr('placeholder') && $field.attr('placeholder') != $label.text()) ? $field.attr('placeholder') : $label.text();

              $label.data('placeholder-text', placeholderText);
              $label.data('original-text', $label.text());

              if ($field.val() == '') {
                $field.addClass('empty')
              }
            });
          },
          swapLabels: function (field) {
            var $field = $(field);
            var $label = $(field).siblings('label').first();
            var isEmpty = Boolean($field.val());

            if (isEmpty) {
              $field.removeClass('empty');
              $label.text($label.data('original-text'));
            }
            else {
              $field.addClass('empty');
              $label.text($label.data('placeholder-text'));
            }
          }
        }


        // Initialization
        function init() {
          registerEventHandlers();

          actions.initialize();
          self.each(function () {
            actions.swapLabels($(this).find('input,textarea').first());
          });
        }
        init();


        return this;
      };

      $(function () {
        $('.float-label-control').floatLabels();
      });
    })(jQuery);
  </script>
  @endsection