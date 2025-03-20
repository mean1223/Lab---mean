<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #ffffff;
            padding: 40px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }
        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding-left: 40px; /* เว้นที่ให้ไอคอน */
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #333;
            outline: none;
        }
        .icon {
            position: absolute;
            left: 12px;
            font-size: 18px;
            color: #777;
        }
        .toggle-password {
            position: absolute;
            right: 12px;
            font-size: 18px;
            color: #777;
            cursor: pointer;
        }
        .btn-login {
            width: 100%;
            background-color: #000;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-login:hover {
            background-color: #333;
        }
        .signup-link {
            margin-top: 15px;
            font-size: 14px;
        }
        .signup-link a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePasswordIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.textContent = "👁️";
            } else {
                passwordField.type = "password";
                toggleIcon.textContent = "👁️‍🗨️";
            }
        }
    </script>
</head>
<body>

<div class="login-container">
    <h2>เข้าสู่ระบบ</h2>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="username">ชื่อผู้ใช้</label>
            <div class="input-container">
                <span class="icon">👤</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password">รหัสผ่าน</label>
            <div class="input-container">
                <span class="icon">🔒</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
                <span class="toggle-password" id="togglePasswordIcon" onclick="togglePassword()">👁️‍🗨️</span>
            </div>
        </div>
        <button type="submit" class="btn-login">เข้าสู่ระบบ</button>
    </form>
    <p class="signup-link">ยังไม่มีบัญชี? <a href="signup.php">สมัครสมาชิก</a></p>
</div>

</body>
</html>
