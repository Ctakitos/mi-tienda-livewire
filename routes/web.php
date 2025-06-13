<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Livewire\Admin\AboutUs;
use App\Livewire\Admin\ContactUs;

use App\Livewire\Dashboard\BannerManager;
use App\Livewire\Dashboard\ProductManager;
use App\Livewire\Dashboard\ServiceManager;

use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;


use App\Livewire\Dashboard\AboutUsManager;
use App\Livewire\Dashboard\ContactUsManager;


use App\Models\StaticContent;
use App\Models\Banner;
use App\Models\Product;

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');


Route::get('/dashboard/about', function () {
    $content = StaticContent::where('section', 'about')->value('content') ?? '';
    return view('frontend.about', compact('content'));
})->name('frontend.about');

Route::get('/dashboard/contact', function () {
    $content = StaticContent::where('section', 'contact')->value('content') ?? '';
    return view('frontend.contact', compact('content'));
})->name('frontend.contact');





Route::get('/home', function () {
    $banners = Banner::where('is_active', true)->latest()->take(5)->get();
    $products = Product::latest()->take(9)->get();  // los 9 últimos productos

    return view('frontend.index', compact('banners', 'products'));
})->name('home');


Route::middleware(['auth'])->group(function () {
    
    Route::view('/dashboard/admin', 'dashboard.dashboard')->name('dashboard.admin');
    Route::view('/dashboard/banners', 'dashboard.banners')->name('dashboard.banners');
    Route::view('/dashboard/products', 'dashboard.products')->name('dashboard.products');
    Route::view('/dashboard/services', 'dashboard.services')->name('dashboard.services');
    
    
    Route::get('/dashboard/admin/about', \App\Livewire\Dashboard\AboutUsManager::class)->name('dashboard.admin.about');
    Route::get('/dashboard/admin/contact', \App\Livewire\Dashboard\ContactUsManager::class)->name('dashboard.admin.contact');
    Route::get('/dashboard/admin/{section}', \App\Livewire\Admin\EditStaticContent::class)->name('dashboard.admin.section');
    
});






















