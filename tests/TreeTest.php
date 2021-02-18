<?php
use PHPUnit\Framework\TestCase;
use Grav\Plugin\Configurator\Tree;
use Symfony\Component\Yaml\Yaml;

final class TreeTest extends TestCase
{
    public function testInstanciation()
    {
        $config_mock = $this->getMock('Grav\Common\Config\Config', ['get']);
        $config_mock->method('get')->will(
            $this->returnCallBack(
                function($path) {
                    switch($path) {
                        case 'plugins.configurator.configurator_tree':
                            return Yaml::parse(file_get_contents(__DIR__ . '/configurator_tree.mock.yaml'));
                    }    
                }
            )    
        );

        $session_mock = $this->getMock('Grav\Common\Session', []);

        $this->expectNotToPerformAssertions();
        $tree = new Tree(
            $config_mock,
            $session_mock
        );
    }

    protected function getMock(string $classname, array $methods)
    {
        $mock = $this->getMockBuilder($classname)
            ->setMethods($methods)
            ->getMock();
        return $mock;
    }

}