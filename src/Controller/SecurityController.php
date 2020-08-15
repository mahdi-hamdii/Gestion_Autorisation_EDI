<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security.registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $user->setRoles(["ROLE_USER"]);
            $email= $user->getEmail();
            $repository = $this->getDoctrine()->getRepository(Employe::class);
            $employe=$repository->findOneBy(['email'=>$email]);
            if($employe!=null){
                $employe->setAccount($user);
                $manager->persist($employe);
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute("security_login");
            }
            else{
                $this->addFlash('error', 'Employee does not exist');
                return $this->redirectToRoute("security.registration");
            }
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("", name="security_login")
     */
    public function login(Request $request){
        $email=$request->getSession()->get('login_email');
        if($email==null) {
            return $this->render("/security/login.html.twig");
        }else{
            return $this->redirectToRoute("personne");
        }
    }
    /**
     * @Route("/logout", name= "security_logout")
     */
    public function logout(){
   return $this->redirectToRoute('security_login');
    }
}
