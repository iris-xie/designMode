<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/30
 * Time: 23:08
 */
/**
 * 工厂方法模式，定义一个用于创建对象的接口，让子类决定将哪一个类实例化。工厂方法模式让一个类的实例化延迟到其子类。
 *
 * 包含的对象
 * 1，抽象产品
 * 2，具体产品
 * 3，抽象工厂
 * 4，具体工厂
 *
 * 将简单工厂模式的工厂类进行抽象化，避免扩展时需要修改简单工厂模式中的工厂类。方便扩展、维护。
 **/
namespace designMode\factory;
/**
 * 运算类
 **/
abstract class Operation
{
    abstract public function getValue($num1,$num2);
}

/**
 * 加法类
 **/
class OperationPlus extends Operation
{
    public function getValue($num1,$num2) {
        return $num1 + $num2;
    }
}

/**
 * 减法类
 **/
class OperationSub extends Operation
{
    public function getValue($num1,$num2) {
        return $num1 - $num2;
    }
}

/**
 * 乘法类
 **/
class OperationMul extends Operation
{
    public function getValue($num1,$num2) {
        return $num1 * $num2;
    }
}

/**
 * 除法类
 **/
class OperationDiv extends Operation
{
    public function getValue($num1,$num2) {
        try {
            if ( $num2 == 0 ) {
                throw new Exception('除数不能为0！');
            } else {
                return $num1/$num2;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

/**
 * 抽象工厂类
 **/
abstract class Factory
{
    public abstract function getOperation();
}

/**
 * 加法工厂
 **/
class FactoryPlus extends Factory
{
    public function getOperation() {
        return new OperationPlus();
    }
}

/**
 * 加法工厂
 **/
class FactorySub extends Factory
{
    public function getOperation() {
        return new OperationSub();
    }
}

/**
 * 加法工厂
 **/
class FactoryMul extends Factory
{
    public function getOperation() {
        return new OperationMul();
    }
}

/**
 * 除法法工厂
 **/
class FactoryDiv extends Factory
{
    public function getOperation() {
        return new OperationDiv();
    }
}
/**
 * client
 */
class Client
{
    /**
     * Main program.
     */
    public static function main()
    {
        // 加法
        $factory = new FactoryPlus();
        $operation = $factory->getOperation();
        echo $operation->getValue(10,11);

// 减法
        $factory = new FactorySub();
        $operation = $factory->getOperation();
        echo $operation->getValue(10,11);

// 除法
        $factory = new FactoryDiv();
        $operation = $factory->getOperation();
        echo $operation->getValue(10,2);
    }
}

Client::main();
