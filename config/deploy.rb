# config valid only for Capistrano 3.1
lock '3.3.4'

set :application, 'maestria'
set :repo_url, 'git@github.com:camael24/maestria.git'

set :scm, :git
set :format, :pretty
set :log_level, :debug
set :keep_releases, 5

namespace :deploy do

  desc 'Restart application'
  task :install do
    on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd #{deploy_to}/current; make install"
    end
  end
  task :db do
    on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd #{deploy_to}/current; make db-install"
    end
  end
  
  task :data do
    on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd #{deploy_to}/current; make db-peuplate"
    end
  end

  task :all do
     on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd #{deploy_to}/current; make install; make db-install; make db-update; make db-peuplate"
    end
  end


end
