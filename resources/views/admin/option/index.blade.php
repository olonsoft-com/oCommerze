@extends('admin.layout._layout')

@section('content')
    <div class="row">
        <!-- column 2 -->
        <div class="col-sm-5">
            <h3><i class="fa fa-cubes"></i> Options</h3>
        </div>
        <div class="col-sm-7"></div>
    </div>
    <div class="row"><!-- center left-->
        <div class="col-md-12">

            <div class="bhoechie-tab-container">
                    <div class="col-md-1 bhoechie-tab-menu">
                        <div class="list-group">
                            <a href="#"
                               class="list-group-item <?php if (!isset($_GET['tab']) || $_GET['tab'] == 'general') echo 'active'; ?> text-center">
                                <h4 class="fa fa-home"></h4><br/>General
                            </a>

                            <a href="#"
                               class="list-group-item <?php if (isset($_GET['tab']) && $_GET['tab'] == 'home') echo 'active'; ?> text-center">
                                <h4 class="fa fa-home"></h4><br/>Home Page
                            </a>

                            <a href="#"
                               class="list-group-item <?php if (isset($_GET['tab']) && $_GET['tab'] == 'contact') echo 'active'; ?> text-center">
                                <h4 class="fa fa-road"></h4><br/>Contact
                            </a>

                            <a href="#"
                               class="list-group-item <?php if (isset($_GET['tab']) && $_GET['tab'] == 'seo') echo 'active'; ?> text-center">
                                <h4 class="fa fa-binocular"></h4><br/>SEO
                            </a>

                            <a href="#"
                               class="list-group-item <?php if (isset($_GET['tab']) && $_GET['tab'] == 'header') echo 'active'; ?> text-center">
                                <h4 class="fa fa-image"></h4><br/>Headers
                            </a>

                            <a href="#"
                               class="list-group-item <?php if (isset($_GET['tab']) && $_GET['tab'] == 'social') echo 'active'; ?> text-center">
                                <h4 class="fa fa-code"></h4><br/>Social
                            </a>

                            <a href="#"
                               class="list-group-item <?php if (isset($_GET['tab']) && $_GET['tab'] == 'footer') echo 'active'; ?> text-center">
                                <h4 class="fa fa-code"></h4><br/>Footer
                            </a>

                        </div>
                    </div>
                    <div class="col-md-10 bhoechie-tab">
                        <!-- flight section -->
                        <div class="bhoechie-tab-content <?php if (!isset($_GET['tab']) || $_GET['tab'] == 'general') echo 'active'; ?>">
                            <!-- General Tab-->
                            <h5>General Options</h5>
                            @include('admin/option/general')
                        </div>

                        <!-- flight section -->
                        <div class="bhoechie-tab-content <?php if (isset($_GET['tab']) && $_GET['tab'] == 'home') echo 'active'; ?>">
                            <!-- General Tab-->
                            <h5>Home Page Options</h5>
                            @include('admin/option/home')
                        </div>

                        <!-- train section -->
                        <div class="bhoechie-tab-content <?php if (isset($_GET['tab']) && $_GET['tab'] == 'contact') echo 'active'; ?>">
                            <!-- Contact & About Tab-->
                            <h5>Contact Details</h5>
                            @include('admin/option/contact')
                        </div>

                        <!-- hotel search -->
                        <div class="bhoechie-tab-content <?php if (isset($_GET['tab']) && $_GET['tab'] == 'seo') echo 'active'; ?>">
                            <!--SEO TAB-->
                            <h5>SEO Settings</h5>
                            @include('admin/option/seo')
                        </div>

                        <div class="bhoechie-tab-content <?php if (isset($_GET['tab']) && $_GET['tab'] == 'header') echo 'active'; ?>">
                            <!--Header Tab-->
                            <h5>Header Options</h5>
                            @include('admin/option/header')
                        </div>
                        
                        <div class="bhoechie-tab-content <?php if (isset($_GET['tab']) && $_GET['tab'] == 'social') echo 'active'; ?>">
                            <!--Footer Tab-->
                            <h5>Socials</h5>
                            @include('admin/option/social')
                        </div>

                        <div class="bhoechie-tab-content <?php if (isset($_GET['tab']) && $_GET['tab'] == 'footer') echo 'active'; ?>">
                            <!--Footer Tab-->
                            <h5>Footer Options</h5>
                            @include('admin/option/footer')
                        </div>
                    </div>
            </div>

            {{--<div class="clearfix"></div>--}}
        </div><!--/col-->


        @endsection

        @section('ownjs')
            <script>
                $(document).ready(function () {
                    $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
                        alert('');
                        e.preventDefault();
                        $(this).siblings('a.active').removeClass("active");
                        $(this).addClass("active");
                        var index = $(this).index();
                        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
                    });
                });
            </script>

            <script>
                //call ajax for retrieve city
                $('.parent_category').on('change', function (e) {
                    var id = $(this).val();
                    var parent = $(this).parents('.parent');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "",
                        data: {category_id: id},
                        success: function (data) {
                            if(data=='')
                            {
                                console.log('id'+ id +' child '+ $(this).parents('.child_category').val());
                                $(parent).find('#child_category').html('');
                            }
                            else
                            {
                                var data = JSON.parse(data);
                                console.log(data);
                                $(parent).find('#child_category').html('');
                                $.each(data, function (key, value) {

                                    $(parent).find('#child_category').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            }


                        },
                        error: function (jqXHR, status, err) {
                            //alert(err);
                        }
                    });
                });

            </script>
<script type="text/javascript" src="{{ asset('js/jquery.upload.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('.jQFileUpload').click( function (e) {
        e.defaultPrevented;
        var jQUploadParent = $(this).parents('.uploadPrent');
        var modal = document.getElementById('myModal');
        var modalTitle = modal.querySelector('.modal-title');
        var modalBody = modal.querySelector('.modal-body');
        var role = this.getAttribute('role');
        modalTitle.innerHTML = "Upload " + role;
        modalBody.innerHTML = "";

        //create form
        var form = $("<form method='post' action='{{ route('dashboard.ajax.jqupload')}}' enqtype='multipart/form-data' charset='utf-8'></form>");
        var inputGroup = $('<div class="input-group"></div>');
        var inputGroupBtn = $('<span class="input-group-btn"></span>');
        var browsBtn = $('<button id="fake-file-button-browse" type="button" class="btn btn-default"></button>');
        var browsBtnIcon = $('<span class="fa fa-image"> Browse...</span>');
        $(browsBtn).append(browsBtnIcon);
        $(inputGroupBtn).append(browsBtn);
        $(inputGroup).append(inputGroupBtn);
        var fileInput = $('<input type="file" name="uploadfile" id="files-input-upload" style="display:none">');
        $(inputGroup).append(fileInput);
        var textInput = $('<input type="text" id="fake-file-input-name" disabled="disabled" placeholder="File not selected" class="form-control">');
        $(inputGroup).append(textInput);
        var inputGroupSubmit = $('<span class="input-group-btn"></span>');
        var submitBtn = $('<button type="submit" class="btn btn-default" disabled="disabled" id="fake-file-button-upload"></button>');
        var submitBtnIcon = $('<span class="fa fa-upload"></span>');

        $(submitBtn).append(submitBtnIcon);
        $(inputGroupSubmit).append(submitBtn);
        $(inputGroup).append(inputGroupSubmit);
        $(form).append(inputGroup);

        var progressParent = $('<div class="progress"></div>');
        var progressBar = $('<div class="bar"></div >');
        var progressPercent = $('<div class="percent">0%</div >');
        var progressStatus = $('<div id="status"></div>');
        $(progressParent).append(progressBar);
        $(progressParent).append(progressPercent);
        $(form).append(progressParent);
        $(form).append(progressStatus);
        $(modalBody).append(form);
        //click events
        $(browsBtn).click(function(e) {
          $(fileInput).click();
        });
        $(fileInput).on("change", function(e) {
          $(textInput).val($(this).val());
          $(submitBtn).removeAttr('disabled');
        });
        //csrf tockent send to header
        $(form).submit( function(e) {
          e.defaultPrevented;
          var bar = $('.bar');
          var percent = $('.percent');
          var status = $('#status');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          $(this).ajaxSubmit({
            beforeSend: function() {
              status.empty();
              var percentVal = '0%';
              bar.width(percentVal);
              percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr){
              var msg = xhr.responseText;
              if( msg == 'no') {
                status.html("<div class='alert alert-warning'>Cannot upload files.</div>");
              } else {
                var fileInputField = jQUploadParent.find('input[name=' + role + ']');
                fileInputField.val(msg);
                var imgPreview = jQUploadParent.find('.imgPreview');
                imgPreview.html('<img src="' + msg + '" class="">');
                // progressParent.hide();
                $(modal).modal('hide');
              }
            }
          });

          return false;
        });
        $(modal).modal("show");
      });
    });
</script>
@endsection