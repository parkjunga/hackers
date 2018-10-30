<?php
$servername = "localhost";
$username = "root";
$password = "localhost";
$dbName = "testdb";
 
// 접속
$conn = mysql_connect($servername, $username, $password,$dbName);
$db_id = mysql_select_db('testdb',$conn);
mysql_query("set session character_set_connection=utf8;");

mysql_query("set session character_set_results=utf8;");

mysql_query("set session character_set_client=utf8;");


 
// 접속성공 여부 확인
if (!$conn) {
    die('접속 실패: ' . mysql_error());
}
//echo "접속 성공";


?>