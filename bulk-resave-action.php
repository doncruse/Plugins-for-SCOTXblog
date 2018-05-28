<?php
/*
Plugin Name: Bulk Re-save Action
Plugin URI: https://doncruse.com
Description: Bulk action to trigger on-save callbacks on many posts
Version: 1.0
Author: Don Cruse
Author URI: https://doncruse.com
License: (C)2018 All Rights Reserved
*/

add_filter( 'bulk_actions-edit-post', 'register_my_bulk_actions' );

function register_my_bulk_actions($bulk_actions) {
  $bulk_actions['force_resave_posts'] = __( 'Trigger Save Callbacks', 'force_resave_posts');
  return $bulk_actions;
}

add_filter( 'handle_bulk_actions-edit-post', 'my_bulk_action_handler', 10, 3 );

function my_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
  if ( $doaction !== 'force_resave_posts' ) {
    return $redirect_to;
  }
  foreach ( $post_ids as $post_id ) {
    // Perform action for each post.
  }
  $redirect_to = add_query_arg( 'posts_resaved', count( $post_ids ), $redirect_to );
  return $redirect_to;
}

add_action( 'admin_notices', 'my_bulk_action_admin_notice' );

function my_bulk_action_admin_notice() {
  if ( ! empty( $_REQUEST['posts_resaved'] ) ) {
    $saved_count = intval( $_REQUEST['posts_resaved'] );
    printf( '<div id="message" class="updated fade">' .
      _n( 'Forced save callbacks on %s posts.',
        'Forced save callbacks on %s posts.',
        $saved_count,
        'force_resave_posts'
      ) . '</div>', $saved_count );
  }
}
