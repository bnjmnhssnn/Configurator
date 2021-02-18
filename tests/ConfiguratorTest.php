<?php
use PHPUnit\Framework\TestCase;
use Grav\Plugin\Configurator\Configurator;
use Symfony\Component\Yaml\Yaml;

final class ConfiguratorTest extends TestCase
{
    public function testInstanciation()
    {
        $config_mock = $this->getMock('Grav\Common\Config\Config', ['get']);
        $config_mock->method('get')->will(
            $this->returnCallBack(
                function($path) {
                    switch($path) {
                        case 'plugins.configurator.configurator_tree.steps':
                            return Yaml::parse(file_get_contents(__DIR__ . '/configurator_tree.mock.yaml'));
                        case 'plugins.configurator.configurator_choices':
                            return Yaml::parse(file_get_contents(__DIR__ . '/configurator_choices.mock.yaml'));   
                    }    
                }
            )    
        );

        $session_mock = $this->getMock('Grav\Common\Session', []);

        $this->expectNotToPerformAssertions();
        $tree = new Configurator(
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