<?php
/**
 * Task fixtures.
 *
 * This file is part of the notes-and-to-do-app.
 *
 * (c) [Michał Dudek] <michalpawel.dudek@student.uj.edu.pl>
 */

namespace App\DataFixtures;

use App\Entity\Task;

/**
 * Class TaskFixtures.
 */
class TaskFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     */
    public function loadData(): void
    {
        for ($i = 0; $i < 30; ++$i) {
            $task = new Task();
            $task->setTitle($this->faker->sentence);
            $task->setCreatedAt(
                \DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $task->setUpdatedAt(
                \DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $this->manager->persist($task);
        }

        $this->manager->flush();
    }
}
