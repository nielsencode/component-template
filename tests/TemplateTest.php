<?php

require_once __DIR__.'/../src/Template/Template.php';

use Components\Template\Template;

class TemplateTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->template = new Template(__DIR__.'/templates');
    }

    public function templateProvider()
    {
        return [
            [
                'home.php',
                ['greeting' => 'Welcome!'],
                file_get_contents(__DIR__.'/output/home.txt')
            ]
        ];
    }

    /**
     * @dataProvider templateProvider
     */
    public function testTemplate($template,$data,$output)
    {
        ob_start();

        $this->template->render($template,$data);

        $this->assertEquals($output,ob_get_clean());
    }
}
