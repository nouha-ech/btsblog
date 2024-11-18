<?php
include('connexion.php');
include ('navbar.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mpd = $_POST['mpd'];

    $sql = "SELECT idU, nom_complet, mpd FROM Users WHERE email = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($idU, $nom_complet, $mpd);
            $stmt->fetch();

            if (password_verify($mpd, $mpd)) {
                $_SESSION['user_id'] = $idU;
                $_SESSION['nom_complet'] = $nom_complet;

                echo "Welcome, " . htmlspecialchars($nom_complet);
                header("Location: home.php");
            } else {
                echo "password incorrect";
            }
        } else {
            echo "no account with this email.";
        }
        $stmt->close();
    } else {
        echo "Error query: " . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-100 min-h-screen">
    <div class="p-6 max-w-md mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-4">Connexion</h1>
            <form method="POST" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Votre email"
                        required
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200">
                </div>

                <div>
                    <label for="mpd" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input
                        type="password"
                        name="mpd"
                        id="mpd"
                        placeholder="Votre mot de passe"
                        required
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200">
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition ease-in-out duration-200">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include('footer.php');
?>