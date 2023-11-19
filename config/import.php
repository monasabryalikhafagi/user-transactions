<?php

return [
   'importers' => [
       'user' => \App\Services\Import\ImportUserService::class,
       'transection' => \App\Services\Import\ImportTransectionService::class,
   ]
];
