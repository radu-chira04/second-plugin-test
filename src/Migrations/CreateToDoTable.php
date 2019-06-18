<?php

namespace ToDoList\Migrations;

use ToDoList\Models\ToDoTest;
use Plenty\Modules\Plugin\DataBase\Contracts\Migrate;

/**
 * Class CreateToDoTable
 */
class CreateToDoTable
{
    /**
     * @param Migrate $migrate
     */
    public function run(Migrate $migrate)
    {
        $migrate->createTable(ToDoTest::class);
    }
}
