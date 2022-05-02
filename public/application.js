
(function () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


})();

!function ($) {
    'use strict';
    var NotificationApp = function () {
    };

    NotificationApp.prototype.send = function (heading, body, position, loaderBgColor, icon, hideAfter, stack, showHideTransition) {
        // default
        if (!hideAfter)
            hideAfter = 3000;
        if (!stack)
            stack = 1;

        var options = {
            heading: heading,
            text: body,
            position: position,
            loaderBg: loaderBgColor,
            icon: icon,
            hideAfter: hideAfter,
            stack: stack
        };

        if (showHideTransition)
            options.showHideTransition = showHideTransition;

        console.log(options);
        $.toast().reset('all');
        $.toast(options);
    },

        $.NotificationApp = new NotificationApp, $.NotificationApp.Constructor = NotificationApp

}(window.jQuery)

function appNotification(type = 'info', title, message = "") {
    $.NotificationApp.send(title, message, 'top-right', '#1ea69a', type, 3000, 1, 'slide');
}

function appRequest(url, body = {}, method = 'GET') { 
    return new Promise((resolve, reject) => {
        return $.ajax({
            url: url,
            type: method,
            data: body,
            success: function (data) {
                resolve(data)
            },
            error: function (error) {
                reject(error.responseJSON)
            },
        })
    })
}

