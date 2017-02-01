<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/1
 * Time: 23:59
 */
namespace designMode\medium;
//中介者接口：可以是公共的方法，如Change方法，也可以是小范围的交互方法。
//同事类定义：比如，每个具体同事类都应该知道中介者对象，也就是每个同事对象都会持有中介者对象的引用，这个功能可定义在这个类中。

//抽象国家
abstract class Country
{
    protected $mediator;
    public function __construct(UnitedNations $_mediator)
    {
        $this->mediator = $_mediator;
    }
}

//具体国家类
//美国
class USA extends Country
{
    function __construct(UnitedNations $mediator)
    {
        parent::__construct($mediator);
    }

    //声明
    public function Declared($message)
    {
        $this->mediator->Declared($message,$this);
    }

    //获得消息
    public function GetMessage($message)
    {
        echo '美国获得对方消息：'.$message
    ;
    }
}
//中国
class China extends Country
{
    public function __construct(UnitedNations $mediator)
    {
        parent::__construct($mediator);
    }
    //声明
    public function  Declared($message)
    {
        $this->mediator->Declared($message, $this);
    }

    //获得消息
    public function GetMessage($message)
    {
        echo '中方获得对方消息：'.$message
    ;
    }
}

//抽象中介者
//抽象联合国机构
abstract class UnitedNations
{
    //声明
    public abstract function Declared($message,Country $colleague);
}

//联合国机构
class UnitedCommit extends UnitedNations
{
    public $country;

    //声明
    public function Declared($message, Country $colleague)
    {
        foreach($this->country as $country)
        {
            if($country != $colleague)
            {
                $country->GetMessage($message);
            }
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
        //测试代码块
        $UNSC = new UnitedCommit();
        $c1 = new USA($UNSC);
        $c2 = new China($UNSC);
        $UNSC->country = array();
        array_push($UNSC->country , $c2);
        array_push($UNSC->country, $c1);
        $c1->Declared('姚明的篮球打的就是好');
        $c2->Declared('谢谢');
    }
}

Client::main();

