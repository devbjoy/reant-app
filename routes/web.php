<?php
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/login');
include __DIR__ . '/admin.php';
include __DIR__ . '/tenant.php';

