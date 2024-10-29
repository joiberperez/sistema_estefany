<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($paginaActual > 1) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPagina(<?= ($paginaActual - 1) ?>)' aria-label="Previous">
                    <i class="tf-icon bx bx-chevrons-left"></i>
                </a>
            </li>
        <?php } ?>

        <?php
        // Mostrar páginas
        $start = max(1, $paginaActual - 4); // Muestra hasta 4 páginas hacia atrás
        $end = min($totalPaginas, $start + 8); // Muestra hasta 8 páginas hacia adelante

        // Asegura que siempre se muestren al menos 9 páginas
        if ($end - $start < 8) {
            $start = max(1, $end - 8);
        }

        // Mostrar "..." y la primera página si es necesario
        if ($start > 2) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="cargarPagina(1)">1</a></li>';
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == $paginaActual) { ?>
                <li class="page-item active">
                    <span class='page-link'><?= $i ?></span>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class='page-link' href="javascript:void(0);" onclick='cargarPagina(<?= $i ?>)'><?= $i ?></a>
                </li>
            <?php }
        }

        // Si hay más de 9 páginas y la última no está en el rango, mostrar "..."
        if ($totalPaginas > 9 && $end < $totalPaginas) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        // Mostrar la última página solo si no está visible
        if ($end < $totalPaginas) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPagina(<?= $totalPaginas ?>)'><?= $totalPaginas ?></a>
            </li>
        <?php } ?>

        <?php if ($paginaActual < $totalPaginas) { ?>
            <li class="page-item">
                <a class='page-link' href="javascript:void(0);" onclick='cargarPagina(<?= ($paginaActual + 1) ?>)' aria-label="Next">
                    <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
<script>
    function cargarPagina(page) {
       let url = $("#url-paginacion").data("url");
        $.get(url,{page}).done(function(e) {
            
            $("#data-table").html(e)

        })
    }
</script>