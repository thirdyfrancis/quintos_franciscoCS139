<?php
	session_start();
	include_once('../include/database.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("INSERT INTO animals (name,type_id,color,num_legs,remarks) VALUES (:name,:type_id,:color,:num_legs,:remarks)");

			if(ctype_space($_POST['animals_name']) || ctype_space($_POST['type_id']) || ctype_space($_POST['animals_color']) || ctype_space($_POST['num_legs']) || 	 ctype_space($_POST['animals_remarks'])){
				$_SESSION['message'] = 'Please enter a valid value';
			}
			else{
				//bind
				$sql->bindParam(':name', $_POST['animals_name']);
				$sql->bindParam(':type_id', $_POST['type_id']);
				$sql->bindParam(':color', $_POST['animals_color']);
				$sql->bindParam(':num_legs', $_POST['num_legs']);
				$sql->bindParam(':remarks', $_POST['animals_remarks']);

				//if-else statement in executing our prepared statement
				$_SESSION['message'] = ( $sql->execute()) ? 'Animals added successfully' : 'Something went wrong. Cannot add animals.';
			}
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: ../index.php');
	
?>