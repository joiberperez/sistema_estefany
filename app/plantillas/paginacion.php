<nav aria-label="...">
    <ul class="pagination">
        <?php
        if ($paginaActual > 1) { ?>
            <li class="page-item ">
                <button class='page-link' onclick='cargarPagina( <?= ($paginaActual - 1) ?>)'><i class="tf-icon bx bx-chevrons-left"></i></button>
            </li>

        <?php } ?>
        <?php
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaActual) {  ?>

                <li class="page-item active">
                    <button class='page-link' onclick='cargarPagina(<?= $i ?>)'> <?= $i ?> </button>
                </li>

            <?php } else { ?>
                <li class="page-item">
                    <button class='page-link' onclick='cargarPagina(<?= $i ?>)'> <?= $i ?> </button>
                </li>
        <?php }
        } ?>

        <?php if ($paginaActual < $totalPaginas) { ?>

            <li class="page-item ">
                <button class='page-link' onclick='cargarPagina(<?= ($paginaActual + 1) ?>)'><i class="tf-icon bx bx-chevrons-right"></i></button>
            </li>
        <?php } ?>
    </ul>
</nav>

<script>
    function cargarPagina(page) {
        
        $.get("/sistema_estefany/app/cliente/listar_cliente.php",{page}).done(function(e) {
            
            $("#data-table").html(e)

        })
    }
</script>