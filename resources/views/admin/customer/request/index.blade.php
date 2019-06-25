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
        <li><a href="{{ route('dashboard.customer.index') }}"><i class="fa fa-user"></i> Customers</a></li>
        <li class="active"><a href="{{ route('dashboard.request.index') }}"><i class="fa fa-random"></i> Requests <span class="badge @if( $count ) badge-info @endif">{{ $count }}</span></a></li>
    <li><a href="{{ route('dashboard.package.index') }}"><i class="fa fa-sitemap"></i> Packages</a></li>
        <li><a href="{{ route('dashboard.area.index') }}"><i class="fa fa-code-branch"></i> Areas</a></li>
    </ul>
</div>
<div class="clearfix"></div>
</div>
<form action="#" method="post" novalidate="novalidate">
    <div class="col-lg-12" id="mainBoxShadow">

        <div id="customFilters">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                    <input type="text" class="form-control search-slt" id="searchGlobal" placeholder="Name, Eamil, Mobile etc.">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                    <input type="text" id="email" class="form-control search-slt" placeholder="Email">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                    <input type="text" id="mobile" class="form-control search-slt" placeholder="Mobile">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                    <select class="form-control search-slt" id="status">
                        <option value="">Status</option>
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                        <option value="2">Disabled</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                    <button type="button" id="search" class="btn btn-danger wrn-btn">Search</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form> 
<div class="col-sm-12">
    <div class="clearfix"></div>
    <div class="box" style="margin-top:-5px;">
      <table class="table table-striped table-bordered" id="dataTable">
        <thead>
          <tr>
            <th><div>Request Type</div></th>
            <th><div>Customer Details</div></th>
            <th><div>Activate At</div></th>
            <th><div>Status</div></th>
            <th><div>Action</div></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

</div>

<div class="clearfix"></div>
</div><!--/col-->
<div class="clearfix"></div>
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/dataTable/DataTables-1.10.18/css/dataTables.bootstrap.min.css') }}"/>
<style type="text/css">
    /*search box css start here*/
    .search-sec{
        padding: 2rem;
    }
    .search-slt{
        display: block;
        width: 100%;
        font-size: 1.5rem;
        line-height: 1.5;
        color: #55595c;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        height: calc(3rem + 2px) !important;
        border-radius:0;
    }
    .wrn-btn{
        width: 100%;
        font-size: 16px;
        font-weight: 400;
        text-transform: capitalize;
        height: calc(3rem + 2px) !important;
        border-radius:0;
    }
    @media (min-width: 992px){
        .search-sec{
            position: relative;
            top: -114px;
            background: rgba(26, 70, 104, 0.51);
        }
    }

    @media (max-width: 992px){
        .search-sec{
            background: #1A4668;
        }
    }
</style>
@endsection

@section('footer')
<script type="text/javascript" src="{{ asset('admin/assets/plugins/dataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/assets/plugins/dataTable/DataTables-1.10.18/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    var url = "{{ route('dashboard.request.index') }}";
//
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: "{{ route('dashboard.request.index') }}",      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );

    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;

    return function ( request, drawCallback, settings ) {
        var ajax          = true;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;

        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
          JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
          JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
          ) {
            // properties changed (ordering, columns, searching)
        ajax = true;
    }

        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );

        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));

                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }

            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);

            request.start = requestStart;
            request.length = requestLength*conf.pages;

            // Provide the same `data` options as DataTables.
            if ( typeof conf.data === 'function' ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }

            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    true,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);

                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }

                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );

            drawCallback(json);
        }
    }
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );
$(function(){
    var customFilter = $('#customFilters');
    var keyword = $(customFilter).find('input#searchGlobal');
    var email = $(customFilter).find('input#email');
    var mobile = $(customFilter).find('input#mobile');
    var status = $(customFilter).find('select#status');
    var search = $(customFilter).find('button#search');
    console.log(keyword);
    var table = $('#dataTable').DataTable( {
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "ajax": {
         'url': url,
           pages: 5, // number of pages to cache
           'data': function(data){
              // Read values
              data.keyword = $(keyword).val();
              data.email = $(email).val();
              data.mobile = $(mobile).val();
              data.status = $(status).val();
          }
      },
      "pageLength": 25, 
      "bFilter": false, 
      "bInfo": false,
      "searching": false,
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
      "lengthChange": true,
      "columns": [
      { "data": "type" },
      { "data": "name" },
      { "data": "action_date" },
      { "data": "status" },
      { "data": "btns" }
      ],
      "columnDefs": [
      {"targets": [1,2,4], "searchable": false, "orderable": false, "visible": true}
      ],
      "order": [[0, 'asc']]
  } );

    //Click on Search Button
    $(search).click( function(e) {
        table.draw();
    });

    //Custom Filters ( title search )
    $(keyword).keyup( function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            table.draw();
        }
    } );

    //Custom Filters ( Author search )
    $(email).keyup( function() {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            table.draw(); 
        }
    } );

    //Custom Filters ( Author search )
    $(mobile).keyup( function() {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            table.draw(); 
        }
    } );

    //Custom Filters ( Author search )
    $(status).change( function() {
        if( $(this).val() != ''){
            table.draw(); 
        }
    } );

    // $('#myModal').modal('show');

    function deleteLibraryItem( id ) {
        var parent = $(this).parents('tr');
        var url = "{{ url('dashboard/library/delete/') }}/" + id;
        var data = null;
        var confirmed = confirm('Are you sure to delete this item?');
        if( confirmed ) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: url,
                data: data,
                success: function(data, textStatus, xhr){
                    if( data.success == true ) {
                        $(parent).remove();
                    }
                    return false;
                }
            });
        }
        return false;
    }
});
</script>
@endsection