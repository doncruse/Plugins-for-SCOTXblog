<?php
/*
Plugin Name: Legacy FilingID Remap
Plugin URI: http://www.scotxblog.com
Description: This is a tiny plugin to remap hyperlinks from legacy FilingID pages on the old SCOTX site to where I post information on DocketDB.
Version: 0.5
Author: Don Cruse
Author URI: http://doncruse.com
License:  Copyright 2012
*/

http://www.supreme.courts.state.tx.us/opinions/Case.asp?FilingID=33175

function filing_id_remap_to_docketdb($content) {
	$filing_id_url = "/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/opinions\/Case\.asp\?FilingID=(\d*)/";
	$content=preg_replace($filing_id_url,"href=\"http://docketdb.com/by_filing_id/$1",$content);
	return $content;
}

/* Need to hook the priority after Markdown */
add_filter( 'the_content', 'filing_id_remap_to_docketdb', 30 );
add_filter( 'the_content_feed', 'filing_id_remap_to_docketdb', 30 );
