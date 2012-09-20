<?php

error_reporting(E_ALL);
/**
 * sense dashboard - Trigger.php
 *
 * This file is part of sense dashboard.
 *
 * @author Ted Schmidt <ted@sense-os.nl>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was made for PHP 5');
}

/**
 * The class Triggers handels all the trigger actions
 *
 * @access public
 * @author Ted Schmidt <ted@sense-os.nl>
 */
class Trigger
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
    private $expression = null;
    
    /**
     * @access private
     * @var int
     */
    private $inactivity = null;
	
	
	
	// --- OPERATIONS ---

	public function Trigger(stdClass $data, Api $api ){
		$this->id = $data->{'id'};
		$this->name = $data->{'name'};
		$this->expression = @$data->{'expression'};
		$this->inactivity = @$data->{'inactivity'};
		$this->api = $api;
	}
	
	public function getID(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getExpression(){
		return $this->expression;
	}
	public function getInactivity(){
		return $this->inactivity;
	}

	
} /* end of class Device */

?>