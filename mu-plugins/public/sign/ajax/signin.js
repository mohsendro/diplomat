function signinSubmit() {

    const form = document.getElementById('signin-form');
    const userLogin = document.getElementById('user-login').value;
    const userPass = document.getElementById('user-pass').value;
    const userRememberme = document.getElementById('user-rememberme').checked;
    const notification = document.getElementById('notification');
    const signinBtn = document.getElementById('signin-btn');

    jQuery.ajax({

        url: signin_ajax_localize_obj.ajax_url,
        type: 'post',
        dataType: 'json',
        data: {

            action: 'signin_ajax_handle',
            submitted_nonce: signin_ajax_localize_obj.the_nonce,
            userLogin: userLogin,
            userPass: userPass,
            userRememberme: userRememberme,

        },
        success: function (response) {

            if (response.data.type === 'error') {

                notification.style.display = 'block';
                notification.style.backgroundColor = '#f7cdcd';
                notification.style.borderRightColor = 'red';
                notification.innerHTML = 'خطا: ' + response.data.message;

            } else {

                notification.style.display = 'block';
                notification.style.backgroundColor = '#cdf7cf';
                notification.style.borderRightColor = 'green';
                notification.innerHTML = 'تبریک: ' + response.data.message;

                var timeleft = 10;
                var downloadTimer = setInterval(function () {

                    if (timeleft <= 0) {

                        clearInterval(downloadTimer);
                        notification.innerHTML = 'تبریک: ' + response.data.message + " (در حال انتقال...) ";
                        setTimeout(function () {
                            location.reload();
                            // window.location.assign("https://www.example.com");
                        }, 1000);

                    } else {

                        notification.innerHTML = 'تبریک: ' + response.data.message + ' (' + timeleft + " ثانیه تا انتقال...)";
                    }

                    timeleft -= 1;

                }, 1000);

                form.remove();
                signinBtn.style.display = 'block';

            }

        },
        error: function (response) {

            alert('خطا در بازیابی اطلاعات: ' + response.status + ' ' + response.statusText);
            console.log(response.data.code);
            console.log(response.data.message);

        }
    });

}


// var userEmail = "ali_hoseyni@gmail.com";
// var pattern = new RegExp("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$");
// var regexResult = pattern.test(userEmail);
// console.log(regexResult)