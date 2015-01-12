# Simple Role Syntax
# ==================
# Supports bulk-adding hosts to roles, the primary server in each group
# is considered to be the first unless any hosts have the primary
# property set.  Don't declare `role :all`, it's a meta role.

role :app, %w{camael@ark.im}
set :deploy_to, '/var/www/maestria-nightly'

server 'ark.im',
  user: 'camael',
  roles: %w{app},
  ssh_options: {
    user: 'camael', # overrides user setting above
    keys: %w(~/.ssh/id_rsa),
    forward_agent: true,
    auth_methods: %w(publickey password)
  }
