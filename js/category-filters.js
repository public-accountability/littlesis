(function($) {

  var $i = 2,
  $params;

  $('#ajax-filter-container').on('click', 'a[data-filter], button[data-page]', function(event) {

    if(event.preventDefault) { event.preventDefault(); }

    $this = $(this);



   /**
    * Set filter active
    */
    if ($this.data('filter')) {
      $page = 1;
      $paged = false;

      $this.closest('ul').find('.active').removeClass('active');

      // Toggle current active
      $this.parent('li').toggleClass('active');
    }
    else {
   /**
    * Pagination
    */
      $this.data('page', $i);
      $page = $this.data('page');
      $paged = true;
      $this = $('.filter-nav .active a');

      if( button.data( 'maxPages' ) >= $page ) {
        $i++;
      }

    }

    $params    = {
      'page' : $page,
      'term' : $this.data('term'),
      'tax' : $this.data('filter'),
      'quantity' : $this.closest('#taxonomy-filter-container').data('paged'),
      'paged' : $paged
    };

    get_posts($params);

  }); // $('#ajax-filter-container')

  /**
   * Retrieve posts
   */
  function get_posts($params) {

    $container = $('.site-main.grid');
    $content   = $container.find('.row.results');

    $.ajax({
      url: littlesis_taxonomy_filters.ajax_url,
      data: {
        action: 'do_taxonomy_filters',
        nonce: littlesis_taxonomy_filters.nonce,
        params: $params
      },
      type: 'post',
      dataType: 'json',
      beforeSend: function() {
        $content.html( 'Loading...' );
      },
      success: function(response) {
        if( $params.paged ) {
          $content.append( response.data );
        } else {
          $content.html( response.data );
        }
        console.log(response);
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
      }
    });

  } // get_posts()


})(jQuery);
