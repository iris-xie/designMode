<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/1
 * Time: 23:48
 */
namespace designMode\chain;
//版主权限
class admin
{
    protected $power = '1';
    protected $top = 'submits';

    public function make($lev)
    {
        if ($lev <= $this->power) {
            echo '删帖子';
        } else {
            $class = 'designMode\chain\\'.$this->top;
            $topObj = new $class;
            $topObj->make($lev);
        }
    }
}

//管理员权限
class submits
{
    protected $power = '3';
    protected $top = 'police';

    public function make($lev)
    {
        if ($lev <= $this->power) {
            echo '禁止用户发言';
        } else {
            $class = 'designMode\chain\\'.$this->top;
            $topObj = new $class;
            $topObj->make($lev);
        }
    }
}

class plice
{

    //警察权限
//责任链最高层（可以不用判断，责任链模式必须要用到最高一层）

    function make($lev)
    {
        echo '教育处理';
    }

}


/**
 * client
 * 客户端
 */
class Client
{
    /**
     * Main program.
     */
    public static function main()
    {
        //一般是判断权限再去调用区中的类去处理
        //这里的责任链模式
        $lev = 3;
        $adminObj = new admin();
        $adminObj->make($lev);
    }
}

Client::main();
