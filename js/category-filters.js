(function($) {

  var filterEl = $( '#taxonomy-filters a' );
  var contentEl = $( '#main .results' );
  var buttonContainer = $( '#infinite-scroll' );
  var button = '<button class="btn btn-primary" data-page="2">' + littlesis_taxonomy_filters.button_text + '</button>';

  /**
   * Filter
   * @type {[type]}
   */
  filterEl.click(function(event) {
    event.preventDefault();

    var $this = $( this );

    $this.closest('ul').find('li').removeClass('active');
    $this.parent('li').addClass('active');

    var args = $this[0].dataset;

    args.posts_per_page = $( '#taxonomy-filters' ).data( 'paged' );

    get_posts(args);

  });

  function get_posts(args) {
    $.ajax({
      url: littlesis_taxonomy_filters.ajax_url,
      data: {
        action: 'do_taxonomy_filters',
        nonce: littlesis_taxonomy_filters.nonce,
        args: args
      },
      type: 'POST'
    })
    .success(function(response, textStatus, XMLHttpRequest) {
      contentEl.html( response.content );
      //console.log( 'response', response );
    })
    .error(function(response) {
      //console.log('error', response);
    })
    .complete(function(response) {
      //console.log('complete ', response);
    });
  }


})(jQuery);
