<?php

namespace Computer\Model;

/**
 * Class ImagesModel
 * @package Computer\Model
 */

class ImagesModel extends CommonModel
{
    protected $resource_path_old;

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

    public function _before_insert(&$data, $options)
    {
        parent::_before_insert($data, $options); // TODO: Change the autogenerated stub
        $data['create_time'] = $data['update_time'] = time();
    }
    public function _before_update(&$data, $options)
    {
        parent::_before_update($data, $options); // TODO: Change the autogenerated stub
        $data['update_time'] = time();
    }
}