<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
use \App\Form\ProductoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandarController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        $producto = new Producto();
        $form = $this -> createForm(ProductoType::class, $producto);
        $num1 = 1;
        $num2 = 100;
        $suma = $num1 + $num2;
        $nombres = "diego, julian, miguel, WENDY, papa, mama";
        $form->handleRequest($request);
        
        if($form ->isSubmitted() && $form -> isValid()){
            $em = $this->getDoctrine()->getManager();
            $producto = $form -> getData();
            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('index');
        }
        
        
        return $this->render('standar/index.html.twig', 
                array('resultadoSum' => $suma, 
                    'num1' => $num1, 
                    'num2' => $num2,
                    'nombres' => $nombres,
                    'form' => $form -> createView()
                ));
    }
    
    /**
     * @Route("/pagina2/{nombre}/", name = "pagina2")
     */
    public function pagina2(Request $request, $nombre){
        $form = $this->createFormBuilder()
            ->add('nombre')
            ->add('codigo')
            ->add('categoria', EntityType::class,[
                'class' => Categoria::class,
                'choice_label' => 'nombre'
            ])
            ->add('Enviar', SubmitType::class)
            ->getForm();
            $form->handleRequest($request);
            
            if($form ->isSubmitted() && $form -> isValid()){
                $em = $this->getDoctrine()->getManager();
                $data = $form->getData();
                $producto = new Producto($data['nombre'], $data['codigo']);
                $producto->setCategoria($data['categoria']);
                $em->persist($producto);
                $em->flush();
                return $this->redirectToRoute('pagina2',['nombre'=>'Guardado Exitoso']);
            }
                    
            
        return $this->render('standar/pagina2.html.twig', array("parametro1" => $nombre, "form" => $form->createView()));
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
    
    /**
     * @Route("/Busquedas/{idProducto}", name = "Busquedas")
     */
    
    public function Busquedas($idProducto){
        $em = $this->getDoctrine()->getManager();
        $producto  = $em -> getRepository(Producto::class) -> find(1);//solo busca por la llave primaria 
        $producto2 = $em -> getRepository(Producto::class) -> findOneBy(['codigo' => 'TV-01', 'nombre' => 'TV pantalla plana']);//busca por varios atributos 
        $producto3 = $em -> getRepository(Producto::class) -> findBy(['categoria' => 1]);//trae todos los registros de la tabla con el atributo en comun 
        $producto4 = $em -> getRepository(Producto::class) -> findAll();//trae todos los registros de la tabla
        
        //*******************************************************************************
        $productRepository = $em -> getRepository(Producto::class) -> BuscarProductoPorId($idProducto);
        
        return $this->render ('standar/busqueda.html.twig',
                array('find'=>$producto,
                         'findOneBy'=>$producto2, 
                         'findBy'=>$producto3, 
                         'findAll'=>$producto4,
                         'BuscarProductoPorId'=>$productRepository), );
    }
}
