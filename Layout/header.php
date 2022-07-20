<?php
require_once 'connection.php';
$username1 = $_SESSION['username'];
$sql2 = "SELECT * FROM users WHERE Username = '$username1'";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();
$image = "./admin/uploads/" . $data2['Image'];
print_r($image);
?>
<header class="main-header">
    <!-- header-top-->
    <div class="header-top fl-wrap">
        <div class="container">
            <div class="logo-holder">
                <a href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == "Connected") {
                echo '<form method="POST">'
                    . '<div class="show-reg-form" id="logout"><button type="submit" name="logout"    style="background: #18458b ; color: white"><span>Se déconnecter</span></button></div>'
                    . '</form>';
            } else {
                echo '<div class="show-reg-form modal-open" id="login"><i class="fas fa-sign-in"></i>Sidentifier</div>';
            }
            ?>
            <div class="lang-wrap">
                <div class="show-lang"><img src="images/lan/2.png" alt=""> <span>Fr</span></div>

            </div>
            <div class="currency-wrap">
                <div class="show-currency-tooltip">TND</div>
            </div>
        </div>
    </div>
    <!-- header-top end-->
    <!-- header-inner-->
    <div class="header-inner fl-wrap">
        <div class="container">
            <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == "Connected") {
                echo '<div class="header-user-menu">'
                    . '<div class="header-user-name">'
                    . ' <span><img src="'. $image .'" alt=""></span>' . $_SESSION['username']
                    . '</div>'
                    . '<ul>'
                    . '<li><a href="dashboard-myprofile.php"> Editer le profil</a></li>'
                    . '<li><a href="dashboard-bookings.php"> Réservations </a></li>'
                    . '</ul>'
                    . '</div>';
            } ?>
            <div class="home-btn"><a href="index.php"><i class="fas fa-home"></i></a></div>
            <!-- nav-button-wrap-->
            <div class="nav-button-wrap color-bg">
                <div class="nav-button">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <!-- nav-button-wrap end-->
            <!--  navigation -->
            <div class="nav-holder main-menu">
                <nav>
                    <ul>
                        <li>
                            <a href="index.php" class="act-link">Hotel Tunisie</a>

                        </li>
                        <li>
                            <a href="voyages-organisés.html">Voyages Organisés</a>

                        </li>
                        <li>
                            <a href="vol.html">Vol</a>

                        </li>





                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
</header>