<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use \App\Repository\FormationRepository;
use App\Entity\Formation;

/**
 * Description of FormationRepositoryTest
 *
 * @author sysadmin
 */
class FormationRepositoryTest extends KernelTestCase
{
   private $expectedString = "Formation de test...";
   public function getRepo()
   {
       self::bootKernel();
       return self::getContainer()->get(FormationRepository::class);
   }
   public function test_add()
   {
       $repo = $this->getRepo();
       $count = $repo->count([]);
       $newFormation = new Formation();
       $newFormation->setTitle($expectedString);
       $newFormation->setDescription("Lorem ipsum dolor sit amet...");
       $newFormation->setVideoId("12312311");
       $newFormation->setPublishedAt(new DateTime("now"));
       $repo->add($newFormation);
       $this->assertEquals($count + 1, $repo->count([]), "erreur lors de l'ajout de la formation");
   }
   public function test_remove()
   {
       $repo = $this->getRepo();
       $count = $repo->count([]);
       $formation = $repo->findOneBy(['title' => $expectedString]);
       if ($formation) {
           $repo->remove($formation);
            $this->assertEquals($count - 1, $repo->count([]), "erreur lors de la suppression de la formation");
       }
   }
   public function test_findAllOrderBy()
   {
       $repo = $this->getRepo();
       $formations = $repo->findAllOrderBy('publishedAt', 'ASC');
       $this->assertTrue(count($formations) > 0, "erreur lors de la recherche par champ selon ordre.");
   }
   public function test_findByContainValue()
   {
       $repo = $this->getRepo();
       $formations = $repo->findByContainValue("title", $expectedString);
       if ($formations) {
           $this->assertTrue(count($formations) > 0, "erreur lors de la recherche par valeur sur champ.");
       }
   }
   public function test_findAllLasted()
   {
       $n = 2;
       $repo = $this->getRepo();
       $formations = $repo->findAllLasted($n);
       $this->assertTrue(count($formations) === $n, "erreur lors de la recherche des n dernières formations.");
   }
}
