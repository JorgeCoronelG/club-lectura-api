<?php

namespace App\Repositories;

use App\Contracts\Repositories\IStudentRepository;
use App\Core\BaseRepository;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 22/03/2022
 */
class StudentRepository extends BaseRepository implements IStudentRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param Student $student
     */
    public function __construct(Student $student)
    {
        $this->entity = $student;
    }
}
