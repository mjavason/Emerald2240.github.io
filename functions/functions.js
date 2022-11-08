function htmlEntities(str) {
    return String(str)

        // .replace(/./g, '&#46;')
        // .replace(/#/g, '&#35;')
        .replace(/{/g, '&#123;')
        .replace(/}/g, '&#125;')
        .replace(/,/g, '&#44;')
        .replace(/:/g, '&#58;')
        .replace(/\"/g, '&#34;')
        .replace(/\'/g, '&#39;')
        .replace(/\//g, '&#47;')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/\n/g, "<br>").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t");
}

$("#search-box").keyup(function () {
    $("#addUseCountryButton").prop({
        disabled: true
    })
    $.ajax({
        type: "POST",
        url: "readCountry.php",
        data: 'keyword=' + $(this).val(),
        beforeSend: function () {
            $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function (data) {
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background", "#FFF");
        }
    });
});

function simpleAjaxRequest(url, dataRequest, type) {
    $.ajax(url, {
        type: type,
        dataType: 'json',
        data: dataRequest,
        beforeSend: function () {
            setLoader();
        },
        success: function (status, response) {
            //$('p').append('<br>' + response[0]['firstName'] + '<br>' + response[0].middleName + '<br>' + response[0].lastName);
            //$('p').append('status: ' + status + ', data: ' + response + '<br>');
            //console.log(response);
            swal({
                //title: "New Course",
                title: "Success",
                icon: "success",
                text: "Welcome Michael!"
                //button: "Got It!",
            });
            //$('#ajax_result').append(JSON.stringify(response, 't', 3) + '<br>');
            removeLoader();
        },
        error: function (error) {
            $('p').append('Error: ' + error);
        }
    });
}

function simpleAjaxPostRequest(url, dataRequest) {
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            var dataParsed = JSON.parse(data);
            //console.log(dataParsed);
            removeLoader();

            if (dataParsed[0].error == null) {
                swal({
                    //title: "New Course",
                    title: "Success",
                    icon: "success",
                    text: "Welcome " + dataParsed[0].first_name + " " + dataParsed[0].last_name
                    //button: "Got It!",
                });

                swal("Welcome " + dataParsed[0].first_name + " " + dataParsed[0].last_name, {
                    title: "Success",
                    icon: "success"
                })
                    .then((value) => {
                        //swal(`The returned value is: ${value}`);
                        //window.location = 'dashboard';
                    });
            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    text: "Error: " + dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })
}

//########################################################################################################
function processLoginAjaxPostRequest(url, dataRequest) {
    console.log(dataRequest);
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            var dataParsed = JSON.parse(data);
            console.log(dataParsed);
            //removeLoader();

            if (dataParsed[0].error == null) {
                swal("Welcome " + dataParsed[0].first_name + " " + dataParsed[0].last_name, {
                    title: "Success",
                    icon: "success"
                })

                    .then((value) => {
                        if (value) {
                            //swal(`The returned value is: ${value}`);
                            window.location = 'dashboard';
                        } else {
                            //swal(`The returned value is: ${value}`);
                            window.location = 'dashboard';
                        }
                    });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    text: "Error: " + dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })
}
//#########################################################################################################

function createNewCourseSession(url, dataRequest) {
    console.log(dataRequest);
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            console.log(data);
            var dataParsed = JSON.parse(data);
            //console.log(dataParsed);
            //removeLoader();

            if (dataParsed[0].error == null) {
                swal(dataParsed[0].success, {
                    title: "Success",
                    icon: "success"
                })

                    .then((value) => {
                        if (value) {
                            //swal(`The returned value is: ${value}`);
                            window.location = 'active-courses';
                        } else {
                            //swal(`The returned value is: ${value}`);
                            window.location = 'all-courses';
                        }
                    });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    //text: "Error: " + dataParsed[0].error
                    text: dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })
}

function simpleAjaxGetRequest(url, dataRequest) {
    $.get(url, // url
        dataRequest,
        function (data, status, jqXHR) {  // success callback
            //alert('status: ' + textStatus + ', data:' + data);
            $('p').append('status: ' + status + ', data: ' + data);
        });
}

function removeLoader() {
    // $(".loader").animate({ opacity: '0.2' });
    // setTimeout(() => {
    //     $('.loader').removeAttr('style');
    // }, 500);

    //$(".preloader").animate({ opacity: '0.2' }, 1500);
    $('.preloader').fadeOut(500, 'linear')
    //$('.preloader').attr('style', 'display:none');


    // setTimeout(() => {
    //     //console.log('setting up timeout');
    //     //$('.preloader').removeAttr('style');
    //     //$('.preloader').attr('style', 'display:none');

    // }, 500);

}

function setLoader() {
    // // $('.loader').attr('style', 'display:block');
    // // setTimeout(() => {
    // $('.loader').show();
    // $(".loader").animate({ opacity: '1' });
    // // }, 1000);


    // $('.loader').attr('style', 'display:block');
    // setTimeout(() => {
    $('.preloader').show();
    $(".preloader").animate({ opacity: '1' });


    // }, 1000);

}

function getInputValuesAndReturnTheirContentAsJson(elementIdsParsed) {
    jsonArray = [];
    for (var i = 0; i < elementIdsParsed.length; i++) {
        var htmlInput = document.getElementById(elementIdsParsed[i]);
        //console.log(elementIdsParsed);
        //console.log(htmlInput.value);
        // $("input[type='checkbox']").val();
        //console.log(htmlInput.type);
        //console.log($(htmlInput).is(":checked"));


        let jsonVar = {
            name: elementIdsParsed[i],
            value: $(htmlInput).val(),
            checked: $(htmlInput).is(":checked")
        }
        jsonArray.push(jsonVar);
    }
    //console.log(JSON.stringify(jsonArray, 't', 3));
    //return JSON.stringify(jsonArray, 't', 3);
    // console.log(jsonArray);
    return jsonArray;
}

function toggleShowPassword(passwordInputId, eyeElementId) {
    var passwordInput = document.getElementById(passwordInputId);
    var eyeElement = document.getElementById(eyeElementId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        $(eyeElement).removeClass("la-eye-slash");
        $(eyeElement).addClass("la-eye");
    } else {
        passwordInput.type = "password";
        $(eyeElement).removeClass("la-eye");
        $(eyeElement).addClass("la-eye-slash");

    }
}

function toggleButtonDisabled(buttonId) {
    buttonId = document.getElementById(buttonId);
    //console.log($(buttonId).prop('disabled'));
    if ($(buttonId).prop('disabled')) {
        $(buttonId).prop({
            disabled: false
        });
    } else {
        $(buttonId).prop({
            disabled: true
        })
    }
}

function logout() {
    swal({
        title: "Ready to leave?",
        text: "Select 'Ok' below if you are ready to end your current session.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Successfully logged out.", {
                    icon: "success",
                });
                window.location = 'functions/logout.php';
            } else {
                //swal("Great Choice!");
            }
        });
}

function createNewlecturer(url, dataRequest) {
    console.log(dataRequest);
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            var dataParsed = JSON.parse(data);
            console.log(dataParsed);
            removeLoader();

            if (dataParsed[0].error == null) {
                swal("Welcome! You can now login", {
                    title: "Success",
                    icon: "success",
                    button: "Got It!",
                }).then((value) => {
                    if (value) {
                        //swal(`The returned value is: ${value}`);
                        window.location = 'index#login_section';
                    } else {
                        //swal(`The returned value is: ${value}`);
                        window.location = 'index#login_section';
                    }
                });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    text: "Error: " + dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })
}

function checkIfAllFormFieldsFilled(buttonId, formValues, extraBooleanValue = null, extraBooleanIndex = null) {
    //var formValues = getInputValuesAndReturnTheirContentAsJson(['first_name', 'last_name', 'user_email', 'password1', 'password2', 'agree']);
    buttonId = document.getElementById(buttonId);

    for (var i = 0; i < formValues.length; i++) {
        //console.log(formValues[i].value);
        //console.log(formValues);

        //console.log(formValues[extraBooleanIndex][extraBooleanValue]);
        if (extraBooleanValue && extraBooleanIndex) {
            if (formValues[i].value == "" || formValues[extraBooleanIndex][extraBooleanValue] == false) {
                $(buttonId).prop({
                    disabled: true
                });
                return false;
            }
            if (formValues[i].name == 'calculator-plans' && (formValues[i].value == 'Invalid' || formValues[i].value == 'Select Plan')) {
                $(buttonId).prop({
                    disabled: true
                });
                return false;
            }


        } else {
            if (formValues[i].value == "") {
                $(buttonId).prop({
                    disabled: true
                });
                return false;
            }
        }
        $(buttonId).prop({
            disabled: false
        });

    }

}

function toggleElementVisibility(elementName, isItById) {
    if (isItById) {
        elementName = document.getElementById(elementName);
    } else {
        elementName = document.getElementsByClassName(elementName);
    }

    if ($(elementName).hasClass('active')) {
        $(elementName).removeClass('active');
    } else {
        $(elementName).addClass('active');
    }
}

function calculateProfit() {
    // calculator-plans
    // calculator-roi
    // calculator-profit
    // calculator-total
    var amount = parseInt($('#calculator-amount').val());
    //console.log(amount);
    if (amount >= 500 && amount <= 4999) {
        //console.log('inside bronze plan');
        $('#calculator-plans').prop("selectedIndex", 1);
        $('#calculator-roi').prop("selectedIndex", 1);
        $('#calculator-profit').val('$' + (Math.floor(amount * (20 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        $('#calculator-total').val('$' + (amount + Math.floor(amount * (20 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        return true;
    }
    if (amount >= 5000 && amount <= 19999) {
        //console.log('inside silver plan');
        $('#calculator-plans').prop("selectedIndex", 2);
        $('#calculator-roi').prop("selectedIndex", 2);
        $('#calculator-profit').val('$' + (Math.floor(amount * (25 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        $('#calculator-total').val('$' + (amount + Math.floor(amount * (25 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        return true;
    }
    if (amount >= 20000 && amount <= 49999) {
        //console.log('inside gold plan');
        $('#calculator-plans').prop("selectedIndex", 3);
        $('#calculator-roi').prop("selectedIndex", 3);
        $('#calculator-profit').val('$' + (Math.floor(amount * (30 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        $('#calculator-total').val('$' + (amount + Math.floor(amount * (30 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        return true;
    }
    if (amount >= 50000 && amount <= 99999) {
        //console.log('inside diamond plan');
        $('#calculator-plans').prop("selectedIndex", 4);
        $('#calculator-roi').prop("selectedIndex", 4);
        $('#calculator-profit').val('$' + (Math.floor(amount * (35 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        $('#calculator-total').val('$' + (amount + Math.floor(amount * (35 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        return true;
    }
    if (amount >= 100000 && amount <= 500000) {
        //console.log('inside platinum plan');
        $('#calculator-plans').prop("selectedIndex", 5);
        $('#calculator-roi').prop("selectedIndex", 5);
        $('#calculator-profit').val('$' + (Math.floor(amount * (40 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        $('#calculator-total').val('$' + (amount + Math.floor(amount * (40 / 100))).toLocaleString(undefined, { maximumFractionDigits: 0 }));
        return true;
    }
    if (amount > 500000) {
        //console.log('inside invalid plan');
        $('#calculator-plans').prop("selectedIndex", 6);
        $('#calculator-roi').prop("selectedIndex", 6);
        return true;
    }
    if (amount < 500) {
        //console.log('inside invalid plan');
        $('#calculator-plans').prop("selectedIndex", 6);
        $('#calculator-roi').prop("selectedIndex", 6);
        return true;
    }

    // switch (amount) {
    //     case (amount >= 500 && amount <= 4999):
    //         break;

    //     case (amount >= 5000 || amount <= 19999):
    //         break;

    //     case (amount >= 20000 || amount <= 49999):
    //         break;

    //     case (amount >= 50000 || amount <= 99999):
    //         break;

    //     case (amount >= 100000 || amount <= 500000):
    //         break;

    //     default:
    //         break;
    // }
    //console.log($('#calculator-plans').val());

}

function emptyDashboardPage() {
    // $('#dashboardPage').fadeOut('slow', 'swing', function () {
    //     $('#dashboardPage').empty();
    //     // elem.html(text[counter]);
    //     // counter++;
    //     // if(counter >= text.length) { counter = 0; }
    //     $('#dashboardPage').fadeIn();
    // });
    $("#dashboardPage").focus();
}

function loadDashboardPages(linkId, url, dataRequest) {
    //dataRequest = JSON.parse(dataRequest);
    //setLoader();
    linkId = document.getElementById(linkId);
    //console.log(dataRequest);
    $.post(url, // url
        dataRequest,
        function (data, status, jqXHR) {  // success callback
            //alert('status: ' + textStatus + ', data:' + data);
            $('#dashboardPage').fadeOut('fast', 'swing', function () {
                removeActiveClassForAllDashboardLinks();
                $(linkId).addClass('active');
                $('.dashboard__sidebar').removeClass('active')
                $('.overlay').removeClass('active')
                //$('#dashboardPage').empty();
                $("#dashboardPage").html(data);
                $('#dashboardPage').fadeIn();
            });
            // $('p').append('status: ' + status + ', data: ' + data);
        });

    removeLoader();
    scrollToElement('dashboardPage');
}

function removeActiveClassForAllDashboardLinks() {

    var dashboardlinks = ['dashboard-active', 'dashboard-invest', 'dashboard-history', 'dashboard-summary', 'dashboard-withdraw'];
    for (var i = 0; i < dashboardlinks.length; i++) {
        $(document.getElementById(dashboardlinks[i])).removeClass('active');
    }
}
//console.log('inside the custom function');

function scrollToElement(element) {
    //var container = $('#dashboardPage');
    element = document.getElementById(element);
    element.scrollIntoView();
}

function createNewInvestment(url, dataRequest) {
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            //console.log(data);
            var dataParsed = JSON.parse(data);
            //console.log(dataParsed);
            removeLoader();

            if (dataParsed.error == null) {
                swal("Click 'Next Step' to go to the payment page", {
                    title: "Success",
                    icon: "success",
                    button: "Next Step!"
                }).then((value) => {
                    if (value) {
                        //swal(`The returned value is: ${value}`);
                        // jsonArray = [];
                        // let jsonVar = {
                        //     "page": "payment",
                        //     "crypto_currency": dataParsed[0]['investment-currency'],
                        //     "amount": dataParsed[0]['calculator-amount']
                        // }
                        //jsonArray.push(jsonVar);
                        window.location = 'dashboard?page=payment&amount=' + dataParsed['amount'] + '&cryptocurrency=' + dataParsed['currency'] + '#dashboardPages';
                        //loadDashboardPages("payment", "functions/ajaxRequests.php", jsonVar);
                    } else {
                        //swal(`The returned value is: ${value}`);
                        window.location = 'dashboard?page=payment&amount=' + data['amount'] + '#dashboardPages';
                        //loadDashboardPages("payment", "functions/ajaxRequests.php", jsonVar);
                    }
                });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    text: "Error: " + dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })

}

function showSweetAlert(alert) {
    switch (alert) {
        case 'paid-request':
            swal({
                title: "Are you sure?",
                text: "You have paid into the company account. You can only send this message once.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Paid request sent! Your investment will be activated shortly.", {
                            icon: "success",
                        });
                    } else {
                        //swal("Your imaginary file is safe!");
                    }
                });
            break;

        case 'message-sent':
            $('#contact_name').val('');
            $('#contact_email').val('');
            $('#contact_message').val('');
            swal("Message Sent succesfully", {
                icon: "success",
            });

            break;
    }
}

function showAlert(message) {
    swal({
        //title: "New Course",
        title: message,
        icon: "warning",
        //text: "Error: " + dataParsed[0].error
        text: "Feature Still In Construction"
        //button: "Got It!",
    });
}

function sendInvestmentPaidRequest(url, dataRequest) {
    //console.log(dataRequest);
    swal({
        title: "Are you sure?",
        text: "You have paid into the company account. You can only send this message once.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willSend) => {
            if (willSend) {

                $.post(url, dataRequest,
                    function (data, status, jqXHR) {// success callback
                        //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
                        //console.log(data);
                        var dataParsed = JSON.parse(data);
                        //console.log(dataParsed);
                        removeLoader();

                        if (dataParsed.error == null) {
                            swal("Paid request sent! Your investment will be activated shortly.", {
                                icon: "success",
                            });
                            loadDashboardPages('dashboard-investments', 'functions/ajaxRequests.php', { "page": "active" })
                            return true;
                            // jsonArray = [];
                            // let jsonVar = {
                            //     "page": "payment",
                            //     "crypto_currency": dataParsed[0]['investment-currency'],
                            //     "amount": dataParsed[0]['calculator-amount']
                            // }
                            //jsonArray.push(jsonVar);
                        } else {
                            swal("An unknown error occured.", {
                                icon: "error",
                            });
                            return false;
                        }
                    })



            } else {
                //swal("Your imaginary file is safe!");
            }
        });
}

function sendDeleteNotificationRequest(url, dataRequest) {
    //console.log(dataRequest);
    swal({
        title: "Are you sure?",
        text: "Once deleted, it can't be retrieved.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willSend) => {
            if (willSend) {

                $.post(url, dataRequest,
                    function (data, status, jqXHR) {// success callback
                        //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
                        //console.log(data);
                        var dataParsed = JSON.parse(data);
                        //console.log(dataParsed);
                        removeLoader();

                        if (dataParsed.error == null) {
                            swal("Notification Deleted.", {
                                icon: "success",
                            });
                            loadDashboardPages('dashboard-investments', 'functions/ajaxRequests.php', { "page": "notifications" })
                            // window.location = 'dashboard?page=notifications#dashboardPages';
                            return true;
                            // jsonArray = [];
                            // let jsonVar = {
                            //     "page": "payment",
                            //     "crypto_currency": dataParsed[0]['investment-currency'],
                            //     "amount": dataParsed[0]['calculator-amount']
                            // }
                            //jsonArray.push(jsonVar);
                        } else {
                            swal("An unknown error occured.", {
                                icon: "error",
                            });
                            return false;
                        }
                    })



            } else {
                //swal("Your imaginary file is safe!");
            }
        });
}

function copyToClipboard(elementId) {
    /* Get the text field */
    var copyText = document.getElementById(elementId);

    /* Select the text field */
    // copyText.select();
    // copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.innerText);

    /* Alert the copied text */
    swal(copyText.innerText + "\n" + "Copied to clipboard", {
        title: "Success",
        icon: "success",
        button: "Got It"
    })
    //alert("Copied:" + copyText.innerText);
    // alert("Copied:" + copyText.value);
}

function createWithdrawalRequest(url, dataRequest) {
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            //console.log(data);
            var dataParsed = JSON.parse(data);
            //console.log(dataParsed);
            removeLoader();

            if (dataParsed.error == null) {
                swal("Withdrawal request sent succesfully. You will be credited shortly. Do not send another.", {
                    title: "Success",
                    icon: "success",
                    button: "Got It!"
                }).then((value) => {
                    if (value) {
                        //swal(`The returned value is: ${value}`);
                        // jsonArray = [];
                        // let jsonVar = {
                        //     "page": "payment",
                        //     "crypto_currency": dataParsed[0]['investment-currency'],
                        //     "amount": dataParsed[0]['calculator-amount']
                        // }
                        //jsonArray.push(jsonVar);
                        //window.location = 'dashboard#dashboardPages';
                        //loadDashboardPages("payment", "functions/ajaxRequests.php", jsonVar);
                    } else {
                        //swal(`The returned value is: ${value}`);
                        window.location = 'dashboard#dashboardPages';
                        //loadDashboardPages("payment", "functions/ajaxRequests.php", jsonVar);
                    }
                });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    text: "Error: " + dataParsed.error
                    //button: "Got It!",
                });

            }

        })

}

function maxValue(inputElementId, max) {
    inputElement = document.getElementById(inputElementId);
    if (inputElement.value > max) {
        inputElement.value = max;
        swal({
            //title: "New Course",
            title: "Error",
            icon: "error",
            //text: "Error: " + dataParsed[0].error
            text: "Value can't exceed " + max
            //button: "Got It!",
        });
    }
    //console.log(max);
}

function getConfirmation(messageTitle, messageDescription, linkIfYes) {
    swal({
        title: messageTitle,
        text: messageDescription,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Successfully Deactivated.", {
                    icon: "success",
                });
                window.location = linkIfYes;
            } else {
                //swal("Great Choice!");
            }
        });
}

var myFilterBox = addFilterBox({
    target: {
        selector: '.course_head',
        items: '.courses1 .courses2 .courses3',
        sources: [
            '.course_name',
            '.course_name .course_code'
        ]
    },
    addTo: {
        selector: '.course_head',
        position: 'before'
    },
    input: {
        label: 'Search: ',
        attrs: {
            class: 'form-control',
            placeholder: '*CEE121 **COMPUTER ENGINEERING'
        }
    },
    // wrapper: {
    //     tag: 'div',
    //     attrs: {
    //         class: 'filterbox-wrap'
    //     }
    // },
    displays: {
        counter: {
            tag: 'span',
            attrs: {
                class: 'counter'
            },
            addTo: {
                selector: '.filterbox-wrap',
                position: 'append'
            },
            text: function () {
                return '<strong>' + this.countVisible() + '</strong>/' + this.countTotal();
            }
        },
        noresults: {
            tag: 'div',
            addTo: {
                selector: '.course_head',
                position: 'after'
            },
            attrs: {
                class: 'no-results'
            },
            text: function () {
                return !this.countVisible() ? 'No matching course code or title for "' + this.getFilter() + '".' : '';
            }
        }
    },
    callbacks: {
        onReady: onFilterBoxReady,
        afterFilter: function () {
            this.toggleHide(this.getTarget(), this.isAllItemsHidden());
        },
        onEnter: function () {
            var $firstItem = this.getFirstVisibleItem();

            if ($firstItem) {
                alert('First visible item: ' + $firstItem.querySelector('td').textContent + '\n(onEnter callback)');
            }
        }
    },
    highlight: {
        style: 'background: #FFD662',
        minChar: 1
    },
    filterAttr: 'data-filter',
    suffix: '-mysuffix',
    debuglevel: 2,
    inputDelay: 100,
    zebra: true,
    enableObserver: true,
    initTableColumns: true,
    useDomFilter: false
});

var myFilterBox2 = addFilterBox({
    target: {
        selector: '.course_head2',
        items: '.courses1 .courses2 .courses3',
        sources: [
            '.course_name',
            '.course_name .course_code'
        ]
    },
    addTo: {
        selector: '.course_head2',
        position: 'before'
    },
    input: {
        label: 'Search: ',
        attrs: {
            class: 'form-control',
            placeholder: '*CEE121 **COMPUTER ENGINEERING'
        }
    },
    // wrapper: {
    //     tag: 'div',
    //     attrs: {
    //         class: 'filterbox-wrap'
    //     }
    // },
    displays: {
        counter: {
            tag: 'span',
            attrs: {
                class: 'counter'
            },
            addTo: {
                selector: '.filterbox-wrap',
                position: 'append'
            },
            text: function () {
                return '<strong>' + this.countVisible() + '</strong>/' + this.countTotal();
            }
        },
        noresults: {
            tag: 'div',
            addTo: {
                selector: '.course_head',
                position: 'after'
            },
            attrs: {
                class: 'no-results'
            },
            text: function () {
                return !this.countVisible() ? 'No matching course code or title for "' + this.getFilter() + '".' : '';
            }
        }
    },
    callbacks: {
        onReady: onFilterBoxReady,
        afterFilter: function () {
            this.toggleHide(this.getTarget(), this.isAllItemsHidden());
        },
        onEnter: function () {
            var $firstItem = this.getFirstVisibleItem();

            if ($firstItem) {
                alert('First visible item: ' + $firstItem.querySelector('td').textContent + '\n(onEnter callback)');
            }
        }
    },
    highlight: {
        style: 'background: #FFD662',
        minChar: 1
    },
    filterAttr: 'data-filter',
    suffix: '-mysuffix',
    debuglevel: 2,
    inputDelay: 100,
    zebra: true,
    enableObserver: true,
    initTableColumns: true,
    useDomFilter: false
});

function onFilterBoxReady() {
    this.fixTableColumns(this.getTarget());
    // this.filter('bra');
    this.focus(true);
}

function simpleAsyncSearch(url, inputId) {
    inputId = document.getElementById(inputId);
    $.ajax({
        type: "POST",
        url: url,
        data: 'keyword=' + $(inputId).val(),
        beforeSend: function () {
            setSearchBarLoader('line');
        },
        success: function (data) {
            console.log(data);
            $("#lecturer_list").show();
            $("#lecturer_list").html(data);
            removeSearchBarLoader('line');
        }
    });
}

function setSearchBarLoader(elementId) {
    elementId = document.getElementById(elementId);
    $(elementId).addClass('line');
    //$(className).removeClass('line')
}

function removeSearchBarLoader(elementId) {
    elementId = document.getElementById(elementId);
    $(elementId).removeClass('line');
}

function selectLecturer(val) {
    $("#lecturer_search_input").val(val);
    $("#lecturer_list").hide();
    $("#new_session_button").prop({
        disabled: false
    })
}

function updateResults(url, dataRequest) {
    console.log(dataRequest);
    setLoader();
    $.post(url,   // url
        dataRequest,//{ myData: 'This is my data.' }, // data to be submit
        function (data, status, jqXHR) {// success callback
            //$('#ajax_result').value = ('status: ' + status + ', data: ' + data + '<br>');
            console.log(data);
            var dataParsed = JSON.parse(data);
            //console.log(dataParsed);
            //removeLoader();

            if (dataParsed[0].error == null) {
                swal(dataParsed[0].success, {
                    title: "Success",
                    icon: "success"
                })

                    .then((value) => {
                        if (value) {
                            //swal(`The returned value is: ${value}`);
                            window.location = dataParsed[1].destination;
                        } else {
                            //swal(`The returned value is: ${value}`);
                            window.location = dataParsed[1].destination;
                        }
                    });

            } else {
                swal({
                    //title: "New Course",
                    title: "Error",
                    icon: "error",
                    //text: "Error: " + dataParsed[0].error
                    text: dataParsed[0].error
                    //button: "Got It!",
                });

            }

        })
}

// function dollarFormat(number) {
//     //window.alert('This naira format function is working');
//     console.log('inside dollarFormat function');
//     document.write('$');
//     document.write(number.toLocaleString(undefined, { maximumFractionDigits: 0 }));
//     //return ''.formater.format(number);
// }

// function dollarFormatReturn(number) {
//     //window.alert('This naira format function is working');
//     console.log('inside dollarFormatR function');
//     //window.alert('this should be working');
//     amount = number.toLocaleString(undefined, { maximumFractionDigits: 0 });
//     return (amount);
// }
