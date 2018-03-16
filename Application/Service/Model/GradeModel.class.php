<?php

namespace Common\Model;
use Think\Model;

class GradeModel extends Model
{
     public function getGradeInfo($level = 1)
    {
        return  $this -> where(['grade_level' => $level]) -> getField('grader_term_of_validity,grade_level');
    }
}