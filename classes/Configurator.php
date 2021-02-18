<?php
namespace Grav\Plugin\Configurator;

use Grav\Common\Config\Config;
use Grav\Common\Session;


class Configurator
{
    public function __construct(Config $config, Session $session)
    {
        $configurator_tree = $config->get('plugins.configurator.configurator_tree');
        $configurator_choices = $config->get('plugins.configurator.configurator_choices');
        $configurator_session_values = $session->configurator ?? [];


        
    }



   



    public function get()
    {
        return $this->tree;
    }

}