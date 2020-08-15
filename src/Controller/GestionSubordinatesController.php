<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Entity\Employe;
use App\Entity\Personne;
use App\Form\EmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GestionSubordinatesController
 * @package App\Controller
 * @Route("/gestion/subordinate")
 */
class GestionSubordinatesController extends AbstractController
{
    /**
     * @Route("", name="gestion_subordinates")
     */
    public function index(Request $request)
    {
        $email=$request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe= $repository->findOneBy(['email' => $email]);
        $employer = $repository->find($employe->getId());
        $employes = $repository->findByEmployer($employer);
        $secondRepository=$this->getDoctrine()->getRepository(DemandeConge::class);
        $demandes=$secondRepository->findByEtat($employe->getId(),'en cours');
        $count=count($demandes);
        return $this->render('gestion_subordinates/index.html.twig',[
            'employes' => $employes,
            'employe'=>$employe,
            'replyDemands'=>$demandes,
            'nbreDemandes'=>$count
        ]);
    }

    /**
     * @param $id
     * @Route("/gestion/subordinate/delete/{id}", name="subordinate.delete")
     */
    public function deleteSubordinate($id){
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe = $repository->find($id);
        if (!$employe) {
            $this->addFlash('error', 'Suppression échouée, employé inexistant');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($employe);
            $manager->flush();
            $this->addFlash('success', 'employé supprimé avec succés');
        }
        return $this->redirectToRoute('gestion_subordinates');
    }
 /**
  * @Route("/add/{id?0}", name="subordinate.add")
  */
 public function addSubordinate(Request $request,Employe $employe=null, EntityManagerInterface $manager){
     if(!$employe){
         $employe = new Employe();
     }
     $email=$request->getSession()->get('login_email');
     $repository= $this->getDoctrine()->getRepository(Employe::class);
     $employe= $repository->findOneBy(['email' => $email]);
     $form= $this->createForm(EmployeType::class,$employe);
     $form->handleRequest($request);
     if($form->isSubmitted()&&$form->isValid()){
        $manager->persist($employe);
        $manager->flush();
        return $this->redirectToRoute('gestion_subordinates');
     }else
     return $this->render('gestion_subordinates/add.html.twig',array(
         'form'=>$form->createView(),
         'employe'=>$employe)
     );
 }
}
