<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Borrow;
use App\Form\BookType;
use App\Entity\Clients;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BookController extends AbstractController
{
    
    #[Route('/book', name: 'book')]
    public function index(ManagerRegistry $doctrine): Response
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
    /**
     * @Route("/book/borrow/{id}")
     */
    public function borrow(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
                                                                    // l'id vient de l'url
        $book = $entityManager->getRepository(Books::class)->findOneBy(['id'=>$id]);
        // nouvel emprunt on defini une date et une date max
        $borrow = new Borrow;
            $borrow->setDateLoan(new \DateTime('now'));
            $borrow->setDateRendredMax(new \DateTime('+15 days'));
            // on lie ce livre trouvé dans la base de donnée qu'on lie à l'emprunt
            $borrow->setBooks($book);
        
        // on doit faire un formulaire pour trouver à quel client emprunte le livre
        // formulaire stocké dans une variable Form
        $form=$this->createFormBuilder($borrow)
        // on ajoute un evariable client de type Entity Type
        ->add('Clients', EntityType::class, [
            'label'=>'Emprunteur',
            // la class recuperée dans la class Client
            'class'=>Clients::class,
            'attr'=>['class'=>'form-control my-5'],
            // choice label est tres important, on defini quelle propriete de la class client (la propriete firstName)
            'choice_label'=>'lastName'
        ])
        // ajout d'un bouton avec la mise en forme SubmitType
        ->add('save', SubmitType::class, [
            'label'=>'Valider',
            'attr'=>['class'=>'btn-primary']
            
        ])
        ->getForm();
            // le $request va contenir les POST les GET les Files
        $form->handleRequest($request);

        // soumission du formulaire verification
        if ($form->isSubmitted()&&$form->isValid()) {
            // recupere les données du formulaire
            $update = $form->getData();

            // on instencie l'emprunt à 1 (s'il y' a un livre de disponible)
            $book->setAivalable(1);

            //on recupere du formulaire le client choisi et on le met dans l'emprunt
            //grace au setter
            $borrow->setClients($update->getClients());

            // on envoi dans la bdd
            $entityManager = $doctrine->getManager();
            $entityManager->persist($borrow);
            $entityManager->flush();

            // et on redirige vers le listing Book
            return $this->redirectToRoute('book_listing');
        }

        return $this->renderForm('book/borrow.html.twig', [
            'form' => $form,
        ]);
    }


    
}

