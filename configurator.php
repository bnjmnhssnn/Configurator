<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Plugin\Configurator\Tree;

/**
 * Class ConfiguratorPlugin
 * @package Grav\Plugin
 */
class ConfiguratorPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            #'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            #'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
        ];
    }

    /**
    * Composer autoload.
    *is
    * @return ClassLoader
    */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            return;
        }
        $uri = $this->grav['uri'];
        


        $this->enable(
            [
                'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            ]   
        );
    }



    /**
     * [onTwigTemplatePaths] Add twig paths to plugin templates.
     */
    public function onTwigTemplatePaths()
    {
        $twig = $this->grav['twig'];
        $twig->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * [onTwigSiteVariables] Set all twig variables for generating output.
     */
    public function onTwigSiteVariables()
    {
        $this->grav['assets']->addJs('plugin://configurator/assets/test.js');  

        $twig = $this->grav['twig'];
        $twig->twig_vars['testvar'] = 'foobarbaz';

        $tree = new Tree($this->config, $this->grav['session']);
        $twig->twig_vars['configurator_tree'] = $tree->get();
    }


}
