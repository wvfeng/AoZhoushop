<?php
namespace Git\Controller;

/**
 * Git控制器
 */
class GitController
{
    private $ProjectPath = '/bweb/azshop'; // 生产环境web目录
    private $LogPath     = null; // 生产环境web目录
    private $token = '89d9a100-0633-11e8-8d23-b19745d39c75'; //Token
    private $save = [
        'ref','before','after','created','deleted','forced','base_ref','compare','commits'
    ];

    /**
     * 构造方法
     */

    public function __construct()
    {
        static::$LogPath = C('LOG_PATH').date('y_m_d').'_Pull.log';
    }

    /**
     * push钩子
     */
    public function Push(){
        if (!empty($_SERVER['HTTP_X_GITHUB_EVENT']) || $_SERVER['HTTP_X_GITHUB_EVENT'] == 'push') {
            $json = json_decode(file_get_contents('php://input'), true);
            foreach ($this->save as $key){
                $input[$key] = $json[$key];
            }
            static::writeLog($input);
            $cmd = "cd {$this->ProjectPath} && git pull;";

            $data['EXEC'] = $cmd;
            exec($cmd,$data,$status);

            if($status === 0){
                static::writeLog($data,'INFO','EXEC');
            }else{
                static::writeLog($data,'ERR','EXEC');
            }
        }
    }

    /**
     * @param $data
     * @param string $typa
     * @param string $exec
     */
    private function writeLog($data,$typa = 'INFO',$exec = 'INPUT'){
        \Think\Log::write($exec.':'.var_export($data,true),'INFO');
    }
}