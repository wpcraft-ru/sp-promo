<?php
/*
Plugin Name: The increased functional from a massage parlor
Plugin URI: 
Description: Beckend for massage parlor 
Author: CasePress Studio
Author URI: http://casepress.org/
Version: 0.1
*/

// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

// DIR полный путь до плагина
if(!defined('MASSAGE_PARLOR_DIR')) DEFINE('MASSAGE_PARLOR_DIR', plugin_dir_path( __FILE__ ) );
	
// URL адрес до плагина
if(!defined('MASSAGE_PARLOR_URL')) DEFINE('MASSAGE_PARLOR_URL', plugin_dir_url( __FILE__ ) );
//*****************************************************************************************//

//***************************** Станции Метро ******************************//
require_once( MASSAGE_PARLOR_DIR . 'metro-station/create-post-type.php');
require_once( MASSAGE_PARLOR_DIR . 'metro-station/create-post-fields.php');
//**************************************************************************//

//***************************** Услуги ******************************//
require_once( MASSAGE_PARLOR_DIR . 'services/create-post-type.php');
require_once( MASSAGE_PARLOR_DIR . 'services/create-post-fields.php');
require_once( MASSAGE_PARLOR_DIR . 'services/create-post-taxonomy.php');
//**************************************************************************//

//***************************** FAQ ******************************//
require_once( MASSAGE_PARLOR_DIR . 'questions/create-post-type.php');
require_once( MASSAGE_PARLOR_DIR . 'questions/create-post-fields.php');
//**************************************************************************//

//***************************** Девушки ******************************//
global $MASSAGE_PARLOR_GIRLS;
$MASSAGE_PARLOR_GIRLS['post_type_name'] = 'Актриссы';
$MASSAGE_PARLOR_GIRLS['singular_name'] = 'Актрисса';
$MASSAGE_PARLOR_GIRLS['add_title_name'] = 'Актриссу';
$MASSAGE_PARLOR_GIRLS['let_enter_name'] = 'Актриссы';

require_once( MASSAGE_PARLOR_DIR . 'girls/create-post-type.php');
require_once( MASSAGE_PARLOR_DIR . 'girls/create-post-fields.php');
require_once( MASSAGE_PARLOR_DIR . 'girls/custom-admin.php');
//**************************************************************************//

require_once( MASSAGE_PARLOR_DIR . 'functions.php');
require_once( MASSAGE_PARLOR_DIR . 'head-settings.php');
require_once( MASSAGE_PARLOR_DIR . 'custom-admin.php');
require_once( MASSAGE_PARLOR_DIR . 'shortcode_stock.php');
require_once( MASSAGE_PARLOR_DIR . 'shortcode_galery_girl.php');