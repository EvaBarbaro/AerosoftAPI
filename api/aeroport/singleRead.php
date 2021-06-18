<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/aeroport.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Aeroport($db);

    $item->IdAeroport = substr($_GET["_url"], -3);
  
    $item->getSingleAeroport();

    if($item->IdAeroport != null){
        // create array
        $aeroport_arr = array(
            "IdAeroport" =>  $item->IdAeroport,
            "NomAeroport" => $item->NomAeroport,
            "NomVilleDesservie" => $item->NomVilleDesservie
        );
      
        http_response_code(200);
        echo json_encode($aeroport_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Aeroport non trouvé");
    }
?>