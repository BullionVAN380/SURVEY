<?php
session_start();

include "connect.php";

// Handle delete request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM survey_responses WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all responses
$allResponses = [];
$query = "SELECT id, firstname, lastname, email, experience, improvements, recommend, submitted_at FROM survey_responses ORDER BY submitted_at DESC";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $allResponses[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Responses</title>
</head>
<body>
    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">Survey Admin Dashboard</div>
            <nav class="hidden md:block">
                <ul class="flex space-x-4">
                   <li><a href="admin.home.php" class="text-gray-700 hover:text-blue-500">Dashboard</a></li>
                    <li><a href="userdata.php" class="text-gray-700 hover:text-blue-500">User Data</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Surveys</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Responses</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Logout</a></li>
                </ul>
            </nav>
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </header>

    <!-- All Responses -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold mb-4">All Responses</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4">Respondent</th>
                        <th class="py-2 px-4">Experience</th>
                        <th class="py-2 px-4">Improvements</th>
                        <th class="py-2 px-4">Recommend</th>
                        <th class="py-2 px-4">Date</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allResponses as $response): ?>
                    <tr class="border-b">
                        <td class="py-2 px-4"><?php echo htmlspecialchars($response['firstname'] . ' ' . $response['lastname']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($response['experience']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($response['improvements']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($response['recommend']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($response['submitted_at']); ?></td>
                        <td class="py-2 px-4">
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this response?');">
                                <input type="hidden" name="delete_id" value="<?php echo $response['id']; ?>">
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
