<?php
$ctrl = $data['url'];
$expand = $active = '';
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/admin" class="app-brand-link">
            <span class=" demo menu-text fw-bolder ms-2 app-header__logo"><?php echo $_ENV['APP_NAME']; ?></span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item <?= $ctrl === $data['url'] ? 'active' : '' ?>">
            <a href="<?= $data['url'] ?>" class="menu-link">
                <i class='menu-icon tf-icons bx bx bxs-dashboard'></i>
                <div>
                    <?php echo $data['url']; ?>
                </div>
            </a>
        </li>
        <?php
        $menus = menus();
        if (!empty($menus)) :
            foreach ($menus as $row) :
                if ($row['men_url_si'] == 1) :
                    $active = ($row['men_url'] == $ctrl) ? 'active' : '';
                    $menburl = ($row['men_url'] != '#') ? $row['men_url'] : '#';
        ?>
                    <li class="menu-item <?php echo $active; ?>">
                        <a href="<?php echo $menburl; ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx <?php echo $row['men_icono']; ?>"></i>
                            <div data-i18n="Analytics"><?php echo $row['men_nombre']; ?></div>
                        </a>
                    </li>
                <?php
                else :
                    $submenus = submenus($row['idmenu']);
                    $expand = (pertenece($ctrl, $row['idmenu'])) ? 'open' : '';
                ?>
                    <li class="menu-item <?php echo $expand; ?>">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx <?php echo $row['men_icono']; ?>"></i>
                            <div data-i18n="Layouts"><?php echo $row['men_nombre']; ?></div>
                        </a>

                        <ul class="menu-sub">
                            <?php
                            foreach ($submenus as $key) :
                                $active = ($key['sub_url'] == $ctrl) ? 'active' : '';
                                $suburl = ($key['sub_url'] != '#') ? $key['sub_url'] : '#';
                            ?>
                                <li class="menu-item <?php echo $active; ?>">
                                    <a href="<?php echo $suburl; ?>" class="menu-link">
                                        <div data-i18n="<?php echo $key['sub_nombre']; ?>">
                                            <i class="menu-icon tf-icons bx <?php echo $key['sub_icono']; ?>"></i>
                                            <?php echo $key['sub_nombre']; ?>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </li>
            <?php
                endif;
            endforeach;
        else :
            ?>
            <li class="menu-item">
                <a href="index.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Sin menus</div>
                </a>
            </li>
        <?php
        endif;
        ?>
    </ul>
</aside>

<script>

</script>