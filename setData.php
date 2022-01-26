<?php
    // header("Access-Control-Allow-Origin: *");
    // header('Content-Type: application/json; charset=utf-8');
    // header("Cache-Control: no-cache, no-store, must-revalidate");
    
    echo "<pre>";
    
    require __DIR__ . '/vendor/autoload.php';
    
    use \app\Classes\Government\FederalCongress;
    use \app\Classes\Government\Roles\Congressperson;
    new \app\Classes\Environment();
    
    $federalCongress = new FederalCongress();
    try{
        
        $federalCongress->getAgentsData();

        $return = ['msg' => 'updated'];
    } catch(Exception $e) {
        $return = ['msg' => 'error'];
    }
    
    echo json_encode($return);