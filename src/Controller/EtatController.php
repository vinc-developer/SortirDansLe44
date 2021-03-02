<?php

namespace App\Controller;

use App\Repository\EtatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EtatController extends AbstractController
{
    /**
     * @Route("/etat", name="etat", methods={"GET"})
     * @param EtatRepository $etatRepository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function index(EtatRepository $etatRepository, SerializerInterface $serializer): Response
    {
        $etat = $etatRepository->findAll();
        $jsonEtat = $serializer->serialize($etat, 'json');

        return new JsonResponse($jsonEtat, Response::HTTP_OK,
        ['Access-Control-Allow-Origin' => 'http://localhost'], true); //CROSS ORIGIN
    }
}
