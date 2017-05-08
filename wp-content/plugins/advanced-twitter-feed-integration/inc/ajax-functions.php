<?php

add_action('wp_ajax_atfi_test_api', 'atfi_test_api_callback');

function atfi_test_api_callback() {
	
	$twitter = new Creare_Twitter();
	$twitter->consumerkey = $_POST['atfi_consumer_key'];
	$twitter->consumersecret = $_POST['atfi_consumer_secret'];
	$twitter->accesstoken = $_POST['atfi_access_token'];
	$twitter->accesstokensecret = $_POST['atfi_access_token_secret'];


	$errors = $twitter->testConnection();


	if(!$errors){
		echo '<span style="color: #468847;">Your API connection to twitter has been successfully set up.</span>';
	} else {
		echo '<span style="color: #b94a48;">Errors found: Code '.$errors[0]->code.' - "'.$errors[0]->message.'".</span>';
	}

	die(); // this is required to return a proper result
}