- read there
http://mgi.hatenablog.com/entry/2014/01/13/125845 (chef,berkshelf)
http://qiita.com/kidachi_/items/b222fb2892e6108c46d5 (cookbook)
https://gemnasium.com/gems/berkshelf/versions (berkshelf all versions)

- Save The Baby Install

# install ruby-devkit
http://www.rubylife.jp/railsinstall/rails/index4.html
# install berkshelf
$ gem install berkshelf --no-ri --no-rdoc -v 2.0.15

1. checkout repository from github.
2. berks --path=chef-repo/cookbooks
3. vagrant up
4. vagrant ssh
# in vagrant virtual box
5. cd /vagrant
6. php composer.phar install
7. export APPLICATION_ENV=development
# config detabase.php
8. php artisan migrate
9. php artisan db:seed
10. exit
# in host
11 vagrant hostmanager



# other tips.

- install(working in host)
$ gem install chef --no-ri --no-rdoc
$ gem install berkshelf --no-ri --no-rdoc -v 2.0.15

- init(working in host)
$ knife configure
$ knife solo init chef-repo
create Berksfile
$ berks --path=chef-repo/cookbooks

- usual(working in host)
maintenance Berksfile
$ berks --path=chef-repo/cookbooks

- create cookbook(working in host)
$ cd chef-repo
$ knife cookbook create doshisha -o site-cookbooks


