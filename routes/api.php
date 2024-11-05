<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::any('pwd', function () {
    $process = Process::fromShellCommandline('pwd');
    echo '<br />';
    echo $process->run();
    echo '<br />';

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    echo $process->getOutput();
});
Route::any('storage-link', function () {
    $process = Process::fromShellCommandline('ln -s /home1/createct/aonetrades.cwpdigital.com/storage/app/public /home1/createct/aonetrades.cwpdigital.com/public/storage');
    $process->run();

    // executes after the command finishes
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }

    echo $process->getOutput();
});
