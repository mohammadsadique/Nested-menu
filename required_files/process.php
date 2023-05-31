<?php
    require('db.php');
    require('memberQuery.php');

    /** Insert into members table */
        // Check if the form is submitted
        if(isset($_POST['name'])){
            $parent_id = $_POST['parent_id'];
            $name = $_POST['name'];
            
            // Disable foreign key checks
            mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 0');

            $query = "INSERT INTO members (`parent_id`, `name`) VALUES ('$parent_id', '$name')";
            $result = mysqli_query($conn, $query);

            // Enable foreign key checks
            mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 1');

            if ($result) {
                // Data insertion was successful
                $response = "success";
                $data = [
                    'data' => getNestedData(0),
                    'selectData' => showSelectOption(),
                    'success' => 'success'
                ];
                echo json_encode($data);
            } else {
                // Error occurred while inserting data
                $response = "Error: " . mysqli_error($conn);
                echo $response;
            }
        }
        ?>