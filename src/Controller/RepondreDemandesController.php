<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Entity\Employe;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RepondreDemandesController extends AbstractController
{
    /**
     * @Route("/repondre/demandes", name="repondre_demandes")
     */
    public function index(\Symfony\Component\HttpFoundation\Request $request)
    {
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $repository=$this->getDoctrine()->getRepository(DemandeConge::class);
        $demandes=$repository->findByEtat($employe->getId(),'en cours');
        $count=count($demandes);
        return $this->render('/repondre_demandes/repondre.html.twig',array(
            'demandes'=>$demandes,
            'employe'=>$employe,
            'replyDemands'=>$demandes,
            'nbreDemandes'=>$count
        ));
    }
    /**
     * @Route("/repondre/demandes/accepter/{id?0}", name="demande_accepter")
     */
    public function accepterDemande(\Symfony\Component\HttpFoundation\Request $request, DemandeConge $demande){
        $demande->setEtat('Accepté');
        $manager=$this->getDoctrine()->getManager();
        $manager->persist($demande);
        $manager->flush();
        return $this->redirectToRoute("repondre_demandes");
    }
    /**
     * @Route("/repondre/demande/refuser/{id?0}", name="demande_refuser")
     */
    public function refuserDemande(\Symfony\Component\HttpFoundation\Request $request, DemandeConge $demande){
        $demande->setEtat('Refusé');
        $manager=$this->getDoctrine()->getManager();
        $manager->persist($demande);
        $manager->flush();
        return $this->redirectToRoute("repondre_demandes");
    }
}
