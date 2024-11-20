<?php
include('../connexion.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}
// Get the user ID from the URL
if (isset($_GET['id'])) {
    $user_id = (int) $_GET['id'];
}
// Fetch the user details (optional, but useful for displaying user info)
$sql_user = "SELECT * FROM Users WHERE idU = $user_id";
$user_result = $con->query($sql_user);
$user = $user_result->fetch_assoc();

// Fetch posts of the user
$sql_posts = "SELECT posts.*, users.nom_complet 
              FROM Post posts 
              JOIN Users users ON posts.idU = users.idU 
              WHERE posts.idU = $user_id";
$posts_result = $con->query($sql_posts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>View Posts - <?= htmlspecialchars($user['nom_complet']) ?></title>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Posts of <?= htmlspecialchars($user['nom_complet']) ?></h1>

        <!-- User Posts Table -->
        <div class="max-w-2xl mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">User Posts</h1>

            <?php if ($posts_result->num_rows > 0): ?>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Post Content</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = $posts_result->fetch_assoc()): ?>
                            <tr class="border-t">
                                <td class="py-3 px-6 text-sm text-gray-700"><?= htmlspecialchars($post['contenu']) ?></td>
                                <td class="py-3 px-6 text-sm text-gray-500"><?= htmlspecialchars($post['dateP']) ?></td>
                                <td class="py-3 px-6 text-sm text-indigo-600">
                                    <a href="../fullpost.php?id=<?= $post['idP'] ?>" class="hover:text-indigo-800">Voir Post Complet</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-600">Aucun post de cet utilisateur</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>