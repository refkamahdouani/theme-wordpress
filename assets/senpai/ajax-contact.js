jQuery(document).ready(function($){
console.log('ajax contact');
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function validatename(name) {
    const re = /^[A-Za-z ,.]+$/i;
    return re.test(String(name).toLowerCase());
}

function validatemsg(msg) {
    const re = /^[a-z0-9 .,?]+$/i;
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
    }
 if (!validateEmail(email)) {
     valid = false
     
 }
 if (!validatename(name)) {
    valid = false
    
}
if (!validatemsg(msg)) {
    valid = false
    
}


 
 var form = new FormData();
form.append("name", name);
form.append("email", email);
form.append("msg", msg);
form.append("nonce", senpai_ajax_contact_params.nonce);
//console.log( senpai_ajax_contact_params.nonce);
//console.log(form);
/*
var settings = {
  "url": senpai_ajax_contact_params.ajaxurl,
  "method": "POST",
  "timeout": 0,
  "processData": false,
  "mimeType": "multipart/form-data",
  "contentType": false,
  "data": form
};*/
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
      "msg": msg,
      "nonce": senpai_ajax_contact_params.nonce,
      "action":"ajaxcontact"
    }
  };




if (valid) {
  console.log('send');
    console.log('submit');
    $.ajax(settings).done(function (response) {
    $('#email-senpai').val('');
    $('#name-senpai').val('');
    $('#msg-senpai').val('');
    console.log('success');
    });
    
}else{
  console.log('error');

}



})
})