<?php
	session_start();
	$con=mysql_connect("localhost","root","root");
	$db=mysql_select_db("Q_A",$con);
	mysql_query('SET NAMES utf8', $con);
	$mail = $_POST['mail_address'];
	if(preg_match ( '/.*@.*/' , $mail) === 0){
		//print "Error";
		header("Location: login.html");
		exit;		
	}
	$password = $_POST['password'];
	//if(strlen($password) < 8){
		//print "Error";
		//header("Location: login.html");
		//exit;		
	//}
	$sql = "SELECT count(*) FROM member where mail_address = $mail and password = $password";
	$result = mysql_query("SELECT * FROM member where mail_address = \"$mail\" and password = \"$password\"",$con);
	$row =  mysql_fetch_array($result);
	if($row["mail_address"] == $mail && $row["password"] == $password){
		$_SESSION["member"] = $row;
		//mysql_query('SET NAMES utf8', $row);
		header("Location: index.php");
		exit;
	}elseif($row["mail_address"] == $mail && $row["password"] !== $password){
		$_SESSION["txt"] = "パスワードが間違っています";
		header("Location: login.html");
		exit;				
	}elseif($row["mail_address"] !== $mail && $row["password"] == $password){
		$_SESSION["txt"] = "メールアドレスが間違っています";
		header("Location: login.html");
		exit;
	}elseif($row["mail_address"] !== $mail && $row["password"] !== $password){
		$_SESSION["txt"] = "メールアドレス/パスワードが間違っています";
		header("Location: login.html");
		exit;	
	}
	
	
/*	try{
		$result = mysql_query("SELECT * FROM member where mail_address = \"$mail\" and password = \"$password\"",$con);
		$_SESSION["member"] = $result;
		$row =  mysql_fetch_array($result);
		//header("Location: index.php");
		print $row["name"];
		exit;
		
	}catch(Exception $e){
		print "error";
	}
*/
	print $result;
	$row =  mysql_fetch_array($result);
	print $row["name"];
	//$result = mysql_query("INSERT INTO member(name,ttitle,name,quest,ans,name1,data,data1) VALUE(\"$_POST[id]\",\"$_POST[ttitle]\",\"$_POST[name]\",\"$_POST[quest]\",\"$_POST[ans]\",\"$_POST[name1]\",\"$_POST[data]\",\"$_POST[data1]\")",$con);

?>
