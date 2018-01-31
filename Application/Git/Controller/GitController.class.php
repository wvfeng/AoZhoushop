<?php
namespace Git\Controller;

/**
 * Git控制器
 */
class GitController
{
    private $ProjectPath = '/bweb/azshop'; // 生产环境web目录
    private $token = '89d9a100-0633-11e8-8d23-b19745d39c75';
    private $save = [
        'ref','before','after','created','deleted','forced','base_ref','compare','commits'
    ];
    public function Push(){
        if (!empty($_SERVER['X-GitHub-Event']) || $_SERVER['X-GitHub-Event'] == 'push') {
            $json = json_decode(file_get_contents('php://input'), true);
            foreach ($this->save as $key){
                $input[$key] = $json[$key];
            }
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