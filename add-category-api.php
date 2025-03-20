<?php
// เปิดใช้งาน CORS (หากจำเป็น) เพื่อให้ API สามารถรับคำขอจากโดเมนอื่นได้
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// เริ่มเซสชัน (Session) เพื่อเก็บข้อมูลของผู้ใช้หรือสถานะต่าง ๆ
session_start();

// นำเข้าไฟล์ config.php ที่มีข้อมูลการเชื่อมต่อฐานข้อมูล
include("../include/config.php");

// ปิดการแสดงข้อผิดพลาด (สำหรับใช้งานในระบบจริง)
error_reporting(0);

// ตรวจสอบว่าการร้องขอเป็นแบบ POST เท่านั้น
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // รับข้อมูล JSON ที่ถูกส่งมา และแปลงเป็นอาร์เรย์
    $input_data = json_decode(file_get_contents("php://input"), true);
    
    // ตรวจสอบว่ามีข้อมูลถูกส่งมาหรือไม่ และข้อมูลอยู่ในรูปแบบ JSON ที่ถูกต้องหรือไม่
    if (!$input_data) {
        http_response_code(400); // รหัส HTTP 400 (Bad Request)
        echo json_encode(array(
            "status" => "error",
            "message" => "ไม่สามารถรับข้อมูลได้ หรือรูปแบบ JSON ไม่ถูกต้อง"
        ));
        exit();
    }
    
    // ดึงข้อมูลประเภทสินค้า
    $category_name = $input_data['cat_id'] ?? ''; // ชื่อประเภทสินค้า
    $category_code = $input_data['cat_name'] ?? ''; // รหัสประเภทสินค้า
   
    // ตรวจสอบว่ามีการกรอกข้อมูลที่จำเป็นหรือไม่
    if (empty($category_name) || empty($category_code)) {
        http_response_code(400); // รหัส HTTP 400 (Bad Request)
        echo json_encode(array(
            "status" => "error",
            "message" => "กรุณากรอกชื่อประเภทสินค้าและรหัสประเภทสินค้า"
        ));
        exit();
    }
    
    try {
        // ตรวจสอบว่ารหัสประเภทสินค้าซ้ำหรือไม่
        $check = "SELECT COUNT(*) FROM category WHERE category_code = :category_code";
        $check_query = $dbh->prepare($check);
        $check_query->bindParam(':category_code', $category_code, PDO::PARAM_STR);
        $check_query->execute();
        
        if ($check_query->fetchColumn() > 0) {
            http_response_code(409); // รหัส HTTP 409 (Conflict)
            echo json_encode(array(
                "status" => "error",
                "message" => "รหัสประเภทสินค้านี้มีอยู่ในระบบแล้ว กรุณาใช้รหัสอื่น"
            ));
            exit();
        }
        
        // เพิ่มข้อมูลประเภทสินค้าใหม่
        $sql = "INSERT INTO category(cat_id, cat_name, description, status) 
                VALUES(:cat_id, :cat_name, :description, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cat_id', $category_name, PDO::PARAM_STR);
        $query->bindParam(':cat_name', $category_code, PDO::PARAM_STR);
        
        // ตรวจสอบว่าการบันทึกสำเร็จหรือไม่
        if ($query->execute()) {
            $category_id = $dbh->lastInsertId(); // ดึง ID ของประเภทสินค้าที่เพิ่มเข้ามา
            
            // ดึงข้อมูลประเภทสินค้าที่เพิ่มเข้ามาใหม่
            $get_category = "SELECT * FROM category WHERE id = :id";
            $get_query = $dbh->prepare($get_category);
            $get_query->bindParam(':id', $category_id, PDO::PARAM_INT);
            $get_query->execute();
            $category = $get_query->fetch(PDO::FETCH_ASSOC);
            
            http_response_code(201); // รหัส HTTP 201 (Created)
            echo json_encode(array(
                "status" => "success",
                "message" => "เพิ่มประเภทสินค้าสำเร็จ",
                "data" => $category
            ));
        } else {
            throw new Exception("ไม่สามารถบันทึกข้อมูลได้");
        }
    } catch (Exception $e) {
        http_response_code(500); // รหัส HTTP 500 (Internal Server Error)
        echo json_encode(array(
            "status" => "error",
            "message" => "เกิดข้อผิดพลาดในระบบ: " . $e->getMessage()
        ));
    }
} else {
    // หากใช้ Method อื่นที่ไม่ใช่ POST ให้แจ้งเตือนว่าไม่สามารถใช้งานได้
    http_response_code(405); // รหัส HTTP 405 (Method Not Allowed)
    echo json_encode(array(
        "status" => "error",
        "message" => "Method Not Allowed. กรุณาใช้คำขอแบบ POST เท่านั้น"
    ));
}
?>