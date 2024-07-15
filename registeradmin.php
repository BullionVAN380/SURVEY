<?php
include "connect.php";
if (isset($_POST['submit'])){
    $firstname =$_POST['firstname']; 
    $lastname =$_POST['lastname'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $serialno =$_POST['serialno'];
    

    $sql = "INSERT INTO `admin`(`firstname`,`lastname`,`email`,`serialno`,`password`) 
    VALUES ('$firstname','$lastname','$email','$serialno','$password')";

    $results=$conn->query($sql);
    if($results == TRUE){
        $_SESSION['message'] = "New record created successfully";

    }else{
        $_SESSION['message'] = "Error: " . $stmt->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreatPeople/Register/Admin@#un</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen relative">
                  <?php
                  
    
                  if (isset($_SESSION['message'])) {
                      echo '<div id="message" class="message">' . $_SESSION['message'] . '</div>';
                      unset($_SESSION['message']);
                  }
                  ?>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6">Register Adiministrator</h1>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="firstname" class="block text-sm font-medium text-gray-700">First Name:</label>
                <input type="text" name="firstname" id="firstname" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="lastname" class="block text-sm font-medium text-gray-700">Second Name:</label>
                <input type="text" name="lastname" id="lastname" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="serialno" class="block text-sm font-medium text-gray-700">Serial Number:</label>
                <input type="number" name="serialno" id="serialno" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          
            <div>
                <input type="submit" name="submit" value="Submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
            </div>
            <div class="text-center mt-4">
                <a href="index.admin.php" class="text-indigo-600 hover:underline">LOGIN</a>
            </div>
        </form>
    </div>
    <script>
         setTimeout(() => {
            const message = document.getElementById('message');
            if (message) {
                message.classList.add('hidden');
            }
        }, 10000); // 10 seconds

    </script>
</body>
</html>
