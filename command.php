<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/1
 * Time: 1:26
 */
namespace designMode\command;
interface Command {
    function onCommand($name, $args);
}

class CommandChain {
    private $_commands = array();
    public function addCommand($cmd) {
        $this->_commands []= $cmd;
    }

    public function runCommand($name, $args) {
        foreach($this->_commands as $cmd) {
            if ($cmd->onCommand($name, $args)) return;
        }
    }
}

class UserCommand implements Command {
    public function onCommand($name, $args) {
        if ($name != 'addUser') return false;
        echo("UserCommand handling 'addUser'\n");
        return true;
    }
}

class MailCommand implements Command {
    public function onCommand($name, $args) {
        if ($name != 'mail') return false;
        echo("MailCommand handling 'mail'\n");
        return true;
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
        $cc = new CommandChain();
        $cc->addCommand(new UserCommand());
        $cc->addCommand(new MailCommand());
        $cc->runCommand('addUser', null);
        $cc->runCommand('mail', null);
    }
}
Client::main();
