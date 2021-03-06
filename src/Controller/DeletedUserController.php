<?php

namespace App\Controller;

use App\Entity\DeletedUser;
use App\Form\DeletedUserType;
use App\Repository\DeletedUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DeletedUserController extends Controller
{
    /**
     * @Route("/", name="deleted_user_index", methods="GET")
     */
    public function index(DeletedUserRepository $deletedUserRepository, Request $request): Response
    {

        $em    = $this->get('doctrine')->getManager();
        $filterByName = $request->query->get('name');
        $filterByDateFrom = $request->query->get('filterFrom');
        $filterByDateTo = $request->query->get('filterTo');
        if(isset($filterByDateFrom)) {
            $filterByDateFrom = $request->query->get('filterFrom');
        }else {
            $filterByDateFrom = "";
        }


        $dql   = "SELECT d FROM App:DeletedUser d WHERE (d.UserName LIKE '$filterByName%' AND d.DisableDate > '$filterByDateFrom' ) ";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );

        // parameters to template
        return $this->render('deleted_user/index.html.twig', array('pagination' => $pagination));

    }

    /**
     * @Route("/new", name="deleted_user_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $deletedUser = new DeletedUser();
        $form = $this->createForm(DeletedUserType::class, $deletedUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($deletedUser);
            $em->flush();

            return $this->redirectToRoute('deleted_user_index');
        }

        return $this->render('deleted_user/new.html.twig', [
            'deleted_user' => $deletedUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="deleted_user_show", methods="GET")
     */
    public function show(DeletedUser $deletedUser): Response
    {
        return $this->render('deleted_user/show.html.twig', ['deleted_user' => $deletedUser]);
    }

    /**
     * @Route("/{id}/edit", name="deleted_user_edit", methods="GET|POST")
     */
    public function edit(Request $request, DeletedUser $deletedUser): Response
    {
        $form = $this->createForm(DeletedUserType::class, $deletedUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deleted_user_index', ['id' => $deletedUser->getId()]);
        }

        return $this->render('deleted_user/edit.html.twig', [
            'deleted_user' => $deletedUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="deleted_user_delete", methods="DELETE")
     */
    public function delete(Request $request, DeletedUser $deletedUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deletedUser->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($deletedUser);
            $em->flush();
        }

        return $this->redirectToRoute('deleted_user_index');
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

}
