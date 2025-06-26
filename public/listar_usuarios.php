<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
            text-transform: uppercase;
        }

        .total-registros {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            text-transform: uppercase;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px 8px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .volver {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .volver:hover {
            background-color: #0056b3;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            margin: 0 5px;
            padding: 8px 12px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: #0056b3;
        }
        .total-registros {
    text-align: right;
    margin-bottom: 20px;
    font-weight: bold;
}
    </style>
</head>
<body>
<div class="container">
    <h2>Lista de Usuarios Registrados</h2>

    <?php
    require_once __DIR__ . '/../repositories/UsuarioRepository.php';
    $repo = new UsuarioRepository();

    // Configuración de paginación
    $registrosPorPagina = 10;
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $registrosPorPagina;

    // Total de registros
    $totalRegistros = $repo->contarUsuarios();
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    // Obtener registros paginados
    $usuarios = $repo->listarPaginado($registrosPorPagina, $offset);
    ?>   

    <table>
        <thead>
        <tr>
            <th>Nombres</th>
            <th>Documento</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Programa</th>
            <th>Creado en</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['nombres']) ?></td>
                <td><?= htmlspecialchars($usuario['documento']) ?></td>
                <td><?= htmlspecialchars($usuario['celular']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['programa']) ?></td>
              <td><?= date('d/m/Y', strtotime($usuario['creado_en'])) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
 <div class="total-registros">Total de registros: <?= $totalRegistros ?></div>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="<?= $i === $paginaActual ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>
</body>
</html>
</html>

