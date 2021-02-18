<?php
namespace Grav\Plugin\Configurator;

use Grav\Common\Config\Config;
use Grav\Common\Session;


class Configurator
{
    public function __construct(Config $config, Session $session)
    {
        $steps = $config->get('plugins.configurator.configurator_tree.steps');
        $choices = $config->get('plugins.configurator.configurator_choices');
        $session_values = $session->configurator ?? [];
        $choices_by_id = array_combine(array_column($choices, 'id'), $choices);
        $processed_steps = array_map(
            function($step) use ($choices_by_id, $session_values) {
                $step['choices'] = array_map(
                    function($choice) use ($choices_by_id) {
                        return $choices_by_id[$choice['id']];
                    },
                    $step['choices']
                );
                return $step;
            },
            $steps
        );
        $this->data = [
            'steps' => $processed_steps
        ];
    }

    public function get()
    {
        return $this->data;
    }

}