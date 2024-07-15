<?php
session_start();

include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $messages = $_POST['messages'];

     // Prepare and bind
     $stmt = $conn->prepare("INSERT INTO contact_us (name, email, subject, messages) VALUES (?, ?, ?, ?)");
     $stmt->bind_param("ssss", $name, $email, $subject, $messages);

      // Execute the query
    if ($stmt->execute()) {
        $_SESSION['message'] = "New record created successfully";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the form page
    header("Location: contact.php");
    exit();
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="bg-white shadow-md w-full md:w-4/5 lg:w-3/5 mx-auto">
    <div class="flex justify-between items-center p-4">
        <div class="flex items-center">
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <ul id="menu" class="md:flex space-x-4">
                <li><a href="home.php" class="text-gray-700 hover:text-blue-500 font-semibold">HOME</a></li>
                <li><a href="dispplayer.php" class="text-gray-700 hover:text-blue-500 font-semibold">SURVEY</a></li>
                <li><a href="contact.php" class="text-gray-700 hover:text-blue-500 font-semibold">CONTACT</a></li>
            </ul>
        </div>
        <div class="p-3 md:space-x-4">
            <a href="index.php" class="text-gray-700 hover:text-blue-500 font-semibold">LOG OUT</a>
            <a href="index.admin.php" id="admin" class="text-gray-700 hover:text-blue-500 font-semibold ">ADMIN</a>
            </div>
    </div>
    <div id="dropdown-menu" class="hidden flex-col space-y-2 p-4">
        <a href="home.php" class="text-gray-700 hover:text-blue-500 font-semibold p-2">HOME</a>
        <a href="dispplayer.php" class="text-gray-700 hover:text-blue-500 font-semibold p-2">SURVEY</a>
        <a href="contact.php" class="text-gray-700 hover:text-blue-500 font-semibold p-2">CONTACT</a>
    </div>
</div>
    <section class="bg-gray-100 flex items-center justify-center min-h-screen">
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div id="message" class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Contact Us</h1>
        <form action="https://api.web3forms.com/submit" method="POST" class="space-y-6">

              <!-- Replace with your Access Key -->
               <input type="hidden" name="access_key" value="7c831c3d-dc0c-41ba-98d4-80ba6ed1e8a7">

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Subject -->
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                <input type="text" name="subject" id="subject" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <!-- Message -->
            <div>
                <label for="messages" class="block text-sm font-medium text-gray-700">Messages:</label>
                <textarea name="messages" id="messages" rows="4" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
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

      
        // JavaScript to toggle the dropdown menu
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
            } else {
                dropdownMenu.classList.add('hidden');
            }
        });
  
    </script>

    </section>
    
</body>
</html>