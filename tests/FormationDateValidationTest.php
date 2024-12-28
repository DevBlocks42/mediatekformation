<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use \App\Repository\FormationRepository;
use App\Entity\Formation;

/**
 * Description of FormationDateValidationTest
 *
 * @author sysadmin
 */
class FormationDateValidationTest extends KernelTestCase
{
    public function getRepo()
    {
        self::bootKernel();
        return self::getContainer()->get(FormationRepository::class);
    }
    public function test_AddFormation()
    {
        $repo = $this->getRepo();
        $count = $repo->count([]);
        $formation = new Formation();
        $formation->setTitle("FORMATION_DE_TEST_DATE_POSTERIEURE");
        $formation->setVideoId("123123321");
        $formation->setPublishedAt(new DateTime('2025-01-01 00:00:00'));
        $repo->add($formation);
        $this->assertNotEquals($count + 1, $repo->count([]), "erreur lors de l'ajout");
    }
    public function test_EditFormation()
    {
        $repo = $this->getRepo();
        $formation = $repo->findOneBy(['id' => 2]);
        $startDate = $formation->getPublishedAt();
        if ($formation) {
            $formation->setPublishedAt(new DateTime('2025-01-01 00:00:00'));
            $repo->edit($formation);
        }
        $f = $repo->findOneBy(['id' => 2]);
        $newDate = $f->getPublishedAt();
        $this->assertEquals($startDate, $newDate, "Modification réussie, la date n'a pas été changée.");
    }
}
