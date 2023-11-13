jQuery(document).ready(function(){
    var options = [];

    jQuery( '.country_drop a' ).on( 'click', function( event ) {

    var $target = jQuery( event.currentTarget ),
        val = $target.attr( 'data-bs-value' ),
        $inp = $target.find( 'input' ),
        idx;

    if ( ( idx = options.indexOf( val ) ) > -1 ) {
        options.splice( idx, 1 );
        setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
    } else {
        options.push( val );
        setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
    }

    jQuery( event.target ).blur();
    return false;
    });
})