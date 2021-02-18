<?php
namespace Grav\Plugin\Configurator;

use Grav\Common\Config\Config;
use Grav\Common\Session;


class Tree
{
    public function __construct(Config $config, Session $session)
    {
        $session->foo = 'bar';

        
        $this->tree = $config->get('plugins.configurator.configurator_tree');

        /*
        if(!$this->validateTree($this->tree, $error)) {
            throw new ConfiguratorException($error);
        }
        */
        /*
        $this->tree['steps'] = array_map(
            function($step) {
                if($step['type'] === 'radio') {
                    $step['options_radio_prepared'] = array_reduce(
                        $step['options'],
                        function($carry, $option) {
                            $carry[$option['id']] = $option['name'];
                            return $carry;
                        },
                        [] 
                    );     
                }
                return $step;
            },
            $this->tree['steps']
        );
        */

        /*
        echo '<pre>'
        . print_r($this->tree, true)
        . print_r($session->getAll(), true) .
        '</pre>';
        exit;
        */
        
    }

   



    public function get()
    {
        return $this->tree;
    }

}