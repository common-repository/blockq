<?php
/*
Plugin Name: BlockQ
Plugin URI: http://box.net/iPublicis4Wordpress
Description: Unclutter long &lt;blockquote&gt;'s into show/hidden sections. Surround text inside &lt;blockquote&gt; with [blockq][/blockq]. Like it? <a href="http://smsh.me/7kit" target="_blank" title="Paypal Website"><strong>Donate</strong></a> | <a href="http://www.amazon.co.uk/wishlist/2NQ1MIIVJ1DFS" target="_blank" title="Amazon Wish List">Amazon Wishlist</a>
Version: 1.0 
Author: Lopo Lencastre de Almeida <dev@ipublicis.com>
Author URI: http://ipublicis.com/
Donate link: http://smsh.me/7kit
License: GNU GPL v3 or later

    Copyright (C) 2009 iPublicis!COM

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

function blockQ_css(){
	global $blockq_dirname;
	
	$blockQ = get_option('blockQ');
	if(intval($blockQ) == 1) {
		$blockQStyleUrl = WP_PLUGIN_URL . '/' . $blockq_dirname . '/blockq.css';
        $blockQStyleFile = WP_PLUGIN_DIR . '/' . $blockq_dirname . '/blockq.css';
        if ( file_exists($blockQStyleFile) ) {
            wp_register_style('blockQStyleSheets', $blockQStyleUrl);
            wp_enqueue_style( 'blockQStyleSheets');
        }
	}
}

function blockQ_js(){
	global $blockq_url;
	
    $blockQ = get_option('blockQ');
    if(intval($blockQ) == 1)
		wp_enqueue_script('blockq_js', $blockq_url.'/blockq.js');
}

function active_blockQ(){
    add_option('blockQ','1','active the plugin');
}

function deactive_blockQ(){
    delete_option('blockQ');
}

function render_blockQ($text) {
	
    $blockQ_open_tag =  	'<span class="clickmore"><a href="javascript:void()" title="'.__('more', 'blockq').'">'.__('more', 'blockq').'</a></span>' . 
										'<span class="blockq">';
    $blockQ_tag_elements = array(
        '\[blockq\s*\]' => $blockQ_open_tag,
        '\[/blockq\]'   => '</span>',
    );

    foreach ($blockQ_tag_elements as $blockQtag => $showtag) {
        $text = eregi_replace($blockQtag, $showtag, $text);
    }
    return $text;
}

$blockq_dirname = plugin_basename(dirname(__FILE__));
if ( !defined('WP_PLUGIN_URL') ) 
	define( 'WP_PLUGIN_URL', get_option('siteurl') . '/wp-content/plugins');
$donate = '<a href="http://smsh.me/7kit">donation</a>';

//load translation file if any for the current language
load_plugin_textdomain('blockq', PLUGINDIR . '/' . $blockq_dirname . '/locale');

register_activation_hook(__FILE__,'active_blockQ');
register_deactivation_hook(__FILE__,'deactive_blockQ');

// add_action('wp_head', 'blockQ_css');
add_action('wp_head', 'blockQ_js');

add_filter('the_content', 'render_blockQ', 10);
?>