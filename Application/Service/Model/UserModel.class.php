<?php

namespace Service\Model;
use Think\Model;

class UserModel extends Model
{
    public function recommendedPerson($userId)
    {
        return $this -> where(['id' => $userId]) -> getField('parent_id');
    }

}