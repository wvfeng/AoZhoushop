<?php
namespace Git\Controller;

/**
 * Git控制器
 */
class GitController
{
    private $ProjectPath = '/bweb/azshop'; // 生产环境web目录
    private $token = '89d9a100-0633-11e8-8d23-b19745d39c75';
    public function Push(){
        $input = json_decode(file_get_contents('php://input'), true);

        $hook = $input['hook'];
        if (empty($hook) || !$hook['active'] || in_array('push',$hook['events'])) {
            static::writeLog($input,'ERR');
        }else{
            static::writeLog($input);
            $cmd = "cd {$this->ProjectPath} && git pull;";

            exec($cmd,$data,$status);
            if($status === 0){
                static::writeLog($data,'INFO','EXEC');
            }else{
                static::writeLog($data,'ERR','EXEC');
            }
        }
    }

    private function writeLog($data,$typa = 'INFO',$exec = 'INPUT'){
        \Think\Log::write($exec.':'.var_export($data,true),'INFO','File','Git.log');
    }
}