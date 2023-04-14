<?php headerWeb('Web.Template.header_web', $data); ?>
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h2 class="mb-4">
                            ¿Olvidaste tu contraseña?
                        </h2>
                        <p class="text-dark font-weight-bold mb-4">
                            Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá elegir una nueva.
                        </p>
                        <form id="forgot_form" class="row contact_form" novalidate="novalidate">
                            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                            <div class="form-group col-md-12 ft-b text-left">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su correo electrónico'" placeholder='Ingrese su correo electrónico' required>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn_3">
                                    Email Password Reset Link
                                </button>
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