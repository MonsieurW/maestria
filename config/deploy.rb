# config valid only for Capistrano 3.1
lock '3.2.1'

set :application, 'maestria'
set :repo_url, 'git@github.com:camael24/maestria.git'

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/tmp/maestria'

# Default value for :scm is :git
set :scm, :git

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, %w{config/database.yml}

# Default value for linked_dirs is []
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
set :keep_releases, 5

namespace :deploy do

  desc 'Restart application'
  task :install do
    on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd /tmp/maestria/current; make install"
    end
  end
  task :db do
    on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd /tmp/maestria/current; make db-install"
    end
  end
  
  task :data do
    on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd /tmp/maestria/current; make db-peuplate"
    end
  end

  task :all do
     on roles(:app) do
      # Your restart mechanism here, for example:
      execute "cd /tmp/maestria/current; make install; make db-install; make db-peuplate"
    end
  end


end
