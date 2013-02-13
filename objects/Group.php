<?php

error_reporting(E_ALL);
/**
 * sense dashboard - Group.php
 *
 * This file is part of sense dashboard.
 *
 * @author Remi Appels <remi@sense-os.nl>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was made for PHP 5');
}

/**
 * The class Group handels all the group actions
 *
 * @access public
 * @author Remi Appels <remi@sense-os.nl>
 */
class Group
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

	/**
     * @access private
     * @var Api
     */
    private $api = null;

    /**
     * @access private
     * @var int
     */
    private $id = null;
	
	/**
     * @access private
     * @var string
     */
    private $name = null;
	
	/**
     * @access private
     * @var string
     */
    private $email = null;
	
	
	
	// --- OPERATIONS ---

	public function Group(stdClass $data, Api $api ){
		$this->id = $data->{'id'};
		$this->name = @$data->{'name'};
		if(isset($data->{'email'}))
			$this->email = $data->{'email'};
		$this->api = $api;
	}
	
	public function getID(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	/**
     * This method will update the details of a group. Only the values specified as input will be updates. Every member of the group can update the group details
     *
     * @access public
     * @param  string email
     * @param  string username
     * @param  string password
     * @param  string name
     * @return json object
     */
	public function update($email, $username, $password, $name){
		return $this->api->updateGroup($this->getID(), $email, $username, $password, $name);
	}
	
	/**
     * This method deletes the group if the group has no other members. If the group has other members then the current user will be removed from the group.
     *
     * @access public
     * @return json object
     */
	public function delete(){
		return $this->api->deleteGroup($this->getID());
	}
	
	
	/**
     * This methods returns the members of the group as a list of users. Only group members can perform this action.
     *
     * @access public
     * @return mixed
     */
    public function getUsers()
    {
		return $this->api->listUsersOfGroup($this->getID());
    }
	
	/**
     * This method will add a user to the group. To add a user at least a username or user_id must be specified. Only members of the group can add a user to the group.
     *
     * @access public
     * @param  int userID
     * @param  string userName
     * @return mixed
     */
    public function addUser($userID, $userName)
    {
		return $this->api->addUserToGroup($this->getID(), $userID, $userName);
    }
    
    /**
     * This method will add sensors to the group. 
     * 
     *
     * @access public
     * @param  array sensor_ids
     * @return mixed
     */
    public function addSensors($sensor_ids)
    {
    	return $this->api->addSensors($this->getID(), $sensor_ids);
    }
    
    /**
     * This method returns a list of sensors of a group.
     *
     * @access public
     * @param  int page
     * @param  int perPage
     * @param  Boolean shared
     * @param  Boolean owned
     * @param  Boolean physical
     * @param  Boolean details
     * @return mixed
     */
    public function listSensors($page, $perPage, $shared, $owned, $physical)
    {    
    	return $this->api->listSensors($page, $perPage, $shared, $owned, $physical, $this->id);    	
    }
	
    
   /**
     * List sensor tags within a group
     * 
     * This method will return a list of sensors with their metatags in the given group.
     * 
     * @access public
     * @param string details To get all the related data as name, display_name, type, device_type, data_typ_id, pager_type, data_type and data_structure the parameter details=full can be used. If only a list of sensor id's is needed then details=no can be used.
     * @param string namespace Find metatags within the given namespace. If not given “default” is assumed as the namepace.
     * @param string sensor_owner “me” only return metatags of sensors owned by the current user. “shared” only return sensors shared with me. "all” return all sensors owned by me or shared with me. When not given “me” is assumed
     * @param int page This parameter specifies which page of the results must be retrieved. The page offset starts at 0.
     * @param int per_page This parameter specifies the amount of sensors that must be received at once. The maximum amount is 1000 items 
     */
    public function listSensorTags($details = NULL, $namespace = NULL, $sensor_owner = NULL, $page = -1, $per_page = -1)
    {
    	return $this->api->listGroupSensorTags($this->id, $details, $namespace, $sensor_owner, $page, $per_page);
    }
    
    /**
     * Finding sensors by metatags
     *
     * Via this method a list of sensors can be selected based on a set of conditions.
     * Supported operators are “equal”, “in”, and “is_set”. All string comparisons are case INsensitive.
     * Currently supported are two types of statement groups. The first is "metatag_statement_groups" which allows to find sensors based on their metatags.
     * The second is "sensor_statement_groups" which allows to find sensors based on their own properties.
     * Supported properties are id, name, type, device_type, data_type_id, pager_type, display_name and use_data_storage.
     *
     * @access public
     * @param int group_id The group identifier
     * @param array filter {"filter":{"metatag_statement_groups":[[{"metatag_name":"greenhouse_number","operator":"equal","value":"1"},{"metatag_name":"greenhouse_number","operator":"equal","value":"2"}],[{"metatag_name":"color","operator":"equal","value":"green"}]],"sensor_statement_groups":[[{"sensor_property":"id","operator":"in","value":"1,2,3,4,5,6,7,8,9,10"}]]}}
     * @param string details (optional) To get all the related data as name, display_name, type, device_type, data_typ_id, pager_type, data_type and data_structure the parameter details=full can be used. If only a list of sensor id's is needed then details=no can be used.
     * @param string namespace (optional) Find metatags within the given namespace. If not given “default” is assumed as the namepace.
     * @param string sensor_owner (optional) “me” only return metatags of sensors owned by the current user. “shared” only return sensors shared with me. "all” return all sensors owned by me or shared with me. When not given “me” is assumed
     * @param int page (optional) This parameter specifies which page of the results must be retrieved. The page offset starts at 0.
     * @param int per_page (optional) This parameter specifies the amount of sensors that must be received at once. The maximum amount is 1000 items
     */
    public function findSensorsByTagsInGroup($filter, $details = NULL, $namespace = NULL, $sensor_owner = NULL, $page = -1, $per_page = -1)
    {
    	return $this->api->findSensorsByTagsInGroup($this->id, $filter,$details, $namespace, $sensor_owner, $page, $per_page);
    }
    
} /* end of class Group */

?>