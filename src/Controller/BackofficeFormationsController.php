<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Form\FormationType;
use App\Entity\Formation;
use DateTime;

/**
 * Classe héritant de FormationsController pour réutiliser les tris
 * @author sysadmin
 */
class BackofficeFormationsController extends FormationsController
{
    /**
     *
     * @var String
     */
    private static $formationsRenderPage = "pages/backoffice/formations.html.twig";
    /**
     *
     * @param FormationRepository $formationRepository
     * @param CategorieRepository $categorieRepository
     */
    public function __construct(FormationRepository $formationRepository, CategorieRepository $categorieRepository)
    {
        parent::__construct($formationRepository, $categorieRepository);
    }
    /**
     *
     * @param String $path
     * @return Response
     */
    #[Route('/backoffice/formations', name: 'backoffice_formations')]
    public function index($path=null) : Response
    {
        return parent::index(self::$formationsRenderPage);
    }
    /**
     *
     * @param type $champ
     * @param type $ordre
     * @param type $table
     * @param type $path
     * @return Response
     */
    #[Route('/backoffice/formations/tri/{champ}/{ordre}/{table}', name: 'backoffice_formations.sort')]
    public function sort($champ, $ordre, $table="", $path=null): Response
    {
        return parent::sort($champ, $ordre, $table, self::$formationsRenderPage);
    }
    /**
     *
     * @param String $champ
     * @param Request $request
     * @param String $table
     * @param String $path
     * @return Response
     */
    #[Route('/backoffice/formations/recherche/{champ}/{table}', name: 'backoffice_formations.findallcontain')]
    public function findAllContain($champ, Request $request, $table="", $path=null): Response
    {
        return parent::findAllContain($champ, $request, $table, self::$formationsRenderPage);
    }
    /**
     *
     * @param type $id
     */
    #[Route('/backoffice/formations/delete/{id}', name: 'backoffice_formation.deleteone')]
    public function deleteOne($id): Response
    {
        $formation = $this->formationRepository->findByContainValue("id", $id)[0];
        $this->formationRepository->remove($formation);
        return parent::redirectToRoute("backoffice_formations");
    }
    /**
     * Affiche le formulaire de modification d'entité ou traite la modification d'une entité après soumission
     * du formulaire
     * @param Request $request
     * @return Response
     */
    #[Route('/backoffice/formations/editformation/{id}', name: 'backoffice_formation.editone')]
    public function editOne(Request $request): Response
    {
        $id = $request->get('id');
        $formation = $this->formationRepository->findByContainValue("id", $id)[0];
        $formationType = $this->createForm(FormationType::class, $formation, array(
            'categories' => $formation->getCategories(),
            'playlist' => $formation->getPlaylist()
        ));
        $formationType->handleRequest($request);
        if ($formationType->isSubmitted() && $formationType->isValid()) {
            $formationType->getData();
            $submitDate = $formation->getPublishedAt();
            //On s'assure que la date saisie est bien antérieure à la date actuelle
            if (time() - strtotime($submitDate->format('m/d/Y')) > 0) {
                $this->formationRepository->getEntityManager()->flush();
                $this->addFlash('formation_success', 'La formation a bien été modifiée.');
            } else {
                $this->addFlash('formation_error', '[!] La date ne peut pas être postérieure à la date actuelle.');
            }
        }
        return $this->render("pages/backoffice/editformation.html.twig", [
            'formation_form' => $formationType->createView()
        ]);
    }
    /**
     * Affiche et traite le formulaire d'ajout d'entité
     * @param Request $request
     * @return type
     */
    #[Route('/backoffice/formations/addformation', name: 'backoffice_formation.addone')]
    public function addOne(Request $request)
    {
        $formation = new Formation();
        $formationType = $this->createForm(FormationType::class, $formation, array(
            'categories' => $formation->getCategories(),
            'playlist' => $formation->getPlaylist()
        ));
        $formationType->handleRequest($request);
        if ($formationType->isSubmitted() && $formationType->isValid()) {
            $formation = $formationType->getData();
            $submitDate = $formation->getPublishedAt();
            //On s'assure que la date saisie est bien antérieure à la date actuelle
            if (time() - strtotime($submitDate->format('m/d/Y')) > 0) {
                $this->formationRepository->add($formation);
                $this->addFlash('formation_success', 'La formation a bien été ajoutée.');
            } else {
                $this->addFlash('formation_error', '[!] La date ne peut pas être postérieure à la date actuelle.');
            }
        }
        return $this->render("pages/backoffice/editformation.html.twig", [
            'formation_form' => $formationType->createView()
        ]);
    }
}
