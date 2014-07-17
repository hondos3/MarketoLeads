<?php

class User_Settings {
	
	public static $my_timezone = 'America/Los_Angeles';
	/* Where to send errors to (the only error sent is if the lead does not exist) */
	public static $error_email_address = 'test@test.com';
	/* 
	 * The list of attributes to get from this lead
	 * You can add/delete attribute names from Marketo here
	 */
	
	/*
	 * The key are the SOAP API names, the value are the friendly labels to use
	 * in the cookie
	 */
	public static $attributes = array(
	'Predictive_Lead_Score__c'=>'Predictive Lead Score',
	'Company'=>'Company Name',
	'Industry'=>'Industry',
	'Role__c'=>'Role',
	'LeadScore'=>'Lead Score',
	'LeadStatus'=>'Lead Status',
	'mostRecentBehavior'=>'Most Recent Behavior',
	"Product_Interest__c"=>'Product Interest',
	'segmentationBuyingCenter1014'=>'Buying Center Segment',
	'segmentationVertical1012 Selling'=>'Teams Segment',
	);
}
?>