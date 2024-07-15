<?php
 include "connect.php";
 if(isset($_POST['login'])){
    
    $email=$_POST['email'];
    $password=$_POST['password'];


    $sql="SELECT*FROM atributes WHERE email= '$email' AND  password='$password'";
    $results=$conn->query($sql);
    if($results->num_rows>0){
        //$msg = 'Login Complete! Thanks';
        echo "<script> window.location.assign('home.php'); </script>";
    }else{
        echo "Invalid Password";
    } 
 }
 $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Account</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6">Log In Details</h1>
        <form action="" method="POST" class="space-y-4">
          
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <input type="submit" name="login" value="Login" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
            </div>
            <div class="text-center mt-4">
                <a href="login.php" class="text-indigo-600 hover:underline">REGISTER</a>
            </div>
        </form>
    </div>
</body>
</html>
