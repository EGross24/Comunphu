<?php
// Conectar a la base de datos
include 'PHP/conexion_be.php';

// Consultar comentarios y maestros
$sql = "
    SELECT comentarios.id_comentario, comentarios.comentario, comentarios.fecha, docentes.NombreCompleto AS docente_nombre
    FROM comentarios
    INNER JOIN docentes ON comentarios.docente_id = docentes.id_docente
    ORDER BY comentarios.fecha DESC
";
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay comentarios
if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "<p>No hay reseñas disponibles.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <link rel="stylesheet" href="css/comunphu.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos básicos del carrusel */
        .carousel-container {
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
            text-align: center;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
            margin: 10px 0;
        }

        .carousel-item h3 {
            margin: 0 0 10px;
        }

        .carousel-item p {
            font-size: 1rem;
            color: #555;
        }

        /* Botones de navegación */
        .carousel-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .carousel-button {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 50%;
        }

        .carousel-button:hover {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
<header class="header">
        <nav class="navbar">
            <ul>
                <li><div class="contenedor-logo">
                <a href="InicioComunphu.php"><img src="fotos y videos comunphu/logo.png" alt="Logo" class="logo"></a></div></li>
                <li><a href="Busqueda.php">BÚSQUEDA GENERAL</a></li>
                <li><a href="Reseñas.php">RESEÑAS</a></li>
                <li>
                <div class="mailhello">
                        <a href="PHP/logout.php" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                <path fill-rule="evenodd"
                                    d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <h1>Reseñas</h1>
<br><br><br><br><br><br><br><div 
class="carousel-container">
    <div class="carousel">
        <?php while ($comentario = mysqli_fetch_assoc($resultado)) { ?>
            <div class="carousel-item">
                <h3><em><?php echo htmlspecialchars($comentario['docente_nombre']); ?></em></h3>
                <p><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                <small>Fecha: <?php echo date('d/m/Y', strtotime($comentario['fecha'])); ?></small>
            </div>
        <?php } ?>
    </div>

    <!-- Navegación del carrusel -->
    <div class="carousel-nav">
        <button class="carousel-button" id="prev"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-button" id="next"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<style>
/* Estilos de la sección del carrusel */
.carousel-container {
    max-width: 800px;
    margin: 30px auto;
    overflow: hidden;
    position: relative;
    background: #ffffff;
    border: 2px solid #4CAF50;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-item {
    min-width: 100%;
    padding: 20px;
    box-sizing: border-box;
    text-align: center;
    background: #f9f9f9;
    border-bottom: 1px solid #ddd;
}

.carousel-item:last-child {
    border-bottom: none;
}

.carousel-item h3 {
    margin-bottom: 10px;
    font-size: 1.5rem;
    color: #2c3e50;
}

.carousel-item p {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.5;
}

.carousel-item small {
    display: block;
    margin-top: 10px;
    font-size: 0.9rem;
    color: #888;
}

/* Botones de navegación */
.carousel-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    z-index: 10;
}

.carousel-button {
    background: #2c3e50;
    color: #ecf0f1;
    border: none;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.carousel-button:hover {
    background: #4CAF50;
    transform: scale(1.1);
}

.carousel-button:active {
    transform: scale(0.95);
}

/* Iconos para botones */
.carousel-button i {
    font-size: 1.5rem;
}
</style>

<script>
    const carousel = document.querySelector('.carousel');
    const items = document.querySelectorAll('.carousel-item');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    let currentIndex = 0;

    function updateCarousel() {
        const width = items[0].clientWidth;
        carousel.style.transform = `translateX(${-currentIndex * width}px)`;
    }

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
        updateCarousel();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
        updateCarousel();
    });

    window.addEventListener('resize', updateCarousel);
    window.addEventListener('load', updateCarousel);
</script>


    <script>
        // Lógica para el carrusel
        const carousel = document.querySelector('.carousel');
        const items = document.querySelectorAll('.carousel-item');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        let currentIndex = 0;

        function updateCarousel() {
            const width = items[0].clientWidth;
            carousel.style.transform = `translateX(${-currentIndex * width}px)`;
        }

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
            updateCarousel();
        });

        // Ajustar el carrusel al cargar
        window.addEventListener('resize', updateCarousel);
        window.addEventListener('load', updateCarousel);
    </script>
</body>
</html>
