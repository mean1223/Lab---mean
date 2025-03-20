<?php
session_start();
include("../include/config.php"); // รวมไฟล์การตั้งค่าฐานข้อมูล
error_reporting(0);

header('Content-Type: application/json'); // ตั้งค่าการตอบกลับเป็น JSON

// ตรวจสอบสิทธิ์ของผู้ใช้
if ($_SESSION['user_type'] == 1) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]); // ถ้าเป็นผู้ใช้ประเภทที่ไม่ได้รับอนุญาต
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) { // ตรวจสอบการร้องขอจาก POST และการตั้งค่า update
    try {
        // รับข้อมูลจากฟอร์มการอัปเดตข้อมูลผู้ใช้
        $eid = filter_input(INPUT_POST, 'eid', FILTER_SANITIZE_NUMBER_INT); // รหัสผู้ใช้
        $fullname = trim($_POST['fullname']); // ชื่อผู้ใช้
        $username = trim($_POST['username']); // ชื่อผู้ใช้ในระบบ
        $useremail = filter_var($_POST['useremail'], FILTER_VALIDATE_EMAIL); // อีเมลของผู้ใช้
        $usermobile = trim($_POST['usermobile']); // เบอร์โทรศัพท์ของผู้ใช้
        $loginpassword = $_POST['loginpassword']; // รหัสผ่านใหม่

        // ตรวจสอบข้อมูลที่จำเป็นทั้งหมดว่าไม่ว่าง
        if (!$eid || !$fullname || !$username || !$useremail || !$usermobile) {
            echo json_encode(["status" => "error", "message" => "Invalid input data"]); // หากข้อมูลไม่ครบ
            exit();
        }

        // คำสั่ง SQL สำหรับอัปเดตข้อมูลผู้ใช้
        if (!empty($loginpassword)) {
            // ถ้ามีการส่งรหัสผ่านใหม่
            $hashedpassword = hash('sha256', $loginpassword); // แฮชรหัสผ่านด้วย sha256
            $sql = "UPDATE userdata SET fullname=:fullname, username=:username, useremail=:useremail, usermobile=:usermobile, loginpassword=:hashedpassword WHERE id=:eid";
        } else {
            // ถ้าไม่มีการส่งรหัสผ่านใหม่
            $sql = "UPDATE userdata SET fullname=:fullname, username=:username, useremail=:useremail, usermobile=:usermobile WHERE id=:eid";
        }

        // เตรียมคำสั่ง SQL และผูกค่าพารามิเตอร์
        $query = $dbh->prepare($sql);
        $query->bindParam(':eid', $eid, PDO::PARAM_INT);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->bindParam(':usermobile', $usermobile, PDO::PARAM_STR);

        if (!empty($loginpassword)) {
            $query->bindParam(':hashedpassword', $hashedpassword, PDO::PARAM_STR);
        }

        // ดำเนินการคำสั่ง SQL
        $query->execute();

        // รับข้อมูลสำหรับอัปเดตสินค้า
        $pro_id = $_POST['pro_id'] ?? ''; // รหัสสินค้า
        $pro_name = $_POST['pro_name'] ?? ''; // ชื่อสินค้า
        $cat_id = $_POST['cat_id'] ?? ''; // รหัสประเภทสินค้า
        $pro_price = $_POST['pro_price'] ?? ''; // ราคาทุน
        $pro_cost = $_POST['pro_cost'] ?? ''; // ราคาขาย
        $pro_img = $_POST['pro_img'] ?? ''; // ลิ้งค์รูปภาพสินค้า

        // ตรวจสอบข้อมูลสินค้าหากมีการอัปเดต
        if ($pro_id && $pro_name && $cat_id && $pro_price && $pro_cost) {
            // คำสั่ง SQL สำหรับอัปเดตข้อมูลสินค้า
            $sql_product = "UPDATE products SET pro_name=:pro_name, cat_id=:cat_id, pro_price=:pro_price, pro_cost=:pro_cost, pro_img=:pro_img WHERE pro_id=:pro_id";
            
            // เตรียมคำสั่ง SQL สำหรับสินค้า
            $query_product = $dbh->prepare($sql_product);
            $query_product->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
            $query_product->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
            $query_product->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
            $query_product->bindParam(':pro_price', $pro_price, PDO::PARAM_STR);
            $query_product->bindParam(':pro_cost', $pro_cost, PDO::PARAM_STR);
            $query_product->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);

            // ดำเนินการคำสั่ง SQL สำหรับสินค้า
            $query_product->execute();
        }

        // หากทุกอย่างสำเร็จ
        echo json_encode(["status" => "success", "message" => "User and product have been updated"]);

    } catch (PDOException $e) {
        // หากเกิดข้อผิดพลาดจากฐานข้อมูล
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    // ถ้าคำขอไม่ถูกต้อง
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
