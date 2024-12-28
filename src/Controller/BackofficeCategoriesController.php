<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \App\Repository\CategorieRepository;
use App\Form\CategorieType;
use App\Entity\Categorie;

/**
 * Description of BackofficeCategoriesController
 *
 * @author sysadmin
 */
class BackofficeCategoriesController extends AbstractController
{
    /**
     *
     * @var CategorieRepository
     */
    private CategorieRepository $categorieRepository;
    /**
     *
     * @param CategorieRepository $categorieRepository
     */
    public function __construct(CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }
    /**
     *
     * @param Request $request
     * @return Response
     */
    #[Route('/backoffice/categories', name: 'backoffice_categories')]
    public function index(Request $request): Response
    {
        $categories = $this->categorieRepository->findAll();
        $categorieType = $this->createForm(CategorieType::class, null, []);
        $categorieType->handleRequest($request);
        if ($categorieType->isSubmitted() && $categorieType->isValid()) {
            $categorie = $categorieType->getData();
            $found = $this->categorieRepository->findOneBy([
                'name' => $categorie->getName()
            ]);
            if ($found === null) {
                $this->categorieRepository->add($categorie);
                $this->addFlash('categorie_success', 'La catégorie a bien été ajoutée.');
            } else {
                $this->addFlash(
                    'categorie_error',
                    '[!] La catégorie n\'a pas pu être ajoutée car son nom existe déjà.'
                );
            }
            return $this->redirectToRoute('backoffice_categories');
        }
        return $this->render("pages/backoffice/categories.html.twig", [
            'categories' => $categories,
            'cat_form' => $categorieType->createView()
        ]);
    }
    /**
     *
     * @param type $id
     * @return Response
     */
    #[Route('/backoffice/categories/delete/{id}', name: 'backoffice_categories.deleteone')]
    public function deleteOne($id): Response
    {
        $cat = $this->categorieRepository->find($id);
        if (count($cat->getFormations()) > 0) {
            $this->addFlash(
                'categorie_error',
                "[!] La catégorie ne peut pas être supprimée si elle est présente dans des formations."
            );
        } else {
            $this->categorieRepository->remove($cat);
            $this->addFlash('categorie_success', "La catégorie a bien été supprimée.");
        }
        return $this->redirectToRoute('backoffice_categories');
    }
}
