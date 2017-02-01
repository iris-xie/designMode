<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/30
 * Time: 20:16
 */
/**
 * 一、意图 定义一系列的算法，把它们一个个封装起来，并且使它们可相互替换。策略模式可以使算法可独立于使用它的客户而变化策略模式变化的是算法
 */
/**
 * server
 */
namespace designMode\Strategy;
interface Strategy
{
    public function run();
}
class StrategyA implements Strategy
{
    public function run()
    {
        // TODO: Implement run() method.
    }
}
class StrategyB implements Strategy
{
    public function run()
    {
        // TODO: Implement run() method.
    }
}
class Context
{
    public $strategy;
    public function __construct(Strategy $strategy)
    {
        $this->strategy=$strategy;
    }
    public function getResult()
    {
        $this->strategy->run();
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
        $strategyA = new StrategyA();
        $context = new Context($strategyA);
        $context->getResult();

        $strategyA = new StrategyA();
        $context = new Context($strategyA);
        $context->getResult();
    }

}

Client::main();