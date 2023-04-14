<?php headerWeb('Web.Template.header_web', $data); ?>
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h1 class="text-center text-md-left">Gracias por registrarte!<br><b><?= $data['name'] ?></b></h1>
                        <p></p>
                        <p>Lo sentimos, su token de sesión ha expirado. Para continuar usando nuestro servicio, deberá solicitar un nuevo token haciendo clic en el botón "Resend Verification Email". Una vez que haya obtenido su nuevo token, podrá activar su cuenta y continuar utilizando nuestra plataforma. Si tiene algún problema para solicitar un nuevo token, no dude en ponerse en contacto con nuestro equipo de soporte para obtener ayuda adicional.</p>
                        <form id="resend_notification" method="post" onsubmit="resend_notification(this,event)" class="mt-3">
                            <input type="hidden" name="_token" value="<?= $data["token"] ?>">
                            <button type="submit" value="submit" class="btn_3">Resend Verification Email</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php footerWeb('Web.Template.footer_web', $data); ?>