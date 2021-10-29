<?php

require_once __DIR__ . "/config.php";

// stabilire la connessione
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ( $conn && $conn->connect_error ) {
	echo "Errore di connessione: {$conn->connect_error}";
	die(); 
}

// connessione è andata a buon fine
$sql = $conn->prepare("SELECT `name`,`phone`,`email`,`head_of_department` FROM `departments` WHERE `id` = ?");

$sql->bind_param("i", $id);

$id = $_GET['id'];

$sql->execute();

$result = $sql->get_result();

if ( $result && $result->num_rows > 0 ) {

	while ( $row = $result->fetch_assoc() ) {
		echo "Nome: {$row['name']} telefono: {$row['phone']} email: {$row['email']} capo dipartimento: {$row['head_of_department']} </br>";
	}

} else if ( $result ) {
	echo "La query non ha prodotto risultati";
} else {
	echo "Errore nella query";
}