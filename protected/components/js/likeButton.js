;
(function($, window, document, undefined) {

    // Create the defaults once
    var pluginName = "likeButton",
            defaults = {
        onSuccess: function() {
        },
        url: '',
        appId: '',
        appKey: '',
    };

    // The actual plugin constructor
    function Plugin(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype.init = function() {
        var options = this.options;
        var yleTunnus = require('yleTunnus');
        yleTunnus.init(function(isAuthenticated, userId) {
            getLikes(userId, options);
        });
        $(this.element).on('click', function(ev) {
            var yleTunnus = require('yleTunnus');
            yleTunnus.init(function(isAuthenticated, userId) {
                if (isAuthenticated) {
                    getLikes(userId, options);
                    like(ev, options, userId);
                }
                else {
                    yleTunnus.openLoginModal(function(userId) {
                        like(ev, options, userId);
                        $("#logout-button").show();
                        $("#login-button").hide();
                    });
                }
            });
        });
    };

    function getLikes(userId, options) {
        var that = this;
        if(that.prototype.likes === 'undefined') {
        return $.ajax({
            url: 'https://profiles.api.yle.fi/v1/api/' + userId + "/botsikot/like?app_id=" + options.appId + "&app_key=" + options.appKey,
            contentType: 'application/json'
        }).done(function(data) {
            that.prototype.likes = data;
            return data;
        });
        }
        else {
            return that.prototype.likes;
        }
    }

    function like(ev, options, userId) {
        $.ajax({
            url: options.url,
            data: {
                id: $(ev.currentTarget).attr('data-id'),
                userId: userId
            },
            success: function() {
                if (typeof options.onSuccess === 'function') {
                    options.onSuccess(ev.currentTarget);
                }
                $(ev.currentTarget).removeClass('btn-primary');
                $(ev.currentTarget).addClass('btn-primary');
                $(ev.currentTarget).attr('disabled', 'disabled');
                var likes = $('[data-id=\'' + $(ev.currentTarget).attr('data-id') + '\'] .likes').html();
                $('[data-id=\'' + $(ev.currentTarget).attr('data-id') + '\'] .likes').html(parseInt(likes, 10) + 1);
            }
        });
        return false;
    }

    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                        new Plugin(this, options));
            }
        });
    }

})(jQuery, window, document);
