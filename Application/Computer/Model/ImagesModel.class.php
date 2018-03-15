<?php

namespace Computer\Model;

/**
 * Class ImagesModel
 * @package Computer\Model
 */

class ImagesModel extends CommonModel
{
    protected $resource_path_old;

    protected $_auto = [
        ['create_time','time',self::MODEL_INSERT,'function'] , // 创建时间
        ['update_time','time',self::MODEL_BOTH,'function'] , // 更新时间
    ];

    public function _before_delete($options)
    {
        $this->resource_path_old = $this->where($options['where'])->getField('resource',true);
        parent::_before_delete($options); // TODO: Change the autogenerated stub
    }

    public function _after_delete($data, $options)
    {
        parent::_after_delete($data, $options); // TODO: Change the autogenerated stub
        foreach ($this->resource_path_old as $file){
            //销毁文件
            if(file_exists($file)){
                unlink($file);
            }
            //销毁缩略图文件
            $thumb_file = dirname($file).'/thumb_'.basename($file);
            if(file_exists($thumb_file)){
                unlink($thumb_file);
            }
        }
    }
}