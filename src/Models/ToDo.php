<?php

namespace ToDoList\Models;

use Plenty\Modules\Plugin\DataBase\Contracts\Model;

/**
 * Class ToDo
 *
 * @property int $id
 * @property string $taskDescription
 * @property int $userId
 * @property string $userName
 * @property boolean $isDone
 * @property int $createdAt
 * @property string $dateAt
 */
class ToDo extends Model
{
    /**
     * @var int
     */
    public $id = 0;

    /**
     * @var string
     */
    public $taskDescription = '';

    /**
     * @var int
     */
    public $userId = 0;

    /**
     * @var string
     */
    public $userName = '';

    /**
     * @var bool
     */
    public $isDone = false;

    /**
     * @var int
     */
    public $createdAt = 0;

    /**
     * @var string
     */
    public $dateAt = '0000-00-00';

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'ToDoList::ToDo';
    }
}
