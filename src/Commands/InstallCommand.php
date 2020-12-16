<?php

namespace SamBindoff\LaravelGust\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    public $signature = 'gust:install {stack : The development stack that should be installed}';

    public $description = 'Install the Gust components and resources.';

    public function handle()
    {
        // "Home" Route...
        $this->replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Install Stack...
        if ($this->argument('stack') === 'fortify') {
            $this->installFortifyStack();
        } elseif ($this->argument('stack') === 'breeze') {
            $this->installBreezeStack();
        } elseif ($this->argument('stack') === 'ui') {
            $this->installUIStack();
        }

        // Install SPA...
        $this->installSPAStack();
    }

    /**
     * Install the Fortify stack into the application.
     *
     * @return void
     */
    protected function installFortifyStack()
    {
        // Install Fortify...
        $this->requireComposerPackages('laravel/fortify:^1.7');

        // Publish Fortify...
        (new Process(['php', 'artisan', 'vendor:publish', '--provider=Laravel\Fortify\FortifyServiceProvider', '--force'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Fortify Service Provider...
        $this->replaceInFile('App\\Providers\RouteServiceProvider::class,', 'App\\Providers\RouteServiceProvider::class,'.PHP_EOL.'        App\Providers\FortifyServiceProvider::class,', config_path('app.php'));

        // SPA Fixes...
        copy(__DIR__.'/../../stubs/config/fortify.php', base_path('config/fortify.php'));
        copy(__DIR__.'/../../stubs/app/Providers/FortifyServiceProvider.php', app_path('Providers/FortifyServiceProvider.php'));
        (new Filesystem)->delete(app_path('Actions/Fortify/UpdateUserPassword.php'));
        (new Filesystem)->delete(app_path('Actions/Fortify/UpdateUserProfileInformation.php'));

        $this->info('Fortify scaffolding installed successfully.');
    }

    /**
     * Install the Breeze stack into the application.
     *
     * @return void
     */
    protected function installBreezeStack()
    {
        // Install Breeze...
        (new Process(['php', 'artisan', 'breeze:install'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Routes...
        copy(__DIR__.'/../../stubs/routes/auth-breeze.php', base_path('routes/auth.php'));

        // SPA Fixes...
        copy(__DIR__.'/../../stubs/app/Http/Controllers/Auth/ConfirmablePasswordController.php', app_path('Http/Controllers/Auth/ConfirmablePasswordController.php'));
        (new Filesystem)->deleteDirectory(app_path('View'));
        $this->replaceInFile('Auth::logout', "Auth::guard('web')->logout", app_path('Http/Controllers/Auth/AuthenticatedSessionController.php'));
        $this->replaceInFile('use App\Http\Controllers\Controller;', 'use App\Http\Controllers\Controller;'.PHP_EOL.'use App\Providers\RouteServiceProvider;', app_path('Http/Controllers/Auth/NewPasswordController.php'));
        $this->replaceInFile("redirect()->route('login')", 'redirect(RouteServiceProvider::HOME)', app_path('Http/Controllers/Auth/NewPasswordController.php'));

        $this->info('Breeze scaffolding installed successfully.');
    }

    /**
     * Install the UI stack into the application.
     *
     * @return void
     */
    protected function installUIStack()
    {
        // Install UI...
        $this->requireComposerPackages('laravel/ui:^3.1');

        // Publish UI...
        (new Process(['php', 'artisan', 'ui:controllers'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Routes...
        copy(__DIR__.'/../../stubs/routes/auth-ui.php', base_path('routes/auth.php'));

        // SPA Fixes...
        copy(__DIR__.'/../../stubs/app/Http/Controllers/Auth/LoginController.php', app_path('Http/Controllers/Auth/LoginController.php'));
        (new Filesystem)->delete(app_path('Http/Controllers/HomeController.php'));

        $this->info('UI scaffolding installed successfully.');
    }

    /**
     * Install the VueJS SPA stack into the application.
     *
     * @return void
     */
    protected function installSPAStack()
    {
        // Install Sanctum...
        $this->requireComposerPackages('laravel/sanctum:^2.6');

        // Publish Sanctum...
        (new Process(['php', 'artisan', 'vendor:publish', '--provider=Laravel\Sanctum\SanctumServiceProvider', '--force'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Sanctum Environment Variable...
        file_put_contents(base_path('.env'), file_get_contents(base_path('.env')).PHP_EOL.'SANCTUM_STATEFUL_DOMAINS='.parse_url(config('app.url'))['host'].PHP_EOL);
        file_put_contents(base_path('.env.example'), file_get_contents(base_path('.env.example')).PHP_EOL.'SANCTUM_STATEFUL_DOMAINS=localhost'.PHP_EOL);

        // Sanctum Middleware...
        $this->replaceInFile("'throttle:api',", "\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,".PHP_EOL."            'throttle:api',", app_path('Http/Kernel.php'));

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // Routes...
        copy(__DIR__.'/../../stubs/routes/api.php', base_path('routes/api.php'));
        copy(__DIR__.'/../../stubs/routes/web.php', base_path('routes/web.php'));
        if (in_array($this->argument('stack'), ['breeze', 'ui'])) {
            $this->replaceInFile('*/', '*/'.PHP_EOL.PHP_EOL."require __DIR__.'/auth.php';", base_path('routes/web.php'));
        }

        // Directories...
        (new Filesystem)->delete(resource_path('js/bootstrap.js'));
        (new Filesystem)->deleteDirectory(resource_path('sass'));
        (new Filesystem)->deleteDirectory(resource_path('views'));
        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/components'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/pages'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/pages/Auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/plugins'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/router'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/services'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/stores'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));

        // Tailwind Configuration...
        copy(__DIR__.'/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));

        // Assets...
        copy(__DIR__.'/../../stubs/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__.'/../../stubs/resources/js/app.js', resource_path('js/app.js'));

        // Vue Components...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/components', resource_path('js/components'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/pages', resource_path('js/pages'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/layouts', resource_path('js/layouts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/plugins', resource_path('js/plugins'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/router', resource_path('js/router'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/services', resource_path('js/services'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/resources/js/stores', resource_path('js/stores'));

        // Blade View...
        copy(__DIR__.'/../../stubs/resources/views/app.blade.php', resource_path('views/app.blade.php'));

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                '@tailwindcss/forms' => '^0.2.1',
                'tailwindcss' => 'npm:@tailwindcss/postcss7-compat@^2.0.1',
                'vue' => '^2.6.12',
                'vue-router' => '^3.4.9',
                'vue-template-compiler' => '^2.6.12',
                'vuex' => '^3.6.0',
            ] + Arr::except($packages, [
                'alpinejs',
                'autoprefixer',
                'postcss-import',
            ]);
        });

        // SPA Fixes...
        copy(__DIR__.'/../../stubs/app/Providers/AppServiceProvider.php', app_path('Providers/AppServiceProvider.php'));
        $this->replaceInFile("route('login')", "url('login')", app_path('Http/Middleware/Authenticate.php'));

        $this->info('Gust scaffolding installed successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $command = array_merge(
            ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
