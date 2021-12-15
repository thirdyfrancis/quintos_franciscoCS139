<?php
	session_start();
	include_once('../include/database.php');

	if(isset($_POST['update'])){
		$database = new Connection();
		$db = $database->open();
		try{
			date_default_timezone_set('Asia/Manila');
            $curr_date = date('Y-m-d H:i:s');
			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("UPDATE animals SET name = :name, type_id = :type_id, color = :color, num_legs = :num_legs, remarks = :remarks, updated_at = :updated_at WHERE id = :id ");

			if(ctype_space($_POST['animals_name']) || ctype_space($_POST['type_id']) || ctype_space($_POST['animals_color']) || ctype_space($_POST['num_legs']) || 	 ctype_space($_POST['animals_remarks'])){
				$_SESSION['message'] = 'Please enter a valid value';
			}
			else{
				$sql->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$sql->bindParam(':name', $_POST['animals_name']);
				$sql->bindParam(':type_id', $_POST['type_id']);
				$sql->bindParam(':color', $_POST['animals_color']);
				$sql->bindParam(':num_legs', $_POST['num_legs']);
				$sql->bindParam(':remarks', $_POST['animals_remarks']);
				$sql->bindParam(':updated_at', $curr_date);

				//if-else statement in executing our prepared statement
				$_SESSION['message'] = ( $sql->execute()) ? 'System Available Updated successfully': 'Something went wrong. Cannot Update system available.';
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