<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
        <link href="https://fonts.cdnfonts.com/css/superhelio" rel="stylesheet">
        <link rel="stylesheet" href="estilo.css">
        <title>PoKedeX!</title>
    </head>
    <body>
        <audio controls autoplay loop class="audio" style="display: none;">
            <source src="media/pokeSong2.mp3" type="audio/mp3"></audio>

        <img id="char" alt="logo" src="img/charizard.png">
        <img id="char1" alt="logo" src="img/charizard.png">
        <h1> Pokemon Rojo Fuego <img id="pkb" alt="logo" src="img/pokebola.png"> Pokedex </h1>
        
        <?php
        /**
        * Script que muestra una Pokédex de 20 entradas utilizando datos de la API de Pokemon.
        * Este Script no contiene funciones.
        *
        * 1) Se accede a la URL de la API para la lista de pokemon y se decodifica el JSON.
        *
        * 2) Se recorren los resultados del objeto decodificado para obtener las URL de cada Pokemon
        *    que contienen en ellas sus datos.
        *
        * 3) Se accede a las propiedades que contienen los datos para poder imprimirlas.
        *
        *4) Por cada vuelta, el bucle imprime los resultados en HTML.
        */

            // En esta URL están los 20 pokemons y sus resultados:
            $poke_json = file_get_contents("https://pokeapi.co/api/v2/pokemon");
            $poke = json_decode($poke_json);
            //var_dump($poke); 

            // Los detalles están realmente en la URL de $poke->results
            // Se recorren los resultados para extraer el ID de la URL para los detalles de cada pokemon
            $pokeID=1;
            foreach ($poke->results as $pokeDatos) {
                $pokeD_json = file_get_contents("https://pokeapi.co/api/v2/pokemon/". $pokeID);
                $pokeDato = json_decode($pokeD_json);

                //Accediendo a las propiedades de los pokeDatos:
                $pokeName = $pokeDato->species->name;
                $pokeImg = $pokeDato->sprites->front_default;
                $pokeImg1 = $pokeDato->sprites->back_default;
                $pokeImg2 = $pokeDato->sprites->front_shiny;
                $pokePeso = $pokeDato->weight;
                $pokeTipo = $pokeDato->types[0]->type->name;
                $pokeHab = $pokeDato->abilities[0]->ability->name;
                $pokeMov = $pokeDato->moves[0]->move->name;
                $pokeMov1 = $pokeDato->moves[1]->move->name;
                $pokeMov2 = $pokeDato->moves[2]->move->name;
                $pokeMov3 = $pokeDato->moves[3]->move->name;

                // Comprobar si existen tipos o habilidades extra:
                $pokeTipo1 = "";
                if (isset($pokeDato->types[1])){
                    $pokeType1 = ", " . $pokeDato->types[1]->type->name;
                } 
                $pokeHab1 = "";
                $pokeHab2 = "";
                if (isset($pokeDato->abilities[1])){
                    $pokeHab1 = ", ".$pokeDato->abilities[1]->ability->name;
                }
                if (isset($pokeDato->abilities[2])){
                    $pokeHab2 = ", ".$pokeDato->abilities[2]->ability->name;
                }

                // El bucle imprime el HTML con sus resultados por cada vuelta
        ?>
                <div id="box">
                    <a href="https://pokeapi.co/api/v2/pokemon/<?php echo $pokeID; ?>" target="_blank">
                        <h2><img id="h2Img" alt="gif" src="img/pokeball-throwing.gif"><b>
                            <?php echo strtoupper($pokeName); ?></b></h2>
                    </a>

                    <p><b class="txt">Tipo: </b><?php echo $pokeTipo . $pokeTipo1; ?></p>
                    <p><b class="txt">Peso: </b><?php echo $pokePeso; ?> Kg</p>
                    <p><b class="txt">Habilidades: </b><?php echo $pokeHab . $pokeHab1. $pokeHab2; ?></p>
                    <p><b class="txt">Movimientos: </b><?php echo $pokeMov.", ". $pokeMov1."<br>"
                        . $pokeMov2.", ". $pokeMov3; ?></p>

                    <div>
                    <p id="audioTxt">Escucha el rugido de <?php echo $pokeName; ?></p>
                    <audio controls class="audio">
                        <source src="<?php echo 
                        "https://raw.githubusercontent.com/PokeAPI/cries/main/cries/pokemon/latest/"
                            . $pokeID . ".ogg"; ?>" type="audio/ogg">
                    </audio>
                    </div>
                        
                    <div id="box1">
                        <img class="pokeImg" alt="pokeImagen" src='<?php echo $pokeImg; ?>'>
                    </div>
                    <div id="box2">
                        <img class="pokeImg" alt="pokeImagen" src='<?php echo $pokeImg1; ?>'>
                    </div>
                </div>

            <?php //Incremento de la pokeID
                  $pokeID++;
            }
        ?>

        <footer>
            GameBoyAdvance <img alt="gif" id="pie" src="img/pokemonashq.gif"> Pokemon® 2004
            <br> Alba Tolosa Bonora <img alt="gif" id="pie1" src="img/pokeball.gif"> 29216542-X&copy; 2024
        </footer>
    </body>
</html>