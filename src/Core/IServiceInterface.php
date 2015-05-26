<?php namespace ServiceBuilder\Core;

interface IServiceInterface
{

    public function loadConfig();
    public function applyConfig();
    public function getService();


}