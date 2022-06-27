<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>ChamkhiBooking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="../css/reset.css">
    <link type="text/css" rel="stylesheet" href="../css/plugins.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="./images/favicon.ico">
    <script type="text/javascript">
        function delete_id(id) {
            if (confirm('Sure To Remove This Record ?')) {
                window.location.href = 'dashboard-user.php?delete_id=' + id;
            }
        }
    </script>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: adminlogin.php');
    }
    include '../connection.php';

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        mysqli_query($conn, "DELETE FROM users WHERE UserID=$id");
    }
    $limit = 5;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY UserID ASC LIMIT $start_from, $limit");
    ?>
    <!--loader-->
    <div class="loader-wrap">
        <div class="pin">
            <div class="pulse"></div>
        </div>
    </div>
    <!--loader end-->
    <!-- Main  -->
    <div id="main">
        <!-- content-->
        <div class="content">
            <!-- section-->
            <section class="flat-header color-bg adm-header">
                <div class="wave-bg wave-bg2"></div>
                <div class="container">
                    <div class="dasboard-wrap fl-wrap">
                        <div class="dasboard-breadcrumbs breadcrumbs"><a>Accueil</a><a>Tableau de bord</a><span>Liste des Utilisateurs</span></div>
                        <!--dasboard-sidebar-->
                        <?php include('./dasboard-sidebar.php')   ?>
                        <!--dasboard-sidebar end-->
                        <!-- dasboard-menu-->
                        <div class="dasboard-menu">
                            <div class="dasboard-menu-btn color3-bg">Menu du tableau de bord <i class="fas fa-bars"></i></div>
                            <ul class="dasboard-menu-wrap">
                                <li>
                                    <a href="dashboard-listing-table.php"><i class="fa-solid fa-hotel"></i>Liste des hôtels</a>
                                </li>
                                <li><a href="dashboard-add-listing.php"><i class="fa-solid fa-plus"></i>Ajouter un Hôtel</a></li>
                                <li><a href="dashboard-user.php" class="user-profile-act"> <i class="fa-solid fa-users"></i>Liste des Utilisateurs</a></li>
                                <li><a href="reservation.php"><i class="fa-solid fa-receipt"></i>Liste des Réservations </a></li>
                            </ul>
                        </div>
                        <!--dasboard-menu end-->
                    </div>
                </div>
            </section>
            <!-- section end-->
            <!-- section-->
            <section class="middle-padding">
                <div class="container">
                    <!--dasboard-wrap-->
                    <div class="dasboard-wrap fl-wrap">
                        <!-- dashboard-content-->
                        <div class="dashboard-content fl-wrap">
                            <div class="dashboard-list-box fl-wrap">
                                <div class="dashboard-header fl-wrap">
                                    <h3>Liste des Utilisateurs</h3>
                                </div>
                                <!-- dashboard-list end-->
                                <?php
                                if (isset($result)) {

                                    while ($row = $result->fetch_assoc()) {
                                        $image = "./uploads/" . $row['Image'];



                                ?>
                                        <div class="dashboard-list">
                                            <div class="dashboard-message">
                                                <a href="javascript:delete_id(<?php echo  $row['UserID']; ?>)" class="del-btn new-dashboard-item">Delete <i class="fal fa-trash-alt"></i></a>
                                                <div class="dashboard-message-avatar">
                                                    <img src="<?php echo $image; ?>" alt="">
                                                </div>
                                                <div class="dashboard-message-text">

                                                    <h4> <?php echo $row['name'] ?> <?php echo $row['firstname'] ?></span></h4>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title"> Adresse e-mail</span> :
                                                        <span class="booking-text"><a href=#><?php echo $row["EMail"] ?></a></span>
                                                    </div>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title">Nom d'utilisateur :</span>
                                                        <span class="booking-text"><?php echo $row["Username"] ?></span>
                                                    </div>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title">Numéro de téléphone :</span>
                                                        <span class="booking-text"><?php echo $row["Phone"] ?></span>
                                                    </div>
                                                    <span class="fw-separator"></span>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                                <!-- dashboard-list end-->
                            </div>
                            <!-- pagination-->
                            <?php

                            $result_db = mysqli_query($conn, "SELECT COUNT(UserID) FROM users");
                            $row_db = mysqli_fetch_row($result_db);
                            $total_records = $row_db[0];
                            $total_pages = ceil($total_records / $limit);
                            $pagLink = $pagLink = "<div class='pagination'>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $pagLink .= "<a class='page-link' href='dashboard-user.php?page=" . $i . "'>" . $i . "</a>";
                            }
                            echo $pagLink . "</div>";
                            ?>
                        </div>
                    </div>
                    <!-- dashboard-list-box end-->
                </div>
                <!-- dasboard-wrap end-->
        </div>
        </section>
        <div class="limit-box fl-wrap"></div>
    </div>
    <!-- content end-->
    <a class="to-top"><i class="fas fa-caret-up"></i></a>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/plugins.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA844tkNbu9Gk651PRbkdn0AwxAPUXp8wI&libraries=places&callback=initAutocomplete"></script>
</body>

</html>