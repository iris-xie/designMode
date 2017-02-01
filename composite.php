<?php
/**
 * Created by PhpStorm.
 * User: risky
 * Date: 2017/2/1
 * Time: 0:21
 */
namespace designMode\composite;
/**
 * 组合模式 就是实现树形结构
 */
abstract class FormElement
{
    /**
     * renders the elements' code
     *
     * @param int $indent
     *
     * @return mixed
     */
    abstract public function render($indent = 0);
}
/**
 * 组合节点必须实现组件接口，这对构建组件树而言是强制的
 */
class Form extends FormElement
{
    /**
     * @var array|FormElement[]
     */
    protected $elements;

    /**
     * 遍历所有元素并调用它们的render()方法, 然后返回返回完整的表单显示
     *
     * 但是从外部来看, 并没有看见组合过程, 就像是单个表单实例一样
     *
     * @param int $indent
     *
     * @return string
     */
    public function render($indent = 0)
    {
        $formCode = '';

        foreach ($this->elements as $element) {
            $formCode .= $element->render($indent + 1) . PHP_EOL;
        }

        return $formCode;
    }

    /**
     * @param FormElement $element
     */
    public function addElement(FormElement $element)
    {
        $this->elements[] = $element;
    }
}

/**
 * InputElement类
 */
class InputElement extends FormElement
{
    /**
     * 渲染input元素HTML
     *
     * @param int $indent
     *
     * @return mixed|string
     */
    public function render($indent = 0)
    {
        return str_repeat('#', $indent) . '<input type="text" /><br/>'."\n";
    }
}
/**
 * TextElement类
 */
class TextElement extends FormElement
{
    /**
     * 渲染文本元素
     *
     * @param int $indent
     *
     * @return mixed|string
     */
    public function render($indent = 0)
    {
        return str_repeat('#', $indent) . 'this is a text element<br/>'."\n";
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
        $form = new Form();
        $form->addElement(new TextElement());
        $form->addElement(new InputElement());
        $embed = new Form();
        $embed->addElement(new TextElement());
        $embed->addElement(new InputElement());
        $emd3= new Form();
        $emd3->addElement(new TextElement());
        $embed->addElement($emd3);
        $form->addElement($embed);  // 这里我们添加一个嵌套树到表单
        echo $form->render(0);

    }

}
Client::main();