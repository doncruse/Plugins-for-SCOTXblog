<?php
/*
Plugin Name: Tames Error Page Remap
Plugin URI: http://www.scotxblog.com
Description: This is a private plugin to remap old Dallas COA urls to the 5th.txcourts.gov namespace.
Version: 1.0
Author: Don Cruse
Author URI: http://doncruse.com
License: (C)2012 All Rights Reserved
*/

function coa_remap_to_tames_error($content) {
	$coas_on_tames = array("/href=\"http:\/\/www\.14thcoa.courts\.state\.tx\.us\/opinions/");
	$content=preg_replace($coas_on_tames,"href=\"/broken-links-to-texas-court-websites/?ref_link=",$content);
	return $content;
}

/* Need to hook the priority after Markdown */
add_filter( 'the_content', 'coa_remap_to_tames_error', 29 );
add_filter( 'the_content_feed', 'coa_remap_to_tames_error', 29 );
