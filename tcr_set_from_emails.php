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

				add_filter( 'wp_mail_from'       , 'name name');
				add_filter( 'wp_mail_from_name'  , 'name@domain.tld');
				add_action('phpmailer_init'      , array ( $this , 'tcr_phpmailer_init_smtp') );	
			}
			
			// This code is copied, from wp-includes/pluggable.php as at version 2.2.2
			function tcr_phpmailer_init_smtp($phpmailer) {	
				// Set the mailer type as per config above, this overrides the already called isMail method
				// Set Mailer value
				$phpmailer->Mailer = get_option('mailer');
				// Set From value
				$phpmailer->From = webriti_smtp_mail_from_email();				
				// Set FromName value
				$phpmailer->FromName = webriti_smtp_mail_from_name();
				// Set Reply To Field
				$phpmailer->AddReplyTo(webriti_smtp_mail_from_email(), webriti_smtp_mail_from_name());				
				// Set SMTPSecure value
				$phpmailer->SMTPSecure = get_option('smtp_ssl');					
				// Set Host value
				$phpmailer->Host = get_option('smtp_host');				
				// Set Port value
				$phpmailer->Port = get_option('smtp_port');   
				// If usrname option is not blank we have to use authentication
				if (get_option('smtp_user') != '') {
					$phpmailer->SMTPAuth = get_option('smtp_auth');
					$phpmailer->Username = get_option('smtp_user');
					$phpmailer->Password = get_option('smtp_pass');
				}					
				$phpmailer = apply_filters('wp_mail_smtp_custom_options', $phpmailer);
			} // End of phpmailer_init_smtp() function definition
			
		}
		new tcr_set_from_emails;

	endif;
