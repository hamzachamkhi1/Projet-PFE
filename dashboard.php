<?php 
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE Username = '$username'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$image = "./admin/uploads/" . $data['Image'];


?>
  <div class="dasboard-sidebar">
                                <div class="dasboard-sidebar-content fl-wrap">
                                    <div class="dasboard-avatar">
                                        <img src="<?php echo $image; ?>" alt="">
                                    </div>
                                    <div class="dasboard-sidebar-item fl-wrap">
                                        <h3>
                                            <span>Bienvenue</span>
                                            <?php echo $data['name'] ?> <?php echo $data['firstname'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>