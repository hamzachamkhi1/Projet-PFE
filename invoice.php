<?php
require_once 'connection.php';

if (session_status() != 2)
    session_start();
require "login.php";

if (!isset($_SESSION['Status']) || $_SESSION['Status'] == "Disconnected") {
    header("Location:index.php");
    die();
}
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM users WHERE Username = '$username'";
$result1 = $conn->query($sql1);
$data1 = $result1->fetch_assoc();
$noOfRooms = $_SESSION['rooms'];
$nbenf = $_SESSION['nbenf'];
$nbadulte = $_SESSION['nbadulte'];
$date = $_SESSION['main-input-search'];
$date1 = new DateTime($date[0]);
$date2 = new DateTime($date[1]);
$hotelid=$_SESSION['idho'];
$prix=$_SESSION['prix'];
$numberOfNights = $date2->diff($date1)->format("%a");
$sql = "SELECT * FROM hotel WHERE id = $hotelid";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$date11 = date_format($date1, "y/m/d");
$date22 = date_format($date2, "y/m/d");
$r = $noOfRooms - 1;
if ($r == 0) {
    $pax[$r]['adultes'] = $_SESSION['adultes' . $r + 1];
    $val_adult = $pax[$r]['adultes'];
    $pax[$r + 1]['enfant'] = $_SESSION['Enfants' . $r + 1];
    $val_enf = $pax[$r + 1]['enfant'];
    $chmb = array($val_adult, $val_enf);
    $totchambre = array($chmb);
    $sqlro = "SELECT * FROM room where id_hotel='$hotelid' and   max_adulte>='$val_adult' and  max_enfant>='$val_enf' and min_adulte <= '$val_adult' and min_enfant<='$val_enf' ";
    $resultro = mysqli_query($conn, $sqlro);
    $arr_values = array();
    while ($row = mysqli_fetch_array($resultro, MYSQLI_ASSOC)) {

        array_push($arr_values, $row);
    }
    $arr = array_unique($arr_values, SORT_REGULAR);
    $count = sizeof($arr);
    $countch = sizeof($arr_values);
} elseif ($r == 1) {
    $pax[$r - 1]['adultes'] = $_SESSION['adultes' . $r];
    $val_adult = $pax[$r - 1]['adultes'];
    $pax[$r]['enfant'] = $_SESSION['Enfants' . $r];
    $val_enf = $pax[$r]['enfant'];
    $chmb1 = array($val_adult, $val_enf);
    $pax[$r]['adultes'] = $_SESSION['adultes' . $r + 1];
    $val_adult1 = $pax[$r]['adultes'];
    $pax[$r + 1]['enfant'] = $_SESSION['Enfants' . $r + 1];
    $val_enf1 = $pax[$r + 1]['enfant'];
    $chmb2 = array($val_adult1, $val_enf1);
    $totchambre = array($chmb1, $chmb2);
    $sqlro = "SELECT * FROM room where id_hotel='$hotelid' and   max_adulte>='$val_adult' and  max_enfant>='$val_enf' and min_adulte <= '$val_adult' and min_enfant<='$val_enf' ";
    $resultro = mysqli_query($conn, $sqlro);
    $arr_values = array();
    while ($row = mysqli_fetch_array($resultro, MYSQLI_ASSOC)) {

        array_push($arr_values, $row);
    }
    $sqlroo = "SELECT * FROM room where id_hotel='$hotelid' and max_adulte>='$val_adult1' and max_enfant>='$val_enf1' and min_adulte <= '$val_adult1' and min_enfant<='$val_enf1'";
    $resultroo = mysqli_query($conn, $sqlroo);
    while ($row = mysqli_fetch_array($resultroo, MYSQLI_ASSOC)) {
        array_push($arr_values, $row);
    }
    $arr = array_unique($arr_values, SORT_REGULAR);
    $count = sizeof($arr);
    $countch = sizeof($arr_values);
} elseif ($r == 2) {
    $pax[$r - 2]['adultes'] = $_SESSION['adultes' . $r - 1];
    $val_adult = $pax[$r - 2]['adultes'];
    $pax[$r - 1]['enfant'] = $_SESSION['Enfants' . $r - 1];
    $val_enf = $pax[$r - 1]['enfant'];
    $chmb1 = array($val_adult, $val_enf);
    $pax[$r - 1]['adultes'] = $_SESSION['adultes' . $r];
    $val_adult1 = $pax[$r - 1]['adultes'];
    $pax[$r]['enfant'] = $_SESSION['Enfants' . $r];
    $val_enf1 = $pax[$r]['enfant'];
    $chmb2 = array($val_adult1, $val_enf1);
    $pax[$r]['adultes'] = $_SESSION['adultes' . $r + 1];
    $val_adult2 = $pax[$r]['adultes'];
    $pax[$r + 1]['enfant'] = $_SESSION['Enfants' . $r + 1];
    $val_enf2 = $pax[$r + 1]['enfant'];
    $chmb3 = array($val_adult2, $val_enf3);
    $totchambre = array($chmb1, $chmb2, $chmb3);
    $sqlro = "SELECT * FROM room where id_hotel='$hotelid' and   max_adulte>='$val_adult' and  max_enfant>='$val_enf' and min_adulte <= '$val_adult' and min_enfant<='$val_enf' ";
    $resultro = mysqli_query($conn, $sqlro);
    $arr_values = array();
    while ($row = mysqli_fetch_array($resultro, MYSQLI_ASSOC)) {

        array_push($arr_values, $row);
    }
    $sqlroo = "SELECT * FROM room where id_hotel='$hotelid' and max_adulte>='$val_adult1' and max_enfant>='$val_enf1' and min_adulte <= '$val_adult1' and min_enfant<='$val_enf1'";
    $resultroo = mysqli_query($conn, $sqlroo);
    while ($row = mysqli_fetch_array($resultroo, MYSQLI_ASSOC)) {
        array_push($arr_values, $row);
    }

    $sqlroom = "SELECT * FROM room where id_hotel='$hotelid' and  max_adulte>='$val_adult2' and  max_enfant>='$val_enf2' and min_adulte <= '$val_adult2' and min_enfant<='$val_enf2'";
    $resultroom = mysqli_query($conn, $sqlroom);
    while ($row = mysqli_fetch_array($resultroom, MYSQLI_ASSOC)) {
        array_push($arr_values, $row);
    }
    $arr = array_unique($arr_values, SORT_REGULAR);
    $count = sizeof($arr);
    $countch = sizeof($arr_values);
}
$timezone = date_default_timezone_get();
$datenow = date('Y/m/d');

?>
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
    <link type="text/css" rel="stylesheet" href="css/invoice.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/logo.png" style="width:150px; height:auto" alt="">
                            </td>
                            <td>
                                facture#: 25<br>
                                Établie:  <?php echo $datenow ?><br>
                                Convenable: <?php echo $date11 ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                ChamkhiBooking , Inc.<br>
                                LA MEDINA HAMMAMET<br>
                                <a href="#" style="color:#666; text-decoration:none">hamza.chamkhi@etudiant-isi.utm.tn</a>
                                <br>
                                <a href="#" style="color:#666; text-decoration:none">+(216)54416265</a>
                            </td>
                            <td>
                                <?php echo $data1['name'] ?> <?php echo $data1['firstname'] ?><br>
                                <a href="#" style="color:#666; text-decoration:none"><?php echo $data1['EMail'] ?></a>
                                <br>
                                <a href="#" style="color:#666; text-decoration:none"><?php echo $data1['Phone'] ?></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Option
                </td>
                <td>
                Détails
                </td>
            </tr>
            <tr class="item">
                <td>
                Hôtel
                </td>
                <td>
                    <?php echo $data['hoteltname'] ?>
                </td>
            </tr>
            <?php
              for ($i = 0; $i < $noOfRooms; $i++) { ?>
            <tr class="item">
                <td>
                Type de chambre
                </td>
                <td>
                <?php echo $arr[$i]["roomname"] ?>
                </td>
            </tr>
            <?php  } ?>
            <tr class="item ">
                <td>
                Journées
                </td>
                <td>
                    <?php echo $numberOfNights; ?>
                </td>
            </tr>
            <tr class="item ">
                <td>
                    Adultes
                </td>
                <td>
                    <?php echo $nbadulte; ?>
                </td>
            </tr>
            <tr class="item ">
                <td>
                    Enfants
                </td>
                <td>
                    <?php echo $nbenf; ?>
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td style="padding-top:50px;">
                    Total: <?php echo $prix;?>dt
                </td>
            </tr>
        </table>
    </div>
    <a href="javascript:window.print()" class="print-button">Imprimer cette facture</a>
</body>

</html>