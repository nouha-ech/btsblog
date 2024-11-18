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

<body class="bg-gray-100">


    <div class="flex justify-between p-4 bg-blue-600 text-white">
        <div class="font-bold">Ghazala Blog</div>
        <div class="space-x-4">
            <a href="authent.php" class="bg-blue-500 p-2 rounded-full hover:bg-blue-700">so connecter</a>
            <a href="add_post.php" class="bg-blue-500 p-2 rounded-full hover:bg-blue-700">Publier</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="p-2 bg-red-500 rounded-full hover:bg-red-700">Logout</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/5 h-screen bg-gray-200 p-4">
            <h2 class="text-lg font-bold mb-4">Users</h2>
            <ul class="space-y-2">
                <?php while ($user = $users_result->fetch_assoc()): ?>
                    <li>
                        <a href="user.php?id=<?= $user['idU'] ?>" class="text-blue-500 hover:underline">
                            <?= htmlspecialchars($user['nom_complet']) ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>



        <div class="w-4/5 p-6">
            <h2 class="text-2xl font-bold mb-4">Post recents</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($post = $posts_result->fetch_assoc()): ?>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="font-bold text-xl"><?= htmlspecialchars($post['contenu']) ?></h3>
                        <p class="text-gray-600 mt-2"><?= nl2br(htmlspecialchars(substr($post['contenu'], 0, 150))) ?>...</p>
                        <a href="fullpost.php?id=<?= $post['idP'] ?>" class="text-blue-600 hover:underline mt-4 inline-block">continue Reading</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

</body>

</html>

<?php
include('footer.php');
?>