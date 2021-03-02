<?php

namespace App\Controller;

use App\Repository\EtatRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EtatController extends AbstractController
{
    /**
     * @Route("api/etat", name="get_all_etat", methods={"GET"})
     * @param EtatRepository $etatRepository
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     * @param Request $request
     * @return Response
     */
    public function getAllEtat(EtatRepository $etatRepository, SerializerInterface $serializer,
                          LoggerInterface $logger, Request $request): Response
    {

        $clientIP = $request->getClientIp();
        $logger->info('Request vers api/etat/ ', [
            'client_ip' => $clientIP,
        ]);

        $etat = $etatRepository->findAll();
        $jsonEtat = $serializer->serialize($etat, 'json');

        return new JsonResponse($jsonEtat, Response::HTTP_OK,
        ['Access-Control-Allow-Origin' => 'http://localhost'], true); //CROSS ORIGIN
    }
}
