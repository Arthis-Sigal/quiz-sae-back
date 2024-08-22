<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\ParticipantsType;
use App\Repository\ParticipantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class APIController extends AbstractController
{

    #[Route('/', name: 'app_a_p_i_index', methods: ['GET'])]
    public function index(ParticipantsRepository $participantsRepository): Response
    {
        return $this->json($participantsRepository->findAll());
    }

    
    #[Route('/new', name: 'app_a_p_i_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new participant from the request data on post
        $participant = new Participants();
        var_dump($request);
        $participant->setFirstname($request->get('firstname'));
        $participant->setName($request->get('name'));
        $participant->setContact($request->get('contact'));
        $participant->setRgpd($request->get('rgpd'));
        $participant->setScore($request->get('score'));

        // Persist the new participant
        $entityManager->persist($participant);
        $entityManager->flush();

    }
    

    /*
    #[Route('/{id}', name: 'app_a_p_i_show', methods: ['GET'])]
    public function show(Participants $participant): Response
    {
        return $this->json($participant);

    }
    */

    /*
    #[Route('/{id}/edit', name: 'app_a_p_i_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participants $participant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipantsType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_a_p_i_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('api/edit.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }
    */

    /*
    #[Route('/{id}', name: 'app_a_p_i_delete', methods: ['POST'])]
    public function delete(Request $request, Participants $participant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participant->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($participant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_a_p_i_index', [], Response::HTTP_SEE_OTHER);
    }

    */
}
