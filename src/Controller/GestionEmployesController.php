<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GestionEmployesController
 * @package App\Controller
 * @Route("/admin")
 */

class GestionEmployesController extends AbstractController
{
    /**
     * @Route("/add/employes", name="admin_add_employes")
     */
        public function addProfile(Request $request, Employe $newEmploye = null, EntityManagerInterface $manager)
        {
            if(!$newEmploye){
                $newEmploye = new Employe();
            }
            $email = $request->getSession()->get('login_email');
            $repository = $this->getDoctrine()->getRepository(Employe::class);
            $employe = $repository->findOneBy(['email' => $email]);
            $form = $this->createForm(EmployeType::class, $newEmploye);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
//                if ($form['image']) {
//                    $image = $form['image']->getData();
//                    $imagePath = md5(uniqid()) . $image->getClientOriginalName();
//                    $destination = __DIR__ . '/../../public/assets/upload';
//                    try {
//                        $image->move($destination, $imagePath);
//                        $newEmploye->setImage('assets/upload/' . $imagePath);
//
//
//                    } catch (FileException $fe) {
//                        echo $fe;
//                    }
//                }
                $manager->persist($newEmploye);
                $manager->flush();
                return $this->redirectToRoute('admin_employes');
            } else {
                return $this->render('gestion_employes/index.html.twig', array(
                        'form' => $form->createView(),
                        'employe' => $employe)
                );
            }
        }
        /**
         * @Route("/gestion/employes/{id?0}", name="admin_gestion_employes")
         */
        public function editProfile(Request $request, EntityManagerInterface $manager,Employe $newEmploye=null){
            if(!$newEmploye){
                $newEmploye = new Employe();
            }
            $email = $request->getSession()->get('login_email');
            $repository = $this->getDoctrine()->getRepository(Employe::class);
            $employe = $repository->findOneBy(['email' => $email]);
            $form = $this->createForm(EmployeType::class, $newEmploye);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
//                if ($form['image']) {
//                    $image = $form['image']->getData();
//                    $imagePath = md5(uniqid()) . $image->getClientOriginalName();
//                    $destination = __DIR__ . '/../../public/assets/upload';
//                    try {
//                        $image->move($destination, $imagePath);
//                        $newEmploye->setImage('assets/upload/' . $imagePath);
//
//
//                    } catch (FileException $fe) {
//                        echo $fe;
//                    }
//                }
                $manager->persist($newEmploye);
                $manager->flush();
                return $this->redirectToRoute('admin_employes');
            } else {
                return $this->render('gestion_employes/index.html.twig', array(
                        'form' => $form->createView(),
                        'employe' => $employe)
                );
            }
        }
}
