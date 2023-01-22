<?php

namespace App\Core;

use App\Exceptions\ViewNotFoundException;

/**
 * class to render views
 */
class View
{
    /** @var string $view view name */
    protected string $view;

    /** @var array $params view arguments to render on page */
    protected array $params;

    /**
     * View constructor
     *
     * @param string $view view name (file name)
     * @param array $params variables to render on page
     **/
    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    /**
     * view render method
     *
     **/
    public function render()
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        extract($this->params);

        include $viewPath;
    }

    /**
     * static method to render view
     *
     * @param string $view view name (file name)
     * @param array $params variables to render on page
     **/
    public static function make(string $view, array $params = [])
    {
        return (new static($view, $params))->render();
    }
}
