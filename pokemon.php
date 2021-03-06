<?php 

    include './config.php';

    $path = $_GET['path'];
    $split = explode('/', $path);
    $id = $split[1];
    $pokemonName = $split[0];

    //Instantiate curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/$id/");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);

    //Json decode
    $data = json_decode($data);

    //Show data
    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';
    // exit;

    //Get objects
    $abilities = $data->abilities;
    $image = $data->sprites;
    $moves = $data->moves[0];
    $version = $moves->version_group_details[0];
    $types = $data->types[0];

    //Show objects
    // echo '<pre>';
    // var_dump($abilities);
    // echo '</pre>';
    // exit;

    include './includes/header.php';
?>

<img class="specific-pokemon" src="<?= $image->front_default ?>" alt="<?= ucfirst($pokemonName) ?>">

<div class="information-pokemon">
    <p class="specific-id"><?= 'N°'.$id ?></p>
    <h1 class="specific-name"><?= ucfirst($pokemonName) ?></h1>
    <table>
        <tr>
            <th>Ability</th>
            <td><?= ucfirst($abilities[0]->ability->name) ?></td>
        </tr>
        <tr>
            <th>Moves</th>
            <td><?= ucfirst($moves->move->name) ?></td>
        </tr>
        <tr>
            <th>Move learn method</th>
            <td><?= ucfirst($version->move_learn_method->name) ?></td>
        </tr>
        <tr>
            <th>Version group</th>
            <td><?= ucfirst($version->version_group->name) ?></td>
        </tr>
        <tr>
            <th>Types</th>
            <td><?= ucfirst($types->type->name) ?></td>
        </tr>
        <tr>
            <th>Weight</th>
            <td><?= $data->weight ?></td>
        </tr>
    </table>
</div>

<?php
    include './includes/footer.php';
?>