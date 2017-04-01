<?php

namespace Modules\Ask\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class AskServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    public function boot()
    {
        $this->publishConfig('ask', 'permissions');
        $this->publishConfig('ask', 'assets');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Ask\Repositories\QuestionRepository',
            function () {
                $repository = new \Modules\Ask\Repositories\Eloquent\EloquentQuestionRepository(new \Modules\Ask\Entities\Question());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ask\Repositories\Cache\CacheQuestionDecorator($repository);
            }
        );
// add bindings

    }
}
