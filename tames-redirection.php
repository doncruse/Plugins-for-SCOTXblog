<?php
/*
Plugin Name: TAMES Redirection
Plugin URI: http://www.scotxblog.com
Description: This is a private plugin to remap some URLs hard-coded into old posts in SCOTXblog to new locations that will not break when the Court rearranges its own website.
Version: 0.5
Author: Don Cruse
Author URI: http://doncruse.com
License: Copyright 2012
*/

function tames_remap_electronic_briefs($content) {
    $ebrief_formats = array("/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+ebriefs\/+\d\d\//");
    $content=preg_replace($ebrief_formats,'href="http://legacy.texasappellate.com/docketdb/scotx/briefs/',$content);
    return $content;
}

function tames_remap_html_orders($content) {
	$html_orders_format = array("/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+historical\/+(\d+)(\d\d)\/(\w+)\/(\d\d\d\d)(\\2)\.htm/");
$content=preg_replace($html_orders_format,"href=\"http://legacy.texasappellate.com/docketdb/scotx/orders/$1$2/$3/$4$2.htm",$content);
	return $content;
}

function tames_remap_pdf_opinions($content) {
	$pdf_opinions = "/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+historical\/+(\d+)\/(\w+)\/(\d+\w*)\.pdf/";
$content=preg_replace($pdf_opinions,"href=\"http://legacy.texasappellate.com/docketdb/scotx/$1/$2/$3.pdf",$content);
	return $content;
}

function tames_remap_html_opinions($content) {
	$html_opinions_format = array("/href=\"http:\/\/www\.supreme\.courts\.state\.tx\.us\/+historical\/+(\d+)(\d\d)\/(\w+)\/(\d\d\d\d\d\d\w*)\.htm/");
$content=preg_replace($html_opinions_format,"href=\"http://docketdb.com/op/$1$2/$3/$4.htm",$content);
	return $content;
}

function tames_remap_docketdb_docket_pages($content) {
	$old_docketdb = "/href=\"http:\/\/docketdb\.com\/(public|docket)\/(public|docket|dockets)\/(\d\d-\d\d\d\d)/";	
$content=preg_replace($old_docketdb,"href=\"http://www.search.txcourts.gov/Case.aspx?cn=$3",$content);
	return $content;
}

/* TODO:  Consider mapping old legacy FilingID pages on supreme court site to DocketDB first, then back somewhere */

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
/* add_filter( 'the_content', 'tames_remap_docketdb_docket_pages', 33 );
add_filter( 'the_content_feed', 'tames_remap_docketdb_docket_pages', 33 ); */

