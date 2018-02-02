<?php
namespace Common\Controller;
use Think\Controller\RestController;
/**
 * 公共控制器
 */
class CommonController extends RestController
{
    //引入分页特性
    use page;

    public function _initialize()
    {
        //登陆验证
        if(static::is_cheCkUser($_SERVER['REDIRECT_URL'])) $this->cheCkUser();

        //实例化当前控制器对应的模型并保存到当前控制器的Model属性中
        $this->Model = static::getModel($this);
    }

    const CODE_SUCCESS = 200;
    const CODE_ERROR = 400;
    const CODE_LOGIN_ERROR = 401;
    const CODE_REFRESH_ERROR = 302;
    const CODE_ARGUMENTS_ERROR = 505; //参数错误
    const CODE_NOLOGIN = 604; //用户未登录
    const CODE_ORDER_ERR = 704; //错误的订单号

    /**
     * AJAX 返回成功
     * @param array  $data
     * @param string $message
     * @param int    $code
     * @param int    $status
     * @return array
     */
    public function returnAjaxSuccess($data,$Methods = null)
    {
        static::setHeader($Methods);
        $response = static::dataConversion($data,true);
        static::ajaxReturn($response,'JSON',JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }

    /**
     * AJAX 返回失败
     * @param string $message
     * @param int    $code
     * @param int    $status
     * @return array
     */
    public function returnAjaxError($data,$Methods = null)
    {
        static::setHeader($Methods);
        $response = static::dataConversion($data,false);
        static::ajaxReturn($response,'JSON',JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }

    /**
     * 允许跨域AJAX请求
     */
    private static function setHeader($Methods = null)
    {
        if(APP_DEBUG){
            $host = $_SERVER['HTTP_ORIGIN'];
        }else{
            $host = C('HTTP_ORIGIN');
        }
        header('Content-type: application/json');//请求的数据格式
        //设置中文header头
        header('Content-Type:text/html;CharSet=UTF-8');
//        header('Content-Type: application/x-www-form-urlencoded; charset=UTF-8');//请求的数据格式
        if(!empty($host)) header('Access-Control-Allow-Origin: '.$host);//请求来源
        header('Access-Control-Allow-Headers: content-type,Cookie');//允许的请求头
        header('Access-Control-Allow-Credentials: true');//允许携带cookie数据
        if($Methods && strtolower($Methods) != 'any'){
            if(is_array($Methods)) $Methods = implode(',',$Methods);
            if(strtolower($Methods) == 'match') $Methods = 'GET,POST';
            var_dump($Methods);die;
            header('Access-Control-Allow-Methods: '.$Methods);//允许的请求方式
        }
    }

    /**
     *  智能数据转换
     * @param mixed $data   数组、对象、JSON
     * @return array    数组
     */
    private static function dataConversion($data,$bool = true){
        $tmp['success'] =   $bool;
        $tmp['message'] =   $bool ? '操作成功！':'操作失败！';
        $tmp['status']  =   $bool ? static::CODE_SUCCESS:static::CODE_ERROR;
        $tmp['code']    =   $bool ? 1:0;

        if(is_array($data)){
            return $response = [
                'success'  =>  isset($data['success']) ? $data['success']:$tmp['success'],
                'message'  =>  isset($data['message']) ? $data['message']:$tmp['message'],
                'status'   =>  isset($data['status'])  ? $data['status']:$tmp['status'],
                'status'   =>  isset($data['status'])  ? (is_numeric($data['status']) ? static::$data['status']:$data['status']):$tmp['status'],
                'code'     =>  isset($data['code'])    ? (is_numeric($data['code']) ? static::$data['code']:$data['code']):$tmp['code'],
                'data'     =>  (object)(isset($data['data']) ? $data['data']:[])
            ];
        }elseif(!is_null(json_decode($data)) && is_array($data = json_decode($data,true))){
            return static::dataConversion($data);
        }elseif(is_object($data)){
            return static::dataConversion([
                'data'    => $data->data,
                'code'    => $data->code,
                'message' => $data->message,
                'status'  => $data->status
            ]);
        }elseif(empty($data)){
            return static::returnAjaxError(['message'=>'空参数！']);
        }else{
            return static::returnAjaxError(['message'=>'参数不是：数组、对象、JSON！']);
        }
    }

    /**
     * 用于获取列表并转换格式
     * @param object 传递一个对象，省略代表使用当前对象
     */
    public function getList($obj){
        $obj = $obj ? :$this;
        $list = $obj->select();
        if($list === false) $this->returnAjaxError(['message'=>'获取列表失败！']);
        $tmp = [];
        foreach ($list as $value) {
            $tmp[base64_encode(array_shift($value))] = array_shift($value);
        }
        array_push($tmp, '其他');
        return $tmp;
    }

    /**
     * 登陆验证
     */
    private function cheCkUser(){
        if(empty(session('user_id'))){
            static::returnAjaxError(['message'=>'CODE_NOLOGIN','status'=>static::CODE_NOLOGIN]);
        }else{
            $this->UserID = session('user_id');
        }
    }

    /**
     * 空操作
     */
    public function _empty(){
        static::returnAjaxSuccess([
            'message'=>'非法操作: '.ACTION_NAME,
            'data'   => ['访问位置'=>MODULE_NAME.'\\'.CONTROLLER_NAME.'\\'.ACTION_NAME]
        ]);
    }

    //模型工厂
    private static function getModel($obj){
        if(!is_object($obj)) return M();
        //记录所有数据表名
        $tables = S("tables");
        $namespaces = C('__NAMESPACE__');
        $table = preg_replace('/(?:\w+)\\\(?:\w+\\\)+(\w+)Controller/',"$1",get_class($obj));

        //检测当前模块有没有控制器的同名模型
        if(class_exists(MODULE_NAME.'\Model\\'.$table.'Model')) return D($table);
        $namespaces = array_diff($namespaces,[MODULE_NAME]);
        foreach ($namespaces as $name){
            if(class_exists("{$name}\Model\{$table}Model")) return D($name."/".$table);
        }
        $table = strtolower($table);
        //判断控制器对应模型控制的数据表是否真实存在，如果存在就实例化并保存在当前对象的model属性中
        if(in_array(C("DB_PREFIX") . $table,$tables)){
            return M($table);
        }else{
            $res = M()->query("SHOW TABLES LIKE '%{$table}'");
            if(empty($res)){
                return M();
            }else{
                S("tables",static::getTables());
                static::getModel($obj);
            }
        }
    }

    /**
     * 获取数据表列表
     * @param null $database
     * @return array
     */
    public function getTables($database = null){
        $model = M();
        if(!empty($database)) $model->query('use '.$database);
        $tables = $model->query('show tables');
        foreach ($tables as $value){
            $tmp[] = $value['tables_in_'.C('DB_NAME')];
        }
        return $tmp;
    }

    /**
     * 快速返回Ajax数据
     * @param $res
     * @param $action
     */
    public function quickReturn($res,$action = null,$Methods = null){
        if(empty($action)){
            $message = empty($res) ? '没有更多数据了！':null;
        }else{
            $message = $action;
            $message .= empty($res) ? '失败！':'成功！';

        }
        if(empty($res)){
            static::returnAjaxError(['data'=>$res,'message'=>$message],$Methods);
        }else{
            static::returnAjaxSuccess(['data'=>$res,'message'=>$message],$Methods);
        }
    }

    private static function is_cheCkUser($REDIRECT_URL){
        $REDIRECT_URL = array_filter(explode('/',strtolower($REDIRECT_URL)));
        if(empty($REDIRECT_URL)) return false;
        $cheCkList = array_filter(C('CHECKLIST'));
        foreach ($cheCkList as $item){
            $item = array_filter(explode('/',strtolower($item)));
            $diffs = array_diff_assoc($REDIRECT_URL,$item);
            if(count($diffs)>1) return false;
            if(empty($diffs)) return true;
            $diffs = array_diff_assoc($item,$REDIRECT_URL);
            if(array_shift($diffs) == '*') return true;
        }

    }
}

    /**
     * 设置分页数据
     */
Trait page {
    public function page($boolean = false){
        $page = isset($_POST['page']) ? $_POST['page']:1;
        $pagesize = isset($_POST['pagesize']) ? $_POST['pagesize']:C('__PAGESIZE__');
        $offset = ($page-1) * $pagesize;
        $this->offset   = $offset;
        $this->pagesize = $pagesize;
        if($boolean) return $pagesize;
        return $offset.','.$pagesize;
    }
}