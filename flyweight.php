<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/2
 * Time: 0:27
 */
namespace designMode\flyWeight;

//机枪兵享元
class MarineFlyweight
{
    //绘制机枪兵的图像动画，参数为状态，比如属于哪一个玩家
    public function drawMarine($state)
    {
        echo $state;
    }
}

//享元工厂
class FlyweightFactory
{
    //享元数组，用于存放多个享元
    private $flyweights;

    //获取享元的方法
    public function getFlyweight($name)
    {
        if (!isset($flyweights[$name]))
        {
            $Cname = 'designMode\flyWeight\\'.$name."Flyweight";
            $this->flyweights[$name] = new $Cname;
        }
        return $this->flyweights[$name];
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
        //初始化享元工厂
        $flyweightFactory = new FlyweightFactory();

//当我们需要绘制一个机枪兵的时候，同时传递一个状态数组，里面包含剩余的血等等
        $marine = $flyweightFactory->getFlyweight("Marine");
        $marine->drawMarine(2133);
    }
}

Client::main();
