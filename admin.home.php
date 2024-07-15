<?php
session_start();

include "connect.php";

// Fetch recent responses
$recentResponses = [];
$query = "SELECT firstname, lastname, email, experience, improvements, recommend, submitted_at FROM survey_responses ORDER BY submitted_at DESC LIMIT 5";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recentResponses[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            #sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">Survey Admin Dashboard</div>
            <nav class="hidden md:block">
                <ul class="flex space-x-4">
                    <li><a href="userdata.php" class="text-gray-700 hover:text-blue-500">User Data</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Surveys</a></li>
                    <li><a href="responses.php" class="text-gray-700 hover:text-blue-500">Responses</a></li>
                    <li><a href="index.admin.php" class="text-gray-700 hover:text-blue-500">Logout</a></li>
                </ul>
            </nav>
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </header>

    <!-- Sidebar and Main Content Container -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-gray-800 text-gray-200 w-64 py-8 absolute md:relative inset-y-0 left-0 transform md:transform-none transition-transform duration-300">
            <nav class="space-y-4">
                <a href="#" class="block px-4 py-2 text-lg hover:bg-gray-700">Dashboard</a>
                <a href="#" class="block px-4 py-2 text-lg hover:bg-gray-700">Manage Surveys</a>
                <a href="#" class="block px-4 py-2 text-lg hover:bg-gray-700">View Responses</a>
                <a href="#" class="block px-4 py-2 text-lg hover:bg-gray-700">Settings</a>
            </nav>
        </aside>

        <!-- Main Dashboard Content -->
        <main class="flex-1 bg-white p-6 overflow-auto">
            <!-- Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold">Total Surveys</h3>
                    <p class="text-4xl mt-2">12</p>
                </div>
                <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold">Active Surveys</h3>
                    <p class="text-4xl mt-2">5</p>
                </div>
                <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold">Total Responses</h3>
                    <p class="text-4xl mt-2">234</p>
                </div>
                <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold">Pending Approvals</h3>
                    <p class="text-4xl mt-2">3</p>
                </div>
            </div>

            <!-- Recent Responses -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-2xl font-bold mb-4">Recent Responses</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4">Respondent</th>
                                <th class="py-2 px-4">Experience</th>
                                <th class="py-2 px-4">Improvements</th>
                                <th class="py-2 px-4">Recommend</th>
                                <th class="py-2 px-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentResponses as $response): ?>
                            <tr class="border-b">
                                <td class="py-2 px-4"><?php echo htmlspecialchars($response['firstname'] . ' ' . $response['lastname']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($response['experience']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($response['improvements']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($response['recommend']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($response['submitted_at']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Create New Survey -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Create New Survey</h2>
                <form>
                    <div class="mb-4">
                        <label for="survey-title" class="block text-sm font-medium text-gray-700">Survey Title</label>
                        <input type="text" id="survey-title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="survey-description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="survey-description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="survey-questions" class="block text-sm font-medium text-gray-700">Questions</label>
                        <textarea id="survey-questions" rows="6" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Survey</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
