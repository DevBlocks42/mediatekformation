<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of BackofficeController
 *
 * @author sysadmin
 */
class BackofficeController extends AbstractController
{
    /**
     * @var FormationRepository
     */
    private FormationRepository $repository;
    
    /**
     *
     * @param FormationRepository $repository
     */
    public function __construct(FormationRepository $repository)
    {
        $this->repository = $repository;
    }
    #[Route('/backoffice', name: 'accueil_backoffice')]
    public function index(): Response
    {
        $formations = $this->repository->findAllLasted(2);
        return $this->render("pages/backoffice/accueil.html.twig", [
            'formations' => $formations
        ]);
    }
}
