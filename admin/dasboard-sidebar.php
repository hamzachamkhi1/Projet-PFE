<?php
require '../connection.php';
$check = $_SESSION['name'];
$query = mysqli_query($conn, "SELECT nom FROM admin WHERE nom='$check' ");
$data = mysqli_fetch_array($query);

$user = $data['nom'];


?>
<div class="dasboard-sidebar">
    <div class="dasboard-sidebar-content fl-wrap">
        <div class="dasboard-avatar">
            <img src="admin.png" alt="">
        </div>
        <div class="dasboard-sidebar-item fl-wrap">
            <h3>
                <span>Bienvenue </span>
                <?php echo $user; ?>
            </h3>
        </div>
        <a href="dashboard-add-listing.php" class="ed-btn">Ajouter un Hôtel</a>
        <a href="adminlogout.php" class="log-out-btn color-bg">Se déconnecter <i class="fas fa-sign-out"></i></a>
    </div>
</div>