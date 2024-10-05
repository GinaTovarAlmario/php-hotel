<?php 
    // i miei dati sono i seguenti
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    $filteredHotels = $hotels;
    // vado a filrare hotel con parcheggio
    if (isset($_GET["parking"]) && $_GET["parking"] === "on"){
        $filteredHotels = [];
        // vado a filtrare gli hotel con parcheggio
        foreach ($hotels as $hotel) {
            if ($hotel["parking"] === true) {
                $filteredHotels[] = $hotel; 
            }
        }
    } else {
        // altrimenti fammi vedere la lista completa
        $filteredHotels = $hotels;
    }

    // vado a gestire il valore del voto hotel
    if(isset($_GET["vote"]) && intval( $_GET["vote"]) >= 1 && intval($_GET["vote"]) <= 5){
        // mi serve un array per salvare la ricerca
        $extraFilteredHotels = [];
        foreach( $filteredHotels as $hotel){
            if(intval($hotel["vote"]) >= intval($_GET["vote"])){
                $extraFilteredHotels[] = $hotel;
            }
        }
    } else {
        $extraFilteredHotels = $filteredHotels;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ginatovaralmario">
    <meta name="project" content="php-array-associativi">
    <title>Php Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
</head>
<body>
    <main class="container">
        <h1 class="mt-3 mb-3">List of Hotels</h1>
        <div class="row">
            <div class="col-12">
                <form action="index.php" method="GET" class="row justify-content-center" >
                    <div class="col-3 form-check">
                        <label class="form-check-label" for="parking">
                            Hotel with Parking
                        </label>
                        <input class="form-check-input" type="checkbox" name="parking" id="parking" >
                    </div>
                    <div class="col-3">
                        <label for="vote">How Many Stars</label>
                        <input type="number" max="5" min="0" id="vote" name="vote" placeholder="1 to 5">
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Filter List</button>
                        <button class="btn btn-warning">Reset Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table mt-3 table-warning">
                    <thead>
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">PARKING</th>
                            <th scope="col">VOTE</th>
                            <th scope="col">DISTANCE TO CENTER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($extraFilteredHotels as $hotel) {?>
                            <tr>
                                <td><?=$hotel["name"]?></td>
                                <td><?=$hotel["description"]?></td>
                                <?php $answer = $hotel["parking"]? "yes" : "no"; ?>
                                <td><?=$answer?></td>
                                <td><?=$hotel["vote"]?></td>
                                <td><?=$hotel["distance_to_center"]?></td>
                            </tr>
                        <?php }?>    
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>