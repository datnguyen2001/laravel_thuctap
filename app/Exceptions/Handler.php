<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationExceptions;
use Throwable;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

            //
        });
    }



//own code for authentication.. if user dont authenticated

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable Exception $exception
     */
    public function render($request, Throwable $e)
    {

       $class = get_class($e);

       switch ($class) {
           case 'Illuminate\Auth\AuthenticationExceptions':
              
              $gaurd = array_get($e->gaurds(),0);

              switch ($gaurd) {
                  case 'admin':
                     $login = "admin.login";
                      break;

                   case 'web':
                     $login = "login";
                      break;
                  
                  
                  default:
                      $login = "login";
                      break;
              }

              return redirect()->route($login);


               break;
           
       }


       return parent::render($request, $e);
     


   }


}
