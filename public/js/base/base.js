function process_content(item) {
    jQuery(item).find('.bootbox-html').each(function(index, el) {
        var target = el.getAttribute('bootbox-target');
        var message = $(target).html();
        jQuery(el).on( "click", function() {
            bootbox.dialog({
                title: el.getAttribute('bootbox-title'),
                message: message,
            });
        });
        $(document).on("shown.bs.modal", function (event) {
            process_content(event.target);
        });
    });

    jQuery(item).find('.bootbox-confirm').each(function(index, el) {
        var message = jQuery(el).attr('confirm-message');
        var href = jQuery(el).attr('href');

        if (!message) {
            message = "Are you sure?";
        }

        jQuery(el).on( "click", function(event) {
            event.preventDefault();
            bootbox.confirm(message, function (result) {
                if (result) {
                    if (href) {
                        window.location.href = href;
                    }
                }
            });
        });

    });

    jQuery(item).find('.drawer').each(function(index, el) {
        var opts = jQuery(el).attr('drawer-options');
        if (opts) {
            var options = opts.parseJSON();
        } else {
            var options = {};
        }

        if (!options.target) {
            options.target = '.drawer-target';
        }
        if (!options.toggle) {
            options.toggle = '.drawer-toggle';
        }
        var drawer = jQuery(el).find(options.target);
        var toggleEl = jQuery(el).find(options.toggle);
        var toggleActive = function() {
            if (jQuery(drawer).is( ":hidden" )) {
                if (jQuery(toggleEl).is(':checkbox')) {
                    jQuery(toggleEl).prop('checked', false);
                } else {
                    jQuery(toggleEl).removeClass('active');
                }
            } else {
                if (jQuery(toggleEl).is(':checkbox')) {
                    jQuery(toggleEl).prop('checked', true);
                } else {
                    jQuery(toggleEl).addClass('active');
                }
            }
        }
        toggleActive();

        jQuery(toggleEl).on("click", function(event) {
            jQuery(drawer).slideToggle( "fast", function() {
                toggleActive();
            });
        });
    });

    jQuery(item).find('.clone-container').each(function(index, el) {
        jQuery(el).cloneya({
            limit       : 999,
            cloneThis       : '.clone-target',
            valueClone      : false,
            dataClone       : false,
            deepClone       : false,
            cloneButton     : '.clone',
            deleteButton    : '.delete',
            clonePosition   : 'after',
            serializeID         : true,
            ignore      : 'label.error'
        });
    });

}

$(document).ready(function() {
    process_content($('body'));
});