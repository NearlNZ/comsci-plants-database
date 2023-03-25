<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../connect.php");

    //1) Exit if user not verified yet.
    session_start();
    if (!isset($_SESSION['BPCS-session-userID'])) {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "จำเป็นต้องทำการยืนยันตัวตนก่อนใช้งาน";

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $bpcsDB->close();
        exit();
    }

    //Set parameter
    $symptomID = $_POST['symptomID'] ?? '';
    $symptomStart = $_POST['symptomStart'] ?? '';
    $symptomEnd = $_POST['symptomEnd'] ?? '';
    $symptomDetail = $_POST['symptomDetail'] ?? null;
    
    //2) Check for required parameter
    if($symptomID == '' || $symptomStart == '' || $symptomDetail ==''){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'โปรดระบุข้อมูลในการบันทึกให้ครบถ้วน';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $bpcsDB->close();
        exit();
    }

    //3) Check if symptom data exist
    $sql = "SELECT symptomID
            FROM patientsymptom
            WHERE symptomID = ?;";

    $stmt =  $bpcsDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('s', $symptomID);
    $stmt->execute();
    $result = $stmt-> get_result();
    $stmt->close();

    if($result->num_rows == 0){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'ไม่พบข้อมูลบันทึกอาการป่วย โปรดตรวจสอบอีกครั้ง';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $bpcsDB->close();
        exit();
    }

    //Pass) Update symptom data
    $sql = "UPDATE patientsymptom
            SET symptomStart = ?, symptomEnd = ?, symptomDetail = ?
            WHERE symptomID = ?;";
    
    $stmt =  $bpcsDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('ssss', $symptomStart, $symptomEnd, $symptomDetail, $symptomID);

    if($stmt->execute()){
        $stmt->close();

        $response->status = 'success';
        $response->title = 'ดำเนินการสำเร็จ';
        $response->text = 'บันทึกข้อมูลอาการป่วยสำเร็จแล้ว';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }else{
        echo $bpcsDB->error;
    }

    $bpcsDB->close();
    exit();
?>