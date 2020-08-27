<?php

return [
    'pref-env' => array_map('trim', explode(',', env('PREF'))),
    
];
