<?php headerWeb('Web.Template.header_web', $data); ?>
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 mx-auto">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <form id="reset_form" class="row contact_form mx-4 mx-sm-2 mx-md-0" novalidate="novalidate">
                            <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                            <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">

                            <input type="hidden" name="email" value="<?= $data['email'] ?>">
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
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php footerWeb('Web.Template.footer_web', $data); ?>