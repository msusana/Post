<?php
function loadClass($classe)
{
  require_once __DIR__.'/../classes/'.
        $classe . '.php'; 
}

spl_autoload_register('loadClass');