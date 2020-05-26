<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $employes = $this->getDoctrine()->getRepository(Employe::class)->findAll();

        return $this->render('default/index.html.twig', [
            'employes' => $employes
        ]);
    }

    /**
     * @Route("employe/add", name="add_employe")
     */
    public function addEmploye(Request $request)
    {
        $form = $this->createForm(EmployeType::class, new Employe());
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            //recupere les valeurs sous forme d'objet employe
            $employe = $form->getData();
            //recupere l'image
            $image = $employe->getImage();
            //recupere le file soumis
            $file = $image->getFile();
            //creer un nom unique
            $name = md5(uniqid()).'.'.$file->guessExtension();
            //deplace le fichier
            $file->move('../public/images', $name);
            //donne le nom a l'image
            $image->setName($name);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();
            return $this->redirectToRoute('default');
        } else {

            return $this->render('employe/add.html.twig',
                [
                    'form' => $form->createView()
                ]);


        }
    }

    /**
     * @Route("/delete/{employe}", name="delete_employe")
     */
    public function deleteEmploye(Employe $employe)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($employe);
        $entityManager->flush();

        return $this->redirectToRoute('default');
    }
}

