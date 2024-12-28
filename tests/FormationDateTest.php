<?php

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

/**
 * Description of FormationDateTest
 *
 * @author sysadmin
 */
class FormationDateTest extends TestCase
{
    /**
     * Méthode de test pour la fonction getPublishedAtString de l'entité Formation
     */
    public function test_getPublishedAtString()
    {
        $formation = new Formation();
        $formation->setPublishedAt(new DateTime("2024-01-01 00:00:00"));
        $this->assertEquals("01/01/2024", $formation->getPublishedAtString());
    }
}
