<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Entity\Employe;
use App\Form\DemandeCongeType;
use ContainerLDxLAbk\getDoctrineMigrations_UpToDateCommandService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DemandeCongeController extends AbstractController
{
    /**
     * @Route("/demande/conge", name="demande_conge")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $demandeConge = new DemandeConge();
        $form = $this->createForm(DemandeCongeType::class,$demandeConge);
        $form->handleRequest($request);
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $date = new \DateTime('NOW');
        $secondRepository=$this->getDoctrine()->getRepository(DemandeConge::class);
        $demandes=$secondRepository->findByEtat($employe->getId(),'en cours');
        $count=count($demandes);
            if($form->isSubmitted()&&$form->isValid()){
            $demandeConge->setDateDeFormulation($date);
            $demandeConge->setEtat("en cours");
            $demandeConge->setSender($employe);
            $demandeConge->setSuperiorId($employe->getEmployer()->getId());
            $manager->persist($demandeConge);
            $manager->flush();
            return $this->redirectToRoute('personne');
        }else{
        return $this->render('demande_conge/request.html.twig', [
            'form' => $form->createView(),
            'employe'=>$employe,
            'replyDemands'=>$demandes,
            'nbreDemandes'=>$count
        ]);
        }
    }
    /**
     * @Route("/mydemands",name="mes_demandes")
     */
    public function myDemands(Request $request){
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $repository=$this->getDoctrine()->getRepository(DemandeConge::class);
        $demandes=$repository->findBySender($employe);
        $secondRepository=$this->getDoctrine()->getRepository(DemandeConge::class);
        $seconddemandes=$secondRepository->findByEtat($employe->getId(),'en cours');
        $count=count($seconddemandes);

        return $this->render('/demande_conge/mesdemandes.html.twig',array(
            'demandes'=>$demandes,
            'employe'=>$employe,
            'replyDemands'=>$seconddemandes,
            'nbreDemandes'=>$count
        ));
    }
    /**
     * @Route("/demande/edit/{id?}", name="demande_conge_edit")
     */
    public function editDemande(Request $request, EntityManagerInterface $manager,DemandeConge $demandeConge){
        if(!$demandeConge){
            $demandeConge = new DemandeConge();
        }
        $form = $this->createForm(DemandeCongeType::class,$demandeConge);
        $form->handleRequest($request);
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $date = new \DateTime('NOW');
        if($form->isSubmitted()&&$form->isValid()){
            $demandeConge->setDateDeFormulation($date);
            $demandeConge->setEtat("en cours");
            $demandeConge->setSender($employe);
            $demandeConge->setSuperiorId($employe->getEmployer()->getId());
            $manager->persist($demandeConge);
            $manager->flush();
            return $this->redirectToRoute('mes_demandes');
        }else{
            return $this->render('demande_conge/request.html.twig', [
                'form' => $form->createView(),
                'employe'=>$employe
            ]);
        }
    }
}
