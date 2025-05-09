<?php
namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controleur des formations
 *
 * @author emds
 */
class FormationsController extends AbstractController
{

    /**
    *
    * @var FormationRepository
    */
    protected $formationRepository;
    /**
    *
    * @var $formationRenderPage:String
    */
    private $formationRenderPage;
    /**
    *
    * @var CategorieRepository
    */
    protected $categorieRepository;
    /**
     *
     * @param FormationRepository $formationRepository
     * @param CategorieRepository $categorieRepository
     */
    public function __construct(FormationRepository $formationRepository, CategorieRepository $categorieRepository)
    {
        $this->formationRenderPage = "pages/formations.html.twig";
        $this->formationRepository = $formationRepository;
        $this->categorieRepository= $categorieRepository;
    }
    /**
     *
     * @param type $path
     * @return Response
     */
    #[Route('/formations', name: 'formations')]
    public function index($path=null): Response
    {
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        if ($path === null) {
            return $this->render($this->formationRenderPage, [
            'formations' => $formations,
            'categories' => $categories
            ]);
        } else {
            return $this->render("pages/backoffice/formations.html.twig", [
            'formations' => $formations,
            'categories' => $categories
            ]);
        }
    }
    /**
     *
     * @param type $champ
     * @param type $ordre
     * @param type $table
     * @param type $path
     * @return Response
     */
    #[Route('/formations/tri/{champ}/{ordre}/{table}', name: 'formations.sort')]
    public function sort($champ, $ordre, $table="", $path=null): Response
    {
        $formations = $this->formationRepository->findAllOrderBy($champ, $ordre, $table);
        $categories = $this->categorieRepository->findAll();
        if ($path === null) {
            return $this->render($this->formationRenderPage, [
                'formations' => $formations,
                'categories' => $categories
            ]);
        } else {
           return $this->render($path, [
                'formations' => $formations,
                'categories' => $categories
            ]);
        }
    }
    /**
     *
     * @param type $champ
     * @param Request $request
     * @param type $table
     * @param type $path
     * @return Response
     */
    #[Route('/formations/recherche/{champ}/{table}', name: 'formations.findallcontain')]
    public function findAllContain($champ, Request $request, $table="", $path=null): Response
    {
        $valeur = $request->get("recherche");
        $formations = $this->formationRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();
        if ($path === null) {
            return $this->render($this->formationRenderPage, [
                'formations' => $formations,
                'categories' => $categories,
                'valeur' => $valeur,
                'table' => $table
            ]);
        } else {
            return $this->render($path, [
                'formations' => $formations,
                'categories' => $categories,
                'valeur' => $valeur,
                'table' => $table
            ]);
        }
    }
    /**
     *
     * @param type $id
     * @return Response
     */
    #[Route('/formations/formation/{id}', name: 'formations.showone')]
    public function showOne($id): Response
    {
        $formation = $this->formationRepository->find($id);
        return $this->render("pages/formation.html.twig", [
            'formation' => $formation
        ]);
    }
}
