<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Entity\Responses;
use App\Repository\DevicesRepository;
use App\Repository\ResponsesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DevicesController extends AbstractController
{
    /**
     * @Route("/administration", name="devices")
     */
    public function devices(DevicesRepository $devicesRepository, ResponsesRepository $responsesRepository): Response
    {
        return $this->render('devices/devices.html.twig', [
            'devices' => $devicesRepository->findAll(),
            'responses' => $responsesRepository->findAll()
        ]);
    }

    /**
     * @Route("/administration/create", name="devices_create", methods={"GET", "POST"})
     * @Route("/administration/{id}/edit", name="devices_edit")
     */
    public function form(Devices $device = null, Request $request): Response
    {
        if (!$device) {
            $device = new Devices();
        }

        $form = $this->createFormBuilder($device)
            ->add('DeviceName', TextType::class, ["attr" => ["placeholder" => "..."]])
            ->add('DeviceMac', TextType::class, ["attr" => ["placeholder" => "XX:XX:XX:XX:XX:XX"]])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($device);

            $response = new Responses();
            $response->setDevices($device);
            $entityManager->persist($response);

            $entityManager->flush();

            return $this->redirectToRoute('devices');
        }

        return $this->render('devices/create.html.twig', [
            'device' => $device,
            'formResponse' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/{id}", name="devices_show", methods={"GET"})
     */
    public function show(Devices $devices)
    {
        return $this->render('devices/show.html.twig', ["device" => $devices]);
    }

    /**
     * @Route("/administration/{id}", name="devices_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Devices $device)
    {
        if ($this->isCsrfTokenValid('delete' . $device->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($device);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devices');
    }
}
