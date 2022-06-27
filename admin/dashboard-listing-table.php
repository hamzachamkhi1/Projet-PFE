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
    <link rel="shortcut icon" href="images/favicon.ico">
    <script type="text/javascript">
        function delete_id(id) {
            if (confirm('Sure To Remove This Record ?')) {
                window.location.href = 'dashboard-listing-table.php?delete_id=' + id;
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
    $sql = "SELECT * FROM hotel";
    $result = $conn->query($sql);


    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $sql1 = " SELECT id FROM room WHERE id_hotel=$id ";
        $result1 = $conn->query($sql1);
        while ($row = $result1->fetch_assoc()) {
            $id_room = $row['id'];
            mysqli_query($conn, "DELETE FROM images_room WHERE id_room= $id_room ");
        }
        mysqli_query($conn, "DELETE FROM hotel WHERE id=$id");

        mysqli_query($conn, "DELETE FROM images_hotel WHERE id_hotel=$id");
        mysqli_query($conn, "DELETE FROM room WHERE id_hotel=$id");
        mysqli_query($conn, "DELETE FROM periode WHERE id_hotel=$id");
    }
    $limit = 5;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    $result = mysqli_query($conn, "SELECT * FROM hotel ORDER BY id ASC LIMIT $start_from, $limit");

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
                        <div class="dasboard-breadcrumbs breadcrumbs"><a>Accueil</a><a>Tableau de bord</a><span>Liste des hôtels</span></div>
                        <!--dasboard-sidebar-->
                        <?php include('./dasboard-sidebar.php')   ?>
                        <!--dasboard-sidebar end-->
                        <!-- dasboard-menu-->
                        <div class="dasboard-menu">
                            <div class="dasboard-menu-btn color3-bg">Menu du tableau de bord <i class="fal fa-bars"></i></div>
                            <ul class="dasboard-menu-wrap">
                                <li>
                                    <a href="dashboard-listing-table.php" class="user-profile-act"><i class="fa-solid fa-hotel"></i>Liste des hôtels</a>
                                </li>
                                <li><a href="dashboard-add-listing.php"><i class="fa-solid fa-plus"></i> Ajouter un Hôtel </a></li>
                                <li>
                                    <a href="dasboardd-user.php"><i class="fa-solid fa-users"></i> Liste des Utilisateurs</a>
                                </li>
                                <li><a href="reservation.php"><i class="fa-solid fa-receipt"></i>Liste des Réservations</a></li>
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
                                    <h3>Liste des hôtels</h3>
                                </div>
                                <!-- dashboard-list  -->
                                <?php
                                if (isset($result)) {

                                    while ($row = $result->fetch_assoc()) {
                                        $id_ho = $row["id"];
                                        $sql1 = "SELECT *from images_hotel WHERE id_hotel= '$id_ho' limit 1 ";
                                        $result1 = $conn->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {


                                ?>
                                            <div class="dashboard-list">
                                                <div class="dashboard-message">

                                                    <div class="dashboard-listing-table-image">
                                                        <a href="listing-single.php?hotel_id=<?php echo $id_ho; ?>"><img src='<?php echo "uploads/" . $row1["file_name"]; ?>' alt=""></a>
                                                    </div>
                                                    <div class="dashboard-listing-table-text">
                                                        <h4><a href="listing-single.php?hotel_id=<?php echo $id_ho; ?>"><?php echo $row["hoteltname"] ?></a></h4>
                                                        <span class="dashboard-listing-table-address"><i class="fas fa-map-marker"></i><a href="#"><?php echo $row["adresse"] ?></a></span>
                                                        <ul class="dashboard-listing-table-opt  fl-wrap">
                                                            <li><a href="hotelupdate.php?hotel_id=<?php echo $id_ho; ?>">Modifier l'hôtel <i class="fal fa-edit"></i></a></li>
                                                            <li><a href="roomupdate.php?hotel_id=<?php echo $id_ho; ?>">Modifier les chambres <i class="fal fa-edit"></i></a></li>
                                                            <li><a href="periodeupdate.php?hotel_id=<?php echo $id_ho; ?>">Modifier la période<i class="fal fa-edit"></i></a></li>
                                                            <li><a href="javascript:delete_id(<?php echo  $id_ho; ?>)" class="del-btn" style="  margin-top: 10px;">Supprimer l'hôtel<i class="fal fa-trash-alt"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php

                                        } ?>
                                    <?php

                                    } ?>
                                <?php

                                } ?>

                                <!-- dashboard-list end-->
                            </div>
                            <!-- pagination-->
                            <?php

                            $result_db = mysqli_query($conn, "SELECT COUNT(id) FROM hotel");
                            $row_db = mysqli_fetch_row($result_db);
                            $total_records = $row_db[0];
                            $total_pages = ceil($total_records / $limit);
                            $pagLink = $pagLink = "<div class='pagination'>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $pagLink .= "<a class='page-link' href='dashboard-listing-table.php?page=" . $i . "'>" . $i . "</a>";
                            }
                            echo $pagLink . "</div>";
                            ?>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&libraries=places&callback=initAutocomplete"></script>
</body>

</html>