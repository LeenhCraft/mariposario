<!-- pagination -->
<nav aria-label="Page navigation example mt-4">
    <div class="w-100 text-capitalize text-monospace mb-2">
        mostrando
        <span class="font-weight-bold"><?= $$paginate['from']; ?></span>
        al
        <span class="font-weight-bold"><?= $$paginate['to']; ?></span>
        de
        <span class="font-weight-bold"><?= $$paginate['total']; ?></span>
        resultados
    </div>
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="<?= $$paginate['prev_page_url']; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <=  $$paginate['last_page']; $i++) : ?>
            <li class="page-item <?= $$paginate['current_page'] == $i ? 'active' : '' ?>">
                <a class="page-link" href="<?= '/contacts?page=' . $i ?><?= isset($_GET['search']) ? "&search={$_GET['search']}" : "" ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor ?>

        <li class="page-item">
            <a class="page-link" href="<?= $$paginate['next_page_url']; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<!-- end pagination -->