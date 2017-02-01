<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/1
 * Time: 0:38
 */
namespace designMode\singleton;
class User {
    //静态变量保存全局实例
    private static $_instance = null;
    //私有构造函数，防止外界实例化对象
    private function __construct() {
    }
    //私有克隆函数，防止外办克隆对象
    private function __clone() {
    }
    //静态方法，单例统一访问入口
    static public function getInstance() {
        if (is_null ( self::$_instance ) || !isset ( self::$_instance )) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }
    public function getName() {
        echo 'hello world!';
    }
}
/**
 * client
 * 客户端
 */
class Client {
    /**
     * Main program.
     */
    public static function main() {

        $user = User::getInstance();
        echo $user->getName();
    }

}

Client::main();