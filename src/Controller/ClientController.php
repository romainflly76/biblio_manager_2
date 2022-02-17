<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/client/listing_client', name: 'client_listing')]
    public function listingClient(EntityManagerInterface $entity): Response
    {
        //on creer une variable qui va chercher la classe Clients
        // On requete l'entity au travers de la variable clients
        $clients = $entity->getRepository(Clients::class)->findAll();

        return $this->render('client/listing_client.html.twig', [
            'controller_name' => 'ClientController',
            'clients' => $clients
        ]);
    
    }

    // Creation d'un nouveau client
    /**
     * @Route("/client/create", name="create_client")
     */
    
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $client = new clients();
        

        $form = $this->createForm(ClientType::class, $client);


        $form->add('save', SubmitType::class, ['label' => 'creer un client','attr' => ['class' => 'btn btn-primary mb-3']]);
            



        // verification du formaulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $client = $form->getData();

            // ... perform some action, such as saving the task to the database


            // Sauveagarde
           $entityManager->persist($client);

              // envoi Bdd
           $entityManager->flush();

          
           // Ajout du bandeau affichage succes
           $this->addFlash('success', 'client créer! Sans probleme!');

            // retour au listing
            return $this->redirectToRoute('client_listing');
        }

        return $this->renderForm('client/create.html.twig', [
            'form' => $form,
        ]);
    }

    // UPDATE (edit d'un client)
       /**
     * @Route("/client/edit/{id}")
     */
    public function update(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $client = $entityManager->getRepository(Clients::class)->find($id);

        $form = $this->createForm(ClientType::class, $client);

        $form->add('Update', SubmitType::class, ['label' => 'Modifier','attr' => ['class' => 'btn btn-primary mb-3']]);
      
        // verification du formaulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $client = $form->getData();

            // ... perform some action, such as saving the task to the database

            // Sauveagarde
           $entityManager->persist($client);

              // envoi Bdd
           $entityManager->flush();

           // Ajout du bandeau affichage succes
           $this->addFlash('success', 'client modifié! Sans probleme!');

           return $this->redirectToRoute('client_listing');
          
        // // return $this->redirectToRoute('book_listing', [
        // //     'id' => $client->getId()
        // ]);
    }
    return $this->renderForm('client/edit.html.twig', [
        'form' => $form,
    ]);
}

// Delete
 /**
     * @Route("/client/delete/{id}")
     */
    public function delete(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $client = $entityManager->getRepository(Clients::class)->find($id);

        // dd($client);
        $entityManager->remove($client);
        $entityManager->flush();

           // Ajout du bandeau affichage succes
           $this->addFlash('danger', 'client suprimé! Sans probleme!');

           return $this->redirectToRoute('client_listing');
          
    }

}
