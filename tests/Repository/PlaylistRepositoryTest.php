<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\PlaylistRepository;
use App\Entity\Playlist;

/**
 * Description of PlaylistRepositoryTest
 *
 * @author sysadmin
 */
class PlaylistRepositoryTest extends KernelTestCase
{
    public function getRepo()
    {
        self::bootKernel();
        return self::getContainer()->get(PlaylistRepository::class);
    }
    public function test_add()
    {
        $repo = $this->getRepo();
        $count = $repo->count([]);
        $newPlaylist = new Playlist();
        $newPlaylist->setName("Playlist de test");
        $newPlaylist->setDescription("Lorem ipsum dolor sit amet...");
        $repo->add($newPlaylist);
        $this->assertEquals($count + 1, $repo->count([]), "erreur lors de l'ajout de la playlist");
    }
    public function test_remove()
    {
       $repo = $this->getRepo();
       $count = $repo->count([]);
       $playlist = $repo->findOneBy(['name' => "Playlist de test"]);
        if ($playlist) {
            $repo->remove($playlist);
            $this->assertEquals($count - 1, $repo->count([]), "erreur lors de la suppression de la playlist");
       }
    }
    public function test_findAllOrderByName()
    {
        $repo = $this->getRepo();
        $playlists = $repo->findAllOrderByName('ASC');
        if ($playlists) {
            $this->assertTrue(count($playlists) > 0, "erreur lors de la recherche par nom trié par ordre croissant.");
        }
    }
    public function test_findAllOrderByCount()
    {
        $repo = $this->getRepo();
        $playlists = $repo->findAllOrderByCount('ASC');
        if ($playlists) {
            $this->assertTrue(count($playlists) > 0, "erreur lors de la recherche par nombre de formations.");
        }
    }
    public function test_findByContainValue()
    {
        $repo = $this->getRepo();
        $playlists = $repo->findByContainValue('name', 'TES');
        if ($playlists) {
            $this->assertEquals($playlists[0]->getName(), "TEST", "erreur lors de la recherche par valeur.");
        }
    }
}
