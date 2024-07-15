<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players List</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">All Users Registered</div>
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

    <div class="bg-cover bg-center p-6 text-center text-white mb-8 mx-4 rounded-lg shadow-lg" style="background-image: url('field2.jpg');">
        <h1 class="text-4xl font-bold">Players List</h1>
    </div>

    <div class="container mx-auto px-4">
        <?php
        include "connect.php";

        // Check if a delete request was made
        if (isset($_POST['delete'])) {
            $emailToDelete = $_POST['email'];
            $deleteQuery = "DELETE FROM `atributes` WHERE email = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("s", $emailToDelete);
            
            if ($stmt->execute()) {
                echo "<div class='bg-green-100 text-green-700 p-4 rounded mb-4'>Record deleted successfully.</div>";
            } else {
                echo "<div class='bg-red-100 text-red-700 p-4 rounded mb-4'>Error deleting record: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }

        // Check if the connection is still open
        if ($conn->ping()) {
            $query = "SELECT * FROM `atributes`";

            // Execute the query
            $result = $conn->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    echo "<div class='overflow-x-auto'>";
                    echo "<table class='min-w-full bg-white border border-gray-200 rounded-lg'>";
                    echo "<thead class='bg-brown-600 text-white'>";
                    echo "<tr><th class='py-2 px-4'>First Name</th><th class='py-2 px-4'>Last Name</th><th class='py-2 px-4'>Email</th><th class='py-2 px-4'>Action</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b border-gray-200'>";
                        echo "<td class='py-2 px-4'>" . $row["firstname"] . "</td>";
                        echo "<td class='py-2 px-4'>" . $row["lastname"] . "</td>";
                        echo "<td class='py-2 px-4'>" . $row["email"] . "</td>";
                        echo "<td class='py-2 px-4 flex space-x-2'>";
                        // Edit form
                        echo '<form method="post" action="edit.php">';
                        echo '<input type="hidden" name="email" value="' . $row["email"] . '">';
                        echo '<input type="submit" name="edit" value="Edit" class="bg-blue-500 text-white px-3 py-1 rounded">';
                        echo '</form>';
                        // Delete form
                        echo '<form method="post" action="" onsubmit="return confirm(\'Are you sure you want to delete this record?\');">';
                        echo '<input type="hidden" name="email" value="' . $row["email"] . '">';
                        echo '<input type="submit" name="delete" value="Delete" class="bg-red-500 text-white px-3 py-1 rounded">';
                        echo '</form>';
                        echo "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<div class='bg-yellow-100 text-yellow-700 p-4 rounded'>0 results</div>";
                }
            } else {
                echo "<div class='bg-red-100 text-red-700 p-4 rounded'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='bg-red-100 text-red-700 p-4 rounded'>Error: Database connection is closed.</div>";
        }

        $conn->close();
        ?>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
