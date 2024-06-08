<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

return fn(array $context) => new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
