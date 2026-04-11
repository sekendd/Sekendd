<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'age', 'course', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
