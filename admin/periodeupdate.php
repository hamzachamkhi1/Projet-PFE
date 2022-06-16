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
        function delete_id(id_de) {
            var id = <?php echo $_GET['hotel_id']; ?>;
            if (confirm('Sure To Remove This Periode ?')) {
                window.location.href = 'http://localhost/Projet%20PFE/admin/periodeupdate.php?hotel_id=' + id + '&deleteid=' + id_de;
            }
        }
    </script>


</head>


<body>
    <?php
    $id = $_GET['hotel_id'];
    include '../connection.php';
    if (isset($_GET['deleteid'])) {
        $id_periode = $_GET['deleteid'];
        mysqli_query($conn, "DELETE FROM periode WHERE Periodeid=$id_periode");
    }
    $sql = " SELECT *  FROM periode WHERE id_hotel=$id ";
    $result = $conn->query($sql);
    $rowcount = mysqli_num_rows($result);
    if (isset($_POST["update_periode"])) {
        $id = $_GET['hotel_id'];
        $dateFrom = $_POST["dateFrom"];
        $dateTo = $_POST["dateTo"];
        $Standard = $_POST["Standard"];
        $VueMer = $_POST["Vue_Mer"];
        $vuepiscine = $_POST["vue_piscine"];
        $petit_déjeuner = $_POST["petit_déjeuner"];
        $demipension = $_POST["demi_pension"];
        $pensioncomplète = $_POST["pension_complète"];
        $nbrperiode = $_POST["nbperiode"];
        $id_periode = $_POST["id_periode"];
        if ($nbrperiode > $rowcount) {
            for ($i = 0; $i < $rowcount; $i++) {
                $sql1 = "UPDATE periode SET datefrom='$dateFrom[$i]',dateto='$dateTo[$i]',Standard='$Standard[$i]',Vue_Mer='$VueMer[$i]',vue_piscine='$vuepiscine[$i]',petit_déjeuner='$petit_déjeuner[$i]',demi_pension='$demipension[$i]',pension_complète='$pensioncomplète[$i]' WHERE Periodeid='$id_periode[$i]' limit $rowcount ";
                $conn->query($sql1);
            }
            for ($i = $rowcount; $i < $nbrperiode; $i++) {
                $sql2 = "INSERT INTO `periode`(datefrom,dateto,Standard,Vue_Mer,vue_piscine,petit_déjeuner,demi_pension,pension_complète,id_hotel) VALUES('$dateFrom[$i]','$dateTo[$i]',' $Standard[$i]',' $VueMer[$i]',' $vuepiscine[$i]',' $petit_déjeuner[$i]','$demipension[$i]','$pensioncomplète[$i]','$id')";
                $conn->query($sql2);
            }
        } else {
            for ($i = 0; $i < $rowcount; $i++) {
                $sql3 = "UPDATE periode SET datefrom='$dateFrom[$i]',dateto='$dateTo[$i]',Standard='$Standard[$i]',Vue_Mer='$VueMer[$i]',vue_piscine='$vuepiscine[$i]',petit_déjeuner='$petit_déjeuner[$i]',demi_pension='$demipension[$i]',pension_complète='$pensioncomplète[$i]' WHERE Periodeid='$id_periode[$i]' ";
                $conn->query($sql3);
            }
        }
        header("Location: http://localhost/Projet%20PFE/admin/dashboard-listing-table.php?");
    }
    ?>

    <!-- content-->
    <div class="content">
        <section class="flat-header color-bg adm-header">
            <div class="wave-bg wave-bg2"></div>
            <div class="container">
                <div class="dasboard-wrap fl-wrap">
                    <div class="dasboard-breadcrumbs breadcrumbs"><a href="#">Home</a><a href="#">Dashboard</a><a>Listing</a><span>Edit periode</span></div>
                </div>
        </section>
        <section class="middle-padding">
            <form action="http://localhost/Projet%20PFE/admin/periodeupdate.php?hotel_id=<?php echo $id ?>" method="POST">
                <div class="container">
                    <div class="box-widget-item-header mat-top">
                        <h3>Periode</h3>
                    </div>
                    <!-- profile-edit-container-->
                    <div class="profile-edit-container" id="clones">
                        <div class="custom-form" id="<?php echo $id ?>">
                            <!-- hotel-facts -->
                            <div class="hotel-facts fl-wrap">
                                <?php
                                $index = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $index++;
                                    $periode = "periode";
                                    $id = $periode . $index;


                                ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>DateDepuis :</label>
                                            <input type="date" name="dateFrom[]" placeholder="Enter date" value="<?php echo $row["datefrom"] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label>DateÀ :</label>
                                            <input type="date" name="dateTo[]" placeholder="Enter date" value="<?php echo $row["dateto"] ?>">
                                        </div>

                                        <input type="text" name="Standard[]" placeholder="Standard prix" value="<?php echo $row["Standard"] ?>" />
                                        <input type="text" name="Vue_Mer[]" placeholder="Vue Mer prix" value="<?php echo $row["Vue_Mer"] ?>" />
                                        <input type="text" name="vue_piscine[]" placeholder="vue piscine prix" value="<?php echo $row["vue_piscine"] ?>" />
                                        <input type="text" name="petit_déjeuner[]" placeholder="petit déjeuner prix " value="<?php echo $row["petit_déjeuner"] ?>" />
                                        <input type="text" name="demi_pension[]" placeholder="demi pension prix" value="<?php echo $row["demi_pension"] ?>" />
                                        <input type="text" name="pension_complète[]" placeholder="pension complète prix" value="<?php echo $row["pension_complète"] ?>" />
                                        <input type="hidden" name=id_periode[] value="<?php echo $row['Periodeid']; ?>">
                                        <ul class="dashboard-listing-table-opt  fl-wrap">
                                            <li><a href="javascript:delete_id(<?php echo  $row["Periodeid"]; ?>)" class="del-btn">Delete Periode <i class="fal fa-trash-alt"></i></a></li>
                                        </ul>
                                    </div>
                                <?php
                                } ?>
                            </div>
                            <!-- hotel-facts end -->
                        </div>
                        <div class="custom-form" id="periode" hidden>
                            <!-- hotel-facts -->
                            <div class="hotel-facts fl-wrap">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>DateDepuis :</label>
                                        <input type="date" name="dateFrom[]" placeholder="Enter date" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>DateÀ :</label>
                                        <input type="date" name="dateTo[]" placeholder="Enter date" value="">
                                    </div>

                                    <input type="text" name="Standard[]" placeholder="Standard prix" value="" />
                                    <input type="text" name="Vue_Mer[]" placeholder="Vue Mer prix" value="" />
                                    <input type="text" name="vue_piscine[]" placeholder="vue piscine prix" value="" />
                                    <input type="text" name="petit_déjeuner[]" placeholder="petit déjeuner prix " value="" />
                                    <input type="text" name="demi_pension[]" placeholder="demi pension prix" value="" />
                                    <input type="text" name="pension_complète[]" placeholder="pension complète prix" value="" />
                                </div>

                            </div>
                            <!-- hotel-facts end -->
                        </div>
                    </div>
                    <!-- profile-edit-container end-->
                </div>
                <input type="hidden" name="nbperiode" id="hiddenperiode" value="<?php echo $rowcount  ?>">
                <ul class="dashboard-listing-table-opt  fl-wrap">
                    <li><button class="btn color-bg  float-btn" id="add_periode" type="button">Ajouter Période<i class="fa-solid fa-circle-plus"></i></button> </li>
                    <li> <button class="btn color2-bg float-btn" name="update_periode" type="submit">Mise à jour<i class="fas fa-paper-plane"></i></button></li>
                </ul>
            </form>
        </section>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!--footer end -->

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/plugins.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbVEb8GFpi-a1cw4KqU-eJ3Kg3cTMqJPM"></script>
    <script type="text/javascript" src="../js/map-add.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $input = $('#hiddenperiode');
            var count = <?php echo $rowcount ?>;
            window.periodesnb = count;
            $("#add_periode").click(function() {

                if (count < 4) {
                    window.periodesnb = window.periodesnb + 1;
                    var div = $("#periode").clone().appendTo("#clones");
                    var element = document.getElementById("periode");
                    document.getElementById("periode").hidden = false;
                    element.id = "periode" + window.periodesnb;
                    count++;
                    var newNumber = Number($input.val()) + 1;
                    $input.val(newNumber);
                }

            });

        });
    </script>


</body>