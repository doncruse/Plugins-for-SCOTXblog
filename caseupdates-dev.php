<?php
/*
Plugin Name: Case Updates - Development Plugin
Plugin URI: https://www.scotxblog.com
Description: Integration between wordpress site and my data backend
Version: 1.1
Author: Don Cruse
Author URI: https://texasappellate.com
License: Copyright 2019
*/

/* Shows HTML for a standard case information
	 block with opinion information
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
	$replacement = 'src="https://static.scotxblog.com/assets/justices';
	$result = preg_replace("/src=\"\/assets\/justices/", $replacement, $result);
	return $result;
/*	set_transient($transient, $results, 10);*/
}

add_shortcode("texapp", "standard_version");

/* Shows a version that includes the latest case summary,
	 if a case summary has been written
*/

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
	$replacement = 'src="https://static.scotxblog.com/assets/justices';
	$result = preg_replace("/src=\"\/assets\/justices/", $replacement, $result);
	return $result;
/*	set_transient($transient, $results, 10);*/
}

add_shortcode("summary", "summary_version");

/* Shows just the name of the case in inline text,
	 along with a docket number and link to the main
	 data website.
*/

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

	return $result;
/*	set_transient($transient, $results, 10);*/
}

add_shortcode("texapptext", "texapp_text_version");

/* Shows a full page of the OA sitting week.
 	 Note: current implementation does not have images,
	 so that $replacement for image paths is unnecessary.
*/

function oa_sitting_week_insert($atts) {
	extract(shortcode_atts(array(
		"date" => 'empty'
	), $atts));

	if ( date == 'empty' ) {
		return '';
	}

	$site = "https://data.scotxblog.com/api/oa_sitting/week/".$date;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $site);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

add_shortcode("oa_sitting", "oa_sitting_week_insert");
