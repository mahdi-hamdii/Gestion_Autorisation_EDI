<?php

namespace App\Controller;

use App\Entity\DemandeConge;
use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditProfileController extends AbstractController
{
    /**
     * @Route("/edit/profile", name="profile.edit")
     */
    public function editProfile(Request $request, Employe $employe = null, EntityManagerInterface $manager)
    {
        $email = $request->getSession()->get('login_email');
        $repository = $this->getDoctrine()->getRepository(Employe::class);
        $employe = $repository->findOneBy(['email' => $email]);
        $form = $this->createForm(EmployeType::class, $employe);
        $secondRepository=$this->getDoctrine()->getRepository(DemandeConge::class);
        $demandes=$secondRepository->findByEtat($employe->getId(),'en cours');
        $count=count($demandes);
        $form->remove('employer')
            ->remove('office')
            ->remove('salaire');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            if($form['image']){
//                $image= $form['image']->getData();
//                $imagePath = md5(uniqid()).$image->getClientOriginalName();
//                $destination = __DIR__.'/../../public/assets/upload';
//                try{
//                    $image->move($destination, $imagePath);
//                    $employe->setImage('assets/upload/'. $imagePath);
//
//
//                }catch (FileException $fe){
//                    echo $fe;
//                }
//            }
            $manager->persist($employe);
            $manager->flush();
            return $this->redirectToRoute('personne');
        } else {
            return $this->render('edit_profile/editProfile.html.twig', array(
                    'form' => $form->createView(),
                'employe'=>$employe,
                    'replyDemands'=>$demandes,
                    'nbreDemandes'=>$count)

            );
        }
    }
}
