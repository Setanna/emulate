<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param $request
     * @param Throwable $e
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        // If model not found
        if ($e instanceof ModelNotFoundException) {
            return response(['error' => 'Data not found.']);
        }

        // If there is a query exception
        if ($e instanceof QueryException){
            // If the data already exists return custom error message
            if($e->getCode() === "23000"){
                return response(['error' => 'Data already exists.']);
            }

            // else return laravel error message
            return response()->json($e);
        }

        return parent::render($request, $e);
    }
}
