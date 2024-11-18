<?php
include('connexion.php');
include('navbar.php');
if (isset($_GET['id'])) {
    $user_id = (int) $_GET['id'];
}

$sql_user = "SELECT * FROM Users WHERE idU = $user_id";
$user_result = $con->query($sql_user);
$user = $user_result->fetch_assoc();


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
    <title>Profile</title>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6 text-center"> Profile</h1>

       
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($user['nom_complet']) ?></h2>
            <p class="text-gray-700 mb-4">Email: <?= htmlspecialchars($user['email']) ?></p>
        </div>

      
        <div class="max-w-2xl mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4"> Posts</h1>

            <?php if ($posts_result->num_rows > 0): ?>
                <ul class="space-y-4">
                    <?php while ($post = $posts_result->fetch_assoc()): ?>
                        <li class="bg-white p-4 rounded shadow">
                            <h3 class="text-lg font-semibold"><?= htmlspecialchars($post['contenu']) ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($post['contenu']) ?></p>
                            <span class="text-sm text-gray-400">Posted on: <?= htmlspecialchars($post['dateP']) ?></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-600">aucun post de cet utilisateur</p>
            <?php endif; ?>
        </div>
    </div>


</body>

</html>



<?php
include('footer.php');
?>