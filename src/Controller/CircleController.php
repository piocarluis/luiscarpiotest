<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\GeometryCalculator;
use App\Repository\CircleRepository;
use App\Entity\Circle;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CircleController extends AbstractController
{
	private $em;

	public function __construct(CircleRepository $circleRepository, EntityManagerInterface $em)
	{
		$this->circleRepository = $circleRepository;
		$this->em = $em;
	}
    
    #[Route('/circle/{radius}', methods: ["GET"], name: 'app_circle')]
    public function index(float $radius): JsonResponse
    {
    	try{
	        $circle = new Circle();
	        $circle->setRadius($radius);
	        $circle->setCircumference();
	        $circle->setSurface();

	        //LOGS
	        $this->em->persist($circle);
	    	$this->em->flush();

	        return $this->json([
	            'type' => $circle->getType(),
	            'radius' => $circle->getRadius(),
	            'surface' => $circle->getSurface(),
	            'circumference' => $circle->getCircumference()
	        ]);
        //return $this->json($response);
	    }catch(\Exception $e){
	    	return $this->json([
	            'error' => 'error'
	        ], 500);
	    }
    }

    #[Route('/circle/sum-objects', methods: ["POST"], name: 'app_circle_sum_object')]
    public function sumObjects(Request $request, GeometryCalculator $geometryCalculator): JsonResponse
    {
    	try{
	        $circle = new Circle();

	        $object1 = json_decode($request->request->get('object1'), TRUE);
	        $circle->setRadius($object1['radius']);
	        $circle->setCircumference();
	        $circle->setSurface();
	        $object1 = $circle;

	        $object2 = json_decode($request->request->get('object2'), TRUE);
	        $circle->setRadius($object2['radius']);
	        $circle->setCircumference();
	        $circle->setSurface();
	        $object2 = $circle;

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
