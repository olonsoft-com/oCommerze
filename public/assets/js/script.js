$(function(){
    
    // $('.action').click(function(){
    //     var role = $(this).attr('role');
    //     var id = $(this).attr('id');
    //     var action = $(this).attr('action');

    //     var csrf_token_name = $(this).attr('token');

    //     if(role =='user'){
    //         var url = "http://localhost/netbill/ajax/action_user";
    //     }elseif(role =='cafe'){
    //         var url = "http://localhost/netbill/ajax/action_cafe";
    //     }else{
    //         var url = "http://localhost/netbill/ajax/action__dcafe";
    //     }

    //     $.ajax({
    //         type: "post",
    //         url: url,
    //         data: {id:id, action:action, csrf_token_name:csrf_token_name},
    //         success: function(msg){
    //             alert(msg);
    //         }
    //     });

    //     return false;
    // });

    $('.register-form').submit(function(){
        var data = $(this).serialize();
        var url = "http://localhost/netbill/ajax/register";

        $('.forgot-message').addClass('hide');
        $('#forgot-message').text('Registering, Please wait...').removeClass('hide');

        $.ajax({
            type: "post",
            url: url,
            data: data,
            success: function(msg){
                if(msg=='ok'){
                    $('.register').hide();
                    $('.forgot-message').removeClass('hide');
                    $('#forgot-message').addClass('hide');
                    window.setTimeout(function () {
                        location.href = "http://localhost/netbill/login";
                    }, 5000);
                }else{
                    $('#forgot-message').html(msg).removeClass('hide');
                    $('.forgot-message').addClass('hide');
                }
            }
        });

        return false;
    });

    
    //login with Ajax
    $('.login').submit(function(){

            var data = $(this).serialize();

            var url = "http://localhost/netbill/ajax/login";

            var split = location.search.replace('?', '').split('=');

            var ref = split[1];



            if(ref=='' || !ref){

                ref = "http://localhost/netbill/dashboard";

            }



            $('.login-button').text('Checking...').removeClass('btn-primary btn-warning').addClass('btn-default');

            $.ajax({

                type: "post",

                url: url,

                data: data,

                success: function(msg){

                    if(msg=='ok'){

                        $('.login-button').text('Logging in...').addClass('btn-success');

                        window.location = ref;

                    }else{

                        $('.login-button').text('Login').addClass('btn-warning');

                        alert(msg);

                    }

                }

            });



            return false;

        });

});

function getXHR(){
  //ajax request 
  var xhr;
  try {
    xhr = new XMLHttpRequest();
  } catch (error)
  {
    try
    {
      xhr = new ActiveXObject('Microsoft.XMLHTTP');
    } catch (error)
    {
      xhr = null;
    }
  }
  return xhr;
}