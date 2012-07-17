<?php
/*
Plugin Name: TAMES Redirection
Plugin URI: http://www.scotxblog.com
Description: This is a private plugin to remap some URLs hard-coded into 
 										old posts in SCOTXblog to new locations that will not break 
 										if the old locations change in the TAMES switch. 										
Version: 0.5
Author: Don Cruse
Author URI: http://doncruse.com
License: Copyright 2012
*/

function tames_remap_electronic_briefs($content) {
    $ebrief_formats = array("/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+ebriefs\/+\d\d\//");
    $content=preg_replace($ebrief_formats,'href="http://s3.amazonaws.com/docketdb/scotx/briefs/',$content);
    return $content;
}

function tames_remap_html_orders($content) {
	$html_orders_format = array("/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+historical\/+(\d+)(\d\d)\/(\w+)\/(\d\d\d\d)(\\2)\.htm/");
$content=preg_replace($html_orders_format,"href=\"http://s3.amazonaws.com/docketdb/scotx/orders/$1$2/$3/$4$2.htm",$content);
	return $content;
}

function tames_remap_pdf_opinions($content) {
	$pdf_opinions = "/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+historical\/+(\d+)\/(\w+)\/(\d+\w*)\.pdf/";
$content=preg_replace($pdf_opinions,"href=\"http://s3.amazonaws.com/docketdb/scotx/$1/$2/$3.pdf",$content);
	return $content;
}

function tames_remap_html_opinions($content) {
	$html_opinions_format = array("/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+historical\/+(\d+)(\d\d)\/(\w+)\/(\d\d\d\d\d\d\w*)\.htm/");
$content=preg_replace($html_opinions_format,"href=\"http://docketdb.com/op/$1$2/$3/$4.htm",$content);
	return $content;
}


/* CRITICAL: Priority needs to come after Markdown conversion for the URLs to match  */
/* CRITICAL: HTML orders must have priority preceding HTML opinions because of overlaps in the URL pattern  */
add_filter( 'the_content', 'tames_remap_html_orders', 29 );
add_filter( 'the_content_feed', 'tames_remap_html_orders', 29 );
add_filter( 'the_content', 'tames_remap_electronic_briefs', 30 );
add_filter( 'the_content_feed', 'tames_remap_electronic_briefs', 30 );
add_filter( 'the_content', 'tames_remap_pdf_opinions', 32 );
add_filter( 'the_content_feed', 'tames_remap_pdf_opinions', 32 );
add_filter( 'the_content', 'tames_remap_html_opinions', 33 );
add_filter( 'the_content_feed', 'tames_remap_html_opinions', 33 );


/* Not implemented:  A routine to map old DocketDB pages to the (presumed) address for TAMES

function tames_remap_docketdb_docket_pages($content) {
	$old_docketdb = "/href=\"http:\/\/docketdb\.com\/(public|docket)\/(public|docket|dockets)\/(\d\d-\d\d\d\d)/";	
$content=preg_replace($old_docketdb,"href=\"http://www.search.txcourts.gov/Case.aspx?cn=$3",$content);
	return $content;
}

add_filter( 'the_content', 'tames_remap_docketdb_docket_pages', 33 );
add_filter( 'the_content_feed', 'tames_remap_docketdb_docket_pages', 33 ); 
*/

