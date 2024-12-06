<?php
// Incluye la conexión a la base de datos y las funciones CRUD
require 'database.php';
require 'destinos.php';
require 'guias.php';
require 'hoteles.php';
require 'reserva.php';

// Procesa las solicitudes POST para las operaciones CRUD
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        createDestino($_POST["nombre"], $_POST["descripcion"], $_POST["ubicacion"], $_POST["precio_estimado"]);
    } elseif (isset($_POST["update"])) {
        updateDestino($_POST["id"], $_POST["nombre"], $_POST["descripcion"], $_POST["ubicacion"], $_POST["precio_estimado"]);
    } elseif (isset($_POST["delete"])) {
        deleteDestino($_POST["id"]);
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        createGuias($_POST["nombre"], $_POST["edad"],$_POST ["especialidad"],$_POST["num_telefono"],$_POST["correo"] ,$_POST["precio"]); 
    } elseif (isset($_POST["update"])) {
        updateGuias($_POST["id"], $_POST["nombre"],  $_POST["edad"],$_POST ["especialidad"],$_POST["num_telefono"],$_POST["correo"] ,$_POST["precio"]);
    } elseif (isset($_POST["delete"])) {
        deleteGuias($_POST["id"]);
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        createHoteles($_POST["nombre"], $_POST["descripcion"],$_POST["ubicacion"] ,$_POST["precio_por_noche"] ,$_POST["precio_por_dia"],$_POST["estrellas"]); 
    } elseif (isset($_POST["update"])) {
        updateHoteles($_POST["id"], $_POST["nombre"], $_POST["descripcion"],$_POST["ubicacion"] ,$_POST["precio_por_noche"] ,$_POST["precio_por_dia"],$_POST["estrellas"]);
    } elseif (isset($_POST["delete"])) {
        deleteHoteles($_POST["id"]);
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        createReservas($_POST["nombre"], $_POST ["anticipo"]); 
    } elseif (isset($_POST["update"])) {
        updateReservas($_POST["id"],$_POST_["nombre"],$_POST ["anticipo"]);
    } elseif (isset($_POST["delete"])) {
        deleteReservas($_POST["id"]);
    }
}
// Obtiene los destinos para mostrarlos en la tabla
$destinos = getDestinos();
$guias = getGuias();
$hoteles= getHoteles();
$reserva = getReservas();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo_Yucatan</title>
    <style>
  body {
            background-color: #ffe4e1; /* Fondo rosado */
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    margin: 0;
    padding: 0;
    color: #4c4446;
}

/* Encabezado */
header {
    background-color: #f37f92; /* Rosado */
    background-image: url('yucatan.jpg'); /* Cambia a la ruta de tu imagen */
    text-align: center;
    padding: 20px;
    border-bottom: 0px solid #f96b85;
}

header h1 {
    color: #e6d5d5; /* Gris */
    font-size: 30px;
    text-align: center;
    margin: 0;
}

header p {
    margin-top: 50px;
    font-size: 50px;
    color: #ffffff;
}

/* Navegación */
nav {
    text-align: center;
    margin: 20px 0;
}

nav a {
    text-decoration: none;
    color: #ffffff;
    background-color: #f77092; /* Rosado fuerte */
    padding: 10px 15px;
    margin: 5px;
    border-radius: 5px;
    display: inline-block;
}

nav a:hover {
    background-color: #ff8793; /* Más oscuro al pasar */
}

/* Estilo del video */
video {
    display: block;
    margin: 20px auto;
    border: 2px solid #ffc0cb;
    border-radius: 10px;
}
/* Estilo para el encabezado */
header {
    background-image: url('images/header-background.jpg'); /* Cambia a la ruta de tu imagen */
    background-size: cover;
    background-position: center;
    padding: 50px;
    color: #ffffff;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
}

/* Tabla de lugares turísticos */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px auto;
    text-align: left;
    font-size: 1em;
    background-color: #ffe4e1;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ccc;
}

table th {
    background-color: #ffc0cb;
    color: #333;
    text-align: center;
}

table td img {
    display: block;
    margin: 0 auto;
    border-radius: 8px;
}
.descripcion-coloradas {
    text-align: center;
    margin: 20px 0;
    padding: 10px;
    background-color: #ffffff; /* Fondo rosado claro */
    border: 1px solid #ff95a6; /* Borde rosado */
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.descripcion-coloradas h3 {
    font-size: 24px;
    color: #333; /* Color oscuro para el título */
    margin: 10px 0;
}

.descripcion-coloradas p {
    font-size: 16px;
    color: #555; /* Color más suave para el texto */
    line-height: 1.6;
    margin: 10px 20px;
}
.imagenes-laterales {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
    gap: 20px;
}

/* Imágenes laterales pequeñas */
.imagen-lateral img {
    width: 150px; /* Tamaño pequeño para los flamencos */
    height: auto;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* Imagen central (Las Coloradas) */
.imagen-central img {
    width: 60%;  /* Reduce el tamaño de la imagen al 60% */
    height: auto;
    border-radius: 12px;
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
    display: block;
    margin: 0 auto; /* Centra la imagen horizontalmente */
}
/* Estilos generales para los cuadros */
.cuadro-lugares, .cuadro-cantos {
    background-color: #fff0f5; /* Fondo rosado claro */
    border: 1px solid #ffc0cb; /* Borde rosado */
    border-radius: 10px;
    margin: 20px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.cuadro-lugares h2, .cuadro-cantos h2 {
    text-align: center;
    color: #fc93bb; /* Color rosado fuerte para el título */
    font-size: 24px;
    margin-bottom: 15px;
}

/* Estilo del contenido dentro de cada cuadro */
.contenido-cuadro {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    text-align: center;
}

/* Estilo del video */
video {
    width: 80%; /* Ajusta el tamaño del video */
    max-width: 600px;
    border-radius: 8px;
}

/* Estilo del párrafo */
.cuadro-lugares p, .cuadro-cantos p {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
}
/* Cuadro con información de cada lugar */
.cuadro-lugar {
    background-color: #fff0f5; /* Fondo rosado claro */
    border: 1px solid #ffc0cb; /* Borde rosado */
    border-radius: 10px;
    margin: 20px;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.cuadro-lugar h2 {
    color: #585858; /* Color rosado fuerte para el título */
    font-size: 24px;
    margin-bottom: 15px;
}

.cuadro-lugar img {
    width: 100%; /* Ajusta el tamaño de la imagen */
    max-width: 500px; /* Limita el tamaño máximo */
    height: auto;
    border-radius: 8px;
}

.cuadro-lugar h3 {
    font-size: 20px;
    color: #f58eb0; /* Títulos en rosado fuerte */
    margin-top: 10px;
}

.cuadro-lugar ul {
    list-style-type: none;
    padding: 0;
}

.cuadro-lugar ul li {
    background-color: #f08080; /* Fondo rosado más oscuro */
    color: white;
    padding: 8px;
    margin: 5px 0;
    border-radius: 5px;
}

.cuadro-lugar ul li:hover {
    background-color: #ff7f7f; /* Más oscuro al pasar el ratón */
}

    </style>
</head>
<body>

    <h1>Organiza tu viaje feliz y despreocupado</h1>

    <nav>
        <ul>
            <li><a onclick="showSection('inicio')">Inicio</a></li>
            <li><a onclick="showSection('crud1')">Reservas</a></li>
            <li><a onclick="showSection('crud2')">Hoteles</a></li>
            <li><a onclick="showSection('crud3')">Guías</a></li>
            <li><a onclick="showSection('comentarios')">Comentarios</a></li>
            <li><a onclick="showSection('crud')">Destinos</a></li>
        </ul>
    </nav>

    <div id="inicio" class="section" style="display: block;">
        <h2>¡Descubre los encantos, la cultura y la historia de Yucatán!</h2>
        <p>Encuentra los mejores destinos turísticos, hospedaje y guías para tu próxima aventura.</p>
        <section>
        <h2>Lugares Lindos De Yucatán</h2>
        <table>
            <thead>
                <tr>
                    <th>Lugar</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Chichén Itzá</td>
                    <td>Una de las siete maravillas del mundo moderno y una joya arqueológica de la cultura maya.</td>
                    <td><img src="chichen-itza.jpg" alt="Chichén Itzá" width="150"></td>
                </tr>
                <tr>
                    <td>Cenote Ik Kil</td>
                    <td>Un cenote majestuoso rodeado de exuberante vegetación y cascadas naturales.</td>
                    <td><img src="cenote-ik-kil.jpg" alt="Cenote Ik Kil" width="150"></td>
                </tr>
                <tr>
                    <td>Mérida</td>
                    <td>La capital cultural de Yucatán, conocida por su arquitectura colonial y tradiciones.</td>
                    <td><img src="merida.jpg" alt="Mérida" width="150"></td>
                </tr>
                <tr>
                    <td>Uxmal</td>
                    <td>Un impresionante sitio arqueológico maya, famoso por su arquitectura Puuc.</td>
                    <td><img src="uxmal.jpg" alt="Uxmal" width="150"></td>
                </tr>
                <tr>
                    <td>Cenote Suytun</td>
                    <td>Un cenote único con una plataforma que parece flotar sobre el agua cristalina.</td>
                    <td><img src="cenote-suytun.jpg" alt="Cenote Suytun" width="150"></td>
                </tr>
                <tr>
                    <td>Celestún</td>
                    <td>Una reserva natural famosa por sus flamencos rosados y paisajes costeros.</td>
                    <td><img src="celestun.jpg" alt="Celestún" width="150"></td>
                </tr>
                <tr>
                    <td>Valladolid</td>
                    <td>Un pintoresco pueblo mágico con calles coloniales y cenotes cercanos.</td>
                    <td><img src="valladolid.jpg" alt="Valladolid" width="150"></td>
                </tr>
                <tr>
                    <td>Izamal</td>
                    <td>Conocido como la "Ciudad de las Tres Culturas" y famoso por sus edificios amarillos.</td>
                    <td><img src="izamal.jpg" alt="Izamal" width="150"></td>
                </tr>
                <tr>
                    <td>Playa Progreso</td>
                    <td>Una hermosa playa cercana a Mérida, ideal para relajarse y disfrutar del mar.</td>
                    <td><img src="progreso.jpg" alt="Playa Progreso" width="150"></td>
                </tr>
                <tr>
                    <td>Ek Balam</td>
                    <td>Un sitio arqueológico con una de las estructuras mayas mejor conservadas.</td>
                    <td><img src="ek-balam.jpg" alt="Ek Balam" width="150"></td>
                </tr>
                <tr>
                    <td>Grutas de Loltún</td>
                    <td>Fascinantes cuevas con arte rupestre y formaciones naturales espectaculares.</td>
                    <td><img src="loltun.jpg" alt="Grutas de Loltún" width="150"></td>
                </tr>
                <tr>
                    <td>Ría Lagartos</td>
                    <td>Una reserva natural que alberga una increíble diversidad de fauna, incluyendo flamencos.</td>
                    <td><img src="ria-lagartos.jpg" alt="Ría Lagartos" width="150"></td>
                </tr>
                <tr>
                    <td>Hacienda Yaxcopoil</td>
                    <td>Una hacienda histórica que ofrece una visión del pasado henequenero de Yucatán.</td>
                    <td><img src="yaxcopoil.jpg" alt="Hacienda Yaxcopoil" width="150"></td>
                </tr>
            </tbody>
        </table>
    </section>
    <section class="imagenes-laterales">
        <div class="imagen-lateral">
            <img src="flamencos.png" alt="Flamencos" />
        </div>
        <div class="imagen-central">
            <img src="las-coloradas.jpg" alt="Las Coloradas" />
        </div>
        <div class="imagen-lateral">
            <img src="flamencos.png" alt="Flamencos" />
        </div>

    </section>
    
    <!-- Título y descripción de Las Coloradas -->
    <section class="descripcion-coloradas">
        <h3>Las Coloradas</h3>
        <p>
            Las Coloradas es un lugar único en Yucatán, famoso por sus lagunas rosas
            que son resultado de la alta concentración de sal y microorganismos.
            Es un destino ideal para los amantes de la naturaleza y la fotografía,
            rodeado de paisajes impresionantes y flamencos.
        </p>
    </section>

    <section class="cuadro-lugares">
        <h2>Lugares Más Lindos y Con Riqueza Cultural de Yucatán</h2>
        <div class="contenido-cuadro">
            <video controls>
                <source src="15 mejores lugares turísticos de Yucatán.mp4" type="video/mp4">
            </video>
            <p>
                Yucatán es un estado lleno de historia y belleza natural. Desde las antiguas ruinas mayas de Chichen Itzá,
                hasta sus hermosas playas y selvas, cada rincón de Yucatán ofrece una mezcla perfecta de cultura, historia
                y belleza. No te puedes perder los cenotes, las haciendas y los coloridos pueblos que hacen de este lugar
                un destino único en México.
            </p>
        </div>
    </section>
    
    <!-- Cuadro 2: Los Lindos Cantos de Yucatán -->
    <section class="cuadro-cantos">
        <h2>Estos Son Los Lindos Cantos de Yucatán</h2>
        <div class="contenido-cuadro">
            <video controls>
                <source src="Aires Del Mayab-Estela Núñez.mp3" type="audio/mp3">
            </video>
            <p>
                La música tradicional de Yucatán es un tesoro que combina influencias mayas con la música española. Los
                cantos, danzas y sonidos de marimba acompañan a las festividades locales y son un reflejo del alma
                yucateca. Escuchar estos cantos es como sumergirse en una atmósfera mágica llena de historia y emoción.
            </p>
        </div>

    </section>
    </div>

    <div id="reservas" class="section">
        <h2>Reservas</h2>
        <p>Aquí puedes hacer tus reservas para los mejores destinos turísticos.</p>
    </div>

    <div id="hoteles" class="section">
        <h2>Hoteles Recomendados</h2>
        <p>Aquí puedes encontrar una lista de hoteles recomendados para tu estancia en cada destino.</p>
        <style>
        /* Estilos para las columnas de los hoteles */
        .hoteles-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin: 20px;
            flex-wrap: wrap;
        }

        .hotel-cuadro {
            border: 2px solid #f08080;
            border-radius: 10px;
            padding: 20px;
            width: 45%;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .hotel-cuadro img {
            width: 100%;
            border-radius: 10px;
        }

        .rating {
            color: gold;
            font-size: 18px;
        }

        .button {
            background-color: #f08080;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #ff7f7f;
        }

        .formulario {
            margin-top: 20px;
        }

        .formulario input, .formulario textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .formulario button {
            background-color: #f08080;
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .formulario button:hover {
            background-color: #ff7f7f;
        }

        .volver-inicio {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Hoteles Recomendados en Yucatán</h1>
    </header>

    <!-- Sección de los primeros 3 hoteles -->
    <section class="hoteles-container">
        <!-- Cuadro del primer hotel (izquierda) -->
        <div class="hotel-cuadro">
            <h3>Hotel Gran Yucatán</h3>
            <img src="hotelgranyucatan.jpg" alt="Hotel Gran Yucatán">
            <p>Un hotel de lujo en Mérida.</p>
            <p>Precio por noche: $100 USD | Restaurante y Piscina: Sí</p>
            <p>Horario: 24 horas</p>
            <div class="rating">★★★★☆</div>

            <!-- Formulario para calificación y comentario -->
            <div class="formulario">
                <h4>Califica este hotel</h4>
                <label for="rating1">Estrellas:</label>
                <input type="number" id="rating1" name="rating1" min="1" max="5" placeholder="1-5 estrellas">
                <label for="comment1">Comentario:</label>
                <textarea id="comment1" name="comment1" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button type="submit">Enviar Comentario</button>
            </div>
        </div>

        <!-- Cuadro del segundo hotel (derecha) -->
        <div class="hotel-cuadro">
            <h3>Hotel Hacienda Xcanatun</h3>
            <img src="hotel-hacienda-xcanatun.jpg" alt="Hotel Hacienda Xcanatun">
            <p>Un hotel colonial con un hermoso paisaje natural.</p>
            <p>Precio por noche: $120 USD | Restaurante y Piscina: Sí</p>
            <p>Horario: 24 horas</p>
            <div class="rating">★★★★★</div>

            <!-- Formulario para calificación y comentario -->
            <div class="formulario">
                <h4>Califica este hotel</h4>
                <label for="rating2">Estrellas:</label>
                <input type="number" id="rating2" name="rating2" min="1" max="5" placeholder="1-5 estrellas">
                <label for="comment2">Comentario:</label>
                <textarea id="comment2" name="comment2" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button type="submit">Enviar Comentario</button>
            </div>
        </div>
    </section>

    <!-- Sección de los siguientes 3 hoteles -->
    <section class="hoteles-container">
        <!-- Cuadro del tercer hotel (izquierda) -->
        <div class="hotel-cuadro">
            <h3>Hotel Casa Blanca Boutique</h3>
            <img src="hotelcasablancaboutique.jpg" alt="Hotel Casa Blanca Boutique">
            <p>Un pequeño pero encantador hotel en el centro de Mérida.</p>
            <p>Precio por noche: $80 USD | Restaurante y Piscina: No</p>
            <p>Horario: 24 horas</p>
            <div class="rating">★★★☆☆</div>

            <!-- Formulario para calificación y comentario -->
            <div class="formulario">
                <h4>Califica este hotel</h4>
                <label for="rating3">Estrellas:</label>
                <input type="number" id="rating3" name="rating3" min="1" max="5" placeholder="1-5 estrellas">
                <label for="comment3">Comentario:</label>
                <textarea id="comment3" name="comment3" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button type="submit">Enviar Comentario</button>
            </div>
        </div>

        <!-- Cuadro del cuarto hotel (derecha) -->
        <div class="hotel-cuadro">
            <h3>Hotel The Royal Palms</h3>
            <img src="hotelroyalpalms.jpg" alt="Hotel The Royal Palms">
            <p>Un resort de lujo ideal para una experiencia relajante.</p>
            <p>Precio por noche: $150 USD | Restaurante y Piscina: Sí</p>
            <p>Horario: 24 horas</p>
            <div class="rating">★★★★★</div>

            <!-- Formulario para calificación y comentario -->
            <div class="formulario">
                <h4>Califica este hotel</h4>
                <label for="rating4">Estrellas:</label>
                <input type="number" id="rating4" name="rating4" min="1" max="5" placeholder="1-5 estrellas">
                <label for="comment4">Comentario:</label>
                <textarea id="comment4" name="comment4" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button type="submit">Enviar Comentario</button>
            </div>
        </div>
    </section>

    <!-- Sección de los 3 últimos hoteles -->
    <section class="hoteles-container">
        <!-- Cuadro del quinto hotel (izquierda) -->
        <div class="hotel-cuadro">
            <h3>Hotel Boutique Casa Azul</h3>
            <img src="hotelboutiquecasaazul.jpg" alt="Hotel Boutique Casa Azul">
            <p>Un hotel boutique con un diseño único en el corazón de Mérida.</p>
            <p>Precio por noche: $110 USD | Restaurante y Piscina: Sí</p>
            <p>Horario: 24 horas</p>
            <div class="rating">★★★★☆</div>

            <!-- Formulario para calificación y comentario -->
            <div class="formulario">
                <h4>Califica este hotel</h4>
                <label for="rating5">Estrellas:</label>
                <input type="number" id="rating5" name="rating5" min="1" max="5" placeholder="1-5 estrellas">
                <label for="comment5">Comentario:</label>
                <textarea id="comment5" name="comment5" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button type="submit">Enviar Comentario</button>
            </div>
        </div>

        <!-- Cuadro del sexto hotel (derecha) -->
        <div class="hotel-cuadro">
            <h3>Hotel El Moloch</h3>
            <img src="hotelelmoloch.jpg" alt="Hotel El Moloch">
            <p>Un hotel acogedor cerca de los cenotes de Yucatán.</p>
            <p>Precio por noche: $90 USD | Restaurante y Piscina: Sí</p>
            <p>Horario: 24 horas</p>
            <div class="rating">★★★☆☆</div>

            <!-- Formulario para calificación y comentario -->
            <div class="formulario">
                <h4>Califica este hotel</h4>
                <label for="rating6">Estrellas:</label>
                <input type="number" id="rating6" name="rating6" min="1" max="5" placeholder="1-5 estrellas">
                <label for="comment6">Comentario:</label>
                <textarea id="comment6" name="comment6" rows="4" placeholder="Escribe tu comentario aquí..."></textarea>
                <button type="submit">Enviar Comentario</button>
            </div>
        </div>
    </section>

    <!-- Opción para volver al inicio -->
    <div class="volver-inicio">
        <a href="index.html" class="button">Volver al Inicio</a>
    </div>

    <div id="guias" class="section">
        <h2>Guías Turísticas</h2>
        <p>Contrata guías expertos que te ayudarán a explorar los destinos más fascinantes.</p>
        <style>
        /* Estilos para la organización de los cuadros de guías */
        .guia-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin: 20px;
            flex-wrap: wrap;
        }

        .guia-cuadro {
            border: 2px solid #f08080;
            border-radius: 10px;
            padding: 20px;
            width: 45%;
            background-color: #fff;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .guia-cuadro img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .button {
            background-color: #f08080;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #ff7f7f;
        }

        .guia-cuadro h3 {
            margin-top: 10px;
        }

        .guia-cuadro p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Guías Expertos</h1>
    </header>

    <!-- Sección de los primeros guías -->
    <section class="guia-container">
        <!-- Primer guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Carlos Pérez">
            <h3>Guía Carlos Pérez</h3>
            <p><strong>Especialidad:</strong> Zonas arqueológicas</p>
            <p><strong>Idiomas:</strong> Español, Inglés</p>
            <p><strong>Edad:</strong> 35 años</p>
            <p><strong>Horario:</strong> 9 am - 6 pm</p>
        </div>

        <!-- Segundo guía (derecha) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Ana Rodríguez">
            <h3>Guía Ana Rodríguez</h3>
            <p><strong>Especialidad:</strong> Cultura y tradiciones</p>
            <p><strong>Idiomas:</strong> Español, Francés</p>
            <p><strong>Edad:</strong> 28 años</p>
            <p><strong>Horario:</strong> 10 am - 5 pm</p>
        </div>
    </section>

    <!-- Sección de los siguientes guías -->
    <section class="guia-container">
        <!-- Tercer guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Luis Gómez">
            <h3>Guía Luis Gómez</h3>
            <p><strong>Especialidad:</strong> Naturaleza y fauna</p>
            <p><strong>Idiomas:</strong> Español, Inglés, Italiano</p>
            <p><strong>Edad:</strong> 42 años</p>
            <p><strong>Horario:</strong> 8 am - 4 pm</p>
        </div>

        <!-- Cuarto guía (derecha) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Marta López">
            <h3>Guía Marta López</h3>
            <p><strong>Especialidad:</strong> Historia colonial</p>
            <p><strong>Idiomas:</strong> Español, Alemán</p>
            <p><strong>Edad:</strong> 39 años</p>
            <p><strong>Horario:</strong> 9 am - 7 pm</p>
        </div>
    </section>

    <!-- Sección de los siguientes guías -->
    <section class="guia-container">
        <!-- Quinto guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Sofía Martínez">
            <h3>Guía Sofía Martínez</h3>
            <p><strong>Especialidad:</strong> Arquitectura maya</p>
            <p><strong>Idiomas:</strong> Español, Portugués</p>
            <p><strong>Edad:</strong> 30 años</p>
            <p><strong>Horario:</strong> 9 am - 6 pm</p>
        </div>

        <!-- Sexto guía (derecha) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Juan Pérez">
            <h3>Guía Juan Pérez</h3>
            <p><strong>Especialidad:</strong> Turismo de aventura</p>
            <p><strong>Idiomas:</strong> Español, Inglés</p>
            <p><strong>Edad:</strong> 33 años</p>
            <p><strong>Horario:</strong> 8 am - 4 pm</p>
        </div>
    </section>

    <!-- Sección de los siguientes guías -->
    <section class="guia-container">
        <!-- Séptimo guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Elena Sánchez">
            <h3>Guía Elena Sánchez</h3>
            <p><strong>Especialidad:</strong> Senderismo y ecoturismo</p>
            <p><strong>Idiomas:</strong> Español, Inglés</p>
            <p><strong>Edad:</strong> 27 años</p>
            <p><strong>Horario:</strong> 7 am - 3 pm</p>
        </div>

        <!-- Octavo guía (derecha) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Ricardo Vargas">
            <h3>Guía Ricardo Vargas</h3>
            <p><strong>Especialidad:</strong> Rutas gastronómicas</p>
            <p><strong>Idiomas:</strong> Español, Italiano</p>
            <p><strong>Edad:</strong> 40 años</p>
            <p><strong>Horario:</strong> 10 am - 5 pm</p>
        </div>
    </section>

    <!-- Sección final de guías -->
    <section class="guia-container">
        <!-- Noveno guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Javier Hernández">
            <h3>Guía Javier Hernández</h3>
            <p><strong>Especialidad:</strong> Zonas costeras</p>
            <p><strong>Idiomas:</strong> Español, Francés</p>
            <p><strong>Edad:</strong> 45 años</p>
            <p><strong>Horario:</strong> 9 am - 6 pm</p>
        </div>

        <!-- Décimo guía (derecha) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Isabel Fernández">
            <h3>Guía Isabel Fernández</h3>
            <p><strong>Especialidad:</strong> Rutas culturales y arte</p>
            <p><strong>Idiomas:</strong> Español, Inglés, Alemán</p>
            <p><strong>Edad:</strong> 38 años</p>
            <p><strong>Horario:</strong> 8 am - 4 pm</p>
        </div>
    </section>

    <!-- Sección de guías adicionales -->
    <section class="guia-container">
        <!-- Undécimo guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Pedro García">
            <h3>Guía Pedro García</h3>
            <p><strong>Especialidad:</strong> Zoología y fauna local</p>
            <p><strong>Idiomas:</strong> Español, Inglés, Alemán</p>
            <p><strong>Edad:</strong> 50 años</p>
            <p><strong>Horario:</strong> 9 am - 5 pm</p>
        </div>

        <!-- Duodécimo guía (derecha) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Lucía Ramírez">
            <h3>Guía Lucía Ramírez</h3>
            <p><strong>Especialidad:</strong> Arqueología y historia</p>
            <p><strong>Idiomas:</strong> Español, Italiano</p>
            <p><strong>Edad:</strong> 32 años</p>
            <p><strong>Horario:</strong> 8 am - 4 pm</p>
        </div>
    </section>

    <!-- Sección final con más guías -->
    <section class="guia-container">
        <!-- Decimotercer guía (izquierda) -->
        <div class="guia-cuadro">
            <img src="mujer.jpg" alt="Guía Rosa Salazar">
            <h3>Guía Rosa Salazar</h3>
            <p><strong>Especialidad:</strong> Ecoturismo y reservas naturales</p>
            <p><strong>Idiomas:</strong> Español, Inglés</p>
            <p><strong>Edad:</strong> 29 años</p>
            <p><strong>Horario:</strong> 7 am - 3 pm</p>
        </div>

        <!-- Decimocuarto guía (derecha) -->
        <div class="guia-cuadro">
            <img src="hombre.jpg" alt="Guía Andrés Díaz">
            <h3>Guía Andrés Díaz</h3>
            <p><strong>Especialidad:</strong> Actividades extremas</p>
            <p><strong>Idiomas:</strong> Español, Inglés, Francés</p>
            <p><strong>Edad:</strong> 34 años</p>
            <p><strong>Horario:</strong> 8 am - 5 pm</p>
        </div>
    </section>
 <!-- Opción para volver al inicio -->
 <div class="volver-inicio">
    <a href="index.html" class="button">Volver al Inicio</a>
</div>
<div id="hoteles" class="section">
        <h2>Comentarios</h2>
        <style>
        /* Centrado del contenido principal */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        #comentarios {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #comentario-form {
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        #nuevo-comentario {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #f08080;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff7f7f;
        }

        #gracias {
            text-align: center;
            margin-top: 20px;
        }

        #gracias img {
            width: 200px;
            height: auto;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Comentarios de Viajeros</h1>
    </header>

    <div id="comentarios">
        <p><strong>María:</strong> Me encantó Yucatán.</p>
    </div>

    <div id="comentario-form">
        <textarea id="nuevo-comentario" placeholder="Escribe tu comentario..."></textarea>
        <button onclick="agregarComentario()">Enviar</button>
    </div>

    <div id="gracias">
        <p>¡Gracias, vuelva pronto!</p>
        <img src="gracias-image.jpg" alt="Gracias Vuelva Pronto">
    </div>

    <script>
        function agregarComentario() {
            const comentario = document.getElementById("nuevo-comentario").value;
            if (comentario.trim() !== "") {
                const comentarioDiv = document.createElement("div");
                comentarioDiv.innerHTML = `<p><strong>Nuevo viajero:</strong> ${comentario}</p>`;
                document.getElementById("comentarios").appendChild(comentarioDiv);
                document.getElementById("nuevo-comentario").value = ""; // Limpiar el campo de texto
            } else {
                alert("Por favor, escribe un comentario.");
            }
        }
        
    </script>
     <div class="volver-inicio">
        <a href="index.html" class="button">Volver al Inicio</a>
    </div>
    <div id="contacto" class="section">
        <h2>Contáctanos</h2>
        <form action="enviar_contacto.php" method="post">
            <p>Nombre: <input type="text" name="nombre" required></p>
            <p>Email: <input type="email" name="email" required></p>
            <p>Mensaje: <textarea name="mensaje" rows="4" required></textarea></p>
            <p><input type="submit" value="Enviar"></p>
        </form>
    </div>

    <div id="crud" class="section">
        <h2>Administración de Destinos Turísticos</h2>

        <h3>Agregar Destino</h3>
        <form method="post">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Descripción: <textarea name="descripcion" required></textarea></label>
            <label>Ubicación: <input type="text" name="ubicacion" required></label>
            <label>Precio Estimado: <input type="number" step="0.01" name="precio_estimado" required></label>
            <button type="submit" name="create">Agregar</button>
        </form>

        <h3>Actualizar Destino</h3>
        <form method="post">
            <label>ID: <input type="number" name="id" required></label>
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Descripción: <textarea name="descripcion" required></textarea></label>
            <label>Ubicación: <input type="text" name="ubicacion" required></label>
            <label>Precio Estimado: <input type="number" step="0.01" name="precio_estimado" required></label>
            <button type="submit" name="update">Actualizar</button>
        </form>

        <h3>Eliminar Destino</h3>
        <form method="post">
            <label>ID: <input type="number" name="id" required></label>
            <button type="submit" name="delete">Eliminar</button>
        </form>

        <h3>Lista de Destinos Turísticos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Precio Estimado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinos as $destino): ?>
                <tr>
                    <td><?php echo $destino["id"]; ?></td>
                    <td><?php echo $destino["nombre"]; ?></td>
                    <td><?php echo $destino["descripcion"]; ?></td>
                    <td><?php echo $destino["ubicacion"]; ?></td>
                    <td><?php echo $destino["precio_estimado"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>

</body>
</html>