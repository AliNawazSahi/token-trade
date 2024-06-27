<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true ){
    header("location:  http://localhost/tokentrade/loginsystem/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #171414;
        color: white;
        margin: 0;
        padding: 0;
    }


    /* ===========index.php css============ */

    .header {
        background-color: #141313;
        padding: 2px;
        display: flex;
        justify-content: space-between;
    }

    .header h2 {
        margin-left: 20px;
    }

    .header span {
        margin-right: 8%;
        margin-top: 2.3%;
    }

    .section {
        margin-top: 20px;
        padding: 20px;
    }

    .section p {
        margin-bottom: 16px;
        color: rgb(108 104 104);
    }

    .tokens {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .token {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .token img {
        width: 50px;
        height: 50px;
        margin-right: 20px;
        border-radius: 50%;
    }

    .token-details {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .logo-name,
    .price {
        flex: 1;

    }

    .token-price {
        margin-left: 10%;
    }


    .token-short-name {
        font-weight: bold;
        color: white;
    }

    hr {
        border: 0;
        height: 1px;
        background: rgb(30, 29, 29, 1);
        margin: 5px 0;
        width: 80%;
    }

    .modal-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 400px;
        background-color: #333;
        color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .user-info {
        margin-bottom: 10px;
    }

    button {
        background-color: #282828;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    button:hover {
        background-color: #222;
    }

    .button {
        background-color: #282828;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .button:hover {
        background-color: #222;
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    .close-button:hover {
        color: #fff;
    }

    .innermodal {
        display: flex;
        flex-direction: column;
        padding: 12px;
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    .close-button:hover {
        color: #fff;
    }

    .update_profile {
        margin-bottom: 3%;
    }

    .currency{
        font-size: 18px;
     }
     .priceheading{
        font-size: 18px;
        margin-left: 3%;
     }
     .actionheading{
        font-size: 18px;
     }
    @media screen and (max-width: 450px) {
        
        .currency{
            font-size: 15px;
        }
        .priceheading{
            font-size: 15px;
        }
        .actionheading{
            font-size: 15px;
        }
        button{
            font-size: 6px;
        }
        .token-price {
    margin-left: 0%;
}
.section p {
    font-size: 12px;
        
}
.token img {
    width: 40px;
    height: 40px;
    margin-right: 4px;
    border-radius: 50%;
       
    }
    .add-token-button {
        font-size: 13px;
    }
    .innerul{
        padding-left:0%;
    }
    .header span {
        margin-top: 6.3%;
    }


 }

    </style>
</head>

<body>
    <div class="header">
        <h2>Tokentrade</h2>
        <span onclick="openModal()"><i class="fa-solid fa-user fa-xl"
                style="color: #dbe0ea; cursor: pointer;"></i></span>
    </div>

    <div class="section">
        <h1>Accounts</h1>
        <p>You can replenish your account or withdraw funds.</p>
        <hr>
    </div>

    <div class="section">
        <div style="display: flex;  ">
            <div style="flex: 1; color: rgb(112 104 104);">
                <h2 class="currency">Cryptocurrency</h2>
            </div>
            <div style="flex: 1; color: rgb(112 104 104); margin-left: 10%;">
                <h2 class="priceheading">Price</h2>
            </div>
        </div>
        <hr style="height: 4px;">
        <ul class="tokens">
            <?php

            // Database connection
            $server = "localhost";
            $username = "root";
            $password = "";
            $database = "tradetoken_db";

            $conn = mysqli_connect($server, $username, $password, $database);

            if (!$conn) {
                die("Error: " . mysqli_connect_error());
            }
            
            $sql = "SELECT * FROM tokens";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                echo '<ul class="innerul">';
                while ($row = mysqli_fetch_assoc($result)) {
                    $logo = $row['logo_url'];
                    $shortName = $row['short_name'];
                    $tokenName = $row['token_name'];
                    $price = $row['token_price'];
            
                    echo '<li class="token">';
                    echo '<div class="token-details">';
                    echo '<div class="logo-name">';
                    echo '<div style="display: flex; align-items: center;">';
                    echo '<img src="' . $logo . '" alt="' . $shortName . '">';
                    echo '<p><span class="token-short-name">' . $shortName . '</span><br>' . $tokenName . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="price">';
                    echo '<p class="token-price">'.'$' . $price . '</p>';
                    echo '</div>';
                
                    echo '</div>';
                    echo '</li>';
                    echo '<hr>';
                }
                echo '</ul>';
                mysqli_close($conn);
            }
          
          ?>
        </ul>
    </div>
    <!-- modal -->

    <div class="modal-container" id="userModal">
        <div class="innermodal">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <div class="user-info">
                <h3 style="text-align: center;">Your Profile</h3>
                <p>Name: <?php echo $_SESSION['username'] ?></p>
                <p>Email: <?php echo $_SESSION['email'] ?></p>
            </div>
            <?php
                if ($_SESSION['email'] != "admin@gmail.com") {
                    echo '<a class="button" style="margin: 2% 0;" href="update_credentials.php" class="update_profile">Update Email and Password</a>';
                }
            ?>
        
            <a class="button" href="http://localhost/tokentrade/loginsystem/logout.php" onclick="logout()">Log Out</a>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/5945d2ca54.js" crossorigin="anonymous"></script>
    <script>
    function openModal() {
        var modal = document.getElementById("userModal");
        modal.style.display = "block";
    }

    function closeModal() {
        var modal = document.getElementById("userModal");
        modal.style.display = "none";
    }

    function logout() {
        closeModal();
    }
    </script>
</body>

</html>