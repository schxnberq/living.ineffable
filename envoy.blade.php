@servers(['web' => 'theineffable@217.160.142.201'])

@story('deploy')
    git
    composer
@endstory

@task('git', ['on' => 'web'])
    git pull origin master
@endtask

@task('composer', ['on' => 'web'])
    composer install
@endtask

