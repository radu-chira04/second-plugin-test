<?php

namespace ToDoList\Contracts;

use ToDoList\Models\ToDoTest;

/**
 * Class ToDoRepositoryContract
 * @package ToDoList\Contracts
 */
interface ToDoRepositoryContract
{
    /**
     * Add a new task to the To Do list
     *
     * @param array $data
     * @return ToDoTest
     */
    public function createTask(array $data): ToDoTest;

    /**
     * List all tasks of the To Do list
     *
     * @return ToDoTest[]
     */
    public function getToDoList(): array;

    /**
     * Update the status of the task
     *
     * @param int $id
     * @return ToDoTest
     */
    public function updateTask($id): ToDoTest;

    /**
     * Delete a task from the To Do list
     *
     * @param int $id
     * @return ToDoTest
     */
    public function deleteTask($id): ToDoTest;
}
