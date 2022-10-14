<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\AddStudentType;
use App\Repository\StudentRepository;
use ContainerGGuUppm\EntityManager_9a5be93;
use Doctrine\Persistence\ManagerRegistry;
#use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/listStudent', name: 'list_student')]

    public function listStudent(StudentRepository $repository): Response
    {

       $List=$repository->findAll();

        return $this->render('student/listStudent.html.twig', [
            'tab_student' => $List,
        ]);
    }

    #[Route('/AddStudent', name: 'Add_Student')]

    public function AddStudent(Request $request ,ManagerRegistry $doctrine ): Response
    {
        $Student = new Student();

        $form = $this->createForm(AddStudentType::class, $Student);
        $em = $doctrine->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $Student = $form->getData();
            $em->persist($Student);


            $em->flush();
            return $this->redirecttoroute('list_student');
        }
        return $this->render('classroom/AddClassroom.html.twig', [
            'Form' => $form->createView(),

        ]);

       }
    #[Route('/UpdateStudent/{NCS}', name: 'Update_Student')]

    public function UpdateStudent($NCS,Request $request, ManagerRegistry  $doctrine , StudentRepository $repository):Response
    {


        $student = $repository->find($NCS);
        $em = $doctrine->getManager();
        $form = $this->createForm(AddStudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $Student = $form->getData();


            $em->flush();
            return $this->redirecttoroute('list_student');
        }
        return $this->render('student/AddStudent.html.twig', [
            'Form' => $form->createView(),

        ]);
    }

    #[Route('/DeleteStudent/{NCS}', name: 'Delete_Student')]


    public function DeleteStudent(StudentRepository $repository,$NCS,ManagerRegistry $doctrine):Response {

        $student =$repository->find($NCS);
        $em=$doctrine->getManager();
        $em->remove($student);
        $em->flush();


        return $this->redirectToRoute('list_student');

    }














}
