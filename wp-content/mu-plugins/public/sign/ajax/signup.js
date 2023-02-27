function signupSubmit(step) {

    const form = document.getElementById('signup-form');
    const stepLevel = step;
    const stepOne = document.getElementById('step-one');
    const stepTwo = document.getElementById('step-two');
    const stepThree = document.getElementById('step-three');

    const signupBtnOne = document.getElementById('signup-submit-one');
    const signupBtnTwo = document.getElementById('signup-submit-two');
    const signupBtnThree = document.getElementById('signup-submit-three');

    // const signupBackOne = document.getElementById('signup-back-one');
    // const signupBackTwo = document.getElementById('signup-back-two');
    // const signupBackThree = document.getElementById('signup-back-three');

    const userLogin = document.getElementById('user-login').value;
    const userCode = document.getElementById('user-code').value;
    const firstName = document.getElementById('first-name').value;
    const lastName = document.getElementById('last-name').value;
    const password = document.getElementById('password').value;

    const notification = document.getElementById('notification');
    const signupBtn = document.getElementById('signup-btn');

    jQuery.ajax({

        url: signup_ajax_localize_obj.ajax_url,
        type: 'post',
        dataType: 'json',
        data: {

            action: 'signup_ajax_handle',
            submitted_nonce: signup_ajax_localize_obj.the_nonce,
            stepLevel: stepLevel,
            userLogin: userLogin,
            userCode: userCode,
            firstName: firstName,
            lastName: lastName,
            password: password,

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

                if (response.data.code === 'unique_email' || response.data.code === 'unique_numeric') {

                    stepOne.style.display = 'none';
                    stepTwo.style.display = 'block';
                    stepThree.style.display = 'none';

                }

                if (response.data.code === 'unique_code') {

                    stepOne.style.display = 'none';
                    stepTwo.style.display = 'none';
                    stepThree.style.display = 'block';

                }

                if (response.data.code === 'success_insert') {

                    var timeleft = 10;
                    var downloadTimer = setInterval(function () {

                        if (timeleft <= 0) {

                            clearInterval(downloadTimer);
                            notification.innerHTML = 'تبریک: ' + response.data.message + " (در حال انتقال...) ";
                            setTimeout(function () {
                                location.reload();
                            }, 2000);

                        } else {

                            notification.innerHTML = 'تبریک: ' + response.data.message + ' (' + timeleft + " ثانیه تا انتقال...)";
                        }

                        timeleft -= 1;

                    }, 1000);

                    form.remove();
                    signupBtn.style.display = 'block';

                }

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