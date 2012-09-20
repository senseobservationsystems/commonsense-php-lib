<?php

error_reporting(E_ALL);
/**
 * sense dashboard - Notification.php
 *
 * This file is part of sense dashboard.
 *
 * @author Ted Schmidt <ted@sense-os.nl>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was made for PHP 5');
}

/**
 * The class Notifications handels all the notification actions
 *
 * @access public
 * @author Ted Schmidt <ted@sense-os.nl>
 */
class Notification
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
    private $type = null;
	
	/**
     * @access private
     * @var string
     */
    private $text = null;
    
    /**
     * @access private
     * @var $string
     */
    private $destination = null;
	
	
	
	// --- OPERATIONS ---

	public function Notification(stdClass $data, Api $api ){
		$this->id = $data->{'id'};
		$this->type = $data->{'type'};
		$this->text = $data->{'text'};
		$this->destination = $data->{'destination'};
		$this->api = $api;
	}
	
	public function getID(){
		return $this->id;
	}
	
	public function getType(){
		return $this->type;
	}
	
	public function getText(){
		return $this->text;
	}
	public function getdestination(){
		return $this->destination;
	}

	
} /* end of class Device */

?>