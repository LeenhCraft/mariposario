<?php headerApp('Template/header_dash', $data); ?>
<div class="card">
    <div class="card-header">
        header
    </div>
    <div class="card-body">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, illum excepturi mollitia voluptatum deserunt iure repellendus facere non quis hic aut id minus dolore neque quae perspiciatis ipsum accusantium nobis?sx
    </div>
</div>
<?php
if ($data['permisos']['perm_w'] == 1 || $data['permisos']['perm_u'] == 1) :
// getModal('mdlPermisos', $data);
endif;
footerApp('Template/footer_dash', $data);
?>