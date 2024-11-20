<?php

session_start();
include('../connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $username = $_POST['username'];
    $password = $_POST['password'];

  
    $query = "SELECT * FROM admins WHERE username = ? AND mdp = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $username, $password);

  
    $stmt->execute();
    $result = $stmt->get_result();

  
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

       
        $_SESSION['admin_id'] = $admin['idA'];

      
        header('Location: dashboard.php');
        exit();  
    } else {
        $error = "mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Admin Login</h1>

        <?php if (isset($error)) { ?>
            <div class="bg-red-500 text-white text-center p-2 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="post" action="" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                <input type="text" name="username" id="username" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none">Login</button>
            </div>
        </form>
    </div>
</body>

</html>