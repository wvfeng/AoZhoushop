<?php

namespace Mobile\Model;
use Think\Model;

class RealnameModel extends Model
{
   protected $_validate = array(
   	 array('name','require','不能为空！',1),
     array('idtype','require','不能为空！',1),
     array('no','require','不能为空！',1),
   );
}