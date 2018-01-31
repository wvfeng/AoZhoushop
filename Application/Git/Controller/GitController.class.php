<?php
namespace Git\Controller;

/**
 * Git控制器
 */
class GitController
{
    private $ProjectPath = '/bweb/azshop'; // 生产环境web目录

    public function Push(){
        \Think\Log::write('REQUEST:'.var_export($_REQUEST,true),'INFO','File','Git.log');
//        $token = 'photo';
//        $wwwUser = 'www';
//        $wwwGroup = 'www';


        $json = json_decode(file_get_contents('php://input'), true);
        \Think\Log::write('INPUT:'.var_export($json,true),'INFO','File','Git.log');
        var_dump($json);die;
        if (empty($json['token']) || $json['token'] !== $token) {
            exit('error request');
        }

        $repo = $json['repository']['name'];

        $cmd = "cd {$this->ProjectPath} && git pull";

        echo exec($cmd);
    }
}