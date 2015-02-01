<?php namespace Ironquest\Repos;

use \App as App;

/**
 * A Factory for building repositories using the IOC container.
 *
 * Class Repo
 * @package Ironquest\Repos
 */
class Repo {

    /**
     * Build a repository by name.
     *
     * @param $name
     * @return mixed
     */
    static function build($name) {
        return App::make('Ironquest\Repos\\' . ucfirst($name) . 'RepoInterface');
    }
} 