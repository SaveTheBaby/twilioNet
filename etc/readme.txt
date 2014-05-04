- read there
http://mgi.hatenablog.com/entry/2014/01/13/125845 (chef,berkshelf)
http://qiita.com/kidachi_/items/b222fb2892e6108c46d5 (cookbook)
https://gemnasium.com/gems/berkshelf/versions (berkshelf all versions)

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