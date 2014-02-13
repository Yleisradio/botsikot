;
(function($, window, document, undefined) {

    // Create the defaults once
    var pluginName = "likeButton",
            defaults = {
        onSuccess: function() {
        },
        url: ''
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
        $(this.element).on('click', function(ev) {
            var yleTunnus = require('yleTunnus');
            yleTunnus.init(function(isAuthenticated, userId) {
                if (isAuthenticated) {
                    like(ev, options);
                }
                else {
                    yleTunnus.openLoginModal(function(userId) {
                        like();
                    });
                }
            });
        });
    };

    function like(ev, options) {
        $.ajax({
            url: options.url,
            data: {
                id: $(ev.currentTarget).attr('data-id')
            },
            success: function() {
                if (typeof options.onSuccess === 'function') {
                    options.onSuccess(ev.currentTarget);
                }
                $(ev.currentTarget).removeClass('btn-primary');
                $(ev.currentTarget).addClass('btn-inverse');
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
