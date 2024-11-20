<?php

include('../connexion.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}


$query = "SELECT Users.idU, Users.nom_complet, COUNT(Post.idP) AS post_count 
          FROM Users 
          LEFT JOIN Post ON Users.idU = Post.idU 
          GROUP BY Users.idU";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">


    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-semibold">Admin Dashboard</h1>
            <a href="dashboard.php" class="text-white hover:bg-indigo-700 py-2 px-4 rounded-md"> posts</a>
            <a href="logout.php" class="text-white hover:bg-indigo-700 py-2 px-4 rounded-md">Logout</a>
        </div>
    </nav>


    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Users List</h2>


        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Username</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">nombre de posts</th>
                        <th>posts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="border-t">
                            <td class="py-3 px-6 text-sm text-gray-700"><?php echo $row['nom_complet']; ?></td>
                            <td class="py-3 px-6 text-sm text-gray-500"><?php echo $row['post_count']; ?></td>
                            <td><a href="user_posts.php?id=<?php echo $row['idU']; ?>">voir les posts</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>