<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Entity\Responses;
use App\Repository\ResponsesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResponsesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('application/home.html.twig');
    }

    /**
     * @Route("/responses", name="responses")
     */
    public function responses(ResponsesRepository $repo): Response
    {
        $responses = $repo->findAll();
        return $this->render('responses/responses.html.twig', [
            'controller_name' => 'ResponsesController',
            'responses' => $responses
        ]);
    }

    /**
     * @Route("/responses/create", name="responses_create", methods={"GET", "POST"})
     * @Route("/responses/{id}/edit", name="responses_edit", methods={"GET", "POST"})
     */
    public function form(Responses $response = null, Request $request): Response
    {
        if (!$response) {
            $response = new Responses();
        }

        $form = $this->createFormBuilder($response)
            ->add('ResponseValue', ChoiceType::class, ["choices" => ["0" => 0, "1" => 1, "2" => 2], "attr" => ["select tag"]])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $response->setResponseDate(new \DateTime());
            $response->setResponseTime(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($response);
            $entityManager->flush();

            return $this->redirectToRoute('responses');
        }

        return $this->render('responses/create.html.twig', [
            'response' => $response,
            'formResponse' => $form->createView()
        ]);
    }

    /**
     * @Route("/responses/{id}", name="responses_show")
     */
    public function show(Responses $responses)
    {
        return $this->render('responses/show.html.twig', ["response" => $responses]);
    }
}
