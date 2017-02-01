<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/30
 * Time: 20:59
 */
namespace designMode\decorate;
/**
 * server
 * 1.装饰者(Milk)和被装饰者(Coffee)必须是一样的类型。目的是装饰者必须取代被装饰者。
 * 2.添加行为：当装饰者和组件组合时，就是在加入新的行为。
 * 装饰行为不是一种必须的行为 所以要单独添加
 */
// 被装饰者类
interface Base
{
    public function show();

}
class Coffee implements Base
{
    public function show(){
        echo '纯咖啡';
    }
}
interface Component
{
    public function decorate(Base $component);
}

//组件类
class Sugar implements Component,Base
{
    public $_component;
    public function decorate(Base $component){
        $this->_component = $component;
    }
    public function show(){
        $this->_component->show();
        echo '加糖了';
    }
}
class Milk implements Component,Base
{
    public $_component;
    public function decorate(Base $component){
        $this->_component = $component;
    }
    public function show(){
        $this->_component->show();
        echo '加奶了';
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

        $coffee = new Coffee();
        $milk   = new Milk();
        $sugar  = new Sugar();
        $milk->decorate($coffee);
        $sugar->decorate($milk);
        $sugar->show();
    }
}

Client::main();