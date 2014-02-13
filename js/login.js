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

    });

    return {};
});