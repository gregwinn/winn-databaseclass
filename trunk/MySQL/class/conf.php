<?php
/*
 * ==== Winn Database Class v1.1.2 for MYSQL ====
 * This is the only file you will need to edit.
 * Thank you for downloading!
 * Need help? (http://code.google.com/p/winn-databaseclass/)
 * 
 */
//------- Database Name
$database_name		= 'db name';
//------- Database Username
$database_user		= 'db user';
//------- Database Password
$database_password	= 'db password';
//------- 99% chance you will not need to change this
$database_host		= 'localhost';

//====================================================
//==== OPTIONAL for Auth Class
//====================================================
// Auth Class OPTIONAL
//------- Your Account table name
$accounts_table			= 'accounts';
//------- Username Column
$accounts_user_column	= 'username';
//------- Password Column
$accounts_pass_column	= 'password';
//------- Are you using md5 for your password hash?
$accounts_pass_md5		= FALSE;

//====================================================
// = DON NOT EDIT BELOW
//====================================================
//-------------------------------------------------
	define('DATABASE_NAME',$database_name);
	define('DATABASE_USER',$database_user);
	define('DATABASE_PASSWORD',$database_password);
	define('DATABASE_HOST',$database_host);
	
	//---------------------------------------------
	
	define('ACCOUNTS_TBL',$accounts_table);
	define('ACCOUNTS_USER_COL',$accounts_user_column);
	define('ACCOUNTS_PASS_COL',$accounts_pass_column);
	define('ACCOUNTS_PASS_MD5',$accounts_pass_md5);
//-------------------------------------------------
?>