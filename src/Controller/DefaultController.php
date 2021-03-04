<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     * @param Request $request
     * @return Response
     */
    public function index(SerializerInterface $serializer, LoggerInterface $logger,
    Request $request): Response
    {
        $clientIP = $request->getClientIp();
        $logger->info('Request vers / ', [
            'client_ip' => $clientIP,
        ]);

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/api", name="api")
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     * @param Request $request
     * @return Response
     */
    public function api(SerializerInterface $serializer, LoggerInterface $logger,
                          Request $request): Response
    {
        $clientIP = $request->getClientIp();
        $logger->info('Request vers /api/ ', [
            'client_ip' => $clientIP,
        ]);

        $code = Response::HTTP_FORBIDDEN;
        $result = [
            "message" => "Operation not allowed"
        ];

        $jsonResult = $serializer->serialize($result, 'json');
        return new JsonResponse($jsonResult, $code,
            ['Access-Control-Allow-Origin' => 'http://localhost'], true);  //CROSS ORIGIN
    }
}
