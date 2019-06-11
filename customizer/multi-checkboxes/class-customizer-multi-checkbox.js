( function( $ ) {
    $('body').on(
        'change',
        '.wsuwp-customizer-multi-checkbox input[type=checkbox]',
        function(event) {
            var wrapper = $(this).closest('.wsuwp-customizer-multi-checkbox');
            var input = wrapper.find('input[type=hidden]');
            var selected = [];
            wrapper.find('input[type=checkbox]:checked').each(
                function( index ) {
                    selected.push( $(this).val() );
                }
            );
            input.val( selected.join(',') );
            input.trigger('change');
        }
    );
} )( jQuery );