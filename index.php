<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
        }
        .header-box {
            display: inline-block;
            padding: 10px 20px;
            font-size: 24px;
            color: black;
            border: 2px solid black;
            border-radius: 10px;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.9);
        }
        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .signup-button {
            background-color: #4CAF50;
        }
        .signup-button:hover {
            background-color: #45a049;
        }
        .logout-button {
            background-color: #f44336;
        }
        .logout-button:hover {
            background-color: #d32f2f;
        }

        /* สไตล์ของรายการสินค้า */
        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }
        .product-card {
            width: 280px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            background-color: white;
            text-align: center;
            padding: 15px;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .product-card img:hover {
            transform: scale(1.05);
        }
        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #111;
        }
        .product-price {
            color: #f44336;
            font-size: 16px;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header-box">MEAN</div>

    <!-- ปุ่ม Signup และ Logout -->
    <div class="button-container">
        <a href="signup.php"><button class="btn signup-button">Sign Up</button></a>
        <a href="login.php"><button class="btn logout-button">Log Out</button></a>
    </div>

    <!-- รายการสินค้า -->
    <div class="products-container">
        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dwc5b3e560/b/b/a/0/bba09d13abcaa9316ab9db6f4911fead2e20131f_30592__1_.JPG?sw=394&sh=394&q=75" alt="CRYBABY x Powerpuff Girls">
            <div class="product-title">LEGO Fast And Furious Toyota Supra Mk4</div>
            <div class="product-price">฿4,500.00</div>
        </div>

        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dw0e7846b7/0/d/1/3/0d13cf01d907b465f805f549f79c64caa02fc8e7_14491_i1.jpg?sw=900&sh=900&q=75" alt="Sad Club Series Fidget Spiner">
            <div class="product-title">LEGO Technic NEOM McLaren Extreme E Race Car 42166</div>
            <div class="product-price">฿3,800.00</div>
        </div>

        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dw09e99286/f/2/2/7/f227cad5801ff5f19516d558805c9d0972196dea_39516_i1.jpg?sw=500&sh=500&q=75" alt="Sad Club Series Scene Sets">
            <div class="product-title">LEGO Technic Koenigsegg Jesko Absolut Gray Hypercar 42173</div>
            <div class="product-price">฿5,000.00</div>
        </div>

        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dwd047f656/5/9/a/4/59a41df4e3ad2c3dc508a397ed51538f8c4c47df_39527_i1.jpg?sw=900&sh=900&q=75" alt="Crying Again Series Figures">
            <div class="product-title">LEGO Technic Volvo FMX Truck & EC230 Electric Excavator 42175</div>
            <div class="product-price">฿7,500.00</div>
        </div>

        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dwbd5ecf14/9/c/1/3/9c13182afc1a0773ff21bd1ccce3cac6a4d88ba4_39532_i1.jpg?sw=900&sh=900&q=75" alt="Crying Again Series-Vinyl Face Plush Blind">
            <div class="product-title">LEGO Technic Mercedes-Benz G 500 PROFESSIONAL Line 42177</div>
            <div class="product-price">฿9,000.00</div>
        </div>

        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dw31090428/0/6/0/3/0603862c981df692e2dd7436f0d6fac7c8013164_1.jpg?sw=900&sh=900&q=75" alt="Crying Parade Series">
            <div class="product-title">LEGO® Technic™ Ducati Panigale V4 S Motorcycle 42202</div>
            <div class="product-price">฿7,500.00</div>
        </div>

        <div class="product-card">
            <img src="https://www.toysrus.co.th/dw/image/v2/BDGJ_PRD/on/demandware.static/-/Sites-master-catalog-toysrus/default/dwae364962/3/a/d/3/3ad37dac1c3bf6ee59c9b8a059a9ba319dd78ac6_30594__1_.JPG?sw=900&sh=900&q=75" alt="Crying Again Series-Vinyl Face Plush Blind">
            <div class="product-title">LEGO Chevrolet Corvette Stingray</div>
            <div class="product-price">฿3,000.00</div>
        </div>

    </div>
</body>
</html>