<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\GeometryCalculator;
use App\Repository\TriangleRepository;
use App\Entity\Triangle;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class TriangleController extends AbstractController
{
    private $em;

    public function __construct(TriangleRepository $triangleRepository, EntityManagerInterface $em)
    {
        $this->triangleRepository = $triangleRepository;
        $this->em = $em;
    }

    #[Route('/triangle/{a}/{b}/{c}', name: 'app_triangle')]
    public function index(float $a, float $b, float $c): JsonResponse
    {
        try{
            $triangle = new Triangle();
            $triangle->setA($a);
            $triangle->setB($b);
            $triangle->setC($c);
            $triangle->setSurface();
            $triangle->setCircumference();

            //LOGS
            $this->em->persist($triangle);
            $this->em->flush();

            return $this->json([
                'type' => $triangle->getType(),
                'a' => $triangle->getA(),
                'b' => $triangle->getB(),
                'c' => $triangle->getC(),
                'surface' => $triangle->getSurface(),
                'circumference' => $triangle->getCircumference()
            ]);
            
        }catch(\Exception $e){
            return $this->json([
                'error' => 'error'
            ], 500);
        }
    }


    #[Route('/triangle/sum-objects', methods: ["POST"], name: 'app_triangle_sum_object')]
    public function sumObjects(Request $request, GeometryCalculator $geometryCalculator): JsonResponse
    {
        try{
            $triangle = new Triangle();

            $object1 = json_decode($request->request->get('object1'), TRUE);
            $triangle->setA($object1['a']);
            $triangle->setB($object1['b']);
            $triangle->setC($object1['c']);
            $triangle->setSurface();
            $triangle->setCircumference();
            $object1 = $triangle;

            $object2 = json_decode($request->request->get('object2'), TRUE);
            $triangle->setA($object2['a']);
            $triangle->setB($object2['b']);
            $triangle->setC($object2['c']);
            $triangle->setSurface();
            $triangle->setCircumference();
            $object2 = $triangle;

            return $this->json([
                'sumSurface'        => $geometryCalculator->getSumSurface($object1, $object2),            
                'sumCircumference'  => $geometryCalculator->getSumCircumference($object1, $object2)
            ]);
        }catch(\Exception $e){
            return $this->json([
                'error' => 'error'
            ], 500);
        }
    }
}
