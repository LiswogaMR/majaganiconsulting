<?php

    include("../connection.php");
    include('../session_data.php');
    set_time_limit(0);

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

    $rows = get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, false);

    foreach ($rows AS $row) {
        $data['data'][$r]['rowID'] = $r;
        $data['data'][$r]['year'] = $row['year_created'];
        $data['data'][$r]['total'] = $row['total'];
        $data['data'][$r]['status'] = $row['status'];

        ++$r;
    };

    $rows = get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, true);

    $recordsTotal = count($rows);

    if($recordsTotal == 0){
        $data['data'] = [];
    };

    $data['recordsFiltered'] = $recordsTotal;
    $data['recordsTotal'] = $recordsTotal;

    die(json_encode($data));

    function get_records($dataSearch, $columnName, $orderDirection, $dataLength, $dataStart,$conn, $limit = false){
        $appraisal_totals_resultset = "SELECT COUNT(id) AS total, YEAR(created_at) AS year_created, status
                                        FROM majaganiconsulting.job_postings "; 
                        
        if($dataSearch != ''){
            $appraisal_totals_resultset .= "WHERE status LIKE '%".$dataSearch."%' ";
        };
        
        $appraisal_totals_resultset .= "Group by year_created, status ";

        $appraisal_stmt_resultset = mysqli_query($conn, $appraisal_totals_resultset);
        return $rows = mysqli_fetch_all($appraisal_stmt_resultset, MYSQLI_ASSOC);
    }
?>