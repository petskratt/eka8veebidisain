<?php

if (!empty($_GET['heading'])) {
	file_put_contents('content.html',
"
<h1>{$_GET['heading']}</h1>
<p>{$_GET['bodytext']}</p>
"
	);

	header( "Location: /" );
}


function db_connect() {

	$host    = '127.0.0.1';
	$db      = 'mycms';
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];

	try {
		$pdo = new PDO( $dsn, 'root', 'root', $opt );
	} catch ( PDOException $e ) {
		echo 'Opening DB connection failed: ' . $e->getMessage() . PHP_EOL;
		exit( 1 );
	}

	return $pdo;
}


function load_post() {

	$pdo = db_connect();

	$stmt = $pdo->prepare( 'SELECT heading, bodytext FROM posts ORDER BY timestamp DESC LIMIT 1' );

	$stmt->execute( );

	$post = $stmt->fetch();

	return "		<h1>{$post['heading']}</h1>
		<p>{$post['bodytext']}</p>
";

}