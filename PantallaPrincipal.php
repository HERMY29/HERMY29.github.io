<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

session_start();

// Consulta para obtener los puntajes
$sql = "SELECT player_name, score FROM scores ORDER BY score DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla Principal</title>
    <link rel="stylesheet" href="BreakstormProject/CSS/PaginaPrincipal.css">

    
</head>
<body>
    <div class="container">
        <img src="BreakstormProject/Img/BREAK-STORM-8-9-2024.png" alt="Logo del Juego" class="logo">

        <div id="mainMenuButtons" class="buttons show">
            <div class="buttons">
                <button class="cartoon-button" onclick="showGameModes()">Inicio</button>
                <button class="cartoon-button" onclick="showScores()">Puntuaciones</button>
                <button class="cartoon-button" onclick="showSettings()">Configuración</button>
            </div>
        </div>

        <!-- Botones de selección de modo de juego, inicialmente ocultos -->
        <div id="gameModeButtons" class="game-buttons" style="display: none;">
            <h1 id="gameModeTitle" style="opacity: 0;">Selecciona el modo de juego</h1>
            <div class="game-buttons">
                <button class="cartoon-button" onclick="showDifficultyButtons()">Solo</button>
                <button class="cartoon-button" onclick="location.href= 'BreakstormProject/Multijugador.php'">Multijugador</button>
            </div>
            <button class="cartoon-button" onclick="hideGameModes()" style="margin-top: 20px;">Atrás</button>
        </div>

        <!-- Botones de dificultad, inicialmente ocultos -->
        <div id="difficultyButtons" class="difficulty-buttons" style="display: none; margin-top: 20px; text-align: center;">
            <h2>Selecciona la dificultad</h2>
            <button class="cartoon-button" onclick="window.location.href='BreakstormProject/DificultadFacil.php'" style="animation-delay: 0s;">Fácil</button>
            <button class="cartoon-button" onclick="window.location.href='BreakstormProject/DificultadMedia.php'" style="animation-delay: 0.2s;">Media</button>
            <button class="cartoon-button" onclick="window.location.href='BreakstormProject/DificultadDificil.php'" style="animation-delay: 0.4s;">Difícil</button>
            <br>
            <button class="cartoon-button" onclick="goBackToGameModes()" style="margin-top: 20px;">Atrás</button>
        </div>

        <!-- Opciones de configuración, inicialmente ocultas -->
        <div id="settingsOptions" style="display: none; margin-top: 20px;">
            <h1>Configuraciones</h1>
            <div class="settings-option">
                <span>Musica</span>
                <div class="toggle-buttons" data-setting="sonido">
                    <button class="toggle-btn yes active">Sí</button>
                    <button class="toggle-btn no">No</button>
                </div>
            </div>
            <div class="settings-option">
                <span>Efectos de sonido</span>
                <div class="toggle-buttons" data-setting="efectos">
                    <button class="toggle-btn yes active">Sí</button>
                    <button class="toggle-btn no">No</button>
                </div>
            </div>
            <div class="settings-option">
                <span>Controles</span>
                <div class="toggle-buttons" data-setting="controles">
                    <button class="toggle-btn yes active">Flechas</button>
                    <button class="toggle-btn no">WASD</button>
                </div>
            </div>
            <button class="cartoon-button1" onclick="hideSettings()">Atrás</button>
        </div>

        <!-- Pantalla de puntuaciones, inicialmente oculta -->
        <div id="scoresScreen" style="display: none; text-align: center; margin-top: 20px;">
            <h1>Puntuaciones</h1>
            <div class="scores-box">
                <?php
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y crea filas para cada jugador y su puntaje
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="score-row">';
                        echo '<span class="player-name">' . htmlspecialchars($row['player_name']) . '</span>';
                        echo '<span class="score">' . htmlspecialchars($row['score']) . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No hay puntuaciones registradas.</p>';
                }
                ?>
            </div>
            <button class="cartoon-button1" onclick="hideScores()">Atrás</button>
        </div>
    </div>

    <audio id="backgroundMusic" autoplay loop>
        <source src="audio/background-music2.mp3" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const audio = document.getElementById("backgroundMusic");
            const yesButton = document.querySelector(".toggle-btn.yes");
            const noButton = document.querySelector(".toggle-btn.no");

            // Reproducir música por defecto (si está habilitada)
            audio.play().catch((e) => {
                console.warn("El navegador bloqueó el autoplay.");
            });

            // Función para pausar música
            const pauseMusic = () => {
                audio.pause();
                yesButton.classList.remove("active");
                noButton.classList.add("active");
            };

            // Función para reproducir música
            const playMusic = () => {
                audio.play().catch((e) => {
                    console.warn("No se puede reproducir la música automáticamente.");
                });
                yesButton.classList.add("active");
                noButton.classList.remove("active");
            };

            // Acción al hacer clic en "Sí" (activar música)
            yesButton.addEventListener("click", () => {
                playMusic();
            });

            // Acción al hacer clic en "No" (desactivar música)
            noButton.addEventListener("click", () => {
                pauseMusic();
            });
        });
    </script>

    <script>
        function showGameModes() {
            const mainMenu = document.getElementById('mainMenuButtons');
            const gameModes = document.getElementById('gameModeButtons');
            const title = document.getElementById('gameModeTitle');

            mainMenu.style.display = 'none'; // Ocultar menú principal
            gameModes.style.display = 'block'; // Mostrar botones de selección
            title.style.opacity = '1'; // Mostrar título de selección
            title.style.transition = 'opacity 0.5s ease';
        }

        function hideGameModes() {
            const mainMenu = document.getElementById('mainMenuButtons');
            const gameModes = document.getElementById('gameModeButtons');
            const title = document.getElementById('gameModeTitle');

            title.style.opacity = '0'; // Ocultar título
            gameModes.style.display = 'none'; // Ocultar botones de modo de juego
            mainMenu.style.display = 'block'; // Mostrar menú principal
            hideDifficultyButtons(); // Asegurarse de ocultar los botones de dificultad
        }

        function showDifficultyButtons() {
            const gameModes = document.getElementById('gameModeButtons');
            const difficultyButtons = document.getElementById('difficultyButtons');

            gameModes.style.display = 'none'; // Ocultar botones de modo de juego
            difficultyButtons.style.display = 'block'; // Mostrar botones de dificultad
        }

        function goBackToGameModes() {
            const difficultyButtons = document.getElementById('difficultyButtons');
            const gameModes = document.getElementById('gameModeButtons');

            difficultyButtons.style.display = 'none'; // Ocultar botones de dificultad
            gameModes.style.display = 'block'; // Mostrar botones de modo de juego
        }

        function showSettings() {
            const mainMenu = document.getElementById('mainMenuButtons');
            const settings = document.getElementById('settingsOptions');

            mainMenu.style.display = 'none'; // Ocultar menú principal
            settings.style.display = 'block'; // Mostrar opciones de configuración
        }

        function hideSettings() {
            const mainMenu = document.getElementById('mainMenuButtons');
            const settings = document.getElementById('settingsOptions');

            settings.style.display = 'none'; // Ocultar opciones de configuración
            mainMenu.style.display = 'block'; // Mostrar menú principal
        }

        function showScores() {
            const mainMenu = document.getElementById('mainMenuButtons');
            const scoresScreen = document.getElementById('scoresScreen');

            mainMenu.style.display = 'none'; // Ocultar menú principal
            scoresScreen.style.display = 'block'; // Mostrar pantalla de puntuaciones
        }

        function hideScores() {
            const mainMenu = document.getElementById('mainMenuButtons');
            const scoresScreen = document.getElementById('scoresScreen');

            scoresScreen.style.display = 'none'; // Ocultar pantalla de puntuaciones
            mainMenu.style.display = 'block'; // Mostrar menú principal
        }
    </script>

    <script src="./BreakstormProject/Js/S_Config.js"></script>
</body>
</html>
