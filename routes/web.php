<?php


use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\TrimStrings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --Cách viết đầy đủ
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin'],function(){
    Route::group(['middleware'=> 'admin.guest'],function(){
        Route::get('/login', [AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware'=> 'admin.auth'],function(){
        Route::get('/dashboard', [HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class,'logout'])->name('admin.logout');
    });
});
// --Cách viết ngắn gọn của cách trên
// Route:: view('/','welcome')->middleware(middleware: 'isToken');

// --middleware cho route trả về màn hình welcome
// Route:: view('/','welcome')->middleware(middleware: 'isToken');

// --Ví dụ về đường dẫn bỏ qua 1 middleware (không áp dụng cho middleware global)
// Route:: view('/','welcome')->withoutMiddleware(middleware: TrimStrings::class);

// --Middleware để thay đổi 1 biến như ví dụ bên dưới
// Route:: view('/','welcome')->Middleware(middleware: 'roleUser:hasRole,admin');


// Route::get("/", function () {
//     $ten='Nguyễn Minh';
//     return view('welcome',['name'=>'<b>'.$ten.'</b>']);
// })->name('welcome_page');

// // Route::get('/posts',function() {
// //     return "Danh sách bài post";
// // });

// // --Route::controller
// Route::controller(PostController::class)
//     // --name('posts.') đặt cho tên với phần đầu là posts.
//     ->name('posts.')
//     // --prefix('posts') đặt cho uri với phần đầu là posts/
//     ->prefix('posts')
//     //--group(function () gộp route
//     ->group(function () {
//         Route::get('/','index')->name('index');
//         Route::get('create','create')->name('create');
//         Route::get('store','store')->name('store');
//         Route::get('{id}/edit','edit')->name('edit');
//     });

// // --Đặt tên cho đường dẫn của class 
// Route::get('/posts',[PostController::class,'index'])->name('posts.index'); 

// // --Route có tham số truyền vào $id (Bắt buộc)
// // --Route có tham số truyền vào $name (Không bắt buộc và có giá trị mặc định là 'zxcnmo' cũng có thể là chuỗi khác hoặc null)
// Route::get('/user/{id}/{name?}',function(string $id,string $name='zxcnmo'){ 
//     echo route('posts.index');
//     return 'User: '.$id.' Name: '.$name;
// })-> where('id','[0-9]+');//where là điều kiện của tham số truyền vào (ở đây có nghĩa là $id chỉ được nhận là regex: số)