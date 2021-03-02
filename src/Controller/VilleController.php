<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class VilleController extends AbstractController
{
    /**
     * @Route("api/ville", name="find_all_ville", methods={"GET"})
     * @param VilleRepository $villeRepository
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     * @param Request $request
     * @return Response
     */
    public function getAllVilles(VilleRepository $villeRepository, SerializerInterface $serializer,
                LoggerInterface $logger, Request $request): Response
    {
        $clientIP = $request->getClientIp();
        $logger->info('Request vers api/ville/ ', [
            'client_ip' => $clientIP,
        ]);

        $ville = $villeRepository->findAll();
        $jsonVille = $serializer->serialize($ville, 'json');
        return new JsonResponse($jsonVille, Response::HTTP_OK,
        ['Access-Control-Allow-Origin' => 'http://localhost'], true); //CROSS ORIGIN
    }
}
