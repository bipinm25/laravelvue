<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\LoginCheck;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LoginController::class, 'index']);

Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');


Route::post('/createuser',[LoginController::class, 'createuser'])->name('createuser');



//Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::middleware([LoginCheck::class])->group(function(){        
       
        Route::get('/getsession',[DashboardController::class, 'getSession']);

        Route::post('/savecategory',[CategoryController::class, 'saveCategory']);

        Route::get('/getcategory',[CategoryController::class, 'getCategory']);

        Route::post('/deletecategory',[CategoryController::class, 'deleteCategory']);

        Route::post('/savetag',[TagController::class, 'saveTag']);

        Route::get('/gettag',[TagController::class, 'getTag']);

        Route::post('/deletetag',[TagController::class, 'deleteTag']);

        Route::get('/listblog',[BlogController::class, 'listBlog']);

        Route::get('/getblog/{id}',[BlogController::class, 'getBlog']);

        Route::post('/saveblog',[BlogController::class, 'saveBlog']);

        Route::post('/deleteblog',[BlogController::class, 'deleteBlog']);

        Route::any('{slug}',[DashboardController::class, 'index'])->where('slug', '(.*)?');

});




Route::get('/admin', function () {
	$data['tasks'] = [
                [
                        'name' => 'Design New Dashboard',
                        'progress' => '87',
                        'color' => 'danger'
                ],
                [
                        'name' => 'Create Home Page',
                        'progress' => '76',
                        'color' => 'warning'
                ],
                [
                        'name' => 'Some Other Task',
                        'progress' => '32',
                        'color' => 'success'
                ],
                [
                        'name' => 'Start Building Website',
                        'progress' => '56',
                        'color' => 'info'
                ],
                [
                        'name' => 'Develop an Awesome Algorithm',
                        'progress' => '10',
                        'color' => 'success'
                ]
        ];
    return view('admin',['tasks'=>$data['tasks']]);
});

// Route::any('{slug}', function (){
//         return view('admin');
//     })->where('slug', '(.*)?');
