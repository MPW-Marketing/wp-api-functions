<?php
/*
Plugin Name: DMM API Functions
Description: Exposes some meta, sets up routes
Version:     0.1-alpha
 */

function slug_get_post_meta_cb( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name );
}
function slug_update_post_meta_cb( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}
add_action( 'rest_api_init', function() {
 register_api_field( 'beer',
    'ibu',
    array(
       'get_callback'    => 'slug_get_post_meta_cb',
       'update_callback' => 'slug_update_post_meta_cb',
       'schema'          => null,
); ) });

add_filter( 'is_protected_meta', function( $protected, $meta_key ) {
   if ( '_yoast_wpseo_title' == $meta_key || '_yoast_wpseo_metadesc' == $meta_key && defined( 'REST_
REQUEST' ) && REST_REQUEST ) {
      $protected = false;
}
   return $protected;
}, 10, 2 );

register_api_field( 'post',
   '_yoast_wpseo_title',
   array(
      'get_callback'    => 'slug_get_post_meta_cb',
      'update_callback' => 'slug_update_post_meta_cb',
      'schema'          => null,
) );
register_api_field( 'post',
   '_yoast_wpseo_metadesc',
   array(
      'get_callback'    => 'slug_get_post_meta_cb',
      'update_callback' => 'slug_update_post_meta_cb',
      'schema'          => null,
) );
register_api_field( 'page',
   '_yoast_wpseo_title',
   array(
      'get_callback'    => 'slug_get_post_meta_cb',
      'update_callback' => 'slug_update_post_meta_cb',
      'schema'          => null,
) );
register_api_field( 'page',
   '_yoast_wpseo_metadesc',
   array(
      'get_callback'    => 'slug_get_post_meta_cb',
      'update_callback' => 'slug_update_post_meta_cb',
      'schema'          => null,
) );