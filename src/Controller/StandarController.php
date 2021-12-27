<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandarController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $num1 = 1;
        $num2 = 100;
        $suma = $num1 + $num2;
        $nombres = "diego, julian, miguel, WENDY, papa, mama";
        return $this->render('standar/index.html.twig', 
                array('resultadoSum' => $suma, 
                    'num1' => $num1, 
                    'num2' => $num2,
                    'nombres' => $nombres
                ));
    }
    
    /**
     * @Route("/pagina2/{nombre}/", name = "pagina2")
     */
    public function pagina2($nombre){
        return $this->render('standar/pagina2.html.twig', array("parametro1" => $nombre));
    }
    
}
