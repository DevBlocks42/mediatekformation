<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Repository\PlaylistRepository;
use App\Form\PlaylistType;
use App\Entity\Playlist;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of BackofficePlaylistsController
 *
 * @author sysadmin
 */
class BackofficePlaylistsController extends PlaylistsController
{
    /**
     *
     * @param PlaylistRepository $playlistRepository
     * @param CategorieRepository $categorieRepository
     * @param FormationRepository $formationRespository
     */
    public function __construct(
        PlaylistRepository $playlistRepository,
        CategorieRepository $categorieRepository,
        FormationRepository $formationRespository
        )
    {
        $this->playlistsRenderDocument = "pages/backoffice/playlists.html.twig";
        parent::__construct($playlistRepository, $categorieRepository, $formationRespository);
    }
    /**
     *
     * @return Response
     */
    #[Route('/backoffice/playlists', name: 'backoffice_playlists')]
    public function index(): Response
    {
        return parent::index();
    }
    /**
     *
     * @param string $champ
     * @param string $ordre
     * @return Response
     */
    #[Route('/backoffice/playlists/tri/{champ}/{ordre}', name: 'backoffice_playlists.sort')]
    public function sort($champ, $ordre): Response
    {
        return parent::sort($champ, $ordre);
    }
    /**
     *
     * @param string $champ
     * @param Request $request
     * @param string $table
     * @return Response
     */
    #[Route('/backoffice/playlists/recherche/{champ}/{table}', name: 'backoffice_playlists.findallcontain')]
    public function findAllContain($champ, Request $request, $table=""): Response
    {
        return parent::findAllContain($champ, $request, $table);
    }
    /**
     *
     * @param Request $request
     * @param type $id
     * @return Response
     */
    #[Route('/backoffice/playlists/addoreditplaylist/{id?}', name: 'backoffice_playlists.addoreditone')]
    public function addOrEditOne(Request $request, $id=null): Response
    {
        $playlist = null;
        //Il s'agit d'une modification d'entité car l'id n'est pas null.
        if ($id !== null) {
            $playlist = $this->playlistRepository->findByContainValue("id", $id)[0];
        } else {
            $playlist = new Playlist();
        }
        $playlistType = $this->createForm(PlaylistType::class, $playlist, array(
                'formations' => $playlist->getFormations()
        ));
        $playlistType->handleRequest($request);
        if ($playlistType->isSubmitted() && $playlistType->isValid()) {
            $playlist = $playlistType->getData();
            if ($id !== null) {
                $this->playlistRepository->getEntityManager()->flush();
                $this->addFlash('playlist_success', 'La playlist a été modifiée avec succès.');
            } else {
                $this->playlistRepository->add($playlist);
                $this->addFlash('playlist_success', 'La playlist a été ajoutée avec succès.');
            }
            return $this->redirectToRoute("backoffice_playlists");
        }
        return $this->render('pages/backoffice/editoraddplaylist.html.twig', [
                'playlist_form' => $playlistType->createView()
        ]);
    }
    /**
     *
     * @param string $id
     * @return Response
     */
    #[Route('/backoffice/playlists/deleteplaylist/{id}', name: 'backoffice_playlists.deleteone')]
    public function deleteOne($id): Response
    {
        $playlist = $this->playlistRepository->findByContainValue("id", $id)[0];
        if (count($playlist->getFormations()) > 0) {
            $this->addFlash(
                'playlist_error',
                '[!] La playlist n\'a pas pu être supprimée c'
                . 'ar elle est rattachée à une ou plusieurs formations.'
            );
        } else {
            $this->playlistRepository->remove($playlist);
            $this->addFlash('playlist_success', 'La playlist a bien été supprimée.');
        }
        return $this->redirectToRoute("backoffice_playlists");
    }

}
