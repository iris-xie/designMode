<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/30
 * Time: 23:32
 */
namespace designMode\template;
/**
 * 抽象模板角色
 * 定义抽象方法作为顶层逻辑的组成部分，由子类实现
 * 定义模板方法作为顶层逻辑的架子，调用基本方法组装顶层逻辑
 */
abstract class Abstract_class {
    abstract public function primitive_operation1();
    abstract public function primitive_operation2();

    public function template_method() {
        echo "this is the template_method<br/>";
        $this->primitive_operation1();
        $this->primitive_operation2();
    }
}

class Concrete_class_A extends Abstract_class {
    public function primitive_operation1() {
        echo "具体类A方法1实现<br/>";
    }
    public function primitive_operation2() {
        echo "具体类A方法2实现<br/>";
    }
}

class Concrete_class_B extends Abstract_class {
    public function primitive_operation1() {
        echo "具体类B方法1实现<br/>";
    }
    public function primitive_operation2() {
        echo "具体类B方法2实现<br/>";
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
        $c = new Concrete_class_A();
        $c->template_method();

        $c = new Concrete_class_B();
        $c->template_method();
    }

}
Client::main();