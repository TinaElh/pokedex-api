<?php 

    $detail = $_GET['detail'];
    $split = explode('/', $detail);
    $id = $split[1];
    $pokemonName = $split[0];

    //Instantiate curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/$id/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $pokemon = curl_exec($curl);
    curl_close($curl);

    //Json decode
    $pokemon = json_decode($pokemon);

    echo '<pre>';
    var_dump($pokemon);
    echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
</head>
<body>
    <h1><?= ucfirst($pokemonName) ?></h1>
    <?php 
        $image = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$id.png";
    ?>
    <img src="<?= $image ?>" alt="<?= ucfirst($pokemonName) ?>">


</body>
</html>