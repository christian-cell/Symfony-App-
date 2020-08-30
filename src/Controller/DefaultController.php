<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Stock;

class DefaultController extends AbstractController
{
    /**
     * @Route("/iphone")
     */
    public function iphone(EntityManagerInterface $doctrine )
    {

        $repo = $doctrine->getRepository(Stock::class);
        $iphone = $repo->findAll();
        return $this->render("maquetacion.malateo.html.twig" , ['iphone' => $iphone]);

        /* $iphone = [
            [
                'nombre' => 'Iphone7',
                'descripcion' => 'bateria que dura 36 horas',
                'img' => 'url de la foto que queremos subir'
            ],
           
        ];
        return $this->render('maquetacion.malateo.html.twig', ['iphone' => $iphone]); */
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

        /* $productos = new Stock();
        $productos->setNombre('Iphone');
        $productos->setDescripcion('ultimo modelo de iphone');
        $productos->setImg('data:image/jpeg;base64,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');
        
        $doctrine->persist($productos);
        $doctrine->flush(); */
    }

}