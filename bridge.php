<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/1
 * Time: 0:56
 */
/**
 * 桥接模式：将两个原本不相关的类结合在一起，然后利用两个类中的方法和属性，输出一份新的结果。其实就是依赖注入
 */
abstract class Abstraction { // 抽象化角色，抽象化给出的定义，并保存一个对实现化对象的引用。
    protected $imp; // 对实现化对象的引用
    public function operation() {
        $this->imp->operationImp();
    }
}

class RefinedAbstraction extends Abstraction { // 修正抽象化角色, 扩展抽象化角色，改变和修正父类对抽象化的定义。
    public function __construct(Implementor $imp) {
        $this->imp = $imp;
    }
    public function operation() { $this->imp->operationImp(); }
}

abstract class Implementor { // 实现化角色, 给出实现化角色的接口，但不给出具体的实现。
    abstract public function operationImp();
}

class ConcreteImplementorA extends Implementor { // 具体化角色A
    public function operationImp() {}
}

class ConcreteImplementorB extends Implementor { // 具体化角色B
    public function operationImp() {}
}

// client
$abstraction = new RefinedAbstraction(new ConcreteImplementorA());
$abstraction->operation();
$abstraction = new RefinedAbstraction(new ConcreteImplementorB());
$abstraction->operation();