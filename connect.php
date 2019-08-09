<?php
class Connect{
	private static $_conn;
	public static function conn(){
		self::$_conn = new PDO('mysql:host=localhost;dbname=oopbai4', "root", "");
		self::$_conn->exec('SET NAMES utf8');
		return self::$_conn;
	}
}
$conn=Connect::conn();
?>