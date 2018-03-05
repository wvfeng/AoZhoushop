<?php

namespace Common\Model;

/**
 * Class AddressModel
 * @package Common\Model
 */
class AddressModel extends CommonModel
{
    public $delDefault = 'Test';
    protected $_map = [
        'default' => 'sdefault',
        'name' => 'sname',
        'tel' => 'siphone',
        'address' => 'saddress',
    ];
    public function _before_insert(&$data, $options)
    {
        parent::_before_insert($data, $options); // TODO: Change the autogenerated stub
        if(isset($data['sdefault']) && $data['sdefault'] == '1'){
            $this->where(['user_id'=>$data['user_id']])->setField('sdefault','0');
        }
        $data['create_time'] = time();
        $data['update_time'] = time();
    }

    public function _before_update(&$data, $options)
    {
        parent::_before_update($data, $options); // TODO: Change the autogenerated stub
        $data['update_time'] = time();
    }

    public function checkFields($data){
        $checkFields = ['sname','siphone','saddress','daddress'];
        foreach ($checkFields as $key){
            if(empty($data[$key])) return false;
        }
        return true;
    }

    public function setDefault(array $where){
        $res = $this->where($where)->find();
        if(empty($res)) return false;
        $res = $this->where(array_merge($where,['sdefault'=>'1']))->find();
        if(!empty($res)) return true;
        $this->startTrans();
        $delDefault = $this->where(['user_id'=>$where['user_id'],'sdefault'=>'1'])->setField('sdefault','0');
        $setDefault = $this->where($where)->setField('sdefault','1');
        if($delDefault === false || $setDefault === false){
            $this->rollback();
            return false;
        }else{
            $this->commit();
            return true;
        }
    }
}