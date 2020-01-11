<?php

if ( ! empty( $_POST['heading'] ) && ! empty( $_POST['bodytext'] ) ) {

	file_put_contents( 'content.html',
		"		<h1>{$_POST['heading']}</h1>
		<p>{$_POST['bodytext']}</p>
" );

	save_post( $_POST['heading'], $_POST['bodytext'] );

	header( "Location: /" );

}

if ( ! empty( $_POST['thecontent'] ) ) {

	file_put_contents( 'content.html', $_POST['thecontent'] );

	header( "Location: /" );

}


function the_content() {
	//echo file_get_contents( 'content.html' );
	echo load_post();
}


function db_connect() {

	$host    = '127.0.0.1';
	$db      = 'not-cms';
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

function save_post( $heading, $bodytext ) {

	$pdo = db_connect();

	$stmt = $pdo->prepare( 'INSERT INTO posts ( heading, bodytext) VALUES(:heading, :bodytext);' );

	$stmt->execute( [ 'heading' => $heading, 'bodytext' => $bodytext ] );

	return $pdo->lastInsertId();

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

function load_post_fields () {

	$pdo = db_connect();

	$stmt = $pdo->prepare( 'SELECT heading, bodytext FROM posts ORDER BY timestamp DESC LIMIT 1' );

	$stmt->execute( );

	$post = $stmt->fetch();

	return "
				<div class='form-group'>
					<label for='heading'>Title</label>
					<input type='text' class='form-control' name='heading' id='heading' value='{$post['heading']}'>
				</div>
				<div class='form-group'>
					<label for='bodytext'>Body text</label>
					<textarea class='form-control' name='bodytext' id='bodytext' rows='3'>{$post['bodytext']}</textarea>
				</div>	
";

}