<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Entity\Employe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="admin")
     */
    public function index(Request $request)
    {
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        return $this->render('admin/index.html.twig', [
            'employe' => $employe,
        ]);
    }
    /**
     * @Route("/employes",name="admin_employes")
     */
    public function loadEmployes(Request $request){
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $employes=$repository->findBy(array(),['id'=>'asc']);
        return $this->render('admin/employes.html.twig',[
            'employe' => $employe,
            'employes'=>$employes
        ]);
    }
    /**
     * @Route("/lesdemandes",name="admin_demandes")
     */
    public function loadDemandes(Request $request){
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(DemandeConge::class);
        $secondRepository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $secondRepository->findOneBy(['email' => $email]);
        $demandes =$repository->findBy(array(),['id'=>'asc']);
        return $this->render('admin/demandes.html.twig',array(
            'demandes'=>$demandes,
            'employe'=>$employe
        ));
    }
    /**
     * @Route("/organigramme", name="admin_organigramme")
     */
    public function loadOrganigramme(Request $request){
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $employes = $repository->findBy(array(),['id'=>'asc']);
        return $this->render('admin/organigramme.html.twig',array(
            'employe'=>$employe,
            'employes'=>$employes
        ));
    }
}
