<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

//Route::get('/student', [StudentController::class, 'studmasterlist']);

Route::get('/Masterlist', [StudentController::class, 'studmasterlist'])->name('student.list');

Route::post('/students/add', [StudentController::class, 'addstudent'])->name('students.add');

Route::get('/student/edit/{index}', [studentcontroller::class, 'editstudent'])->name('student.edit');

Route::post('/student/update/{index}', [studentcontroller::class, 'updatestudent'])->name('student.update');

Route::delete('/student/delete/{index}', [studentcontroller::class, 'deletestudent'])->name('student.delete');
