<?php

class User_Settings {
	
	public static $my_timezone = 'America/Los_Angeles';
	/* Where to send errors to (the only error sent is if the lead does not exist) */
	public static $error_email_address = 'test@test.com';
	/* 
	 * The list of attributes to get from this lead
	 * You can add/delete attribute names from Marketo here
	 */
	public static $attributes = array('Title','Company','Industry');
}
?>