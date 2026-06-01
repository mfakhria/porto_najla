<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects/vms', function () {
    return view('projects.vms');
})->name('projects.vms');

Route::get('/projects/connect', function () {
    return view('projects.connect');
})->name('projects.connect');

Route::get('/projects/fleet', function () {
    return view('projects.fleet');
})->name('projects.fleet');

Route::get('/projects/re-actions', function () {
    return view('projects.reactions');
})->name('projects.reactions');
