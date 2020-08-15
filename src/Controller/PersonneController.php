<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Entity\Employe;
use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne")
     */
    public function index(Request $request)
    {
        $email=$request->getSession()->get('login_email');
        $repository= $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $secondRepository= $this->getDoctrine()->getRepository(DemandeConge::class);
        $thirdrep=$this->getDoctrine()->getRepository(Type::class);
        $type=$thirdrep->findOneBy(['type'=>'congé']);
        $nbreconge=count($secondRepository->findByType($employe,$type));
        $nbreAutorisation= count($secondRepository->findByType($employe));
        $demandes=$secondRepository->findByEtat($employe->getId(),'en cours');
        $count=count($demandes);
        return $this->render('personne/index.html.twig', [
            'employe' => $employe,
            'nbreconge'=> $nbreconge,
            'nbreAutorisation'=>$nbreAutorisation,
            'replyDemands'=>$demandes,
            'nbreDemandes'=>$count
        ]);
    }
    /**
     * @Route("/base", name="base")
     */
    public function base(Request $request){
        $email=$request->getSession()->get('login_email');
        $repository= $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        return $this->render('base.html.twig', [
            'employe' => $employe,
        ]);

    }
}
