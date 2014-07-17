<?php
/**
 This is modified from a PHP Marketo SOAP API example from Marketo's SOAP API reference document
 */



if(isset($_GET['_mkto_trk'])) {
	// We only include the Marketo API class if it's needed.
	include_once($_SERVER['DOCUMENT_ROOT'] . '/service/class.marketoapi.php');
	include_once($_SERVER['DOCUMENT_ROOT'] . '/service/user-settings.php');
	/*
	 * Get Lead info
	 */
	$marketo_api = new MarketoAPI();
	$result = $marketo_api->getLead('COOKIE', $_COOKIE['_mkto_trk']);
	
	// If the response looks valid return desired attribute values
	if (TRUE === $marketo_api->doesResponseLookValid($result))
	{
		//Here are the attributes from marketo for this lead
		$mkto_attributes = $result->result->leadRecordList->leadRecord->leadAttributeList->attribute;
		$attributes = User_Settings::$attributes;
		// Find in mkto_attributes those that are defined in $attributes above
		/* 
		foreach ($attributes as $key => $value) {
			foreach ($mkto_attributes as $mkto_key => $mkto_value) {
				if (strcmp(str_replace('_',' ',$key),$mkto_value->attrName) == 0) {
					$response[$value] = $mkto_value->attrValue;
					//$response[$key]->attrValue = $mkto_value->attrValue;
				}
			}
			
		}
		*/
		/* The structure we send back is the marketo response and the list of attributes we want to
		 * stuff in the cookie
		 */
		echo json_encode(array('responseCode'=>0,'responseMessage'=>$mkto_attributes,'_attr'=>$attributes));
	} else {
		echo json_encode(array('responseCode'=>-2));
	}
} else {
	echo json_encode(array('responseCode'=>-1));
}
exit();

?>