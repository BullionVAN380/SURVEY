<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Home</title>
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
        <img src="images/survey.png" alt="survey" class="w-full h-auto rounded-lg shadow-lg">
    </section>

    <script>
        
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
</body>
</html>
