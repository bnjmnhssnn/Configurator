<?php
use PHPUnit\Framework\TestCase;
use Grav\Plugin\Configurator\Tree;

final class TreeTest extends TestCase
{
    public function testInstanciation()
    {
        $this->expectNotToPerformAssertions();
        $tree = new Tree();
    }
}