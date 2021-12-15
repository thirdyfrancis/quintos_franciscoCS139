<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS139-Final Examination</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <!-- Main -->
    <div class="container mt-2">
        <h3 class="page-header text-center">Final Examination for Hands-on</h3>
        <hr>
        <div class="row">
            <div class=""col-sm-8 col-sm-offset-2">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_animals">Add New Animal</a>
                <br>
                <br>
                <?php 
                    session_start();
                    if(isset($_SESSION['message'])){
                        ?>
                        <div class="alert alert-info text-center" style="margin-top:10px;">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php

                        unset($_SESSION['message']);
                    }
                ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>No.</th>
                            <th>Name </th>
                            <th>Type</th>
                            <th>Color</th>
                            <th>Number of Legs</th>
                            <th>Remarks</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                        </thead>
                        <tbody>
                        <?php
                            //include our connection
                            include_once('include/database.php');

                            $database = new Connection();
                            $db = $database->open();
                            try{	
                                $sql = 'SELECT * FROM animals ORDER BY name ASC';
                                $no = 0;
                                foreach ($db->query($sql) as $row) {
                                    $no++;
                        ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['type_id']; ?></td>
                                        <td><?php echo $row['color']; ?></td>
                                        <td><?php echo $row['num_legs']; ?></td>
                                        <td><?php echo $row['remarks']; ?></td> 
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td><?php echo $row['updated_at']; ?></td>
                                        <td align="right">
                                            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#update_animals<?php echo $row['id']; ?>">Edit</a>
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_animals<?php echo $row['id']; ?>">Delete</a>
                                        </td>
                                        <?php include('animals/view_delete_animals.php'); ?>
                                        <?php include('animals/view_update_animals.php'); ?>
                                    </tr>
                        <?php 
                                }
                            }
                            catch(PDOException $e){
                                echo "There is some problem in connection: " . $e->getMessage();
                            }

                            //close connection
                            $database->close();

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h3 class="page-header text-center fixed-bottom">Abby Quintos & G-third Francisco</h3>
    </div>
    <?php include('animals/view_add_animals.php'); ?>
    <!-- JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>