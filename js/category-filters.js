(function($) {

  $('#category-filter-container').on( 'click', '.pagination a, a[data-filter]', function(event) {
    event.preventDefault();

    var $this = $(this);

    if ($this.data('filter')) {

      $this.closest('ul').find('.active').removeClass('active');
      $this.parent().addClass('active');
      var $page = $this.data('page');

    } else {

      var $page = parseInt($this.attr('href').replace(/\D/g,''));
      var $this = $('.nav-filter .active a');

    }

    var $params = {
      'page'      : $page,
      'tax'       : $this.data('filter'),
      'term'      : $this.data('term'),
      'quantity'  : $this.closest('#category-filter-container').data('paged')
    }

    get_posts( $params );

    //$('a[data-term="all-terms"]').trigger('click');

    function get_posts( $params ) {

      var $container = $('.site-main.grid');
      var $content = $container.find('.results');
      var $status = $container.find('.status')

      $status.text('Loading...');

      $.ajax({

        url: littlesis_category_filters.ajax_url,
        data: {
          action:   'littlesis_category_filters',
          nonce:    littlesis_category_filters.nonce,
          params:   $params
        },
        type:       'post',
        dataType:   'json',

        success: function(data, textStatus, XMLHttpRequest) {

          console.log(data);

          if(data.status == 200) {
            $content.html(data.content);
          } else if(data.status == 201) {
            $content.html(data.message);
          } else {
            $content.html(data.message);
          }

        },

        error: function(XMLHttpRequest, textStatus, error) {

          $status.html(textStatus);

        },

        complete: function(data, textStatus) {

          var msg = textStatus;

          if(textStatus == 'success') {
            msg = data.responseJSON;
          }

          $status.html('Posts found ' + msg);

        }

      });

    }

  } );
})(jQuery);
