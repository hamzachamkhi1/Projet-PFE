<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Easybook - Hotel Booking Directory Listing Template</title>
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

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        print_r("hhhhhh");
        mysqli_query($conn, "DELETE *FROM users WHERE UserID=$id");
    }
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
                                <li><a href="dasboardd-user.php" class="user-profile-act"> <i class="fa-solid fa-users"></i>Liste des Utilisateurs</a></li>
                                <li><a href="dashboard-review.php"><i class="fa-solid fa-bars"></i>Liste des Réservations </a></li>
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


                                ?>
                                        <div class="dashboard-list">
                                            <div class="dashboard-message">
                                                <a href="javascript:delete_id(<?php echo  $row['UserID']; ?>)" class="del-btn">Delete <i class="fal fa-trash-alt"></i></a>
                                                <div class="dashboard-message-avatar">
                                                    <img src="images/avatar/3.jpg" alt="">
                                                </div>
                                                <div class="dashboard-message-text">

                                                    <h4><?php echo $row["FullName"] ?><span><?php echo $row["Date"] ?></span></h4>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title"> EMail :</span> :
                                                        <span class="booking-text"><a href=#><?php echo $row["EMail"] ?></a></span>
                                                    </div>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title">Username :</span>
                                                        <span class="booking-text"><?php echo $row["Username"] ?></span>
                                                    </div>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title">Phone :</span>
                                                        <span class="booking-text"><?php echo $row["Phone"] ?></span>
                                                    </div>
                                                    <div class="booking-details fl-wrap">
                                                        <span class="booking-title">City :</span>
                                                        <span class="booking-text"><a href="#" target="_top"><?php echo $row["City"] ?></a></span>
                                                    </div>
                                                    <span class="fw-separator"></span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                                <!-- dashboard-list end-->
                            </div>
                            <!-- pagination-->
                            <div class="pagination">
                                <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                                <a href="#" class="current-page">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
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
        <!--map-modal -->
        <div class="map-modal-wrap">
            <div class="map-modal-wrap-overlay"></div>
            <div class="map-modal-item">
                <div class="map-modal-container fl-wrap">
                    <h3>Hotel Title</h3>
                    <div class="map-modal fl-wrap">
                        <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                    </div>
                    <a href="#" class="btn color2-bg">View Details <i class="fas fa-angle-right"></i></a>
                    <div class="map-modal-close"><i class="fas fa-times"></i></div>
                </div>
            </div>
        </div>
        <!--map-modal end -->
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