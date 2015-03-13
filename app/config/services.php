<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/
        
        'mailgun' => array(
        'domain' => 'sandboxa2326214a3594edcb46eb1946b9a8822.mailgun.org',
        'secret' => 'key-d90a1a4036d3c0443cd4f335e50751dc',
        ),
	

	'mandrill' => array(
		'secret' => '',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
