<?php
// Question é uma pasta dentro do diretório de Controllers onde eu crio controllers com responsabilidade única "__invoke()"
use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // Verifica se estou acessando pelo localhost
    if(app()->isLocal()) {
        // Loga automaticamente utilizando o loginId número 1
        auth()->loginUsingId(1);

        // Leva diretamente para a roda dashboard
        return to_route('dashboard');
    }

    return view('welcome');
});

// Essa rota vai mostrar o dashboard se o usuário estiver autenticado
Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
Route::post('question/like/{question}', Question\LikeController::class)->name('question.like');
Route::post('question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');
Route::put('question/publish/{question}', Question\PublishController::class)->name('question.publish');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
