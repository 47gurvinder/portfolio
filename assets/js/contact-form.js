// JavaScript Document
$(document).ready(function () {

    "use strict";

    $(".contact-form").submit(function (e) {
        e.preventDefault();
        grecaptcha.ready(function () {
            grecaptcha.execute('6LebIzQqAAAAAN2khjCOGuCiQNZZzpqXaHhIfVKL', { action: 'submit' }).then(function (token) {
                // Add your logic to submit to your backend server here.
                var name = $(".name");
                var email = $(".email");
                var subject = $(".subject");
                var msg = $(".message");
                var flag = false;
                if (name.val() == "") {
                    name.closest(".bottom-form-control").addClass("error");
                    name.focus();
                    flag = false;
                    return false;
                } else {
                    name.closest(".bottom-form-control").removeClass("error").addClass("success");
                } if (email.val() == "") {
                    email.closest(".bottom-form-control").addClass("error");
                    email.focus();
                    flag = false;
                    return false;
                } else {
                    email.closest(".bottom-form-control").removeClass("error").addClass("success");
                } if (msg.val() == "") {
                    msg.closest(".bottom-form-control").addClass("error");
                    msg.focus();
                    flag = false;
                    return false;
                } else {
                    msg.closest(".bottom-form-control").removeClass("error").addClass("success");
                    flag = true;
                }
                var dataString = "name=" + name.val() + "&email=" + email.val() + "&subject=" + subject.val() + "&message=" + msg.val() + "&captcha_token=" + token +"&origin="+window.location.href;
                $(".loading").fadeIn("slow").html("Loading...");
                $.ajax({
                    type: "POST",
                    data: dataString,
                    url: "https://api.gurwinder.me/api/contact",
                    cache: false,
                    success: function (d) {
                        $(".bottom-form-control").removeClass("success");
                        if (d.code == 200) // Message Sent? Show the 'Thank You' message and hide the form
                            $('.loading').fadeIn('slow').html('<font color="#48af4b">Mail sent Successfully.</font>').delay(3000).fadeOut('slow');

                        else
                            $('.loading').fadeIn('slow').html('<font color="#ff5607">Mail not sent.</font>').delay(3000).fadeOut('slow');

                    }
                });
                return false;
            });
        });
    });
    $("#reset").on('click', function () {
        $(".bottom-form-control").removeClass("success").removeClass("error");
    });

})

