<?php
include('connexion.php');
include('navbar.php');
session_start(); 

// if (!isset($_SESSION['user_id'])) {
  //  die('User not logged in'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
   $contenu = $_POST['contenu'];
    $user_id = $_SESSION['user_id'];
    $dateP = date('Y-m-d');

   
    $sql = "INSERT INTO Post (contenu, dateP, idU) VALUES (?, ?, ?)";

 
    if ($stmt = $con->prepare($sql)) {
        
        $stmt->bind_param('ssi', $contenu, $dateP, $user_id); 

       
        if ($stmt->execute()) {
            echo "Post created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

      
        $stmt->close();
    } else {
        echo "Error preparing query: " . $con->error;
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-100">
  <div class="p-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-4">partagez vos pensées</h1>
<form method="POST" class="space-y-4">
     <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        placeholder="titre" 
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200"
                    >
                </div>

              
                <div>
                    <label for="contenu" class="block text-sm font-medium text-gray-700">post...</label>
                    <textarea 
                        name="contenu" 
                        id="contenu" 
                        placeholder="partagez ici..." 
                        required 
                        rows="6" 
                        class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition ease-in-out duration-200"
                    ></textarea>
                </div>

                
                <input type="hidden" name="user_id" value="<?= $user_id ?>">

               
                <div>
                    <button 
                        type="submit" 
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition ease-in-out duration-200"
                    >
                       publier
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

<?php
include('footer.php');
?>