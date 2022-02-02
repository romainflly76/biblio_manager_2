<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BookController extends AbstractController
{
    #[Route('/book', name: 'book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/listing', name: 'book_listing')]
    public function listing(EntityManagerInterface $entity): Response

    {
        //on creer une variable qui va chercher la classe Books
        // On requete l'entity au travers de la variable Books
        $books = $entity->getRepository(Books::class)->findAll();

        return $this->render('book/listing.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books
        ]);
    }

    // Creation d'un livre Ajout d'un nouveau livre
    /**
     * @Route("/book/create", name="create_book")
     */
    
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $book = new Books();
        

        $form = $this->createForm(BookType::class, $book);


        $form->add('save', SubmitType::class, ['label' => 'creer un livre','attr' => ['class' => 'btn btn-primary mb-3']]);
            



        // verification du formaulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $book = $form->getData();

            // ... perform some action, such as saving the task to the database


            // Sauveagarde
           $entityManager->persist($book);

              // envoi Bdd
           $entityManager->flush();

          
            // retour au listing
            return $this->redirectToRoute('book_listing');
        }

        return $this->renderForm('book/create.html.twig', [
            'form' => $form,
        ]);
    }

    // UPDATE (EDIT D'UN LIVRE)
       /**
     * @Route("/book/edit/{id}")
     */
    public function update(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Books::class)->find($id);

        $form = $this->createForm(BookType::class, $book);

        $form->add('Update', SubmitType::class, ['label' => 'Modifier','attr' => ['class' => 'btn btn-primary mb-3']]);
      
        // verification du formaulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $book = $form->getData();

            // ... perform some action, such as saving the task to the database

            // Sauveagarde
           $entityManager->persist($book);

              // envoi Bdd
           $entityManager->flush();

           // Ajout du bandeau affichage succes
           $this->addFlash('success', 'Tâche modifiée! Sans probleme!');

           return $this->redirectToRoute('book_listing');
          
        // // return $this->redirectToRoute('book_listing', [
        // //     'id' => $book->getId()
        // ]);
    }
    return $this->renderForm('book/edit.html.twig', [
        'form' => $form,
    ]);
}

// Delete
 /**
     * @Route("/book/delete/{id}")
     */
    public function delete(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Books::class)->find($id);

        
        $entityManager->remove($book);
        $entityManager->flush();

           // Ajout du bandeau affichage succes
           $this->addFlash('success', 'book suprimé! Sans probleme!');

           return $this->redirectToRoute('book_listing');
          
    }
    
}

