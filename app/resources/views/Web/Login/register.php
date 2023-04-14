<?php headerWeb('Web.Template.header_web', $data); ?>
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>Bienvenido! <br> Por favor ingresa tus datos</h3>
                        <form id="register_form" class="row contact_form" novalidate="novalidate">
                            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                            <div class="form-group col-md-12 ft-b text-left">
                                <label for="dni">DNI:</label>
                                <input type="number" class="form-control" id="dni" name="dni" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su dni'" placeholder='Ingrese su dni' required min="1" pattern="^[0-9]+">
                            </div>
                            <div class="form-group col-md-12 ft-b div_nom text-left">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su nombre completo'" placeholder='Nombre y apellidos' required>
                            </div>
                            <div class="form-group col-md-12 ft-b text-left">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su correo electrónico'" placeholder='Ingrese su correo electrónico' required>
                            </div>
                            <div class="form-group col-md-12 ft-b div_nom text-left">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su contraseña'" placeholder='Ingrese su contraseña'>
                            </div>
                            <div class="form-group col-md-12 ft-b div_nom text-left">
                                <label for="password_confirmation">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese nuevamente la contraseña'" placeholder='Ingrese nuevamente la contraseña'>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn_3">
                                    Registrarme
                                </button>
                                <a class="lost_pass my-3 d-block d-md-none" href="/login">Ya tengo cuenta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 d-none d-md-block">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>¿Ya tienes una cuenta?</h2>
                        <p>Inicia sesion y revisa nuestras nuevas novedades.</p>
                        <a href="/login" class="btn_3">Iniciar Session</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php footerWeb('Web.Template.footer_web', $data); ?>