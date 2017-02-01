<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/31
 * Time: 23:39
 */
namespace designMode\adapter;
/**
 * 适配器 没啥说的 就是简单的方法替换
 */
//目标角色
interface Target {
    public function simpleMethod1();
    public function simpleMethod2();
}

//源角色
class Adaptee {

    public function simpleMethod1(){
        echo 'Adapter simpleMethod1'."<br>";
    }
}

//类适配器角色
class Adapter implements Target {
    private $adaptee;


    function __construct(Adaptee $adaptee) {
        $this->adaptee = $adaptee;
    }

    //委派调用Adaptee的sampleMethod1方法
    public function simpleMethod1(){
        echo $this->adaptee->simpleMethod1();
    }

    public function simpleMethod2(){
        echo 'Adapter simpleMethod2'."<br>";
    }

}

//客户端
class Client {

    public static function main() {
        $adaptee = new Adaptee();
        $adapter = new Adapter($adaptee);
        $adapter->simpleMethod1();
        $adapter->simpleMethod2();
    }
}

Client::main();
