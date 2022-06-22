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
    <link rel="shortcut icon" href="../images/favicon.ico">
    <script type="text/javascript">
        function deleteid(id_de) {
            var id = <?php echo $_GET['hotel_id']; ?>;
            if (confirm('Sure To Remove This Image ?')) {
                window.location.href = 'http://localhost/Projet%20PFE/admin/roomupdate.php?hotel_id=' + id + '&deleteid=' + id_de;
            }
        }
    </script>

</head>

<body>
    <?php
    $id = $_GET['hotel_id'];
    include '../connection.php';
    if (isset($_GET['deleteid'])) {
        $id_roomimg = $_GET['deleteid'];
        mysqli_query($conn, "DELETE FROM images_room WHERE id=$id_roomimg");
    }
    $sql = " SELECT *  FROM room WHERE id_hotel=$id ";
    $result = $conn->query($sql);
    $rowcount = mysqli_num_rows($result);
    if (isset($_POST["update_room"])) {
        $id = $_GET['hotel_id'];
        $room_name = $_POST["room_name"];
        $max_adult = $_POST["max_adulte"];
        $min_adult = $_POST["min_adulte"];
        $max_enf = $_POST["max_enf"];
        $min_enf = $_POST["min_enf"];
        $all_incl = $_POST["all_incl"];
        $all_incl_s = $_POST["all_incl_s"];
        $demi_p = $_POST["demi_p"];
        $petit_d = $_POST["petit_d"];
        $room_descri = $_POST["room_de"];
        $roomfacility = $_POST["service"];
        $id_room = $_POST["id_room"];
        $nbr_room = count($id_room);
        if ($nbr_room > $rowcount) {
            for ($i = 0; $i < $rowcount; $i++) {
                $facilityindex = $i + 1;
                $imagesindex = $i + 1;
                $rf = json_encode($roomfacility[$facilityindex]);
                $sql1 = "UPDATE room SET roomname='$room_name[$i]',max_adulte='$max_adult[$i]',min_adulte='$min_adult[$i]',max_enfant='$max_enf[$i]',min_enfant='$min_enf[$i]',room_description='$room_descri[$i]',services='$rf' WHERE id='$id_room[$i]' limit $rowcount ";
                if (mysqli_query($conn, $sql1)) {
                    echo "Record was updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $update. "
                        . mysqli_error($conn);
                }
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
                                $sqlVal = "('" . $fileName . "', '" .  $id_room[$i] . "')";
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

            for ($i = $rowcount; $i < $nbr_room; $i++) {
                $facilityindex = $i + 1;
                $imagesindex = $i + 1;
                $rf = json_encode($roomfacility[$facilityindex]);
                $sql = "INSERT INTO `room`(roomname,max_adulte,min_adulte,max_enfant,min_enfant,room_description,services,id_hotel	) VALUES('$room_name[$i]','$max_adult[$i]',' $min_adult[$i]',' $max_enf[$i]',' $min_enf[$i]',' $room_descri[$i]','$rf','$id') ";
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
        } else {
            for ($i = 0; $i < $rowcount; $i++) {
                $facilityindex = $i + 1;
                $imagesindex = $i + 1;
                $rf = json_encode($roomfacility[$facilityindex]);
                $sql1 = "UPDATE room SET roomname='$room_name[$i]',max_adulte='$max_adult[$i]',min_adulte='$min_adult[$i]',max_enfant='$max_enf[$i]',min_enfant='$min_enf[$i]',room_description='$room_descri[$i]',services='$rf' WHERE id='$id_room[$i]'";
                if (mysqli_query($conn, $sql1)) {
                    echo "Record was updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $update. "
                        . mysqli_error($conn);
                }
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
                                $sqlVal = "('" . $fileName . "', '" .  $id_room[$i] . "')";
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


        header("Location: http://localhost/Projet%20PFE/admin/dashboard-listing-table.php?");
    }











    ?>
    <!-- content-->
    <div class="content">
        <section class="flat-header color-bg adm-header">
            <div class="wave-bg wave-bg2"></div>
            <div class="container">
                <div class="dasboard-wrap fl-wrap">
                    <div class="dasboard-breadcrumbs breadcrumbs"><a href="#">Home</a><a href="#">Dashboard</a><a>Listing</a><span>Edit room</span></div>
                </div>
        </section>
        <section class="middle-padding">
            <form action="roomupdate.php?hotel_id=<?php echo $id ?>" enctype="multipart/form-data" method="POST">
                <div class="container">

                    <div class="box-widget-item-header mat-top">
                        <h3>Chambres</h3>
                    </div>
                    <div class="profile-edit-container" id="clone">
                        <?php
                        $index = 0;
                        while ($row = $result->fetch_assoc()) {
                            $index = $index + 1;
                            if ($row['services'] != null) {
                                $services = json_decode($row['services'], true);
                            } else $services = null;
                            $id_ro = $row['id'];


                        ?>
                            <div class="custom-form  delete_mem<?php echo $id_ro ?> " id="duplicater1">
                                <div class="room-add-item">
                                    <label><i class="fa-solid fa-warehouse"></i>Titre de la chambre  </label>
                                    <input type="text" name="room_name[]" placeholder="Numéro standard" value="<?php echo $row["roomname"] ?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nombre maximum d'adultes <i class="fas fa-male"></i></i></label>
                                            <input type="text" name="max_adulte[]" placeholder="nombre d'adultes" value="<?php echo $row["max_adulte"] ?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nombre minimum d'adultes <i class="fas fa-male"></i></i></label>
                                            <input type="text" name="min_adulte[]" placeholder=" nombre d'adultes" value="<?php echo $row["min_adulte"] ?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nombre maximum d'enfants <i class="fa-solid fa-child"></i></i></label>
                                            <input type="text" name="max_enf[]" placeholder="nombre d'enfants" value="<?php echo $row["max_enfant"] ?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nombre minimum d'enfants <i class="fa-solid fa-child"></i></i></label>
                                            <input type="text" name="min_enf[]" placeholder="nombre d'enfants" value="<?php echo $row["min_enfant"] ?>" />
                                        </div>

                                    </div>
                                    <label>Détails de la chambre</label>
                                    <textarea cols="40" rows="3" name="room_de[]" placeholder="Détails"><?php echo $row["room_description"] ?></textarea>
                                    <div class="profile-edit-container" style="margin-top:30px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Galerie</label>
                                                <div class="add-list-media-wrap">
                                                    <div class="fuzone">
                                                        <div class="fu-text">
                                                            <span><i class="fas fa-cloud-upload-alt"></i> Click here or drop files to upload</span>
                                                            <div class="photoUpload-files fl-wrap"></div>
                                                        </div>
                                                        <input type="file" name='fileUploads[<?php echo $index ?>][]' class="upload" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="add-list-media-header" style="margin-bottom:20px">
                                                    <label>Images</label>
                                                </div>
                                                <div class="add-list-media-wrap">
                                                    <div class="fuzoneimg">
                                                        <?php
                                                        $sqls = "SELECT * FROM images_room WHERE id_room = $id_ro";
                                                        $results = $conn->query($sqls);
                                                        if (isset($results)) {

                                                            while ($row1 = $results->fetch_assoc()) {

                                                        ?>
                                                                <div class=" box">

                                                                    <img src='<?php echo "uploads/" . $row1["file_name"]; ?>' alt="">
                                                                    <a href="javascript:deleteid(<?php echo $row1['id']; ?>)"><i class="fas fa-window-close"></i></a>

                                                                </div>
                                                            <?php

                                                            } ?>
                                                        <?php

                                                        } ?>

                                                    </div>



                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <!-- Checkboxes -->
                                                <ul class="fl-wrap filter-tags" style="margin-top:24px">
                                                    <li>
                                                        <input id="check-aaa51" type="checkbox" name='service[<?php echo $index ?>][wifi]' value="Wifi gratuit" <?php if ($services != null && array_key_exists('wifi', $services) && $services['wifi'] == "Wifi gratuit") echo 'checked';
                                                                                                                                                                else echo 'unchecked';  ?>>
                                                        <label for="check-aaa51"> Wifi gratuit</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-bb51" type="checkbox" name="service[<?php echo $index ?>][bathroom]" value="Salle de bains" <?php if ($services != null && array_key_exists('bathroom', $services) && $services['bathroom'] == "Salle de bains") echo 'checked';
                                                                                                                                                                else echo 'unchecked'; ?>>
                                                        <label for="check-bb51"> Salle de bains</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-dd51" type="checkbox" name="service[<?php echo $index ?>][air_cond]" value="Climatiseur" <?php if ($services != null && array_key_exists('air_cond', $services) && $services['air_cond'] == "Climatiseur") echo 'checked';
                                                                                                                                                                        else echo 'unchecked'; ?>>
                                                        <label for="check-dd51">Climatiseur</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-cc51" type="checkbox" name="service[<?php echo $index ?>][tv]" value="Télévision à l'intérieur" <?php if ($services != null && array_key_exists('tv', $services) && $services['tv'] == "Télévision à l'intérieur") echo 'checked';
                                                                                                                                                            else  echo 'unchecked'; ?>>
                                                        <label for="check-cc51">Télévision à l'intérieur</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-ff51" type="checkbox" name="service[<?php echo $index ?>][breakfast]" value="Petit-déjeuner" <?php if ($services != null && array_key_exists('breakfast', $services) && $services['breakfast'] == "Petit-déjeuner") echo 'checked';
                                                                                                                                                                    else echo 'unchecked'; ?>>
                                                        <label for="check-ff51">Petit-déjeuner</label>
                                                    </li>
                                                    <input type="hidden" name=id_room[] value="<?php echo $row['id']; ?>">
                                                </ul>
                                                <!-- Checkboxes end -->
                                                <ul class="dashboard-listing-table-opt  fl-wrap">
                                                    <li><a href="" class="del-btn" id="delete_button<?php echo $row['id']; ?>" value="delete" onclick="delete_row('<?php echo $row['id']; ?>');">Delete <i class="fal fa-trash-alt"></i></a></li>
                                                </ul>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php

                        } ?>
                        <div class="custom-form " id="duplicater" hidden>
                            <div class="room-add-item">
                                <label><i class="fa-solid fa-warehouse"></i>Titre de la chambre </label>
                                <input type="text" name="room_name[]" placeholder="Numéro standard" value="" />
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
                                <label>Détails de la chambre</label>
                                <textarea cols="40" rows="3" name="room_de[]" placeholder="Détails "></textarea>
                                <div class="profile-edit-container" style="margin-top:30px">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Galerie</label>
                                            <div class="add-list-media-wrap">
                                                <div class="fuzone">
                                                    <div class="fu-text">
                                                        <span><i class="fas fa-cloud-upload-alt"></i> Cliquez ici ou déposez les fichiers à télécharger</span>
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
                                                    <input id="check-cc51" type="checkbox" name="service[1][tv]" value="Télévision à l'intérieur">
                                                    <label for="check-cc51">Télévision à l'intérieur</label>
                                                </li>
                                                <li>
                                                    <input id="check-ff51" type="checkbox" name="service[1][breakfast]" checked value="Petit-déjeuner">
                                                    <label for="check-ff51">Petit-déjeuner</label>
                                                </li>
                                            </ul>
                                            <!-- Checkboxes end -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <ul class="dashboard-listing-table-opt  fl-wrap">
                        <li><button class="btn    color-bg  float-btn" name="addroom" id="addbutton" type="button">Ajouter une chambre +<i class="fa-solid fa-circle-plus"></i></button></li>
                        <li><button class="btn    color2-bg  float-btn" name="update_room" type="submit">Mise à jour<i class="fas fa-paper-plane"></i></button></li>
                    </ul>
                </div>
            </form>

        </section>
        <div class="limit-box fl-wrap">
        </div>
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
    <script type="text/javascript" src="../js/modify_records.js"></script>
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

</body>