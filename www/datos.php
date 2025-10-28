<?php
// Conexión a PostgreSQL
$host = "192.168.56.11"; // IP de la máquina db
$port = "5432";
$dbname = "taller";
$user = "vagrant";
$password = "vagrant";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Error al conectar a la base de datos.";
    exit;
}

$result = pg_query($conn, "SELECT * FROM personas");

if (!$result) {
    echo "Error al ejecutar la consulta.";
    exit;
}

// Iniciar estructura HTML
echo '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Personas - Taller Vagrant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }
        header {
            background-color: #b81d1d;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 1.3em;
        }
        main {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        th {
            background-color: #b81d1d;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <header>Base de datos - Taller de provisionamiento</header>
    <main>
        <div>
            <h2>Lista de personas registradas</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
';

// Mostrar cada fila de la base de datos
while ($row = pg_fetch_assoc($result)) {
    echo "<tr><td>{$row['id']}</td><td>{$row['nombre']}</td></tr>";
}

// Cerrar HTML
echo '
            </table>
        </div>
    </main>
    <footer>© 2025 Universidad Autónoma de Occidente - Samuel Izquierdo Bonilla - 2246993</footer>
</body>
</html>
';

// Cerrar conexión
pg_close($conn);
?>
