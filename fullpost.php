<?php
// use fullpost.php?id=1

include('connexion.php');
include('navbar.php');

if (isset($_GET['id'])) {
    $post_id = (int) $_GET['id'];

   
    $sql = "SELECT posts.*, users.nom_complet FROM Post posts 
            JOIN Users users ON posts.idU = users.idU 
            WHERE posts.idP = $post_id";

    $result = $con->query($sql);

    
    if ($result->num_rows > 0) {
     
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['contenu']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex-col min-h-screen bg-gray-100">

    <div class="flex-1 p-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold"><?= htmlspecialchars($post['contenu']) ?></h1>
            <p class="text-gray-500 text-sm mt-2">By <?= htmlspecialchars($post['nom_complet']) ?> on <?= $post['dateP'] ?></p>
            <div class="mt-4">
                <p class="text-lg"><?= nl2br(htmlspecialchars($post['contenu'])) ?></p>
            </div>
        </div>
    </div>

</body>

</html>

<?php
include('footer.php');
?>