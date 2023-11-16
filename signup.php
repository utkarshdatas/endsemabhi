<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    //     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//   <strong>Success</strong> You should check in on some of those fields below.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
    if (empty($name)) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($name);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dummy";
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
        echo "Connected";
        $sql1 = "SELECT * FROM `User` WHERE Email='$email'";
        echo $sql1;
        echo "<br>";
        $result1 = mysqli_query($conn, $sql1);
        $num = mysqli_num_rows($result1);
        if ($num != 0) {
            $row = mysqli_fetch_assoc($result1);
            echo $row['Name'] . $row['Email'];
            echo "<br>";
        } else {
            $sql2 = "INSERT INTO `User` (`Name`, `Email`, `Password`) VALUES ('$name', '$email', '$pass')";
            $result = mysqli_query($conn, $sql2);
            if ($result) {
                echo "Success";
                //             echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//   <strong>Success</strong>
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
            }
        }

    }


}
// $type = $_SERVER['REQUEST_METHOD'];
// echo "Name entered is $name and $type";
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body>
    <h2>Server-side Form Validation</h2>
    <form method="post" name="empfrm" id="eform" action="">
        Name: <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <span id="nameError" class="red"></span>
        <br><br>
        E-mail:
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <span id="emailError" class="red"></span>
        <br><br>
        <input type="submit" id="submit" name="submit" value="Submit">
        <input type="reset" value="CLEAR" id="reset" onclick="clearDisplay()">
    </form> -->
<!-- <div class="bg-white p-8 rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Sign Up</h2>
    <form id="signupForm" action="" method="post">
        <div class="mb-4">
            <label for="name" class="block text-gray-600 text-sm font-medium mb-2">Name</label>
            <input type="text" id="name" name="name" class="w-full p-2 border rounded" value="<?php echo $name; ?>" />
            <span class="error">*
                <?php echo $nameErr; ?>
            </span>
            <span id="nameError" class="red"></span>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email</label>
            <input type="email" id="email" name="email" class="w-full p-2 border rounded" value="<?php echo $email; ?>"
                required />
            <span class="error">*
                <?php echo $emailErr; ?>
            </span>
            <span id="emailError" class="red"></span>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border rounded" required />
        </div>
        <div class="mb-4">
            <label for="confirmPassword" class="block text-gray-600 text-sm font-medium mb-2">Confirm
                Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" class="w-full p-2 border rounded"
                required />
        </div>
        <button type="submit" onclick="validateForm()"
            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Sign Up
        </button>
    </form>
</div>
</body>

</html> -->