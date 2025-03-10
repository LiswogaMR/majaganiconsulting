<?php

    //Session Data
    include("functions/connection.php");
    include('functions/session_data.php');
    set_time_limit(0);

    $loggedInUser = '';
    if(isset($_SESSION['user']['id']))
        $loggedInUser = $_SESSION['user']['Email'];


        if (isset($_GET['id'])) {
            // Retrieve and sanitize the job ID from the query string
            $jobId = intval($_GET['id']);
            $newStatus = 'Closed'; // Default status when deleting a job via the link
        
            // SQL query to update job status
            $updateQuery = "
                UPDATE job_postings 
                SET status = '$newStatus', updated_at = NOW() , last_Updated_by = '$loggedInUser'
                WHERE id = $jobId
            ";
        
            // Execute the query and handle the response
            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION['msg'] = "Job status updated to '$newStatus' successfully.";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['msg'] = "Error updating job status: " . mysqli_error($conn);
                $_SESSION['msg_type'] = "error";
            }
        
            // Redirect to the jobs listing page
            header("Location: employee.php");
            exit;
        } else {
            // If no job ID is provided, redirect to the main page with an error
            $_SESSION['msg'] = "No job ID provided.";
            $_SESSION['msg_type'] = "error";
            header("Location: employee.php");
            exit;
        }

?>
