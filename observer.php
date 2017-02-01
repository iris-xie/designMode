<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/31
 * Time: 21:50
 */
namespace designMode\observer;

/**
 * 观察者模式是定义一对多的关系
 */
abstract class Subject
{
    private $observers;

    public function add(Observer $observer)
    {
        if (empty($this->observers)) $this->observers = array();
        array_push($this->observers, $observer);
    }

    public function remove(Observer $observer)
    {
        $key = array_search($observer, $this->observers);
        array_splice($this->observers, $key, 1);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

class CreateSubject extends Subject
{
    private $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }
}

interface Observer
{
    public function update();
}

class CreateObserver implements Observer
{
    private $subject;

    public function setSubject(CreateSubject $subject)
    {
        $this->subject = $subject;
    }

    public function update()
    {
        echo $this->subject->getState();
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
        $boss = new CreateSubject();
        $employee = new CreateObserver();
        $employee->setSubject($boss);
        $boss->setState(111);
        $boss->add($employee);
        $boss->notify();
    }

}

Client::main();