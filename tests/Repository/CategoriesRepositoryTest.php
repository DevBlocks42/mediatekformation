<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\CategorieRepository;
use App\Entity\Categorie;

/**
 * Description of CategoriesRepositoryTest
 *
 * @author sysadmin
 */
class CategoriesRepositoryTest extends KernelTestCase
{
    public function getRepo()
    {
        self::bootKernel();
        return self::getContainer()->get(CategorieRepository::class);
    }
    public function test_add()
    {
        $repo = $this->getRepo();
        $count = $repo->count([]);
        $categorie = new Categorie();
        $categorie->setName("TEST");
        $repo->add($categorie);
        $this->assertEquals($count + 1, $repo->count([]), "erreur lors de l'ajout de la catégorie");
    }
    public function test_remove()
    {
        $repo = $this->getRepo();
        $count = $repo->count([]);
        $categorie = $repo->findOneBy(['name' => "TEST"]);
        $repo->remove($categorie);
        $this->assertEquals($count - 1, $repo->count([]), "erreur lors de la suppression de la catégorie");
    }
    public function test_findAllForOnePlaylist()
    {
        $repo = $this->getRepo();
        $categories = $repo->findAllForOnePlaylist(1);
        $this->assertTrue(count($categories) > 0, "erreur lors de la recherche des catégories pour une playlist.");
    }
}
