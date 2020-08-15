<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request, Employe $employe)
    {
        $form=$this->createForm(EmployeType::class,$employe);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

        }
        return $this->render('login/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
