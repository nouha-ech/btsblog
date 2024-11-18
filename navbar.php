<?php
include('connexion.php');

$sql = "SELECT * FROM post ORDER BY dateP DESC";
$posts_result = $con->query($sql);

$user_sql = "SELECT * FROM Users";
$users_result = $con->query($user_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghazala Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">


    <div class="flex justify-between p-4 bg-blue-600 text-white">
        <a href="home.php" class="font-bold">Ghazala Blog</a>
        <div class="space-x-4">
            <a href="authent.php" class="bg-blue-500 p-2 rounded-full hover:bg-blue-700">so connecter</a>
            <a href="add_post.php" class="bg-blue-500 p-2 rounded-full hover:bg-blue-700">publier</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="p-2 bg-red-500 rounded-full hover:bg-red-700">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>