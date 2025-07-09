<?php

namespace App\Providers;

use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\AppPanelProvider;
use App\Providers\Filament\GuestPanelProvider;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('nativekit.admin_panel_enabled', false)) {
            $this->app->register(AdminPanelProvider::class);
        }
        if (config('nativekit.app_panel_enabled', false)) {
            $this->app->register(AppPanelProvider::class);
        }
        if (config('nativekit.guest_panel_enabled', false)) {
            $this->app->register(GuestPanelProvider::class);
        }
        if (config('nativekit.favicon.enabled')) {
            FilamentView::registerRenderHook(PanelsRenderHook::HEAD_START, fn (): View => view('components.favicon'));
        }
        FilamentView::registerRenderHook(PanelsRenderHook::HEAD_START, fn (): View => view('components.js-md5'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
