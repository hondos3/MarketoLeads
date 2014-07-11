<?php
/**
 This is modified from a PHP Marketo SOAP API example from Marketo's SOAP API reference document
 */

/* 
 * The list of attributes to get from this lead
 * You can add/delete attribute names from Marketo here
 */
$attributes = array('Title','Company','Industry');

if(isset($_GET['_mkto_trk'])) {
	// We only include the Marketo API class if it's needed.
	include_once($_SERVER['DOCUMENT_ROOT'] . '/service/class.marketoapi.php');
	
	/*
	 * Get Lead info
	 */
	$marketo_api = new MarketoAPI();
	$result = $marketo_api->getLead('COOKIE', $_COOKIE['_mkto_trk']);
	
	// If the response looks valid return desired attribute values
	if (TRUE === $marketo_api->doesResponseLookValid($result))
	{
		$response = array();
		//Here are the attributes from marketo for this lead
		$mkto_attributes = $result->result->leadRecordList->leadRecord->leadAttributeList->attribute;
		
		// Find in mkto_attributes those that are defined in $attributes above
		foreach ($attributes as $key => $value) {
			foreach ($mkto_attributes as $mkto_key => $mkto_value) {
				if (strcmp($value,$mkto_value->attrName) == 0) {
					$response[$key]->attrName = $mkto_value->attrName;
					$response[$key]->attrValue = $mkto_value->attrValue;
				}
			}
			
		}

		echo json_encode(array('responseCode'=>0,'responseMessage'=>$response));
	} else {
		echo json_encode(array('responseCode'=>-2));
	}
} else {
	echo json_encode(array('responseCode'=>-1));
}
exit();

?>