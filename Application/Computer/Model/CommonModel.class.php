<?php

namespace Computer\Model;

use Common\Model\CommonModel as Model;

/**
 * Class CommonModel
 * @package Computer\Model
 * 公共模型库
 */

class CommonModel extends Model
{
    //根据数据表获取全部字段信息
    public function getFields($obj){

        $obj = $obj ? :$this;
        $fields = $obj->getDbFields();
        $list = "";
        foreach($fields as $key=>$value){
            $list .= "'" . $value . "',";
        }
        return trim($list,",");
    }

    //封装图片上传方法
    public function uploadImg($image,$path){

        //base64转换
        $image = explode(',',$image);
        $type = substr(strstr(strstr($image['0'],';',-1),'/'),1);
        $imageName = md5(time()).'.'.$type;

        if (!is_dir($path)){
            //判断目录是否存在 不存在就创建
            mkdir($path,0777,true);
        }

        $imagePath =  $path."/". $imageName;  //图片名字
        $r = file_put_contents($imagePath, base64_decode($image['1']));//返回的是字节数
        if($r) {
            return $imagePath;
        }else{
            return json_decode(['data'=>null,"code"=>0,"msg"=>"图片生成失败"]);
        }
    }

    /**
     * @param mixed 传递单个字符串按照id作为查询条件；单个数组或json按照键值对应关系进行查找；两个参数第一个为条件第二个为条件值；
     * @return int/bool 参数合法将返回int类型；参数不合法返回false；
     */
    public function getCount(){
        $num = func_num_args();
        $tmp = func_get_args();
        if($tmp['MAX']){
            $max = $tmp['MAX'];
            unset($tmp['MAX']);
            $num--;
        }else{
            $max = pow(10,4);
        }
        if(isset($tmp['OBJ'])){
            $obj = $tmp['OBJ'];
            unset($tmp['OBJ']);
            $num--;
        }else{
            $obj = $this;
        }
        if(!$num){
            return $obj->count();
        }elseif($num == 1){
            $tmp = array_shift($tmp);
            if(is_array($tmp)){
                foreach ($tmp as $key => $value){
                    $where[] =  $key.'='.$value;
                }
                $where = implode(',',$where);
            }elseif(!is_null(json_decode($tmp))){
                $obj->getCount(json_decode($tmp,true));
            }else{
                $where = 'id ='.$tmp;
            }
        }elseif($num == 2){
            $where = array_shift($tmp).'='.array_shift($tmp);
        }elseif($num > 2 && $num%2 == 0){
            foreach ($tmp as $value){
                $where[] = array_shift($tmp).'='.array_shift($tmp);
            }
            array_filter($where);
            $where = implode(',',$where);
        }else{
            $obj->error = '参数格式不正确！';
            echo '参数格式不正确！';
            return false;
        }
        return $obj->where($where)->count();
    }

    /**
     * @param string $name 传递用户名，判断用户名是否存在
     * @return mixed 存在返回用户ID，不存在返回false
     */
    public function user_exists($name,$obj=null){
        $obj = $obj ? : $this;
        $name = addslashes($name);
        $res = $obj->field('id')->where('name="'.$name.'"')->find();
        if($res === false){
            return false;
        }else{
            return $res['id'];
        }
    }
}