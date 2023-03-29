<?php

use App\Models\Course;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Preference;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/one-to-one', function () {
    // $user = User::first();
    $user = User::with('preference')->find(2);

    $data = [
        'background_color' => '#FGBB63',
    ];

    if ($user->preference == null) {
        // $user->preference()->create($data);
        $preference = new Preference($data);
        // $preference = $data;
        $user->preference()->save($preference);
    } else {
        $user->preference()->update($data);
    }

    $user->refresh();

    dd($user->preference);
});


Route::get('/one-to-many', function () {
    // $course = new Course();
    // $course->create(['name' => 'Curso de Laravel']);

    $course = Course::with('modules.lessons')->find(1);

    // $dataModules = ['name' => 'TYPEORM 2'];
    // $dataLessons = ['name' => 'Create a TYPEORM', 'video' => 'URLVIDEO'];

    // $course->modules()->create($dataModules);
    // $course->modules()->lessons->create($dataLessons);

    // $modules = $course->modules;
    // $lessons = $course->modules->lessons;

    echo 'Curso: ' . $course->name . '<br/>';
    foreach ($course->modules as $modules) {
        echo "Modulo: {$modules->name} <br/>";

        foreach ($modules->lessons as $lessons) {
            echo "Aulas: {$lessons->name}";
        }
    }
    // dd($modules);
    dd("Fim");
});


Route::get('/many-to-many', function () {
    $user = User::with("permissions")->find(3);

    $permission = Permission::first();
    $user->permissions()->save($permission);


    // $user->permissions()->saveMany([
    //     Permission::find(3),
    //     Permission::find(2)
    // ]);

    // $user->permissions()->sync([2]);

    // $user->permissions()->attach([2, 3]);

    // $user->permissions()->detach([2, 3]);

    // $user->refresh();

    dd($user->permissions);
});

Route::get('/', function () {
    return view('welcome');
});
