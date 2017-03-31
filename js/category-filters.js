(function($) {

  /**
   * Variables
   */
  var contentEl = $( '#main .results' );

  var filterEl = $( '#taxonomy-filters a' );

  var buttonContainer = $( '#infinite-scroll' );
  var buttonContent = '<button class="btn btn-primary">' + littlesis_taxonomy_filters.button_text + '</button>';
  buttonContainer.append(buttonContent);
  var buttonEl = $( '#infinite-scroll button' );

  var nextPage = 2;

  /**
   * Load More Event
   */
  buttonEl.click(function(event) {
    event.preventDefault();

    var $this = $( this );
    var data = $this[0].dataset;

    var $filter = filterEl.closest('ul').find('.active').find('a');
    var args = $filter[0].dataset;

    args.posts_per_page =  littlesis_taxonomy_filters.posts_per_page;
    args.paged = nextPage;

    get_posts(args);

  });

  /**
   * Filter Event
   */
  filterEl.click(function(event) {
    event.preventDefault();

    nextPage = 2;
    buttonEl.attr( 'data-paged', nextPage ).prop( 'disabled', false );

    var $this = $( this );

    $this.closest('ul').find('li').removeClass('active');
    $this.parent('li').addClass('active');

    var args = $this[0].dataset;

    args.posts_per_page =  littlesis_taxonomy_filters.posts_per_page;
    args.paged = 0;

    get_posts(args);

  });

  /**
   * Get Posts
   * @param  obj args
   * @return obj response
   */
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

      //If a paged request, append posts
      if( response.paged ) {
        contentEl.append( response.content );

        //Increment pager
        nextPage++;
        buttonEl.attr( 'data-paged', nextPage );

      } else { //If filter request, reload with category posts
        contentEl.html( response.content );
      }

      // Disable Load More
      // If there is only 1 page of posts or is last page, disable the button
      if( 1 === response.max_pages || response.max_pages <= response.paged ) {
        buttonEl.prop( 'disabled', true );
      }

    })
    .error(function(response) {
      //console.log('error', response);
    })
    .complete(function(response) {
      //console.log(response);
    });

  }


})(jQuery);
