<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/1/31
 * Time: 23:56
 */
/**
 * 备忘录模式 就是提供一个单独的状态记录类
 */


//游戏角色
class GameRole
{
    #region 游戏角色状态属性（生命力、攻击力、防御力）
    public $liveLevel;

    public $attackLevel;

    public $defenseLevel;
    #endregion

    //保存状态
    public function SaveState()
    {
        return (new RoleStateMemento($this->liveLevel,$this->attackLevel,$this->defenseLevel));
    }

    //恢复状态
    public function RecoveryState(RoleStateMemento $_memento)
    {
        $this->liveLevel = $_memento->liveLevel;
        $this->attackLevel = $_memento->attackLevel;
        $this->defenseLevel = $_memento->defenseLevel;
    }

    //------------其他属性及操作--------------
    //获得初始状态
    public function GetInitState()
    {
        $this->defenseLevel = 100;
        $this->attackLevel = 100;
        $this->liveLevel = 100;
    }

    //状态显示
    public function StateDisplay()
    {
        echo "角色状态：<br/>";
        echo "生命力：{$this->liveLevel}<br/>";
        echo "攻击力：{$this->attackLevel}<br/>";
        echo "防御力：{$this->defenseLevel}<br/>";
    }

    //被攻击
    public function BeenAttack()
    {
        $this->liveLevel -= 9.5;
        if($this->liveLevel<=0)
        {
            $this->liveLevel = 0;
            echo "呃，该角色阵亡了！<br/>";
            echo "Game Over!<br/>";
            return;
        }

        $this->attackLevel -= 1.1;
        if($this->attackLevel<=0)
        {
            $this->attackLevel = 0;
        }

        $this->defenseLevel -= 0.5;
        if($this->defenseLevel<=0)
        {
            $this->defenseLevel = 0;
        }
    }
}

//角色状态存储箱类
class RoleStateMemento
{
    public $liveLevel;
    public $attackLevel;
    public $defenseLevel;

    public function RoleStateMemento($_ll,$_al,$_dl)
    {
        $this->liveLevel=$_ll;
        $this->attackLevel=$_al;
        $this->defenseLevel=$_dl;
    }
}

//游戏角色状态管理者类
class RoleStateManager
{
    public $memento;
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
        $ufo = new GameRole();
        $ufo->GetInitState();
        echo "<span style='color:#ff0000'>----------------开战前-----------------</span><br/>";
        $ufo->StateDisplay();
        $ufo->attackLevel=111;
        //保存进度
        $roleMan = new RoleStateManager();
        $roleMan->memento = $ufo->SaveState();
        //恢复之前状态
        $ufo->RecoveryState($roleMan->memento);
        $ufo->StateDisplay();
    }
}

Client::main();