function process_content($selector) {
    $($selector).find('.bootbox-html').each(function(index, el) {
        var target = el.getAttribute('bootbox-target');
        var message = $(target).html();
        jQuery(el).on( "click", function() {
            bootbox.dialog({
                title: el.getAttribute('bootbox-title'),
                message: message,
            });
        });
        $(document).on("shown.bs.modal", function (event) {
            process_content('.modal-dialog');
        });
    });

    $($selector).find('.bootbox-confirm').each(function(index, el) {
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
}

$(document).ready(function() {
    process_content('body');
});