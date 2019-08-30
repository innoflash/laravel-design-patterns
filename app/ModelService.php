<?php


namespace App;


class ModelService
{
    /**
     * @var Model
     */
    private $modelObject;

    /**
     * ModelService constructor.
     */
    public function __construct(Model $modelObject)
    {
        $this->modelObject = $modelObject;
    }
}