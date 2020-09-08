<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Stock;
use App\Entity\Clientes;
use App\Entity\Opiniones;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home")
     */
    public function home(){
        return $this->render("maquetacion.malateo.html.twig");
    }

    /**
     * @Route("/maleteo")
     */
    public function maleteo(EntityManagerInterface $doctrine )
    {

        $repo = $doctrine->getRepository(Stock::class);
        $iphone = $repo->findAll();
        return $this->render("maquetacion.malateo.html.twig" , ['iphone' => $iphone]);
    }

    

    /**
     * @Route("/demo" ,name="newDemo")
     */

    public function insert(Request $request , EntityManagerInterface $doctrine ){
        $data = new Clientes();
        $data->setNombre($request->get("nombre"));
        $data->setEmail($request->get("email"));
        $data->setCiudad($request->get("ciudad"));

        $doctrine->persist($data);
        $doctrine->flush();

        return new Response("Informacion añadida");
    }

    /**
     * @Route("/info" , name="newRate")
     */
    public function insertOpiniones(Request $request , EntityManagerInterface $doctrine){

        

        $info = new Opiniones();
        $info->setNombre($request->get("nombre"));
        $info->setOpinion($request->get("opinion"));

        $doctrine->persist($info);
        $doctrine->flush();
        return new Response("Opinion añadida");
    }
    /**
     * @Route("/newProducts")
     */
    public function newProducts(EntityManagerInterface $doctrine )
    {
        $productos = new Stock();
        $productos->setNombre('Samsung');
        $productos->setDescripcion('Es un telefono con 36 horas de bateria');
        $productos->setImg('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS5_VEvrj7MGTR204kFnhGoxvq8yTZzBlQQXDftwXMH6wvz3QS0eSUKKTnKsAB4JtDVHG27QmMy&usqp=CAc');
        
        $doctrine->persist($productos);
        $doctrine->flush();
    }

    /**
     * @Route("/solicitudes")
     */
    public function showSolicitudes(EntityManagerInterface $doctrine)
    {

        $solicitud = $doctrine->getRepository(Clientes::class);
        $solicitud = $solicitud->findAll();
        return $this->render("solicitudes-demo.html.twig" , ['solicitud' => $solicitud]);
        /* $solicitud = new Clientes();

        $doctrine->persist($solicitud);
        $doctrine->flush();
        return $this->render('solicitudes-demo.html.twig', ['solicitud' => $solicitud]); */
    }
    /**
     * @Route("/opiniones")
     */
    public function showOpiniones(EntityManagerInterface $doctrine)
    {
        $repo = $doctrine->getRepository(Opiniones::class);
        $opinion = $repo->findAll();
        return $this->render("opiniones.html.twig" , ['opinion'=> $opinion]);
    }

    
    
















        
    /**
     * @Route("/producto/{id})
     */
   /*  public function getProducto($id , EntityManagerInterface $doctrine )
    {
        $repo = $doctrine->getRepository(Stock::class);
    } */

}