<?php

namespace App\Controller;

use App\Services\Api\Plugin\Deputados\GetDeputado;
use App\Services\Api\Plugin\Deputados\GetDeputados;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(GetDeputados $getDeputados, GetDeputado $getDeputado): Response
    {
        // $t = $getDeputados->getList();
        // $t = $getDeputado->get(10);
        // dd($t);

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
