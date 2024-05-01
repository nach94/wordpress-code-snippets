(function ($) {

    $('.button-qty').click(function (e) {
        e.preventDefault();
        const inputQty = $(this).parent().find('input')[0];

        if ($(this).data('quantity') === 'plus') {
            inputQty.stepUp();
        } else {
            inputQty.stepDown();
        }

        $(inputQty).trigger('change');

    });
})(jQuery);