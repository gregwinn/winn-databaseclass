<?php
//-------------------------------------
// -----VERSION 1.1.2 for MYSQL--------
//-------------------------------------
//-------------------------------------
//-------------------------------------
//connect to db using the conf.php file.
/*
 * DO NOT EDIT BELOW! -> User the conf.php file.
 * =============================================
 */
include('conf.php');
$dbhost = DATABASE_HOST;
$dbuser = DATABASE_USER;
$dbpass = DATABASE_PASSWORD;
$database = DATABASE_NAME;
/*
 * DO NOT EDIT BELOW! -> User the conf.php file.
 * =============================================
 */
// ---- auth class - Settings
// -- if you use this below for the auth class you need to un comment the global line in the auth class line 144
$MD5pass = ACCOUNTS_PASS_MD5; // Do you need to MD5 the password? TRUE for yes and FALSE for no.
$accountstable = ACCOUNTS_TBL; // What is the name of the table where you keep your users?
$usercol = ACCOUNTS_USER_COL; // Column name where you keep your usernames
$passcol = ACCOUNTS_PASS_COL; // Column name where you keep your passwords
// ----

if ($dbc = @mysql_connect ($dbhost, $dbuser, $dbpass) ) {
	//select db
	if( !@mysql_select_db($database) ) {
		die ('bad ' . mysql_error() . '');
	}
	
}else{
	//this will display a readable error
	die ('bad.. and you cant connect ' . mysql_error() . '');
}

//==SaniSQL -- From Jim Mayes
function sanisql($value) {
	//----- Stripslashes form magic quotes
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	
	//----- Apply proper quotes if not an interger
	if (!is_numeric($value)) {
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	
	return $value;
   
}
//========

/*
	Need to start the classes? Go to bottom of file and 
	un-comment the 'new dbcon();' and 'new auth();'
	only un-comment the ones you want to start auto.
	
	This will save you a line of code if you chose to auto start
	the class in this file.
*/


//====================
//   dbcon CLASS
//====================
class dbcon {

	/*
	Greg Winn -> started on 11-01-07
	
	==Changes==
		
		May 4  08 -> Added function selectwhere
		May 2  08 -> Added function numrecords
		Feb 20 08 -> Added function to dbcon (selectall)
		Jan 14 08 -> Added function (validates_confirmation_of_password) to auth class
		Jan 2  08 -> Added function (validates_uniqueness_of_email) to auth class
		Jan 2  08 -> Fixed globals
		Dec 30 07 -> Added auth class for user login
		Nov 11 07 -> Added update id.
		Nov 11 07 -> Avalable to public on winn.ws.
		
	===========
	
	$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
		Would you like to use this in an application you are selling? Contact me for approval. 
		You may use this class in any application or site that is non profit.
	$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
	
	NEED Help? Go to the Google Code page at:
	http://code.google.com/p/winn-databaseclass/
	*/

	//insert
	//==> how to call this
	// $db = new dbcon();
	// $db->insert('table_name', 'row=your info');
	function insert($table, $sql) {
		mysql_query('INSERT INTO ' . $table . ' SET ' . $sql . '');
	}

	//update
	//==> how to call this
	// $db = new dbcon();
	// $db->update('table', 'row=your data', 'id');
	function update($table, $sql, $id) {
		mysql_query('UPDATE ' . $table . ' SET ' . $sql . ' WHERE id=' . $id . '');
	}

	//delete
	//==> how to call this
	// $db = new dbcon();
	// $db->delete('table', 'id');
	function delete($table, $id) {
		mysql_query('DELETE FROM ' . $table . ' WHERE id=' . $id . ' LIMIT 1');
	}


	//=======================Advanced calls

	//DELETE ALL
	//==> how to call this
	// $db = new dbcon();
	// $db->deleteall('table', 'condition -> somthing=somthing');
	function deleteall($table, $cond) {
		mysql_query('DELETE FROM ' . $table . ' WHERE ' . $cond . '');
	}
	
	
	//SELECT ALL or columns
	//==> how to call this
	// $db = new dbcon();
	// $accounts = $db->selectall('accounts', 'all');
	// ==== to display results use:
	// while($row = mysql_fetch_array($accounts)) {
	// 		print $row['name'];	
	// }
	function selectall($table,$columns) {
		if($columns == 'all' || empty($columns)) {
			$col = "*";
		}else{
			$col = $columns;
		}
		
		return mysql_query('SELECT ' . $col . ' FROM ' . $table . '');
	}
	
	//SELECT by WHERE something = something
	//==> how to call this
	// $db = new dbcon();
	// $vars[] = 'something=' . sanisql($something);
	// $vars[] = 'something2=' . sanisql($something2);
	// $accounts = $db->selectwhere('accounts', 'all', $vars);
	// ==== to display results use:
	// $row = mysql_fetch_array($accounts)
	// print $row['name'];	
	// 
	function selectwhere($table,$columns,$where) {
		if($columns == 'all' || empty($columns)) {
			$col = "*";
		}else{
			$col = $columns;
		}
		$num = count($where);
		$c = 0;
		$sqlwh = null;
		foreach($where AS $val) {
			$c += 1;
			if($c == $num) {
				$c == 1 ? $start = '' : $start = ' AND ';
				$sqlwh .= $start . $val;
			}else{
				$c == 1 ? $start = '' : $start = ' AND ';
				$sqlwh .= $start . $val;
			}
		}
		
		return mysql_query('SELECT ' . $col . ' FROM ' . $table . ' WHERE ' . $sqlwh);
	}
	
	//Number of records
	//==> how to call this
	// $db = new dbcon();
	// $num = $db->numrecords('accounts','id','12');
	// print $num;
	function numrecords($table,$colname,$id) {
		$col = "*";
		$query = mysql_query('SELECT ' . $col . ' FROM ' . $table . ' WHERE ' . $colname . '=' . $id);
		return mysql_num_rows($query);
	}


}

//====================
//   auth CLASS
//====================
class auth	{
	
	//global $MD5pass,$usercol,$passcol,$accountstable;
	
	//login
	//==> how to call this
	// $auth = new auth();
	// $auth->login('the_username', 'the_password');
	function login($user, $pass) {
		if( $MD5pass == TRUE ) {
			$pass = md5($pass);
		}
		
		// select the user from the database -- Edit this to fit your needs
		if( $selectuser = mysql_query('SELECT ' . $usercol . ', ' . $passcol . ' FROM ' 
		. $accountstable . ' WHERE ' 
		. $usercol . '=' . sanisql($user) . ' AND ' 
		. $passcol . '=' . sanisql($pass) . '') ) {
			
			//===> This is if the user was found, now would be a good time to set cookies or redirect
			// return TRUE;
			// setcookie('userName', $user, time()+3600);
			// $pass = md5($pass);
			// setcookie('authpass', $pass, time()+3600);
			// header("location: /user.php");
			//===> Somthing like that
			
		}else{
			
			//===!!> This is if the user did not make it, the password or username was wrong.
			// return FALSE;
			// somthing like that
			
		}
		
	}
	
	
	//Check
	//==> how to call this
	// $auth = new auth();
	// $auth->check($_COOKIE['userName'], $_COOKIE['authpass']);
	function check($user, $pass)	{
		
		if( empty($user) || empty($pass) ) {
			//===!!> The users cookies or var's are empty.
			return FALSE;
		}else{
			
			//===> This will only work if you save your passwords in MD5 <===
			if( $selectuser = mysql_query('SELECT ' . $usercol . ', ' . $passcol . ' FROM ' 
			. $accountstable . ' WHERE ' 
			. $usercol . '=' . sanisql($user) . ' AND ' 
			. $passcol . '=' . sanisql($pass) . '') ) {
				
				//===> This is if the user passes the check and is still logged in
				return TRUE;
				
			}else{
				//===!!> This is if the user did not pass the check.
				return FALSE;
			}
			
		}
		
	}
	
	// Checks to see if you have an account with that email address.
	// you can also pass this fuction 'new' or 'edit' this will allow the user to edit the email address
	// $auth = new auth();
	// $auth->validates_uniqueness_of_email($_POST['email'], 'new'); ,<- new accounts
	// $auth->validates_uniqueness_of_email($_POST['email'], 'edit'); <- edit accounts
	// !!! Dont use 'new' to have your users edit accounts or it will say the email address is taken
	// --- always use 'edit' for changing the data, only use 'new' for NEW accounts/signups
	function validates_uniqueness_of_email($email,$neworedit) {
		$select = mysql_query('SELECT email FROM ' . $accountstable . ' WHERE email=' . sanisql($email) . '');

		$num = mysql_num_rows($select);
		if( $num > 0 ) {
			$row = mysql_fetch_array($select);
			if($email == $row['email']) {
				if( $neworedit == "edit" ) {
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}

		}else{
			return TRUE;
		}
	}
	
	// This will check to make sure that the passwords given match
	// Pass it the first password then the second password it will check them and return TRUE or FALSE
	// $auth = new auth();
	// $auth->validates_confirmation_of_password('password','password2');
	function validates_confirmation_of_password($pass, $pass_conf) {
		if( $pass != $pass_conf ) {
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
}
//=====AUTO START
//$db = new dbcon();
//$auth = new auth();
//=====
?>