<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $_SESSION['email'] !== "admin@gmail.com"){
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
        width: 40px;
        height: 40px;
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
        margin-left: 4%;
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

    /* ===========admin.php css============ */


    .add-token-button {
        background-color: #2a2c2e;
        color: #858585;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-weight: bold;
        font-size: 18px;
    }

    .add-token-button:hover {
        background-color: green;
    }

    .add-token-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 400px;
        background-color: #333;
        color: #858585;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .modal-title {
        text-align: center;
        font-size: 24px;
        color: #fff;
        margin-bottom: 20px;
    }

    .token-form .form-group {
        margin-bottom: 15px;
    }

    .token-form label {
        color: #fff;
        font-weight: bold;
        display: block;
    }

    .token-form input {
        width: 90%;
        padding: 10px;
        border: none;
        background-color: #2a2c2e;
        color: #fff;
        border-radius: 5px;
        margin-top: 2%;
    }

    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .cancel-button,
    .save-button {
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        color: #fff;
    }

    .cancel-button {
        background-color: #dd4b39;
    }

    .cancel-button:hover {
        background-color: #ff5b49;
    }

    .save-button {
        background-color: #5cb85c;
    }

    .save-button:hover {
        background-color: #63c663;
    }

    .add-tokken-div {
        display: flex;
        justify-content: center;
        margin-top: 4%;
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
     .innerul{
        padding-left:0%;
    }
    .token-address{
     padding-left:6%;
    }

    @media screen and (max-width: 500px) {
        
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
       
.section p {
    font-size: 12px;
        
}
.token-address{
    font-size: 10px;

}
.token img {
    width: 40px;
    height: 40px;
    margin-right: 4px;
    border-radius: 50%;
       
    }
    .add-token-button {
        font-size: 11px;
    }
    .innerul{
        padding-left:0%;
    }
    .header span {
        margin-top: 6.3%;
    }
    .toke-price p{
    margin-left: 11%;
}


 }
    @media screen and (max-width: 400px) {
        
        .currency{
            font-size: 11px;
        }
        .priceheading{
            font-size: 11px;
        }
        .actionheading{
            font-size: 11px;
        }
        button{
            font-size: 4px;
        }
        .token-price {
    margin-left: 0%;
}
.section p {
    font-size: 9px;
        
}
.token-address{
    font-size: 10px;

}
.section p {
    margin-bottom: 2px;
    color: rgb(108 104 104);
}
.toke-price p{
    margin-left: 11%;
}
.token img {
    width: 35px;
    height: 35px;
    margin-right: 4px;
    border-radius: 50%;
       
    }
    .add-token-button {
        font-size: 10px;
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
        <h2>tokenstrade</h2>
        <span onclick="openModal()"><i class="fa-solid fa-user fa-xl"
                style="color: #dbe0ea; cursor: pointer;"></i></span>
    </div>

    <!-- admin -->

    <div class="add-tokken-div">
        <button class="add-token-button" onclick="openAddTokenModal()">Add Token</button>
    </div>




    <div class="section">
        <div style="display: flex;  ">
            <div style="flex: 1; color: rgb(112 104 104);">
                <h2 class="currency">Cryptocurrency</h2>
            </div>
            <div style="flex: 1; color: rgb(112 104 104);">
                <h2 class="priceheading">Price</h2>
            </div>
            <div style="flex: 1; color: rgb(112 104 104);">
                <h2 class="priceheading">Address</h2>
            </div>
            <div style=" color: rgb(112 104 104);">
                <h2 class="actionheading">Action</h2>
            </div>
        </div>
        <hr style="height: 4px;">
        <ul class="tokens">
        <form method="post" style="display: none;" id="deleteForm">
         <input type="hidden" name="delete_token" id="deleteTokenInput">
      </form>
            <?php

            // Database connection
           // Database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "tradetoken_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDirectory = "assets/"; // The directory to store image files
    $logo = $_FILES["logo"]["name"]; // Get the original file name
    $targetFile = $targetDirectory . $logo;

    // Check if the file is an actual image or fake image
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if ($check === false) {
    } else {
        // Move the uploaded image to the "assets" directory
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully

            // Proceed to save the image's path in the database
            $shortName = $_POST["shortName"];
            $tokenName = $_POST["tokenName"];
            $tokenPrice = $_POST["price"];
            $tokenAddress = $_POST["tokenAddress"];

            // Insert data into the "tokens" table
            $sql = "INSERT INTO tokens (logo_url, short_name, token_name, token_price, token_address) 
                    VALUES ('$targetFile', '$shortName', '$tokenName', '$tokenPrice', '$tokenAddress')";

            if (mysqli_query($conn, $sql)) {
                // Data inserted successfully
            } else {
                // Handle errors
                echo "Error: " . mysqli_error($conn);
            }
        } else {
        }
    }
}

$sql = "SELECT * FROM tokens";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo '<ul class="innerul">';
    while ($row = mysqli_fetch_assoc($result)) {
        $logo = $row['logo_url'];
        $shortName = $row['short_name'];
        $tokenName = $row['token_name'];
        $tokenAddress = $row['token_address'];
        $tokenPrice = $row['token_price'];
        $id = $row['id'];

        echo '<li class="token">';
        echo '<div class="token-details">';
        echo '<div class="logo-name">';
        echo '<div style="display: flex; align-items: center;">';
        echo '<img src="' . $logo . '" alt="' . $shortName . '">';
        echo '<p><span class="token-short-name">' . $shortName . '</span><br>' . $tokenName . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="price">';
        echo '<p class="token-price">' . '$' . $tokenPrice . '</p>';
        echo '</div>';
        echo '<div class="price">';
        echo '<p class="token-price token-address">' . $tokenAddress . '</p>';
        echo '</div>';
        echo '<div class="token-actions">';
        echo '<button class="edit-button" onclick="confirmEdit(' . $id . ')">Edit</button>';
        echo '<button style="margin-left: 5px;" class="delete-button" onclick="confirmDelete(' . $id . ')">Delete</button>';
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
}

mysqli_close($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDirectory = "assets/"; // Create an "uploads" folder in your project directory
    $targetFile = $targetDirectory . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image or fake image
   

    // Check if the file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Check file size (you can adjust this value)
    if ($_FILES["logo"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats (you can modify this list)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    if ($uploadOk === 0) {
    } else {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            // Proceed with saving other form data and inserting into the database
        } else {
        }
    }
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
                <p>Name: Admin</p>
                <p>Email: admin@gmail.com</p>
            </div>
            <a class="button" href="http://localhost/tokentrade/loginsystem/logout.php" onclick="logout()">Log Out</a>
        </div>
    </div>

    <!-- add token modal -->

    <div class="add-token-modal" id="addTokenModal">
    <span class="close-button" onclick="closeAddTokenModal()">&times;</span>
    <h3 class="modal-title">Add Token</h3>
    <form class="token-form" action="" method="post" enctype="multipart/form-data">
    <p class="message">Choose Logo intrinsic size 225 x 225 px</p>
    <div class="form-group">
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo" required>
    </div>
    <div class="form-group">
        <label for="tokenAddress">Token Address:</label>
        <input type="text" id="tokenAddress" name="tokenAddress" placeholder="Enter Token Address" required>
    </div>
        <div class="form-group">
            <label for="shortName">Symbol:</label>
            <input type="text" id="shortName" name="shortName" placeholder="Symbol in capital" required>
        </div>
        <div class="form-group">
            <label for="tokenName">Name:</label>
            <input type="text" id="tokenName" name="tokenName" placeholder="Token Name" required>
         </div>
        <div class="button-container">
        <input type="hidden" id="tokenPriceInput" name="price">

            <button class="cancel-button" onclick="closeAddTokenModal()">Cancel</button>
            <button class="save-button" type="submit">Add</button>
        </div>
    </form>
</div>









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

    function openAddTokenModal() {
        var modal = document.getElementById("addTokenModal");
        modal.style.display = "block";
    }

    function closeAddTokenModal() {
        var modal = document.getElementById("addTokenModal");
        modal.style.display = "none";
    }

    // edit and delete

    function confirmDelete(id) {
        var result = window.confirm('Are you sure you want to delete this token?');
        if (result) {
            window.location.href = 'delete_token.php?id=' + id;
        }
    }

    function confirmEdit(id) {
        var result = window.confirm('Are you sure you want to edit this token?');
        if (result) {
            window.location.href = 'edit_token.php?id=' + id;
        }
    }

    

// Api request

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".token-form");
    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        const logo = form.querySelector("#logo").value;
        let tokenName = form.querySelector("#tokenName").value;
        tokenName = tokenName.toUpperCase(); // Convert to uppercase

        // Make an API request to CoinMarketCap
        const apiKey = "75c0e05e-4181-4d45-a05c-2c6b49b55c21"; // Replace with your actual API key
        const apiUrl = `https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=${tokenName}&convert=USD`;

        try {
            const response = await fetch(apiUrl, {
                method: "GET",
                headers: {
                    "X-CMC_PRO_API_KEY": apiKey,
                },
            });

            if (!response.ok) {
                throw new Error(`Error: ${response.status} - ${response.statusText}`);
            }

            const data = await response.json();

            if (data.data && data.data[tokenName]) {
                const tokenPrice = data.data[tokenName].quote.USD.price;

                // Set the token price to the hidden input field
                tokenPriceInput.value = tokenPrice;
                console.log("Fetched Token Price:", tokenPriceInput);
                // Proceed to insert the data into the database
                form.submit();
            } else {
                console.error(`Token ${tokenName} not found in the API response.`);
                alert(`Token "${tokenName}" not found by CoinMarketCap please enter new token`);
            }

        } catch (error) {
            console.error("Error:", error);
        }
    });
});




    </script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
    <script src="https://kit.fontawesome.com/5945d2ca54.js" crossorigin="anonymous"></script>
</body>

</html>







