<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class AdminModel extends RelationModel
{
    protected $_validate = array(
        array('name', 'require', '账号必选！'),
        array('name', '', '帐号名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('password', 'require', '密码必选！', 0),
    );

    protected $_auto = array(
        array('password', 'md5', 1, 'function'),
        array('password', 'md5', 3, 'function'),
    );
}
