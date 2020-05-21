<?php 

    include './top-cache.php';
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
    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';

    // Get array keys
    $allPokemons = $data->results;

    include './includes/header.php';
?>

<h1>Pokedex</h1>
<div class="wrapper-container">
    <?php foreach($allPokemons as $key => $value): ?>
        <?php
            //include './top-cache.php';
            // Get the url of each pokemon
            $url = $value->url;
            // Split the url
            $parts = explode('/', $url);
            // Get the second last part of the url
            $pokemonId = $parts[count($parts) - 2];
            // Dynamic URL image
            $image = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$pokemonId.png";
        ?>
        <div class="container-card-pokemon">
            <!--Image of the pokemon-->
            <img src="<?= $image ?>" alt="<?= ucfirst($value->name) ?>">
            <!--Name and id of pokemons-->
            <div class="content-card">
                <div class="details-text">
                    <p class="name-pokemon"><?= ucfirst($value->name) ?></p>
                    <p class="id-pokemon"><?= 'N°'.$pokemonId ?></p>
                </div>
                <!--See more details about the pokemon-->
                <div class="button">
                    <a href="./pokemon.php?path=<?= $value->name.'/'.$pokemonId ?>">See more</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php
    include './includes/footer.php';
    include './bottom-cache.php';
?>

