<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/30
 * Time: 22:18
 */
namespace designMode\proxy;
/**
 * server
 */
interface action
{
    public function giveGift();

    public function giveFlower();
}

class SchoolGirl
{
    public $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Pursuit implements action
{
    public $target;

    public function __construct(SchoolGirl $girl)
    {
        $this->target = $girl;
    }

    public function giveGift()
    {
        echo $this->target->name . "收到了礼物\n";
    }

    public function giveFlower()
    {
        echo $this->target->name . "收到了花\n";
    }
}

class Proxy implements action
{
    public $follower;

    public function __construct(SchoolGirl $girl)
    {
        $this->follower = new Pursuit($girl);
    }

    public function giveGift()
    {
        $this->follower->giveGift();
    }

    public function giveFlower()
    {
        $this->follower->giveFlower();
    }
}

/**
 * client
 * 客户端
 */
class Client
{
    /**
     * Main program.
     */
    public static function main()
    {
        $girl = new SchoolGirl();
        $girl->setName('景甜');
        $proxy = new Proxy($girl);
        $proxy->giveGift();
        $proxy->giveFlower();
    }
}

Client::main();