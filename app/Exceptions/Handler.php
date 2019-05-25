<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        // Se o tipo de arquivo não for permitido...
        if ($exception instanceOf FileUnacceptableForCollection) {
            return redirect()
                ->back()
                ->with('message', 'Somente imagens JPEG, JPG ou PNG são permitidas.')
                ->with('type', 'danger');
        }
        // Se a imagem não pode ser carregada ...
        if ($exception instanceOf FileCannotBeAdded) {
            return redirect()
                ->back()
                ->with('message', 'Algo deu errado. A imagem não pode ser selecionada. Tente novamente.')
                ->with('type', 'danger');
        }

        return parent::render($request, $exception);
    }
}
