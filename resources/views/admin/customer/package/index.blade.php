@extends('admin.layout._layout')

@section('content')
<div class="top-menu">
  <!-- column 2 --> 
  <div class="col-sm-5">
   <h3><i class="fa fa-code-branch"></i> {{ $title }}</h3>  
 </div>
 <div class="col-sm-7">
  <ul class="nav nav-pills pull-right page-top-navigation">
    <li><a href="{{ route('dashboard.package.create') }}"><i class="fa fa-plus"></i> Add new</a></li>
    <li><a href="{{ route('dashboard.customer.index') }}"><i class="fa fa-user"></i> Customers</a></li>
    <li><a href="{{ route('dashboard.request.index') }}"><i class="fa fa-random"></i> Requests <span class="badge">{{ $count }}</span></a></li>
    <li class="active"><a href="#"><i class="fa fa-sitemap"></i> Packages</a></li>
    <li><a href="{{ route('dashboard.area.index')}}"><i class="fa fa-code-branch"></i> Areas</a></li>
  </ul>
</div>
<div class="clearfix"></div>
</div>
<div class="col-sm-12" id="mainBoxShadow">
  <div class="row">
    <div class="col-sm-9">
        <div id="customFilters">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 p-0">
                  <div class="input-group">
                    <input type="text" class="form-control search-slt" id="searchGlobal" placeholder="Name, Eamil, Mobile etc.">
                    <div class="input-group-btn">
                      <button type="submit" id="search" class="btn btn-warning">Search</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 p-0">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
      <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Code</th>
              <th>Customers</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-sm-3" style="padding-left: 0">
      <div class="sidebar-right" style="background: #f9f8f8; margin-top: 15px;min-height: 400px; border: 1px solid #f1f1f1; padding: 10px 15px">
        <h4 class="sidebar-title"><i class="fa fa-chart-line"></i> Statistics</h4><hr>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
</div><!--/col-->
<div class="clearfix"></div>
@endsection

@section('header')
<style type="text/css">
.sidebar-title {
  margin: 0;
}
hr {
  margin: 10px 0;
}
</style>
@endsection

@section('footer')
<script type="text/javascript" src="{{ asset('admin/assets/plugins/dataTable/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/assets/plugins/dataTable/DataTables-1.10.18/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    var url = "{{ route('dashboard.package.index') }}";
//
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: "{{ route('dashboard.package.index') }}",      // script url
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
    var search = $(customFilter).find('button#search');
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
          }
      },
      "pageLength": 25, 
      "bFilter": false, 
      "bInfo": false,
      "searching": false,
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
      "lengthChange": true,
      "columns": [
      { "data": "id" },
      { "data": "name" },
      { "data": "code" },
      { "data": "customer_count" },
      { "data": "btns" }
      ],
      "columnDefs": [
      {"targets": [2,4], "searchable": false, "orderable": false, "visible": true}
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

    // $('#myModal').modal('show');

    function deleteLibraryItem( id ) {
        var parent = $(this).parents('tr');
        var url = "{{ url('dashboard/library/delete') }}/" + id;
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