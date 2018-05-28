<?php
/*
Plugin Name: Case Updates - Development Plugin
Plugin URI: https://www.scotxblog.com
Description: Working on the Case Updates functionality in SCOTXblog, to be used to seed the database (and to see whether this is a viable input method).
Version: 0.5
Author: Don Cruse
Author URI: https://texasappellate.com
License: Copyright 2018
*/


/* Goes to TexasApp -> comes back with raw HTML to render
   Which should be the fastest way to get something online
*/

function standard_version($atts) {
	extract(shortcode_atts(array(
		"docket_no" => 'empty',
		"post_date" => get_the_time("Y-m-d")
	), $atts));

	if ( $docket_no == 'empty' ) {
		return '';
	}

	$site = "https://data.scotxblog.com/api/standard/scotx/no/".$docket_no."?post_date=".$post_date;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $site);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	/* Does Curl send back HTML that is directly usable? */

	/* src="/assets/justices */
	/* Fixing the location of photo assets */
	$replacement = 'src="https://static.scotxblog.com/assets/justices';
	$result = preg_replace("/src=\"\/assets\/justices/", $replacement, $result);
	return $result;
/*	set_transient($transient, $results, 10);*/
}

add_shortcode("texapp", "standard_version");

function summary_version($atts) {
	extract(shortcode_atts(array(
		"docket_no" => 'empty',
		"post_date" => get_the_time("Y-m-d")
	), $atts));

	if ( $docket_no == 'empty' ) {
		return '';
	}

	$site = "https://data.scotxblog.com/api/summary/scotx/no/".$docket_no."?post_date=".$post_date;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $site);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	/* Does Curl send back HTML that is directly usable? */

	/* src="/assets/justices */
	/* Fixing the location of photo assets */
	$replacement = 'src="https://static.scotxblog.com/assets/justices';
	$result = preg_replace("/src=\"\/assets\/justices/", $replacement, $result);
	return $result;
/*	set_transient($transient, $results, 10);*/
}

add_shortcode("summary", "summary_version");

function texapp_text_version($atts) {
	extract(shortcode_atts(array(
		"docket_no" => 'empty',
		"post_date" => get_the_time("Y-m-d")
	), $atts));

	if ( $docket_no == 'empty' ) {
		return '';
	}

	$site = "https://data.scotxblog.com/api/text/scotx/no/".$docket_no."?post_date=".$post_date;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $site);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	/* Does Curl send back HTML that is directly usable? */

	/* src="/assets/justices */
	/* Fixing the location of photo assets */
	/* $replacement = 'src="https://static.scotxblog.com/assets/justices';
	$result = preg_replace("/src=\"\/assets\/justices/", $replacement, $result);*/
	return $result;
/*	set_transient($transient, $results, 10);*/
}

add_shortcode("texapptext", "texapp_text_version");

/* Seems to have some caching built into $transient with an expiration of 120 somethings --- is that seconds? Could be handy.  Makes sense to throttle the rates a little bit, and could also speed up rendering when information isn't changing rapidly.
