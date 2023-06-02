<?php


use App\Http\Controllers\LogErroController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Device;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    $dispositivos = Device::distinct('MAC')->get();
    return view('dashboard',compact('dispositivos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Route::get('/dispositivo',[SensorController::class,'ultimosDez'])->name('sensor.todos');




Route::get('/sensor10', [SensorController::class, 'ultimosDez'])->name('sensor.ultimos-dez');
Route::get('/atualiza-dados',[SensorController::class, 'atualizaDados']);
Route::get('/log_erro', [LogErroController::class, 'index'])->name('log.erro');



Route::delete('/device/{id}',[DeviceController::class,'destroy'])->name('device.destroy');
Route::get('/device', [DeviceController::class, 'index'])->name('device.index');
Route::get('/criar/dispositivo', [DeviceController::class, 'create'])->name('device.create');
Route::post('/device/salvar', [DeviceController::class, 'store'])->name('device.store');
Route::get('/device/{id}/edit',[DeviceController::class,'edit'])->name('device.edit');
Route::put('/device/{id}', [DeviceController::class,'update'])->name('device.update');






