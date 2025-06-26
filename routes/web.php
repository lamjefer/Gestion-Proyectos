<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProyectoEntregadoController;
use App\Exports\ProyectosExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PROYECTOS -----------------------------
    Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');

    //  Eliminar todos
    Route::delete('/proyectos/eliminar-todos', [ProyectoController::class, 'eliminarTodos'])->name('proyectos.eliminarTodos');

    // Proyecto individual
    Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
    Route::get('/proyectos/{id}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
    Route::get('/proyectos/{id}/ticket', [ProyectoController::class, 'generarTicket'])->name('proyectos.ticket');

    // Exportar Excel de proyectos
    Route::get('/proyectos/excel', [ProyectoController::class, 'exportExcel'])->name('proyectos.excel');

    // CLIENTES -------------------------------
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    // DASHBOARD y vistas resumen -------------
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pendientes', [ProyectoController::class, 'pendientes'])->name('pendientes.index');
    Route::get('/entregados-mes', [ProyectoEntregadoController::class, 'index'])->name('entregados.mes');

    // EXPORTACIONES EXCEL
    Route::get('/exportar-finalizados', function () {
        return Excel::download(new ProyectosExport, 'proyectos_finalizados_mes.xlsx');
    })->name('exportar.finalizados');

    Route::get('/entregados/excel', function () {
        return Excel::download(new ProyectosExport, 'proyectos_entregados_mes.xlsx');
    })->name('entregados.excel');
});

require __DIR__.'/auth.php';
