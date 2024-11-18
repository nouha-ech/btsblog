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

<footer class="bg-gray-100 py-8 mt-12">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-none text-center">
        <p class="text-gray-500 text-sm">
            &copy; 2024 Made by Nouha.
        </p>
        <div class="mt-4 flex justify-center space-x-8">
            <a href="#" class="text-gray-600 hover:text-indigo-600 transition duration-200">Lycée Ghazala</a>
            <a href="https://maps.app.goo.gl/fagQXELT7Wndeeu48" class="text-gray-600 hover:text-indigo-600 transition duration-200">Adresse</a>
            <a href="#" class="text-gray-600 hover:text-indigo-600 transition duration-200">Contact</a>
        </div>
    </div>
</footer>



</html>