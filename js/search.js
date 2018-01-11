(function($) {

  /**
   * Add Mark-up Around Search Icon
   */
  $('#main-menu .menu-search-icon a').wrapInner('<span class="screen-reader-text" aria-hidden="true"></span>');


  /**
   * Toggle Search Expand/Collapse
   */
  $('#main-menu .menu-search-icon').on('click', function(event) {
    event.preventDefault();
    var $el = $('.top-search');

    $el.toggleClass( 'expanded' ).toggleClass( 'collapsed' );

    if( 'true' == $el.attr( 'aria-expanded' ) ) {
      $el.attr( 'aria-expanded', 'false' );
    } else {
      $el.attr( 'aria-expanded', 'true' );
    }
  });

  $('.top-search .close-button').on('click', function(event) {
    event.preventDefault();
    var $el = $(this).closest('.top-search');

    $el.toggleClass( 'expanded' ).toggleClass( 'collapsed' );

    if( 'true' == $el.attr( 'aria-expanded' ) ) {
      $el.attr( 'aria-expanded', 'false' );
    } else {
      $el.attr( 'aria-expanded', 'true' );
    }
  });

})( jQuery );
