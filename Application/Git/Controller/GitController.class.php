<?php
namespace Git\Controller;

/**
 * Git控制器
 */
class GitController
{
    private $ProjectPath = '/bweb/azshop'; // 生产环境web目录
    private static $LogPath     = null; // 生产环境web目录
    private $token = '89d9a100-0633-11e8-8d23-b19745d39c75'; //Token
    private $title = '代码提交失败！';
    private $content;
    private $Address;
    //设置日志记录的信息
    private $save = [
        'ref','before','after','created','deleted','forced','base_ref','compare','commits'
    ];

    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->Address = array_filter(C('Administrators'));
        self::$LogPath = C('LOG_PATH').date('y_m_d').'_pull.log';
    }

    /**
     * push钩子
     */
    public function Push(){
        echo 111;die;
        $json = json_decode(file_get_contents('php://input'), true);
        foreach ($this->save as $key){
            $input[$key] = $json[$key];
        }
        if (!empty($_SERVER['HTTP_X_GITHUB_EVENT']) && $_SERVER['HTTP_X_GITHUB_EVENT'] == 'push' && in_array('refs/heads/master',$input)) {
            static::writeLog($input);
            $cmd = "cd {$this->ProjectPath} && git pull 2>&1;";

            $data['Command'] = $cmd;
            exec($cmd,$data,$status);

            if($status === 0){
                echo 'success';
                static::writeLog($data,'INFO','EXEC');
            }else{
                echo 'error'.PHP_EOL;
                echo 'log_path:'.static::$LogPath;
                print_r($data);
                static::writeLog($data,'ERR','EXEC');
                $content = '<h1 style="color: red">错误详情:</h1>';
                foreach ($data as $itme){
                    $content .= '<p>'.$itme.'</p>';
                }
                $content .= '<p>log_path:'.static::$LogPath.'</p>';
                $this->content = $content;
                A('Common/Email')->SendEmail($this->title,$this->content,$this->Address);
            }
        }elseif(!in_array('refs/heads/master',$input)){
            echo $input['ref'];
        }else{
            echo 'Test success';
        }
    }

    /**
     * @param $data
     * @param string $typa
     * @param string $exec
     */
    private function writeLog($data,$type = 'INFO',$exec = 'INPUT'){
        \Think\Log::write($exec.':'.var_export($data,true),$type,'File',static::$LogPath);
    }
}