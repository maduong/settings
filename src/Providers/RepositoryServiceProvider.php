<?php namespace Edutalk\Base\Settings\Providers;

use Illuminate\Support\ServiceProvider;
use Edutalk\Base\Settings\Models\Setting;
use Edutalk\Base\Settings\Repositories\SettingRepository;
use Edutalk\Base\Settings\Repositories\Contracts\SettingContract;
use Edutalk\Base\Settings\Repositories\SettingRepositoryCacheDecorator;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SettingContract::class, function () {
            $repository = new SettingRepository(new Setting);

            if (config('edutalk-caching.repository.enabled')) {
                return new SettingRepositoryCacheDecorator($repository);
            }

            return $repository;
        });
    }
}
