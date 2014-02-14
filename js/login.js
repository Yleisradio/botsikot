require.config({
    baseUrl: 'js',
    paths: {
        jquery: 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min',
        yleTunnus: 'http://tunnus.yle.fi/yletunnus/js/yleTunnus'
    }
});

define(function(require) {
    var $ = require('jquery');
    $.noConflict(true);
    var yleTunnus = require('yleTunnus');
    yleTunnus.init(function(isAuthenticated, userId) {
        var logoutButton = $("#logout-button");
        logoutButton.click(function(event) {
            event.preventDefault()
            yleTunnus.logout(function() {
                logoutButton.hide();
                loginButton.show();
            });
        });

        var loginButton = $("#login-button");
        loginButton.click(function(event) {
            event.preventDefault()
            yleTunnus.openLoginModal(function(userId) {
                logoutButton.show();
                loginButton.hide();
            })
        });

        if (isAuthenticated) {
            logoutButton.show();
        }
        else {
            loginButton.show();
        }
    });

    return {};
});

