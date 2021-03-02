<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function index(SerializerInterface $serializer): Response
    {
        $code = Response::HTTP_FORBIDDEN;
        $result = [
            "message" => "Operation not allowed"
        ];

        $jsonResult = $serializer->serialize($result, 'json');
        return new JsonResponse($jsonResult, $code,
            ['Access-Control-Allow-Origin' => 'http://localhost'], true);  //CROSS ORIGIN
    }
}
