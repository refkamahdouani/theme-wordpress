jQuery(document).ready(function($){
console.log('ajax contact');
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //return true;
    return re.test(String(email).toLowerCase());
}


function validatename(name) {
    const re = /^[A-Za-z ]+$/i;
    //return true;
    return re.test(String(name).toLowerCase());
}

function validatemsg(msg) {
    const re = /^[a-z0-9 +-.,?@#$%!.]+$/i;
    //return true;
    return re.test(String(msg).toLowerCase());
}



$('#send-msg').on('click',function() {
var email = $('#email').val();
var name =  $('#name').val();
var msg =  $('#msg').val();
valid = true;

//empty
if(msg.length ==0||
    email.length==0||
    name.length==0){
        valid = false
        $('#return-senpai').addClass('show-return-msg');
        $('#return-senpai').html('All Fields are required.');
    }


var errorsHTML = '';

 if (!validateEmail(email)) {
     valid = false
     $('#return-senpai').addClass('show-return-msg');
     errorsHTML += '<p>please check email</p>';
     $('#return-senpai').html(errorsHTML);
     
 }
 if (!validatename(name)) {
    valid = false
    $('#return-senpai').addClass('show-return-msg');
    errorsHTML += '<p>please check name</p>';
    $('#return-senpai').html(errorsHTML);
}
if (!validatemsg(msg)) {
    valid = false
    $('#return-senpai').addClass('show-return-msg');
    errorsHTML += '<p>please check message</p>';
    $('#return-senpai').html(errorsHTML);
}


var settings = {
    "url": senpai_ajax_contact_params.ajaxurl,
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    "data": {
      "name": name,
      "email": email,
      "message": msg,
      "nonce": senpai_ajax_contact_params.nonce,
      "action":"ajaxcontact"
    }
  };



//loading-btn-ajax
if (valid) {
  $('#loading-btn-ajax').show(300);
  $('#return-senpai').removeClass('show-return-msg');
  $('#return-senpai').html('');
  console.log('send');
    console.log('submit');
    $.ajax(settings).done(function (response) {
      let R = JSON.parse(response);
      if (R.success) {
        $('#loading-btn-ajax').hide(300);
        $('#email').val('');
        $('#name').val('');
        $('#msg').val('');
        $('#return-senpai').html('your message has been sent succefully');
        $('#return-senpai').css({'color':'green'});
        $('#return-senpai').show(700);
        setTimeout(function() {
          $('#return-senpai').hide(700);
        
        }, 1000); 
      }else{
        $('#loading-btn-ajax').hide(300);
        var errorsHTML = '';
        Object.values(R.msg).forEach(val => {
          errorsHTML += '<p>' + val +  '</p>';
        });
        $('#return-senpai').html(errorsHTML);
      }

    console.log('success');
    console.log(response);
    });
    
}else{
  console.log('error');

}



})
})