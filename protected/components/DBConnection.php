<?php

/**
 * ConnectionService class, for DB connections
 * 
 * @author Luca Gianneschi
 * @version 0.1
 * @since 2014-07-15
 * @copyright	Jamyourself.com 2014	
 * @warning
 * @bug
 * @todo                
 */
class DBConnection {

    /**
     * @var BOOL 
     */
    public $commit;

    /**
     * @var BOOL 
     */
    private $autocommit;

    /**
     * Costruttore dell'oggetto
     */
    function __construct() {
	$this->commit = array();
	$this->autocommit = true;
    }

    /**
     * Set autcommit
     * @return BOOL true if ok, false otherwise
     */
    public function autocommit($value) {
	if (is_bool($value)) {
	    $this->autocommit = $value;
	    return true;
	} else {
	    return false;
	}
    }

    /**
     * Set connection
     * @return BOOL true if ok, false otherwise
     */
    public function connect() {
	try {
	    $connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PSW, MYSQL_DB);
	    if (mysqli_connect_errno($connection)) {
		return false;
	    } else {
		return $connection;
	    }
	} catch (Exception $e) {
	    return false;
	}
    }

    /**
     * Disconnection
     * @return void
     */
    public function disconnect($connection) {
	@mysqli_close($connection);
    }

    /**
     * get autocommit value
     */
    public function getAutocommit() {
	return $this->autocommit;
    }

}

?>