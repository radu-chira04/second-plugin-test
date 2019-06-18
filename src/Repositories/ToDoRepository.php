<?php

namespace ToDoList\Repositories;

use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use ToDoList\Contracts\ToDoRepositoryContract;
use ToDoList\Models\ToDoTest;
use ToDoList\Validators\ToDoValidator;
use Plenty\Modules\Frontend\Services\AccountService;

class ToDoRepository implements ToDoRepositoryContract
{
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * UserSession constructor.
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Get the current contact ID
     * @return int
     */
    public function getCurrentContactId(): int
    {
        return $this->accountService->getAccountContactId();
    }

    /**
     * Add a new item to the To Do list
     *
     * @param array $data
     * @return ToDoTest
     * @throws ValidationException
     */
    public function createTask(array $data): ToDoTest
    {
        try {
            ToDoValidator::validateOrFail($data);
        } catch (ValidationException $e) {
            throw $e;
        }

        /**
         * @var DataBase $database
         */
        $database = pluginApp(DataBase::class);

        $toDo = pluginApp(ToDoTest::class);

        $toDo->taskDescription = $data['taskDescription'];

        $toDo->userId = $this->getCurrentContactId();

        $toDo->createdAt = time();

        $database->save($toDo);

        return $toDo;
    }

    /**
     * List all items of the To Do list
     *
     * @return ToDoTest[]
     */
    public function getToDoList(): array
    {
        $database = pluginApp(DataBase::class);

        $id = $this->getCurrentContactId();
        /**
         * @var ToDoTest[] $toDoList
         */
        $toDoList = $database->query(ToDoTest::class)->where('userId', '=', $id)->get();
        return $toDoList;
    }

    /**
     * Update the status of the item
     *
     * @param int $id
     * @return ToDoTest
     */
    public function updateTask($id): ToDoTest
    {
        /**
         * @var DataBase $database
         */
        $database = pluginApp(DataBase::class);

        $toDoList = $database->query(ToDoTest::class)
            ->where('id', '=', $id)
            ->get();

        $toDo = $toDoList[0];
        $toDo->isDone = true;
        $database->save($toDo);

        return $toDo;
    }

    /**
     * Delete an item from the To Do list
     *
     * @param int $id
     * @return ToDoTest
     */
    public function deleteTask($id): ToDoTest
    {
        /**
         * @var DataBase $database
         */
        $database = pluginApp(DataBase::class);

        $toDoList = $database->query(ToDoTest::class)
            ->where('id', '=', $id)
            ->get();

        $toDo = $toDoList[0];
        $database->delete($toDo);

        return $toDo;
    }
}