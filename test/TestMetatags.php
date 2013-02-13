<?php
include_once "../class.Api.php";

// use the release_candidate
$api = new Api("rc");
// use a random testname
$user_name = "testMetaTags.".microtime(true);
//$user_name = "testMetaTags.1360751885.5599";
// create the user
$api->createUser($user_name, $user_name, "t", "est", "0900test", "test");
// login
if(!$api->login($user_name, "test", false))
	die("login error");
// get current user objet
$user = $api->readCurrentUser();

// create sensors
$sensor  = new Sensor($api->createSensor("test sensor", "test_sensor", "test metatags", "", "string", "")->sensor, $api);
$sensor2 = new Sensor($api->createSensor("test sensor 2", "test_sensor 2", "test metatags", "", "string", "")->sensor, $api);

$metatags  = array("metatags" => array("accuracy" => array("bad")));
$sensor->updateTags($metatags);

$metatags  = array("metatags" => array("accuracy" => array("good")));
$sensor2->updateTags($metatags);


$metatags  = array("metatags" => array("size" => array("small")));
$sensor->updateTags($metatags);

$metatags  = array("metatags" => array("size" => array("large")));
$sensor2->updateTags($metatags);


// Find the sensor based on the filter
$filter = array("filter" => array("metatag_statement_groups" => array(array(array("metatag_name" => "accuracy", "operator" => "equal", "value" => "bad")))) );
$response = $api->findSensorsByTags($filter, "full");
if (sizeof($response) != 1)
	echo "findSensorsByTags Error: wrong return size should be 1\n";
elseif ($response[0]->getName() != "test sensor")
	echo "findSensorsByTags Error: wrong sensor returned should be 'test sensor'\n";	


$metatags  = array("metatags" => array("color" => array("red")));
$sensor->replaceTags($metatags);

$metatags  = array("metatags" => array("color" => array("green")));
$sensor2->replaceTags($metatags);


// Find the sensor based on the filter
$filter = array("filter" => array("metatag_statement_groups" => array(array(array("metatag_name" => "accuracy", "operator" => "equal", "value" => "bad")))) );
$response = $api->findSensorsByTags($filter, "full");
if (sizeof($response) != 0)
	echo "findSensorsByTags Error: wrong return size should be 0\n";

// Find the sensor based on the filter
$filter = array("filter" => array("metatag_statement_groups" => array(array(array("metatag_name" => "color", "operator" => "equal", "value" => "green")))) );
$response = $api->findSensorsByTags($filter, "full");
if (sizeof($response) != 1)
	echo "findSensorsByTags Error: wrong return size should be 1\n";
elseif ($response[0]->getName() != "test sensor 2")
	echo "findSensorsByTags Error: wrong sensor returned should be 'test sensor 2'\n";


$metatags  = array("metatags" => array("size" => array("large")));
$sensor2->updateTags($metatags);
$response = $sensor2->listTags();
if(sizeof((array)$response) != 2)
	echo "listTags Error: size should be 2\n";

// delete tags
$sensor2->deleteTags();
$response = $api->findSensorsByTags($filter, "full");
if (sizeof($response) != 0)
	echo "findSensorsByTags Error: wrong return size should be 0\n";

$response = $api->listMetaTags("full");
if(sizeof((array)$response) != 2)
	echo "listMetaTags Error: size should be 2\n";
else 
{
	$cnt = 0;
	foreach((array)$response as $sensor)
	{
		$tags = (array)@$sensor->getMetatags();		
		if(!empty($tags))
			++$cnt;
	}	
	if($cnt != 1)
		echo "listMetaTags Error: size should be 1\n";
}

$response = $api->findDistinctMetatagValues("color");
if (sizeof($response) != 2)
	echo "findDistinctMetatagValues Error: wrong return size should be 2\n";

// remove the user
echo "Done...Cleaning up\n";
$user->delete();

function printSensors($sensors)
{
	echo "Sensors:\n";
	foreach($sensors as $sensor)
	{
		echo "Sensor id:".$sensor->getID()."\n";
		echo "Sensor name:".$sensor->getName()."\n";
	}
	
}
?>