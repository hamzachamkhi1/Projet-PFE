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

</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: adminlogin.php');
    }
    include '../connection.php';
    if (isset($_POST['submit'])) {
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
        $nbrooms = $_POST["nbrooms"];
        $nbrperiode = $_POST["nbperiode"];
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
        $room_name = $_POST["room_name"];
        $max_adult = $_POST["max_adulte"];
        $min_adult = $_POST["min_adulte"];
        $max_enf = $_POST["max_enf"];
        $min_enf = $_POST["min_enf"];
        $dateFrom = $_POST["dateFrom"];
        $dateTo = $_POST["dateTo"];
        $Standard = $_POST["Standard"];
        $VueMer = $_POST["Vue_Mer"];
        $vuepiscine = $_POST["vue_piscine"];
        $petit_d??jeuner = $_POST["petit_d??jeuner"];
        $demipension = $_POST["demi_pension"];
        $pensioncompl??te = $_POST["pension_compl??te"];
        $room_descri = $_POST["room_de"];
        $roomfacility = $_POST['service'];
        $checkUserExistSQL = "SELECT * FROM `hotel` WHERE hoteltname='$Name'";
        $checkUserExistQuery = $conn->query($checkUserExistSQL);
        $getResult = $checkUserExistQuery->fetch_assoc();
        if ($getResult == NULL) {
            $insertDataSQL = "INSERT INTO `hotel`(hoteltname,hotel_categories,adresse,longitude,latitude,id_city,Email_adresse,phone,website,description,services,fax,star,facebook,twitter,instagram) VALUES('$Name','$category','$address','$Longitude','$Latitude','$val','$email','$phone','$website','$descr','$exampleEncoded','$fax' ,'$star','$facebook',' $twitter' ,'$instagram')";

            if ($conn->query($insertDataSQL) === TRUE) {
                $last_id = $conn->insert_id;
                if (isset($_POST['submit'])) {

                    $uploadsDir = "uploads/";
                    $allowedFileType = array('jpg', 'png', 'jpeg');

                    // Velidate if files exist
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
                                    $sqlVal = "('" . $fileName . "', '" . $last_id . "')";
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
                }
                for ($i = 0; $i < $nbrperiode; $i++) {
                    $sql = "INSERT INTO `periode`(datefrom,dateto,Standard,Vue_Mer,vue_piscine,petit_d??jeuner,demi_pension,pension_compl??te,id_hotel) VALUES('$dateFrom[$i]','$dateTo[$i]',' $Standard[$i]',' $VueMer[$i]',' $vuepiscine[$i]',' $petit_d??jeuner[$i]','$demipension[$i]','$pensioncompl??te[$i]','$last_id ')";
                    $conn->query($sql);
                }
                for ($i = 0; $i < $nbrooms; $i++) {
                    $facilityindex = $i + 1;
                    $imagesindex = $i + 1;
                    $rf = json_encode($roomfacility[$facilityindex]);
                    $sql = "INSERT INTO `room`(roomname,max_adulte,min_adulte,max_enfant,min_enfant,room_description,services,id_hotel	) VALUES('$room_name[$i]','$max_adult[$i]',' $min_adult[$i]',' $max_enf[$i]',' $min_enf[$i]',' $room_descri[$i]','$rf','$last_id ')";
                    $conn->query($sql);
                    $id_room = $conn->insert_id;
                    $uploadsDir = "uploads/";
                    $allowedFileType = array('jpg', 'png', 'jpeg');
                    // Velidate if files exist
                    if (!empty(array_filter($_FILES['fileUploads']['name'][$imagesindex]))) {

                        // Loop through file items
                        foreach ($_FILES['fileUploads']['name'][$imagesindex] as $id => $val) {
                            // Get files upload path
                            $fileName        = $_FILES['fileUploads']['name'][$imagesindex][$id];
                            $tempLocation    = $_FILES['fileUploads']['tmp_name'][$imagesindex][$id];
                            $targetFilePath  = $uploadsDir . $fileName;
                            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));


                            if (in_array($fileType, $allowedFileType)) {
                                if (move_uploaded_file($tempLocation, $targetFilePath)) {
                                    $sqlVal = "('" . $fileName . "', '" .  $id_room . "')";
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
                                $insert = $conn->query("INSERT INTO images_room (file_name, id_room	) VALUES $sqlVal");
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
                }
            }
        } else {
            echo "hotel exist";
        }

        header("Location: dashboard-listing-table.php?");
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
                    <div class="dasboard-breadcrumbs breadcrumbs"><a>Accueil</a><a>Tableau de bord</a><span>Ajouter un H??tel</span></div>
                        <!--dasboard-sidebar-->
                        <?php include('./dasboard-sidebar.php')   ?>
                        <!--dasboard-sidebar end-->
                        <!-- dasboard-menu-->
                        <div class="dasboard-menu">
                                    <div class="dasboard-menu-btn color3-bg">Menu du tableau de bord<i class="fal fa-bars"></i></div>
                                    <ul class="dasboard-menu-wrap">
                                        <li>
                                            <a href="dashboard-listing-table.php"><i class="fa-solid fa-hotel"></i>Liste des h??tels</a>
                                        </li>
                                        <li><a href="dashboard-add-listing.php" class="user-profile-act"><i class="fa-solid fa-plus"></i> Ajouter un H??tel</a></li>
                                        <li>
                                            <a href="dashboard-user.php"><i class="fa-solid fa-users"></i>  Liste des Utilisateurs  </a>
                                            
                                        </li>
                                        <li><a href="reservation.php"><i class="fa-solid fa-receipt"></i>Liste des R??servations</a></li>
                                    </ul>
                                </div>
                        <!--dasboard-menu end-->

                    </div>
            </section>
            <!-- section end-->
            <!-- section  -->
            <section class="middle-padding">
                <div class="container">
                    <!--dasboard-wrap-->
                    <div class="dasboard-wrap fl-wrap">
                        <!-- dashboard-content-->
                        <form action="dashboard-add-listing.php" enctype="multipart/form-data" method="POST">
                            <div class="dashboard-content fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3> Informations de base</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container">
                                    <div class="custom-form">
                                        <label>Titre de l???h??tel <i class="fas fa-briefcase"></i></label>
                                        <input type="text" name="hotelname" placeholder="Nom de votre h??tel" value="" />
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label>Type / Cat??gorie</label>
                                                <div class="listsearch-input-item">
                                                    <select data-placeholder="Appartements" class="chosen-select no-search-select" name="category">
                                                        <option>Toutes les cat??gories</option>
                                                        <option>Appartements</option>
                                                        <option>H??tel</option>
                                                        <option>Auberge</option>
                                                        <option>Maison d'h??tes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Ville/Emplacement</label>
                                                <div class="listsearch-input-item">
                                                    <select data-placeholder="Ville" class="chosen-select no-search-select" name="ville">
                                                        <option>Toutes les villes</option>
                                                        <?php
                                                        include 'connection.php';
                                                        $records = mysqli_query($conn, "select id,Nom from cites");
                                                        while ($row = mysqli_fetch_array($records)) {
                                                            echo "<option value= " . $row['Nom'], ">" . $row['Nom'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nombre d'??toiles<i class="fas fa-long-arrow-alt-right"></i> </label>
                                                <input type="text" name="stars" placeholder="Nombre d'??toiles" value="" />
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- profile-edit-container end-->
                                <div class="box-widget-item-header">
                                    <h3> Localisation / Coordonn??es</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container">
                                    <div class="custom-form">
                                        <label>Adresse<i class="fas fa-map-marker"></i></label>
                                        <input type="text" name="address" placeholder="Adresse de votre h??tel" value="" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Longitude (Faites glisser le marqueur sur la carte)<i class="fas fa-long-arrow-alt-right"></i> </label>
                                                <input type="text" name="Longitude" placeholder="Longitude de la carte" id="long" value="" />
                                            </div>
                                            <div class="col-md-6">
                                                <label>Latitude (Faites glisser le marqueur sur la carte) <i class="fas fa-long-arrow-alt-down"></i> </label>
                                                <input type="text" name="Latitude" placeholder="Latitude de la carte" id="lat" value="" />
                                            </div>
                                        </div>
                                        <div class="map-container">
                                            <div id="singleMap" class="vis-map" data-latitude="36.4073" data-longitude="10.6225"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Adresse e-mail<i class="fas fa-envelope"></i> </label>
                                            <input type="text" name="email" placeholder="Ajouter l'adresse email de l'h??tel" value="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>T??l??phone<i class="fas fa-phone"></i> </label>
                                            <input type="text" name="T??l??phone" placeholder="Ajouter le num??ro de t??l??phone de l'h??tel" value="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label> Site Internet <i class="fas fa-globe"></i> </label>
                                            <input type="text" name="website" placeholder="Ajouter le site Web de l'h??tel" value="" />
                                        </div>
                                        <div class="col-md-6">
                                            <label> Fax <i class="fas fa-globe"></i> </label>
                                            <input type="text" name="Fax" placeholder="Ajouter le fax de l'h??tel" value="" />
                                        </div>
                                    </div>
                                </div>
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
                                                            <span><i class="fas fa-cloud-upload-alt"></i> Cliquez ici ou d??posez les fichiers ?? t??l??charger</span>
                                                            <div class="photoUpload-files fl-wrap"></div>
                                                        </div>
                                                        <input type="file" name='fileUpload[]' class="upload" multiple>
                                                    </div>


                                                </div>
                                            </div>
                                            <!--col end-->


                                        </div>
                                    </div>
                                </div>
                                <!-- profile-edit-container end-->
                                <div class="box-widget-item-header mat-top">
                                    <h3>D??tails</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container">
                                    <div class="custom-form">
                                        <label>Texte</label>
                                        <textarea cols="40" rows="3" placeholder="D??tails" name="desc"></textarea>
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
                                                <input id="check-aaa5" type="checkbox" name="hotelfacility[1]" value="Wifi gratuit" checked>
                                                <label for="check-aaa5">Wifi gratuit</label>
                                            </li>
                                            <li>
                                                <input id="check-bb5" type="checkbox" name="hotelfacility[2]" value="Parking" checked>
                                                <label for="check-bb5">Parking</label>
                                            </li>
                                            <li>
                                                <input id="check-dd5" type="checkbox" name="hotelfacility[3]" value="Centre Fitness">
                                                <label for="check-dd5">Centre Fitness</label>
                                            </li>
                                            <li>
                                                <input id="check-cc5" type="checkbox" name="hotelfacility[4]" value="Chambres non-fumeurs">
                                                <label for="check-cc5">Chambres non-fumeurs</label>
                                            </li>
                                            <li>
                                                <input id="check-ff5" type="checkbox" name="hotelfacility[5]" value="Navette a??roport" checked>
                                                <label for="check-ff5">Navette a??roport</label>
                                            </li>
                                            <li>
                                                <input id="check-c4" type="checkbox" name="hotelfacility[6]" value="Climatisation">
                                                <label for="check-c4">Climatisation</label>
                                            </li>
                                        </ul>
                                        <!-- Checkboxes end -->
                                    </div>
                                </div>
                                <!-- profile-edit-container end-->
                                <div class="box-widget-item-header mat-top">
                                    <h3>Periode</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container"  id="clones">
                                    <div class="custom-form" id="periode1">
                                        <!-- hotel-facts -->
                                        <div class="hotel-facts fl-wrap">
                                            <div class="row" >
                                                <div class="col-md-6">
                                                    <label>DateDepuis :</label>
                                                    <input type="date" name="dateFrom[]" placeholder="Enter date" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Date?? :</label>
                                                    <input type="date" name="dateTo[]" placeholder="Enter date" value="">
                                                </div>

                                                <input type="text" name="Standard[]" placeholder="Standard prix" value="" />
                                                <input type="text" name="Vue_Mer[]" placeholder="Vue Mer prix" value="" />
                                                <input type="text" name="vue_piscine[]" placeholder="vue piscine prix" value="" />
                                                <input type="text" name="petit_d??jeuner[]" placeholder="petit d??jeuner prix " value="" />
                                                <input type="text" name="demi_pension[]" placeholder="demi pension prix" value="" />
                                                <input type="text" name="pension_compl??te[]" placeholder="pension compl??te prix" value="" />
                                            </div>

                                        </div>
                                       <!-- hotel-facts end -->
                                    </div>
                                    <div class="custom-form" id="periode" hidden>
                                        <!-- hotel-facts -->
                                        <div class="hotel-facts fl-wrap">
                                            <div class="row" >
                                                <div class="col-md-6">
                                                    <label>DateDepuis :</label>
                                                    <input type="date" name="dateFrom[]" placeholder="Enter date" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Date?? :</label>
                                                    <input type="date" name="dateTo[]" placeholder="Enter date" value="">
                                                </div>

                                                <input type="text" name="Standard[]" placeholder="Standard prix" value="" />
                                                <input type="text" name="Vue_Mer[]" placeholder="Vue Mer prix" value="" />
                                                <input type="text" name="vue_piscine[]" placeholder="vue piscine prix" value="" />
                                                <input type="text" name="petit_d??jeuner[]" placeholder="petit d??jeuner prix " value="" />
                                                <input type="text" name="demi_pension[]" placeholder="demi pension prix" value="" />
                                                <input type="text" name="pension_compl??te[]" placeholder="pension compl??te prix" value="" />
                                            </div>

                                        </div>
                                        <!-- hotel-facts end -->
                                    </div>       
                                </div>
                                <span class="add-button color-bg" id="add_periode">Ajouter P??riode </span>
                                 <input type="hidden" name="nbperiode" id="hiddenperiode" value="1">
                                <!-- profile-edit-container end-->
                                <div class="box-widget-item-header mat-top"></div>

                                <!-- profile-edit-container end-->
                                <div class="box-widget-item-header mat-top">
                                    <h3>Chambres</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container" id="clone">
                                    <div class="custom-form " id="duplicater1">
                                        <div class="room-add-item">
                                            <label><i class="fa-solid fa-warehouse"></i>Titre de la chambre </label>
                                            <input type="text" name="room_name[]" placeholder="Num??ro standard" value="" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nombre maximum d'adultes <i class="fas fa-male"></i></i></label>
                                                    <input type="text" name="max_adulte[]" placeholder="nombre d'adultes" value="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre minimum d'adultes <i class="fas fa-male"></i></i></label>
                                                    <input type="text" name="min_adulte[]" placeholder=" nombre d'adultes" value="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre maximum d'enfants <i class="fa-solid fa-child"></i></i></label>
                                                    <input type="text" name="max_enf[]" placeholder="nombre d'enfants" value="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre minimum d'enfants <i class="fa-solid fa-child"></i></i></label>
                                                    <input type="text" name="min_enf[]" placeholder="nombre d'enfants" value="" />
                                                </div>
                                            </div>
                                            <label>D??tails de la chambre</label>
                                            <textarea cols="40" rows="3" name="room_de[]" placeholder="D??tails "></textarea>
                                            <div class="profile-edit-container" style="margin-top:30px">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Galerie</label>
                                                        <div class="add-list-media-wrap">
                                                            <div class="fuzone">
                                                                <div class="fu-text">
                                                                    <span><i class="fas fa-cloud-upload-alt"></i> Cliquez ici ou d??posez les fichiers ?? t??l??charger</span>
                                                                    <div class="photoUpload-files fl-wrap"></div>

                                                                </div>
                                                                <input type="file" name='fileUploads[1][]' class="upload" multiple>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <!-- Checkboxes -->
                                                        <ul class="fl-wrap filter-tags" style="margin-top:24px">
                                                            <li>
                                                                <input id="check-aaa51" type="checkbox" name="service[1][wifi]" checked value="Wifi gratuit">
                                                                <label for="check-aaa51">Wifi gratuit</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-bb51" type="checkbox" name="service[1][bathroom]" checked value="Salle de bains">
                                                                <label for="check-bb51"> Salle de bains</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-dd51" type="checkbox" name="service[1][air_cond]" value="Climatiseur">
                                                                <label for="check-dd51">Climatiseur</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-cc51" type="checkbox" name="service[1][tv]" value="T??l??vision ?? l'int??rieur">
                                                                <label for="check-cc51">T??l??vision ?? l'int??rieur</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-ff51" type="checkbox" name="service[1][breakfast]" checked value="Petit-d??jeuner">
                                                                <label for="check-ff51">Petit-d??jeuner</label>
                                                            </li>
                                                        </ul>
                                                        <!-- Checkboxes end -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-form " id="duplicater"hidden>
                                        <div class="room-add-item">
                                            <label><i class="fa-solid fa-warehouse"></i>Titre de la chambre </label>
                                            <input type="text" name="room_name[]" placeholder="Num??ro standard" value="" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nombre maximum d'adultes <i class="fas fa-male"></i></i></label>
                                                    <input type="text" name="max_adulte[]" placeholder="nombre d'adultes" value="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre minimum d'adultes <i class="fas fa-male"></i></i></label>
                                                    <input type="text" name="min_adulte[]" placeholder=" nombre d'adultes" value="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre maximum d'enfants <i class="fa-solid fa-child"></i></i></label>
                                                    <input type="text" name="max_enf[]" placeholder="nombre d'enfants" value="" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nombre minimum d'enfants <i class="fa-solid fa-child"></i></i></label>
                                                    <input type="text" name="min_enf[]" placeholder="nombre d'enfants" value="" />
                                                </div>
                                            </div>
                                            <label>D??tails de la chambre</label>
                                            <textarea cols="40" rows="3" name="room_de[]" placeholder="D??tails "></textarea>
                                            <div class="profile-edit-container" style="margin-top:30px">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Galerie</label>
                                                        <div class="add-list-media-wrap">
                                                            <div class="fuzone">
                                                                <div class="fu-text">
                                                                    <span><i class="fas fa-cloud-upload-alt"></i> Cliquez ici ou d??posez les fichiers ?? t??l??charger</span>
                                                                    <div class="photoUpload-files fl-wrap"></div>

                                                                </div>
                                                                <input type="file" name='fileUploads[1][]' class="upload" multiple>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <!-- Checkboxes -->
                                                        <ul class="fl-wrap filter-tags" style="margin-top:24px">
                                                            <li>
                                                                <input id="check-aaa51" type="checkbox" name="service[1][wifi]" checked value="Wifi gratuit">
                                                                <label for="check-aaa51">Wifi gratuit</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-bb51" type="checkbox" name="service[1][bathroom]" checked value="Salle de bains">
                                                                <label for="check-bb51"> Salle de bains</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-dd51" type="checkbox" name="service[1][air_cond]" value="Climatiseur">
                                                                <label for="check-dd51">Climatiseur</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-cc51" type="checkbox" name="service[1][tv]" value="T??l??vision ?? l'int??rieur">
                                                                <label for="check-cc51">T??l??vision ?? l'int??rieur</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-ff51" type="checkbox" name="service[1][breakfast]" checked value="Petit-d??jeuner">
                                                                <label for="check-ff51">Petit-d??jeuner</label>
                                                            </li>
                                                        </ul>
                                                        <!-- Checkboxes end -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="add-button color-bg" id="addbutton" type="button">Ajouter une chambre +</button>
                                <input type="hidden" name="nbrooms" id="hiddenInput" value="1">
                                <div class="box-widget-item-header mat-top">
                                    <h3>Sociaux</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container">
                                    <div class="custom-form">
                                        <label>Facebook <i class="fab fa-facebook"></i></label>
                                        <input type="text" name="facebook" placeholder="facebook" value="" />
                                        <label>Twitter<i class="fab fa-twitter"></i> </label>
                                        <input type="text" name="twitter" placeholder="twitter" value="" />
                                        <label> Instagram <i class="fab fa-instagram"></i> </label>
                                        <input type="text" name="instagram" placeholder="www.instagram" value="" />
                                        <button class="btn    color2-bg  float-btn" name="submit" type="submit">Envoyer la liste<i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
                                <!-- profile-edit-container end-->
                            </div>
                        </form>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA844tkNbu9Gk651PRbkdn0AwxAPUXp8wI"></script>
    <script type="text/javascript" src="../js/map-add.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $input = $('#hiddenInput');
            var count = 1;
            window.roomsnb = 1;
            $("#addbutton").click(function() {

                if (count < 4) {
                    window.roomsnb = window.roomsnb + 1;
                    var div = $("#duplicater").clone().appendTo("#clone");
                    var element = document.getElementById("duplicater");
                    document.getElementById("duplicater").hidden = false;
                    element.id = "duplicater" + window.roomsnb;
                    div.find('input[type=checkbox]').each(function() {
                        this.name = this.name.replace('[1]', '[' + window.roomsnb + ']');
                    });
                    div.find('input[type=file]').each(function() {
                        this.name = this.name.replace('[1]', '[' + window.roomsnb + ']');
                    });
                    count++;
                    var newNumber = Number($input.val()) + 1;
                    $input.val(newNumber);
                }

            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $input = $('#hiddenperiode');
            var count = 1;
            window.periodesnb = 1;
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

</html>