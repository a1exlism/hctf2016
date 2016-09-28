<?php

class	User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function user_register ($teamname, $email, $password) {
		$insert_data = array(
			''
		)
		$this -> db -> isnert('user', );
	}
}

?>
