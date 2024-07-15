<?php
session_start();

include "connect.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $experience = $_POST['experience'];
    $improvements = $_POST['improvements'];
    $recommend = $_POST['recommend'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO survey_responses (firstname, lastname, email, experience, improvements, recommend) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $experience, $improvements, $recommend);

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
    header("Location: dispplayer.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
 
</head>
<body class="relative">
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
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h1 class="text-3xl font-bold mb-6">Survey Form</h1>
        <form action="" method="POST" class="space-y-6">
            <!-- Personal Information Section -->
            <div>
                <h2 class="text-2xl font-semibold mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" name="firstname" required id="firstname" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input type="text" name="lastname" required id="lastname" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
            <!-- Survey Questions Section -->
            <div>
                <h2 class="text-2xl font-semibold mb-4">Survey Questions</h2>
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700">How would you rate your overall experience with our product?</label>
                    <select name="experience" id="experience" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select an option</option>
                        <option value="excellent">Excellent</option>
                        <option value="good">Good</option>
                        <option value="average">Average</option>
                        <option value="poor">Poor</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="improvements" class="block text-sm font-medium text-gray-700">What can we improve?</label>
                    <textarea name="improvements" id="improvements" rows="4" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="mt-4">
                    <label for="recommend" class="block text-sm font-medium text-gray-700">Would you recommend our product to others?</label>
                    <div class="mt-2 space-y-2">
                        <div>
                            <input type="radio" id="recommend-yes" name="recommend" required value="yes" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="recommend-yes" class="ml-2 block text-sm font-medium text-gray-700">Yes</label>
                        </div>
                        <div>
                            <input type="radio" id="recommend-no" name="recommend" required value="no" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="recommend-no" class="ml-2 block text-sm font-medium text-gray-700">No</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div>
                <input type="submit" value="Submit" class="w-full py-3 px-6 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
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
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
</section>
</body>
</html>
