<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => $_ENV['FB_APP_ID'],
            'client_secret' => $_ENV['FB_SECRET'],
            'scope'         => array(),
        ),

        /**
         * Google
         */
        'Google' => array(
            'client_id'     => $_ENV['GOOGLE_CLIENT_ID'],
            'client_secret' => $_ENV['GOOGLE_CLIENT_SECRET'],
            'scope'         => array(),
        ),

        /**
         * Twitter
         */
        'Twitter' => array(
            'client_id'     => $_ENV['TWITTER_API_ID'],
            'client_secret' => $_ENV['TWITTER_SECRET'],
        ),

    )

);