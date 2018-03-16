<?php

namespace Service\Model;
use Think\Model;

class RankModel extends Model
{
    protected $tableName = 'rank';

    public function getRankInfo($memberId)
    {
        return $this->find($memberId);

    }
}