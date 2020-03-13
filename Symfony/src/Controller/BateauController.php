<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Form\BateauType;
use App\Repository\BateauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bateau")
 */
class BateauController extends AbstractController
{
    /**
     * @Route("/", name="bateau_index", methods={"GET"})
     */
    public function index(BateauRepository $bateauRepository): Response
    {
        return $this->render('bateau/index.html.twig', [
            'bateaus' => $bateauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bateau_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bateau = new Bateau();
        $form = $this->createForm(BateauType::class, $bateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bateau);
            $entityManager->flush();

            return $this->redirectToRoute('bateau_index');
        }

        return $this->render('bateau/new.html.twig', [
            'bateau' => $bateau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bateau_show", methods={"GET"})
     */
    public function show(Bateau $bateau): Response
    {
        return $this->render('bateau/show.html.twig', [
            'bateau' => $bateau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bateau_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bateau $bateau): Response
    {
        $form = $this->createForm(BateauType::class, $bateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bateau_index');
        }

        return $this->render('bateau/edit.html.twig', [
            'bateau' => $bateau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bateau_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bateau $bateau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bateau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bateau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bateau_index');
    }
}
