<?php headerWeb('Web.Template.header_web', $data); ?>
<!--================login_part Area =================-->
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>¿Eres nuevo por aquí?</h2>
                        <p>No te pierdas nuestras novedades, registrate y reserva tu libro que tanto deseas.</p>
                        <a href="/register" class="btn_3">Crear mi cuenta</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Bienvenido Nuevamente!<br>Inicie sesión ahora</h3>
                        <form id="form_login" class="row contact_form" novalidate="novalidate">
                            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Usuario">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="f-option" name="selector">
                                    <label for="f-option">No cerrar sesion</label>
                                </div>
                                <button type="submit" value="submit" class="btn_3">
                                    log in
                                </button>
                                <a class="lost_pass" href="/forgot-password">No recuerdo mi contraseña?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->
<?php footerWeb('Web.Template.footer_web', $data); ?>