<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Controller
{
    protected $service;
    protected $resource;

    public function __call($method, $args)
    {
        $result = $this->{$method}(...$args);

        if ($result instanceof \Illuminate\Http\Response) {
            return $result;
        }
        if ($result instanceof Collection) {
            return $this->resource::collection($result);
        }
        if (is_array($result)) {
            return response()->json($result);
        }
        if (is_a($result, Model::class)) {
            return $this->resource::make($result);
        }
    }
}
