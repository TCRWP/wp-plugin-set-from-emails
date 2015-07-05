<?php
	/*
	Plugin Name: TCR set from emails
	Description: Sets the email name and address used by the website
	Version: 1.0.0
	Plugin URI: http://thecellarroom.uk
	Author: The Cellar Room Limited
	Author URI: http://www.thecellarroom.uk
	Copyright (c) 2015 The Cellar Room Limited
	*/

	defined( 'ABSPATH' ) or die();

	/*************************************************************************/

	if ( ! class_exists( 'tcr_set_from_emails' ) ) :

		class tcr_set_from_emails {

			function __construct() {

				add_filter( 'wp_mail_from'       ,'name name');
				add_filter( 'wp_mail_from_name'  ,'name@domain.tld');
			}

		}
		new tcr_set_from_emails;

	endif;
