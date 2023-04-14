<header class="main_menu home_menu">
    <div class="header_top d-none d-md-inline" style="background-color: #ECFDFF;">
        <div class="container">
            <div class="row py-1">
                <div class="col-lg-6">
                    <label class="form-label m-0">Hola, <b><?= $nombre ?></b></label>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand logo-web" href="/"> <?= $_ENV['APP_NAME']; ?> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            <?php foreach ($menus as $menu) :
                                if ($menu['me_url'] != "") : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= $menu["me_url"] ?>"><?= $menu['me_name'] ?></a>
                                    </li>
                                <?php endif;

                                if ($menu['me_url'] == null) : ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="<?= str_replace(" ", "-", $menu['me_name']) ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= $menu['me_name'] ?>
                                        </a>
                                        <?php
                                        if (!empty($menu['submenus'])) :
                                        ?>
                                            <div class="dropdown-menu" aria-labelledby="<?= str_replace(" ", "-", $menu['me_name']) ?>">
                                                <?php foreach ($menu['submenus'] as $submenu) : ?>
                                                    <a class="dropdown-item" href="<?= $submenu['me_url'] ?>"><?= $submenu['me_name'] ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        <a id="search_1" href="javascript:void(0)"><i class="ti-search m-0"></i></a>
                        <?php
                        if (isset($_SESSION['pe'])) :
                        ?>
                            <a href="/logout" class="mx-3"><i class='ti-arrow-circle-left m-0'></i></a>
                        <?php else : ?>
                            <a href="/login" class="mx-3"><i class="ti-user m-0"></i></a>
                        <?php endif; ?>

                        <div class="">
                            <a class="" href="/carrito">
                                <i id="cantcar" class="fas fa-cart-plus m-0"><span class="cant_car" <?= $dnone ?? "" ?>><?= $data['cant'] ?></span></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container ">
            <form class="d-flex justify-content-between search-inner">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="ti-close" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>