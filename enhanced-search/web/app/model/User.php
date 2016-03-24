<?php

class User extends \ActiveRecord\Model {

	// static $table_name = 'users';


	static public function getSession() {
		return $_SESSION["userSession"];
	}

	static public function auth(){
	    if ($_SESSION["userSession"]) {
	        $user = $_SESSION["userSession"];
	    }else{
	        $user = new stdClass;
	        $user->role = 0;
	    }
	    $user->token = md5(date("d-m-Y H:i:s"));

	    return $user;
	}

	static public function doLogin($data) {
		
		// search for login/password
		$oUser = self::find('first', $data);

		$displayName = explode(" ", $oUser->name);

	    if($oUser){
	        $jUser = json_encode(array(
	            "msg" => "Welcome to my pub, ".$displayName[0],
	            "dt_login" => date("Y-m-d H:i:s"),
	            "role" => $oUser->role,
	            "name" => $oUser->name,
	            "email" => $oUser->email,
	            "xp" => $oUser->xp,
	            "tag" => $oUser->tag,
	            "alias" => $oUser->alias
	        ));

	    }else{
	        $jUser = json_encode(array(
	            "msg" => "You shall not pass!",
	            "error" => "wrong login/pass, sorry!"
	        ));
	    }

		// return a json string with results of login	  
	    return $jUser;

	}

	static public function doLogout() {
		session_destroy();
	}
	
}