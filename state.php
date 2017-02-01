<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/31
 * Time: 23:11
 */
namespace designMode\state;
/*状态模式
*
* 允许一个对象在其内部状态改变时改变它的行为,对象看起来似乎修改了它所属的类
 * 每一个状态在所所属的状态处理类里 做逻辑判断更改状态
*
*/

interface State
{
    public function handle($state);

    public function display();
}

class Context
{
    private $_state = null;

    public function __construct($state)
    {

        $this->setState($state);

    }

    public function setState($state)
    {

        $this->_state = $state;

    }

    public function request()
    {

        $this->_state->display();

        $this->_state->handle($this);
    }

}

class StateA implements State
{

    public function handle($context)
    {

        $context->setState(new StateB());
    }

    public function display()
    {
        echo "state A<br />";
    }
}
class StateB implements State
{
    public function handle($context)
    {
        $context->setState(new StateC());
    }

    public function display()
    {
        echo "state B<br/>";
    }
}

class StateC implements State
{
    public function handle($context)
    {
        $context->setState(new StateA());
    }

    public function display()
    {
        echo "state C<br/>";
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
        // 实例化一下
        $objContext = new Context(new StateB());
        $objContext->request();
        $objContext->request();
        $objContext->request();
        $objContext->request();
        $objContext->request();

    }

}

Client::main();
