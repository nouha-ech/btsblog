<?php
include ('connexion.php');

if (isset($_GET['email'], $_GET['mpd'])) {
    $email = $_GET['email'];
    $mpd = $_GET['mpd'];

    $stmt = $con->prepare("SELECT * FROM Users WHERE email = ? AND mpd = ?");
    $stmt->bind_param("ss", $email, $mpd);
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
}
echo "Bonjour  <br>";
echo "voir publication   <input type='submit' value='afficher les postes'>  "
?>