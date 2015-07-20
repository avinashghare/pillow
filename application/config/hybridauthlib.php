<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => false
			),

			"Yahoo" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array (
				"enabled" => false
			),

			"Google" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "40595885202-8j9u26oeo850me2r1dcqn77o5is12vq3.apps.googleusercontent.com", "secret" => "OxXR_vcyKrg-juM71_sQoJiq" )
				
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "1050091755019969", "secret" => "aa2ca739e8bd4ca3a073c4d16a1dd100" ),
                "scope"   => "email, user_about_me, user_birthday, user_hometown, user_website,publish_actions"
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "OyqptjsjeFqLlzfSZKk1AB386", "secret" => "sFuCATn4UeOmtAKAomWbVIUdi248HLNqaj106YtDvQCNcVAqkB" )
			),

			// windows live
			"Live" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
			"Instagram" => array (
				"enabled" => true,
//				"keys"    => array ( "id" => "99ee67e817dd428b9fbfe6eb5eaf3ab8", "secret" => "9775026daadd47a3b1d72b76f966d6f1" )
				"keys"    => array ( "id" => "cffd3b87c2364702af68bfb0d577be72", "secret" => "e784b95e80124871be59dfc535306e2d" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */