<?php

/**
 * This file is part of the notes-and-to-do-app.
 *
 * (c) [Michał Dudek] <michalpawel.dudek@student.uj.edu.pl>
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * AppFixtures.
 */
class AppFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager Manager
     */
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }// end load()
}// end class
