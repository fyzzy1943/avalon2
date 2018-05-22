@servers(['web' => ['fyzzy@123.56.184.165']])

@task('foo')
    cd app/avalon2
@endtask

@task('git')
    cd app/avalon2
    git fetch --all
    git reset --hard origin/master
@endtask

@task('cache')
    cd app/avalon2
    php artisan config:cache
    php artisan route:cache
    php artisan view:clear
@endtask

@task('composer')
    cd app/avalon2
    composer install
    composer dumpautoload
@endtask

@story('deploy', ['on' => 'web'])
    {{--foo--}}
    git
    cache
    composer
@endstory

