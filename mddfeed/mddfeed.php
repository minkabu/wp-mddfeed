<?php
/**
* @package MDDFeed
* @version 1.0
*/
/*
Plugin Name: MDDFeed
Plugin URI: https://github.com/minkabu/wp-mddfeed
Description: Minkabu Data Dictionary用のRSSフィードを出力する
Author: Hiromasa Kawabata
Version: 1.0
Author URI: https://github.com/k-bata
*/

define( 'MDDFEED__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function change_post_status_for_mddfeed($query) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->is_feed('mdd') ) {
        $query->set( 'post_status', array('publish', 'private', 'trash'));
        return;
    }
}
add_action( 'pre_get_posts', 'change_post_status_for_mddfeed' );

function do_feed_mdd() {
    $feed_template = MDDFEED__PLUGIN_DIR .'/feed-template.php';
    load_template( $feed_template );
}
add_action( 'do_feed_mdd', 'do_feed_mdd' );

?>
