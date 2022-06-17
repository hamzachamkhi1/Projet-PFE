
<div class="main-register-wrap modal">
            <div class="reg-overlay"></div>
            <div class="main-register-holder">
                <div class="main-register fl-wrap">
                    <div class="close-reg color-bg"><i class="fas fa-times"></i></div>
                    <ul class="tabs-menu">
                        <li class="current"><a href="#tab-1"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
                        <li><a href="#tab-2"><i class="fas fa-user-plus"></i> S'inscrire</a></li>
                    </ul>
                    <!--tabs -->
                    <div id="tabs-container">
                        <div class="tab">
                            <!--tab -->
                            <div id="tab-1" class="tab-content">
                                <h3>S'identifier <span>Easy<strong>Book</strong></span></h3>
                                <div class="custom-form">
                                    <form method="post" action="index.php" name="login">
                                        <label>nom d'utilisateur <span>*</span> </label>
                                        <input name="Username" type="text" value="">
                                        <label>Mot de passe <span>*</span> </label>
                                        <input name="Password" type="password" value="">
                                        <button type="submit" name="login" class="log-submit-btn color-bg"><span>Connexion</span></button>
                                        <div class="clearfix"></div>
                                        <div class="filter-tags">
                                            <input id="check-a" type="checkbox" name="check">
                                            <label for="check-a">Souviens-toi de moi </label>
                                        </div>
                                    </form>
                                    <div class="lost_password">
                                        <a href="#">Mot de passe perdu?</a>
                                    </div>
                                </div>
                            </div>
                            <!--tab end -->
                            <!--tab -->
                            <div class="tab">
                                <div id="tab-2" class="tab-content">
                                    <h3>S'inscrire <span>Easy<strong>Book</strong></span></h3>
                                    <div class="custom-form">
                                        <form method="post" name="registerform" class="main-register-form" id="main-register-form2">
                                            <label>Nom et prénom <span>*</span> </label>
                                            <input name="name" type="text" value="">
                                            <label>Adresse e-mail <span>*</span></label>
                                            <input name="email" type="text" onClick="this.select()" value="">
                                            <label>Mot de passe <span>*</span></label>
                                            <input name="password" type="password" onClick="this.select()" value="">
                                            <button type="submit" class="log-submit-btn color-bg"><span>S'inscrire</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--tab end -->
                        </div>
                        <!--tabs end -->
                    </div>
                </div>
            </div>
        </div>