<?php

    //Session Data
    include("../connection.php");
    include('../session_data.php');
    set_time_limit(0);

    $loggedInUser = '';
    if(isset($_SESSION['user']['id']))
        $loggedInUser = $_SESSION['user']['id'];



    file_put_contents('debug_log.txt', print_r($_POST, true), FILE_APPEND);

  
    $dataDraw = (int)($_POST['draw']);
    $dataStart = (int)($_POST['start']);
    $dataLength = (int)($_POST['length']);
    $dataSearch = $_POST['search']['value'];
    $orderColumn = (int)($_POST['order'][0]['column']);
    $orderDirection = $_POST['order'][0]['dir'];
    $columnName = $_POST['columns'][$orderColumn]["name"];

    $data = array();

    $recordsTotal = 0;
    $r = 0;

    // echo $loggedInUser;exit;

    $rows = get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, false);
    foreach ($rows AS $row) {
       
        $actions = " ";

        $actions = "
        <a class='editJob' data-toggle='modal' data-target='#editModal' 
           data-rec='$row[id]' data-job_title='$row[job_title]' data-department='$row[department]' 
           data-job_description='$row[job_description]' data-job_requirements='$row[job_requirements]' 
           data-job_type='$row[job_type]' data-application_deadline='$row[application_deadline]' 
           data-status='$row[status]' data-posted_by='$row[posted_by]'>
            <span class='glyphicon glyphicon-pencil'></span>
        </a> <br><br>
        <a class='deleteJob' href='delete_job.php?id=$row[id]' 
           onclick=\"return confirm('Are you sure you want to delete this job Post?');\">
            <span class='glyphicon glyphicon-trash'></span>
        </a>";
    
        $data['data'][$r]['rowID'] = $r;
        $data['data'][$r]['rec'] = $row['id'];
        $data['data'][$r]['job_title'] = $row['job_title'];
        $data['data'][$r]['department'] = $row['department'];
        $data['data'][$r]['job_description'] = $row['job_description'];
        $data['data'][$r]['job_requirements'] = $row['job_requirements'];
        $data['data'][$r]['job_type'] = $row['job_type'];
        $data['data'][$r]['application_deadline'] = $row['application_deadline'];
        $data['data'][$r]['status'] = $row['status'];
        $data['data'][$r]['posted_by'] = $row['posted_by'];
        $data['data'][$r]['created_at'] = $row['created_at'];
        $data['data'][$r]['actions'] = $actions;
        





        ++$r;

    };

    $rows = get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, true);

    $recordsTotal = count($rows);

    if($recordsTotal == 0){
        $data['data'] = [];
    };
    // $data['draw'] = $dataDraw;
    $data['recordsFiltered'] = $recordsTotal;
    $data['recordsTotal'] = $recordsTotal;
    // $data['selectedGrid'] = $selectedGrid;
    die(json_encode($data));

    function get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, $limit = false){
       
        $loggedInUser = $_SESSION['user']['id'];

        $user_sql_resultset = "SELECT * FROM majaganiconsulting.job_postings ";
                                
        if($dataSearch != ''){
            $user_sql_resultset .= "WHERE job_postings.job_title LIKE '%".$dataSearch."%' ";
            $user_sql_resultset .= "OR job_postings.status LIKE '%".$dataSearch."%' ";
        };
      
        // echo $user_sql_resultset;exit;
        $user_stmt_resultset = mysqli_query($conn, $user_sql_resultset);

        if (!$user_stmt_resultset) {
            die('Query error: ' . mysqli_error($conn));
        }

        return $rows = mysqli_fetch_all($user_stmt_resultset, MYSQLI_ASSOC);

    }

?>