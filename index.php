<?php 

    include './config.php';

    //Instantiate curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://pokeapi.co/api/v2/pokemon?limit=151');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);

    //Json decode
    $data = json_decode($data);

    //Show data
    echo '<pre>';
    var_dump($data);
    echo '</pre>';

    // Get array keys
    $number = $data->results

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
</head>
<body>
    <h1>Pokedex</h1>
    <?php foreach($number as $key => $test) { ?>
        <?php 
            // Get the url of each pokemon
            $url = $test->url;
            // Split the url
            $parts = explode('/', $url);
            // Get the second last part of the url
            $pokemonId = $parts[count($parts) - 2];
            // Dynamic URL image
            $image = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$pokemonId.png";
        ?>
        <img src="<?= $image ?>" alt="<?= ucfirst($test->name) ?>">
        <ul>
            <li><?= ucfirst($test->name) ?></li>
            <p>N°<?= $pokemonId ?></p>
            <a href="./pokemon.php?detail=<?= $test->name.'/'.$pokemonId ?>">Voir plus</a>
        </ul>
    <?php } ?>

</body>
</html>