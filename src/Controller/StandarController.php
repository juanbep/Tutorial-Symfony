<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
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
    
    /**
     * @Route("/PersistirDatos/", name = "Persistir")
     */
    public  function PersistirDatos(){
        $entityManager = $this->getDoctrine()->getManager();
        $categoria = new Categoria('Tecnologia');
        $producto = new Producto('TV LCD 32 pulgadas', 'TV-02');
        $producto -> setCategoria($categoria);
        $entityManager->persist($producto);
        $entityManager->flush();
        
        return $this->render ('standar/success.html.twig');
    }
    
    
}
