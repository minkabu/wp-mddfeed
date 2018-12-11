<?php
/**
* @package MDDFeed
* @version 1.0
*/
/*
Plugin Name: MDDFeed
Plugin URI: https://minkabu.co.jp/
Description: Minkabu Data Dictionary用のRSSフィードを出力する
Author: Hiromasa Kawabata
Version: 1.0
Author URI: https://github.com/k-bata
*/

define( 'MDDFEED__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function do_feed_mdd() {
    $feed_template = MDDFEED__PLUGIN_DIR .'/feed-template.php';
    load_template( $feed_template );
}
add_action( 'do_feed_mdd', 'do_feed_mdd' );

?>
