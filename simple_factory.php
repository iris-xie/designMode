<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/30
 * Time: 19:25
 */
/**
 * server
 */
namespace designMode\simpleFactory;
class OperationFactory
{
    public static function getOperation($operate)
    {
        $return = '';
        switch((string)$operate)
        {
            case "+":
                $return = new Add();
                break;
            case "-":
                $return = new Minus();
                break;
            case "*":
                $return = new Time();
                break;
            case "/":
                $return = new Divide();
                break;
        }
        return $return;
    }
}
interface Operation
{
    public function passParameter(array $param);
    public function getResult();
}
class Add implements Operation
{
    protected $param1;
    protected $param2;
    public function passParameter(array $param){
        $this ->param1 = floatval($param[0]);
        $this ->param2 = floatval($param[1]);
    }
    public function getResult(){
        $return = $this->param1 + $this ->param2 ;
        return $return;
    }

}
class Minus implements Operation
{
    protected $param1;
    protected $param2;
    public function passParameter(array $param){
        $this ->param1 = floatval($param[0]);
        $this ->param2 = floatval($param[1]);
    }
    public function getResult(){
        $return = $this->param1 - $this ->param2 ;
        return $return;
    }

}
class Time implements Operation
{
    protected $param1;
    protected $param2;
    public function passParameter(array $param){
        $this ->param1 = floatval($param[0]);
        $this ->param2 = floatval($param[1]);
    }
    public function getResult(){
        $return = $this->param1 * $this ->param2 ;
        return $return;
    }

}
class Divide implements Operation
{
    protected $param1;
    protected $param2;
    public function passParameter(array $param){
        $this ->param1 = floatval($param[0]);
        $this ->param2 = floatval($param[1]);
    }
    public function getResult(){
        try {
            if ( $this ->param2 == 0 ) {
                throw new \Exception('除数不能为0！');
            } else {
                return $this ->param1/$this ->param2;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
        $operateFactory = new OperationFactory();
        $operate = $operateFactory->getOperation('+');
        $operate->passParameter(array(1, 2));
        $operate->getResult();
    }
}

Client::main();