<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../database.php");

    //1) Exit if user not verified yet.
    session_start();
    if (!isset($_SESSION['CSP-session-userID'])) {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "จำเป็นต้องทำการยืนยันตัวตนก่อนใช้งาน";

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $database->close();
        exit();
    }

    //Set parameter
    $plantID = uniqid("PLANT-").rand(100,999);
    $userID = $_SESSION['CSP-session-userID'];
    $plantName = $_POST['plantName'] ?? '';
    $cateID = !empty($_POST['cateID']) ? $_POST['cateID'] : Null;
    $plantDescription = $_POST["plantDescription"] ?? '';
    $plantRegist = date("Y-m-d");

    //2) Check for required parameter
    if($plantName == ''){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'โปรดระบุรายละเอียดให้ครบถ้วน';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $database->close();
        exit();
    }

    //Pass) Create new plant
    $sql = "INSERT INTO plants(plantID, plantName, userID, cateID, plantDescription, plantRegist)
            VALUES(?, ?, ?, ?, ?, ?);";
    
    $stmt =  $database->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('ssssss', $plantID, $plantName, $userID, $cateID, $plantDescription, $plantRegist);

    if($stmt->execute()){
        $stmt->close();

        $response->status = 'success';
        $response->title = 'ดำเนินการสำเร็จ';
        $response->text = 'ลงทะเบียนพืชสำเร็จแล้ว';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }else{
        echo $database->error;
    }

    $database->close();
    exit();
?>