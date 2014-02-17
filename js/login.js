require.config({
    baseUrl: 'js',
    paths: {
        jquery: 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min',
        yleTunnus: 'http://tunnus.yle.fi/yletunnus/js/yleTunnus'
    }
});

var likes;

define(function(require) {
    var $ = require('jquery');
    $.noConflict(true);
    var yleTunnus = require('yleTunnus');
    yleTunnus.init(function(isAuthenticated, userId) {
        getLikes(userId);
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

    function getLikes(userId) {
            $.ajax({
                url: 'https://profiles.api.yle.fi/v1/api/' + userId + "/botsikot/like?app_id=3d6a6580&app_key=f5312a84f105c2be552868780ea85ea9",
                contentType: 'application/json',
                success: function(data) {
                    $.each(data, function(index, element) {
                        var likeButton = $('#all-headings-grid a[data-id="' + element.id + '"]');
                        likeButton.removeClass('btn-primary');
                        likeButton.addClass('btn-primary');
                        likeButton.attr('disabled', 'disabled');
                    })
                }
            });
    }

    return {};
});

