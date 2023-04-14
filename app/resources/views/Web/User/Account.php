<?php headerWeb('Web.Template.header_web', $data); ?>
<section class="login_part padding_top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 bborder border-success">
                <?php include_once __DIR__ . '/navbarUser.php'; ?>
            </div>
            <div class="col-12 col-sm-12 col-md-9 bborder border-success">
                <form id="account_form" novalidate="novalidate">
                    <input type="hidden" name="<?= $data['tk']['name'] ?>" value="<?= $data['tk']['key'][$data['tk']['name']]  ?>">
                    <input type="hidden" name="<?= $data['tk']['value'] ?>" value="<?= $data['tk']['key'][$data['tk']['value']] ?>">
                    <input type="hidden" name="id" value="<?= $data['user']['idwebusuario'] ?>">

                    <div class="form-row align-items-end d-none">
                        <div class="form-group col-12 col-md-6">
                            <label for="address">Foto de perfil</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profile" name="profile">
                                <label class="custom-file-label" for="profile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <div class="w-25 mx-auto">
                                <img src="https://via.placeholder.com/120x120" class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" readonly placeholder="<?= $data['user']['usu_usuario'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su nombre completo'" placeholder='Ingrese su nombre completo' value="<?= $data['user']['usu_nombre'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dni">Dni</label>
                            <input type="number" class="form-control" id="dni" name="dni" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su dni'" placeholder='Ingrese su dni' min="1" pattern="^[0-9]+" value="<?= $data['user']['usu_ndoc'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Celular</label>
                            <input type="number" class="form-control" id="phone" name="phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese un número de contacto'" placeholder='Ingrese un número de contacto' min="1" pattern="^[0-9]+" value="<?= $data['user']['usu_cel'] ?>">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese una direccion de referencia'" placeholder='Ingrese una direccion de referencia' value="<?= $data['user']['usu_direc'] ?>">
                    </div>
                    <hr class="d-none">
                    <div class="form-row d-none">
                        <div class="form-group col-md-6">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese su contraseña'" placeholder='Ingrese su contraseña'>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese nuevamente la contraseña'" placeholder='Ingrese nuevamente la contraseña'>
                        </div>
                    </div>
                    <hr class="d-none">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="fecha">Fecha de registro</label>
                            <input type="text" class="form-control border border-0" id="fecha" value="<?= $data['user']['usu_fecha'] ?>" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php footerWeb('Web.Template.footer_web', $data); ?>