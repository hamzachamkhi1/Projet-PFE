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
        function deleteid(id_de) {
            var id = <?php echo $_GET['hotel_id']; ?>;
            if (confirm('Sure To Remove This Image ?')) {
                window.location.href = 'hotelupdate.php?hotel_id=' + id + '&deleteid=' + id_de;
            }
        }
    </script>

</head>

<body>
    <?php
    $id = $_GET['hotel_id'];
    include '../connection.php';
    $sql = "SELECT * FROM `hotel` where id = $id";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $option = $data['hotel_categories'];
    $id_city = $data['id_city'];
    $info = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM cites WHERE id=$id_city"));
    $city_option = $info['Nom'];
    $services = json_decode($data['services'], true);
    if (isset($_GET['deleteid'])) {
    $id_hotelimg = $_GET['deleteid'];
    mysqli_query($conn, "DELETE FROM images_hotel WHERE id=$id_hotelimg");}
    if (isset($_POST['update'])) {
        $Name = $_POST["hotelname"];
        $category = $_POST["category"];
        $address = $_POST["address"];
        $Longitude = $_POST["Longitude"];
        $Latitude = $_POST["Latitude"];
        $ville = $_POST["ville"];
        $star = $_POST["stars"];
        $facebook = $_POST["facebook"];
        $twitter = $_POST["twitter"];
        $instagram = $_POST["instagram"];
        $sql = "SELECT id FROM cites WHERE Nom='$ville'";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {

            $val = $row["id"];;
        }
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $website = $_POST["website"];
        $fax = $_POST["Fax"];
        $descr = $_POST["desc"];
        $service = $_POST["hotelfacility"];
        $exampleEncoded = json_encode($service);
        $update = "UPDATE hotel SET hoteltname='$Name',hotel_categories='$category',adresse='$address',longitude='$Longitude',latitude='$Latitude',id_city='$val',Email_adresse='$email',phone='$phone',website= '$website',description= '$descr',services='$exampleEncoded',fax= '$fax',star='$star',facebook='$facebook',twitter='$twitter',instagram='$instagram' WHERE id=$id ";
        if (mysqli_query($conn, $update)) {
            echo "Record was updated successfully.";
        } else {
            echo "ERROR: Could not able to execute $update. "
                . mysqli_error($conn);
        }
        $uploadsDir = "uploads/";
        $allowedFileType = array('jpg', 'png', 'jpeg');
        if (!empty(array_filter($_FILES['fileUpload']['name']))) {

            // Loop through file items
            foreach ($_FILES['fileUpload']['name'] as $id => $val) {
                // Get files upload path
                $fileName        = $_FILES['fileUpload']['name'][$id];
                $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));


                if (in_array($fileType, $allowedFileType)) {
                    if (move_uploaded_file($tempLocation, $targetFilePath)) {
                        $sqlVal = "('" . $fileName . "', '" . $_GET['hotel_id'] . "')";
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "File coud not be uploaded."
                        );
                    }
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Only .jpg, .jpeg and .png file formats allowed."
                    );
                }
                // Add into MySQL database
                if (!empty($sqlVal)) {
                    $insert = $conn->query("INSERT INTO images_hotel (file_name, id_hotel) VALUES $sqlVal");
                    if ($insert) {
                        $response = array(
                            "status" => "alert-success",
                            "message" => "Files successfully uploaded."
                        );
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "Files coudn't be uploaded due to database error."
                        );
                    }
                }
            }
        } else {
            // Error
            $response = array(
                "status" => "alert-danger",
                "message" => "Please select a file to upload."
            );
        }
        header("Location: http://localhost/Projet%20PFE/admin/dashboard-listing-table.php?");
    }
    $sql1 = "SELECT * FROM images_hotel WHERE id_hotel = $id";
    $result1 = $conn->query($sql1);



    ?>
        <!-- content-->
        <div class="content">
        <section class="flat-header color-bg adm-header">
                <div class="wave-bg wave-bg2"></div>
                <div class="container">
                    <div class="dasboard-wrap fl-wrap">
                        <div class="dasboard-breadcrumbs breadcrumbs"><a href="#">Home</a><a href="#">Dashboard</a><a>Listing</a><span>Edit hotel</span></div>
                    </div>
        </section>
            <section class="middle-padding">
                <div class="container">
                    <form action="http://localhost/Projet%20PFE/admin/hotelupdate.php?hotel_id=<?php echo $id ?>" enctype="multipart/form-data" method="POST">
                        <div class="box-widget-item-header">
                            <h3>Informations de base</h3>
                        </div>
                        <div class="profile-edit-container">
                            <div class="custom-form">
                                <label>Titre de l’hôtel  <i class="fas fa-briefcase"></i></label>
                                <input type="text" name="hotelname" placeholder="" value="<?= $data['hoteltname'] ?>" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Type / Catégorie</label>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="" class="chosen-select no-search-select" name="category">
                                                <option>Toutes les catégories</option>
                                                <option value="Appartements" <?php if ($option == "Appartements") echo 'selected="selected"'; ?>>Apartments</option>
                                                <option value="Hôtel" <?php if ($option == "Hôtel") echo 'selected="selected"'; ?>>Hotel</option>
                                                <option value="Auberge" <?php if ($option == "Auberge") echo 'selected="selected"'; ?>>Hostel</option>
                                                <option value="Maison d'hôtes" <?php if ($option == "Maison d'hôtes") echo 'selected="selected"'; ?>>Guest House</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ville/Emplacement</label>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="City" class="chosen-select no-search-select" name="ville">
                                                <option>Toutes les villes</option>
                                                <?php
                                                include '../connection.php';
                                                $records = mysqli_query($conn, "select id,Nom from cites");
                                                while ($row = mysqli_fetch_array($records)) {
                                                    echo '<option value="' . $row['Nom'] . '" ' . (($city_option == $row['Nom']) ? 'selected="selected"' : "") . '>' . $row['Nom'] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nombre d'étoiles<i class="fas fa-long-arrow-alt-right"></i> </label>
                                        <input type="text" name="stars" placeholder="" value="<?= $data['star'] ?>" />
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="box-widget-item-header">
                            <h3> Localisation / Coordonnées</h3>
                        </div>
                        <div class="profile-edit-container">
                            <div class="custom-form">
                                <label>Adresse<i class="fas fa-map-marker"></i></label>
                                <input type="text" name="address" placeholder="" value="<?= $data['adresse'] ?>" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Longitude (Faites glisser le marqueur sur la carte)<i class="fas fa-long-arrow-alt-right"></i> </label>
                                        <input type="text" name="Longitude" placeholder="" id="long" value="<?= $data['longitude'] ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Latitude (Faites glisser le marqueur sur la carte)<i class="fas fa-long-arrow-alt-down"></i> </label>
                                        <input type="text" name="Latitude" placeholder="" id="lat" value="<?= $data['latitude'] ?>" />
                                    </div>
                                </div>
                                <div class="map-container">
                                    <div id="singleMap" class="vis-map" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
                                </div>
                                <div class="col-md-6">
                                    <label>Adresse e-mail<i class="fas fa-envelope"></i> </label>
                                    <input type="text" name="email" placeholder="" value="<?= $data['Email_adresse'] ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label>Téléphone<i class="fas fa-phone"></i> </label>
                                    <input type="text" name="phone" placeholder="" value="<?= $data['phone'] ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label> Site Internet <i class="fas fa-globe"></i> </label>
                                    <input type="text" name="website" placeholder="" value="<?= $data['website'] ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label> Fax <i class="fas fa-globe"></i> </label>
                                    <input type="text" name="Fax" placeholder="" value="<?= $data['fax'] ?>" />
                                </div>
                            </div>
                            <!-- profile-edit-container-->
                            <div class="profile-edit-container">
                                <div class="custom-form">
                                    <div class="row">
                                        <!--col -->
                                        <div class="col-md-6">
                                            <div class="add-list-media-header" style="margin-bottom:20px">
                                                <label>Galerie</label>
                                            </div>
                                            <div class="add-list-media-wrap">

                                                <div class="fuzone">
                                                    <div class="fu-text">
                                                        <span><i class="fas fa-cloud-upload-alt"></i>Cliquez ici ou déposez les fichiers à télécharger</span>
                                                        <div class="photoUpload-files fl-wrap"></div>
                                                    </div>
                                                    <input type="file" name='fileUpload[]' class="upload" multiple>
                                            </div>


                                            </div>
                                        </div>
                                        <!--col end-->
                                        <div class="col-md-6">
                                            <div class="add-list-media-header" style="margin-bottom:20px">
                                                <label>Images</label>
                                            </div>
                                            <div class="add-list-media-wrap">
                                                <div class="fuzoneimg">
                                                    <?php
                                                    if (isset($result1)) {

                                                        while ($row = $result1->fetch_assoc()) {

                                                    ?>
                                                            <div class=" box">

                                                                <img src='<?php echo "uploads/" . $row["file_name"]; ?>' alt="">
                                                                <a href="javascript:deleteid(<?php echo $row['id']; ?>)"><i class="fas fa-window-close"></i></a>

                                                            </div>
                                                        <?php

                                                        } ?>
                                                    <?php

                                                    } ?>

                                                </div>



                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- profile-edit-container end-->
                            <div class="box-widget-item-header mat-top">
                                <h3>Détails</h3>
                            </div>
                            <!-- profile-edit-container-->
                            <div class="profile-edit-container">
                                <div class="custom-form">
                                    <label>Texte</label>
                                    <textarea cols="40" rows="3" placeholder="Détails" name="desc"> <?= $data['description'] ?></textarea>
                                </div>
                            </div>
                            <!-- profile-edit-container end-->
                            <!-- profile-edit-container end-->
                            <div class="box-widget-item-header mat-top">
                                <h3>Services</h3>
                            </div>
                            <!-- profile-edit-container-->
                            <div class="profile-edit-container">
                                <div class="custom-form">
                                    <!-- Checkboxes -->
                                    <ul class="fl-wrap filter-tags">

                                        <li>
                                            <input id="check-aaa5" type="checkbox" name="hotelfacility[1]" value="Wifi gratuit" <?php if (array_key_exists(1, $services) && $services[1] == "Free_WiFi") echo 'checked'; ?>>
                                            <label for="check-aaa5">Wifi gratuit</label>
                                        </li>
                                        <li>
                                            <input id="check-bb5" type="checkbox" name="hotelfacility[2]" value="Parking" <?php if (array_key_exists(2, $services) && $services[2] == "Parking") echo 'checked'; ?>>
                                            <label for="check-bb5">Parking</label>
                                        </li>
                                        <li>
                                            <input id="check-dd5" type="checkbox" name="hotelfacility[3]" value="Centre Fitness" <?php if (array_key_exists(3, $services) && $services[3] == "Fitness Center") echo 'checked'; ?>>
                                            <label for="check-dd5">Centre Fitness</label>
                                        </li>
                                        <li>
                                            <input id="check-cc5" type="checkbox" name="hotelfacility[4]" value="Chambres non-fumeurs" <?php if (array_key_exists(4, $services) && $services[4] == "on-smoking Rooms") echo 'checked'; ?>>
                                            <label for="check-cc5">Chambres non-fumeurs</label>
                                        </li>
                                        <li>
                                            <input id="check-ff5" type="checkbox" name="hotelfacility[5]" value="Navette aéroport" <?php if (array_key_exists(5, $services) && $services[5] == "Airport Shuttle") echo 'checked'; ?>>
                                            <label for="check-ff5">Navette aéroport</label>
                                        </li>
                                        <li>
                                            <input id="check-c4" type="checkbox" name="hotelfacility[6]" value="Climatisation" <?php if (array_key_exists(6, $services) && $services[5] == "Airport Shuttle") echo 'checked'; ?>>
                                            <label for="check-c4">Climatisation</label>
                                        </li>
                                    </ul>
                                    <!-- Checkboxes end -->
                                </div>
                            </div>
                            <div class="box-widget-item-header mat-top">
                                <h3>Sociaux</h3>
                            </div>
                            <!-- profile-edit-container-->
                            <div class="profile-edit-container">
                                <div class="custom-form">
                                    <label>Facebook <i class="fab fa-facebook"></i></label>
                                    <input type="text" name="facebook" placeholder="https://www.facebook.com/" value="<?= $data['facebook'] ?>" />
                                    <label>Twitter<i class="fab fa-twitter"></i> </label>
                                    <input type="text" name="twitter" placeholder="https://twitter.com/" value="<?= $data['twitter'] ?>" />
                                    <label> Instagram <i class="fab fa-instagram"></i> </label>
                                    <input type="text" name="instagram" placeholder="https://www.instagram.com/" value="<?= $data['instagram'] ?>" />
                                </div>
                            </div>
                            <button class="btn    color2-bg  float-btn" name="update" type="submit">Mise à jour<i class="fas fa-paper-plane"></i></button>
                            <!-- profile-edit-container end-->
                        </div>
                    </form>
                </div>


            </section>
            <div class="limit-box fl-wrap"></div>
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



</body>

</html>