<?php

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

Route::group(['prefix' => '/', 'namespace' => 'Site'], function () {

    //--------------------------------- Accueil -----------------------------------------------------------    

    Route::group(['prefix' => '/', 'namespace' => 'Accueil'], function () {

        Route::get('/', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'getShow'])
            ->name('Site-AccueilGetShow');

        Route::get('/index', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'getIndex'])
            ->name('Site-AccueilGetIndex'); 
            
        Route::get('/create', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'getCreate'])
            ->name('Site-AccueilGetCreate'); 

        Route::post('/store', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'postStore'])
            ->name('Site-AccueilPostStore');   
            
        Route::get('/edit/{product}', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'getEdit'])
            ->name('Site-AccueilGetEdit'); 

        Route::post('/edit/{product}', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'postUpdate'])
            ->name('Site-AccueilPostUpdate');     

        Route::get('/accueil/{id}', [App\Http\Controllers\Site\Accueil\AccueilController::class, 'postDestroy'])
            ->name('Site-AccueilPostDestroy');       
    });


    //------------------------------------- Order -----------------------------------------------------------------    

    Route::group(['prefix' => '/order', 'namespace' => 'Order'], function () {

        Route::get('/', [App\Http\Controllers\Site\Order\OrderController::class, 'getShow'])
            ->name('Site-OrderGetShow');

        Route::get('/create', [App\Http\Controllers\Site\Order\OrderController::class, 'getCreate'])
            ->name('Site-OrderGetCreate'); 

        Route::get('/index', [App\Http\Controllers\Site\Order\OrderController::class, 'getIndex'])
            ->name('Site-OrderGetIndex');   
            
        Route::post('/store', [App\Http\Controllers\Site\Order\OrderController::class, 'postStore'])
            ->name('Site-OrderPostStore');   
            
        Route::get('/invoice/{id}', [App\Http\Controllers\Site\Order\OrderController::class, 'getInvoice'])
            ->name('Site-OrderGetInvoice');
            
        Route::post('/invoice/download/{id}', [App\Http\Controllers\Site\Order\OrderController::class, 'downloadInvoice'])
            ->name('invoice.download');

    
            
        Route::get('/order/{id}', [App\Http\Controllers\Site\Order\OrderController::class, 'postDestroy'])
            ->name('Site-OrderPostDestroy');     
    });


    //---------------------------------------- Cart -------------------------------------------------------

    Route::group(['prefix' => '/cart', 'namespace' => 'cart'], function () {

        Route::get('/', [App\Http\Controllers\Site\Cart\CartController::class, 'getShow'])
            ->name('Site-CartGetShow');

        Route::post('/add/{id}', [App\Http\Controllers\Site\Cart\CartController::class, 'postAdd'])
            ->name('Site-CartPostAdd'); 
            
        Route::get('/remove/{id}', [App\Http\Controllers\Site\Cart\CartController::class, 'getRemove'])
            ->name('Site-CartGetRemove');  
            
        Route::get('/cart/clear', [App\Http\Controllers\Site\Cart\CartController::class, 'getClear'])
        ->name('Site-CartGetClear');    
    });


    //------------------------------------- Login -----------------------------------------------------------------    

    Route::group(['prefix' => '/login', 'namespace' => 'Login'], function () {

        Route::get('/', [App\Http\Controllers\Site\Login\LoginController::class, 'getShow'])
            ->name('Site-LoginGetShow');

        Route::post('/', [App\Http\Controllers\Site\Login\LoginController::class, 'postLogin'])
            ->name('postLogin');     
    });


     //--------------------------------- Logout -------------------------------------------------------------

     Route::post('/', [App\Http\Controllers\Site\Login\LoginController::class, 'postLogout'])
     ->name('postLogout');



    //------------------------------------- Register -----------------------------------------------------------------    

    Route::group(['prefix' => '/register', 'namespace' => 'Register'], function () {

        Route::get('/', [App\Http\Controllers\Site\Register\RegisterController::class, 'getShow'])
            ->name('Site-RegisterGetShow');

        Route::get('/create', [App\Http\Controllers\Site\Register\RegisterController::class, 'getCreate'])
            ->name('Site-RegisterGetCreate'); 
            
        Route::post('/store', [App\Http\Controllers\Site\Register\RegisterController::class, 'postStore'])
            ->name('Site-RegisterPostStore');   
                  
    });
    

    //------------------------------------- Profil -----------------------------------------------------------------    

        Route::group(['prefix' => '/profil', 'namespace' => 'Profil'], function () {

            Route::get('/', [App\Http\Controllers\Site\Profil\ProfilController::class, 'getShow'])
                ->name('Site-ProfilGetShow');
    
            Route::post('/', [App\Http\Controllers\Site\Profil\ProfilController::class, 'postLogin'])
                ->name('Site-ProfilGetEdit'); 
                
            Route::post('/store', [App\Http\Controllers\Site\Profil\ProfilController::class, 'postLogout'])
                ->name('Site-ProfilGetStore'); 
                
            Route::get('/profil/{id}', [App\Http\Controllers\Site\Profil\ProfilController::class, 'postDestroy'])
                ->name('Site-ProfilPostDestroy'); 
        });

     
    //------------------------------------ Delivery -----------------------------------------------------------------
    Route::group(['prefix' => '/delivery', 'namespace' => 'Delivery'], function () {

        Route::post('/store', [App\Http\Controllers\Site\Delivery\DeliveryController::class, 'postStore'])
            ->name('Site-DeliveryPostStore');

    }); 
    
    
    //------------------------------------ Parametre -----------------------------------------------------------------
    Route::group(['prefix' => '/delivery', 'namespace' => 'Delivery'], function () {

        Route::get('/', [App\Http\Controllers\Site\Parametre\ParametreController::class, 'getShow'])
            ->name('Site-ParametreGetShow');

    }); 

});

