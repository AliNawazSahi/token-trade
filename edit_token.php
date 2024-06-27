<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['email'] !== "admin@gmail.com"){
    header("location: http://localhost/tokentrade/loginsystem/login.php");
    exit;
}

$server = "localhost";
$username = "root";
$password = "";
$database = "tradetoken_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Load the page for editing

    // Get the ID from the URL
    $ids = $_GET['id'];

    // Fetch the token data for the given ID
    $selectQuery = "SELECT * FROM tokens WHERE id = {$ids}";
    $result = mysqli_query($conn, $selectQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $logo = $row['logo_url'];
        $tokenAddress = $row['token_address'];
        $shortName = $row['short_name'];
        $tokenName = $row['token_name'];
        $tokenPrice = $row['token_price'];
    } else {
        echo "Error fetching token data: " . mysqli_error($conn);
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission and update the token

    // Retrieve form data
    $id = $_POST['id'];
    $tokenAddress = $_POST['tokenAddress'];
    $shortName = $_POST['shortName'];
    $tokenName = $_POST['tokenName'];
    $tokenPrice = $_POST['price'];

    // Handle logo image upload only if a new logo is provided
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $uploadDirectory = "assets/"; // Directory to store uploaded images
        $uploadedFile = $_FILES['logo'];

        $tmpName = $uploadedFile['tmp_name'];
        $extension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
        $newFilename = "logo_" . $id . ".$extension"; // Generate a unique filename

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($tmpName, $uploadDirectory . $newFilename)) {
            $logo = $uploadDirectory . $newFilename;
        }
    }

    // Update Query
    $updateQuery = "UPDATE tokens SET token_address = '$tokenAddress', short_name = '$shortName', token_name = '$tokenName', token_price = '$tokenPrice'";

    if (isset($logo)) {
        // Only include the logo update if a new logo was provided
        $updateQuery .= ", logo_url = '$logo'";
    }

    $updateQuery .= " WHERE id = $id";
    
    $query = mysqli_query($conn, $updateQuery);

    if ($query) {
        // Redirect back to the admin dashboard or any other page upon success
        header("location: http://localhost/tokentrade/admin_dashboard.php");
    } else {
        echo "Error updating token: " . mysqli_error($conn);
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokentrade</title>
    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
    body {
        background-color: #151719;
    }

    .form {
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-width: 350px;
        padding: 50px;
        border-radius: 20px;
        position: relative;
        background-color: #1a1a1a;
        color: #fff;
        border: 1px solid #333;
    }

    .title {
        font-size: 28px;
        font-weight: 600;
        letter-spacing: -1px;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 30px;
        color: #00bfff;
    }

    .title::before {
        width: 18px;
        height: 18px;
    }

    .title::after {
        width: 18px;
        height: 18px;
        animation: pulse 1s linear infinite;
    }

    .title::before,
    .title::after {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        border-radius: 50%;
        left: 0px;
        background-color: #00bfff;
    }

    .message,
    .signin {
        font-size: 14.5px;
        color: rgba(255, 255, 255, 0.7);
    }

    .signin {
        text-align: center;
    }

    .signin a:hover {
        text-decoration: underline royalblue;
    }

    .signin a {
        color: #00bfff;
    }

    .flex {
        display: flex;
        width: 100%;
        gap: 6px;
    }

    .form label {
        position: relative;
    }

    .form label .input {
        background-color: #333;
        color: #fff;
        width: 100%;
        padding: 20px 60px 05px 10px;
        outline: 0;
        border: 1px solid rgba(105, 105, 105, 0.397);
        border-radius: 10px;
    }

    .form label .input+span {
        color: rgba(255, 255, 255, 0.5);
        position: absolute;
        left: 10px;
        top: 0px;
        font-size: 0.9em;
        cursor: text;
        transition: 0.3s ease;
    }

    .form label .input:placeholder-shown+span {
        top: 12.5px;
        font-size: 0.9em;
    }

    .form label .input:focus+span,
    .form label .input:valid+span {
        color: #00bfff;
        top: 0px;
        font-size: 0.7em;
        font-weight: 600;
    }

    .input {
        font-size: medium;
    }

    .submit {
        border: none;
        outline: none;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 16px;
        transform: .3s ease;
        background-color: #00bfff;
    }

    .submit:hover {
        background-color: #00bfff96;
    }

    @keyframes pulse {
        from {
            transform: scale(0.9);
            opacity: 1;
        }

        to {
            transform: scale(1.8);
            opacity: 0;
        }
    }

    #main_comtainer {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 2.2%;

    }
    </style>
</head>

<body>
<div style=" display: flex;
    align-items: center;
    justify-content:center ; overflow:hidden; flex-direction:column; margin-top:33px; " class="main-div">
   
    <div class="w-100 text-center" id="main_comtainer">
        <form class="form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <p class="title">Edit Token</p>
            <div style=" flex: 1;" class="logo-div">
     <img style="    height: 50px;
    width: 50px; border-radius:50%;" src="<?php echo $logo; ?>" alt="Image description">

     </div>
            <p class="message">Chose Logo intrinsic size 225 x 225 px </p>
            <div class="flex">   
            <label>
                <input title="Select logo" type="file" id="logo" name="logo" value="<?php echo $logo; ?>" accept="image/*" >   
                       
                </label>
            </div>

            <label>
            <input class="input" type="text" name="tokenAddress" value="<?php echo $tokenAddress; ?>">
            <span>Token Address</span>
            </label>
            <label>
            <input class="input" type="text" name="shortName" value="<?php echo $shortName; ?>">
            <span>Token Symbol</span>
            </label>

            <label>
            <input class="input" type="text" name="tokenName" value="<?php echo $tokenName; ?>">
            <span>Token Full Name</span>
        </label>
        <input class="input" type="hidden" id="tokenPriceInput" name="price" value="<?php echo $tokenPrice; ?>">
        
            <button class="submit" type="submit">Update</button>
        
        </form>
    </div>
    </div>

    <script>

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form");
    const tokenPriceInput = form.querySelector("#tokenPriceInput"); // Define tokenPriceInput here
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
                throw an Error(`Error: ${response.status} - ${response.statusText}`);
            }

            const data = await response.json();

            if (data.data && data.data[tokenName]) {
                const tokenPrice = data.data[tokenName].quote.USD.price;

                // No need to set the tokenPrice again here
                console.log("Fetched Token Price:", tokenPrice);
                // Proceed to insert the data into the database
                form.submit();
            } else {
                console.error(`Token ${tokenName} not found in the API response.`);
            }

        } catch (error) {
            console.error("Error:", error);
        }
    });
});





    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>


</body>

</html>
