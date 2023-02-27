function lostpasswordSubmit(step) {

    const form = document.getElementById('lostpassword-form');
    const stepLevel = step;
    const stepOne = document.getElementById('step-one');
    const stepTwo = document.getElementById('step-two');
    const stepThree = document.getElementById('step-three');

    const lostpasswordBtnOne = document.getElementById('lostpassword-submit-one');
    const lostpasswordBtnTwo = document.getElementById('lostpassword-submit-two');
    const lostpasswordBtnThree = document.getElementById('lostpassword-submit-three');

    // const lostpasswordBackOne = document.getElementById('lostpassword-back-one');
    // const lostpasswordBackTwo = document.getElementById('lostpassword-back-two');
    // const lostpasswordBackThree = document.getElementById('lostpassword-back-three');

    const userLogin = document.getElementById('user-login').value;
    const userCode = document.getElementById('user-code').value;
    const password = document.getElementById('password').value;

    const notification = document.getElementById('notification');
    const lostpasswordBtn = document.getElementById('lostpassword-btn');

    jQuery.ajax({

        url: lostpassword_ajax_localize_obj.ajax_url,
        type: 'post',
        dataType: 'json',
        data: {

            action: 'lostpassword_ajax_handle',
            submitted_nonce: lostpassword_ajax_localize_obj.the_nonce,
            stepLevel: stepLevel,
            userLogin: userLogin,
            userCode: userCode,
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

                if (response.data.code === 'success_change') {

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
                    lostpasswordBtn.style.display = 'block';

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