<?php
include("include/config.php");
error_reporting(0);

$success = false;

if(isset($_POST['signup'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $mobile = $_POST['usermobile'];
    $password = $_POST['loginpassword'];
    $hashedpassword = hash('sha256', $password);

    $ret = "SELECT * FROM userdata WHERE (username=:uname || useremail=:uemail)";
    $queryt = $dbh->prepare($ret);
    $queryt->bindParam(':uname', $username, PDO::PARAM_STR);
    $queryt->bindParam(':uemail', $email, PDO::PARAM_STR);
    $queryt->execute();
    
    if($queryt->rowCount() == 0){
        $sql = "INSERT INTO userdata(fullname,username,useremail,usermobile,loginpassword) 
                VALUES (:fname, :uname, :uemail, :umobile, :upass)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':uname', $username, PDO::PARAM_STR);
        $query->bindParam(':uemail', $email, PDO::PARAM_STR);
        $query->bindParam(':umobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':upass', $hashedpassword, PDO::PARAM_STR);
        $query->execute();

        $success = true;
    } else {
        echo "<script>alert('Username หรือ Email ถูกใช้งานแล้ว กรุณาลองใหม่');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SignUp Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background: #f8f9fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }
    .container {
      max-width: 400px;
      background: #ffffff;
      padding: 30px;
      border: 1px solid #ddd;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #333;
      text-align: center;
      font-size: 1.8rem;
    }
    .btn-success {
      background-color: #333;
      border: none;
      width: 100%;
      text-transform: uppercase;
    }
    .btn-success:hover {
      background-color: #555;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>สมัครสมาชิก</h2>
  <form action="#" method="post">
    <div class="form-group">
      <label for="fullname">ชื่อ</label>
      <input type="text" class="form-control" id="fullname" name="fullname" required>
    </div>
    <div class="form-group">
      <label for="username">ชื่อผู้ใช้</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="useremail">E-mail</label>
      <input type="email" class="form-control" id="useremail" name="useremail" required>
    </div>
    <div class="form-group">
      <label for="usermobile">เบอร์โทรศัพท์</label>
      <input type="text" maxlength="10" pattern="[0-9]{10}" class="form-control" id="usermobile" name="usermobile" required>
    </div>
    <div class="form-group">
      <label for="loginpassword">รหัสผ่าน</label>
      <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
    </div>
    <button type="submit" class="btn btn-success" name="signup">สร้างบัญชี</button>
  </form>
</div>

<!-- Modal แจ้งเตือนสมัครสมาชิกสำเร็จ -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-3">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M9 12l2 2 4-4"></path>
        </svg>
        <h4 class="mb-3">สมัครสมาชิกสำเร็จ!</h4>
        <button class="btn btn-success" onclick="location.reload();">ตกลง</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    <?php if($success) { ?>
      $('#successModal').modal('show');
    <?php } ?>
  });
</script>

</body>
</html>