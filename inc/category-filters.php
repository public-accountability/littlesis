<?php
/**
 * LittleSis Category Filters
*
 * @package understrap
 * @subpackage littlesis
 * @since 0.1.0
 */


 function littlesis_category_filters() {

   if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'littlesis_category_filters' ) ) {
     die( 'Permission Denied.' );
   }

   $response = array(
     'status'  => 500,
     'message' => __( 'Something is wrong, please try again later...', 'littlesis-core' ),
     'content' => false,
     'found'   => 0
   );

   $tax = sanitize_text_field( $_POST['params']['tax'] );
   $term = sanitize_text_field( $_POST['params']['term'] );
   $page = intval( $_POST['params']['page'] );
   $quantity = intval( $_POST['params']['quantity'] );

   if( !term_exists( $term, $tax ) && 'all-terms' != $term ) {

     $response = array(
       'status'	=> 501,
       'message'	=> __( 'Term Does Not Exist', 'littlesis-core' ),
       'content' => 0
     );

     die( json_encode( $response ) );

   }

   $tax_query[] = array(
     'taxonomy'	=> $tax,
     'field'			=> 'slug',
     'terms'			=> $term,
     'operator'	=> ( 'all-terms' == $term ) ? 'NOT IN' : '',
   );

   $args = array(
     'paged'						=> $page,
     'post_type'				=> 'post',
     'posts_per_page'	=> $quantity,
     'tax_query'				=> $tax_query,
   );

   $query = new WP_Query( $args );

   ob_start();

   if( $query->have_posts() ) {
     while( $query->have_posts() ) {
       the_post();

       get_template_part( 'loop-templates/content', 'grid' );

     }

     $response = array(
       'status'		=> 200,
       'found'			=> $quantity,
     );

   } else {

     get_template_part( 'loop-templates/content', 'none' );

     $response = array(
       'status'		=> 201,
       'found'			=> __( 'None Found', 'littlesis-core' ),
     );

   }

   $response['content'] = ob_get_clean();

   die( json_encode( $response ) );

}
add_action( 'wp_ajax_littlesis_category_filters', 'littlesis_category_filters' );
add_action( 'wp_ajax_no_priv_littlesis_category_filters', 'littlesis_category_filters' );
