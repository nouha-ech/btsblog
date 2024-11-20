<?php
include('../connexion.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

$query = "SELECT Post.idP, Post.contenu, Post.dateP, Users.nom_complet 
          FROM Post 
          JOIN Users ON Post.idU = Users.idU";
$result = $con->query($query);

if (!$result) {
    die("err query: " . $con->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-semibold">Admin Dashboard</h1>
            <a href="logout.php" class="text-white hover:bg-indigo-700 py-2 px-4 rounded-md">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">List des posts</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">titre de post</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">date</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">publié par</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="border-t">
                            <td class="py-3 px-6 text-sm text-gray-700"><?php echo $row['contenu']; ?></td>
                            <td class="py-3 px-6 text-sm text-gray-500"><?php echo $row['dateP']; ?></td>
                            <td class="py-3 px-6 text-sm text-gray-500"><?php echo $row['nom_complet']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            <a href="users_list.php" class="text-indigo-600 hover:underline">Users list</a>
        </div>
    </div>

</body>

</html>