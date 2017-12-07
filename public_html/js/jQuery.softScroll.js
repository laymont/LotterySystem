/*
 * jQuery 'soft scrolling' plugin
 * http://fortyonedegrees.co.uk/
 * Copyright 2013, Forty-one Degrees
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

;(function(window, $) {

    $.fn.softScroll = function (options) {
        options = $.extend({
            'overshoot' : 0,
            'duration' : 500
        }, options);

        var $body = $('html, body');
        var el;
        var href;
        var $toEl;
        var top;

        $(this).on('click', 'a[href^="#"]', function (e) {
            el   = this;
            href = el.getAttribute('href').substr(1);
            top  = null;

            // To absolute px
            if (href.length > 2 && href.substr(-2) === 'px') {
                // Sub
                top = parseInt(href.substr(0, href.length - 2), 10);
            }

            // To element px
            else {
                $toEl = $('#' + href);

                if (!($toEl.length === 0)) {
                    top = $toEl.offset().top;
                }
            }

            // There's somewhere to go
            if (!(top === null)) {

                // Overshooting means scrolling less...
                top -= parseInt(options.overshoot, 10);

                $body.animate({
                    'scrollTop' : top + 'px'
                }, options.duration);

                // We're soft scrollin', Don't do the default.
                if (e.preventDefault) {
                    e.preventDefault();
                }

                return false;
            }
        });
    };

}(this, jQuery));