<?php

namespace App\Controller;

use App\Repository\ClubRepository;
#use http\Env\Request;
#use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
#use Symfony\Component\HttpFoundation\Request;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route('club/getname/{nom}', name: 'get_name')]
    public function getName($nom): Response
    {
        return $this->render('club/details.html.twig', [
            'nom' => $nom,
        ]);
    }

    #[Route('/formations', name: 'app_formation')]
    public function formations(): Response
    {
        //$var1= '3A29';
        //$var2= 'i23';
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony 4', 'Description' => 'pratique',
                'date_debut' => '12/06/2020', 'date_fin' => '19/06/2020',
                'nb_participants' => 19),
            array('ref' => 'form177', 'Titre' => 'Formation SOA',
                'Description' => 'theorique', 'date_debut' => '03/12/2020', 'date_fin' => '10/12/2020',
                'nb_participants' => 0),
            array('ref' => 'form178', 'Titre' => 'Formation Angular',
                'Description' => 'theorique', 'date_debut' => '10/06/2020', 'date_fin' => '14/06/2020',
                'nb_participants' => 12));
        return $this->render("club/list.html.twig", array('tab_formations' => $formations));
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function reservation():Response
    {
        return new  Response("nouvelle page");
    }



    #[Route('/ListClub', name: 'List_Club')]


    public  function  listClub(ClubRepository $repository ):Response
    {
        $List=$repository->findAll();

        return $this->render('club/listClub.html.twig', [
            'tab_Club' => $List,
        ]);
    }

    #[Route('/show/{id}', name: 'Show_Club')]

  public  function  showDetails($id,ClubRepository $repository):Response{
        $List=$repository->find($id);

      return $this->render('club/Show.html.twig', [
          'user' => $List,
      ]);


  }
    #[Route('/delete/{id}', name: 'Delete_Club')]


public function  Delete($id,ClubRepository $repository, ManagerRegistry $doctrine):Response{
        $Club=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($Club);
        $em->flush();




return $this->redirectToRoute('List_Club');



}

}
