<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 30px;
}

.container {
    max-width: 1300px;
    margin: auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

h2 {
    color: #222;
    margin-bottom: 25px;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
    text-transform: uppercase;
    border-bottom: 2px solid #007BFF;
    padding-bottom: 10px;
}

.total-registros {
    text-align: right;
    margin-top: 15px;
    font-weight: bold;
    color: #333;
    font-size: 15px;
}

.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    min-width: 1000px;
    background-color: #fff;
    font-size: 13.5px;
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    padding: 12px 10px;
    text-align: center;
    vertical-align: middle;
    color: #333;
}

th {
    background-color: #007BFF;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 13px;
    border-bottom: 2px solid #0056b3;
}

td {
    background-color: #fff;
    border-bottom: 1px solid #eee;
}

tr:nth-child(even) td {
    background-color: #f9f9f9;
}

.thumbnail {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.thumbnail:hover {
    transform: scale(1.05);
}

.pagination {
    margin-top: 25px;
    text-align: center;
}

.pagination a {
    display: inline-block;
    margin: 0 4px;
    padding: 8px 14px;
    background-color: #007BFF;
    color: white;
    font-size: 14px;
    text-decoration: none;
    border-radius: 6px;
    transition: background-color 0.2s;
}

.pagination a:hover {
    background-color: #0056b3;
}

.pagination a.active {
    background-color: #0056b3;
    font-weight: bold;
}

@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    table {
        font-size: 12px;
        min-width: 800px;
    }

    .thumbnail {
        width: 50px;
        height: 50px;
    }
}
    </style>
</head>
<body>
<div class="container">
    <h2>Lista de Usuarios Registrados</h2>

    <?php
    require_once __DIR__ . '/../repositories/UsuarioRepository.php';
    $repo = new UsuarioRepository();

    $registrosPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $registrosPorPagina;

    $totalRegistros = $repo->contarUsuarios();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    $usuarios = $repo->listarPaginado($registrosPorPagina, $offset);
    ?>

    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th>Nombres</th>
                <th>Documento</th>
                <th>Celular</th>
                <th>Programa</th>
                <th>Doc. Lado A</th>
                <th>Doc. Lado B</th>
                <th>Acta Bachiller</th>
                <th>Pruebas ICFES</th>
                <th>SISBÉN</th>
                <th>Creado en</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['nombres']) ?></td>
                    <td><?= htmlspecialchars($usuario['documento']) ?></td>
                    <td><?= htmlspecialchars($usuario['celular']) ?></td>
                    <td><?= htmlspecialchars($usuario['programa']) ?></td>

                    <!-- Documento Lado A -->
                    <td>
                        <?php if (!empty($usuario['documento_lado_a'])): ?>
                            <?php if (str_ends_with($usuario['documento_lado_a'], '.pdf')): ?>
                                <a href="<?= htmlspecialchars($usuario['documento_lado_a']) ?>" target="_blank">📄 Ver PDF</a>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($usuario['documento_lado_a']) ?>" target="_blank">
                                    <img src="<?= htmlspecialchars($usuario['documento_lado_a']) ?>" alt="Lado A" class="thumbnail">
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>

                    <!-- Documento Lado B -->
                    <td>
                        <?php if (!empty($usuario['documento_lado_b'])): ?>
                            <?php if (str_ends_with($usuario['documento_lado_b'], '.pdf')): ?>
                                <a href="<?= htmlspecialchars($usuario['documento_lado_b']) ?>" target="_blank">📄 Ver PDF</a>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($usuario['documento_lado_b']) ?>" target="_blank">
                                    <img src="<?= htmlspecialchars($usuario['documento_lado_b']) ?>" alt="Lado B" class="thumbnail">
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>

                    <!-- Acta Bachiller -->
                    <td>
                        <?php if (!empty($usuario['acta_bachiller_url'])): ?>
                            <?php if (str_ends_with($usuario['acta_bachiller_url'], '.pdf')): ?>
                                <a href="<?= htmlspecialchars($usuario['acta_bachiller_url']) ?>" target="_blank">📄 Ver PDF</a>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($usuario['acta_bachiller_url']) ?>" target="_blank">
                                    <img src="<?= htmlspecialchars($usuario['acta_bachiller_url']) ?>" alt="Acta" class="thumbnail">
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>

                    <!-- Pruebas ICFES -->
                    <td>
                        <?php if (!empty($usuario['pruebas_icfes'])): ?>
                            <?php if (str_ends_with($usuario['pruebas_icfes'], '.pdf')): ?>
                                <a href="<?= htmlspecialchars($usuario['pruebas_icfes']) ?>" target="_blank">📄 Ver PDF</a>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($usuario['pruebas_icfes']) ?>" target="_blank">
                                    <img src="<?= htmlspecialchars($usuario['pruebas_icfes']) ?>" alt="ICFES" class="thumbnail">
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>

                    <!-- Archivo SISBÉN -->
                    <td>
                        <?php if (!empty($usuario['archivo_sisben'])): ?>
                            <?php if (str_ends_with($usuario['archivo_sisben'], '.pdf')): ?>
                                <a href="<?= htmlspecialchars($usuario['archivo_sisben']) ?>" target="_blank">📄 Ver PDF</a>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($usuario['archivo_sisben']) ?>" target="_blank">
                                    <img src="<?= htmlspecialchars($usuario['archivo_sisben']) ?>" alt="SISBEN" class="thumbnail">
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>

                    <td><?= date('d/m/Y', strtotime($usuario['creado_en'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="total-registros">Total de registros: <?= $totalRegistros ?></div>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="<?= $i === $paginaActual ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>
</body>
</html>
