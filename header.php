<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Miyakimolzavod
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<? if(wpmd_is_phone() === true) : ?>
		<meta name="viewport" content="width=640px">
	<? else : ?>
		<meta name="viewport" content="width=device-width">
	<? endif; ?>
	<?php wp_head(); ?>
	<style type="text/css">
	    #onloaded{
	        background-color: #fff;
	        position: fixed;
	        top: 0;
	        left: 0;
	        width: 100%;
	        height: 100%;
	        z-index: 99999;
	    }

	    #onloaded > img{
	        position: absolute;
	        top: calc(50% - 195px);
	        left: calc(50% - 180px);
	        width: 360px;
	        height: 360px;
	        transform: scale(.7);
	    }
	</style>
	<link rel="stylesheet" href="<?=get_stylesheet_directory_uri()?>/js/jquery/slick/slick.css">
	<link rel="stylesheet" href="<?=get_stylesheet_directory_uri()?>/css/style.css">
</head>
<body class="modal_bg">
<div id="onloaded">
  <img src="<?=get_stylesheet_directory_uri()?>/images/other/preloaderbg.gif">
</div>
