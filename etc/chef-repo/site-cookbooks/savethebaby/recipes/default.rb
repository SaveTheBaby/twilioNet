#
# Cookbook Name:: savethebaby
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

include_recipe "yum"
include_recipe "yum-ius"
include_recipe "yum-epel"
include_recipe "mysql::server"
include_recipe "database::mysql"

mysql_connection_info = {:host => "localhost",
                         :username => "root",
                         :password => node["mysql"]["server_root_password"]}

mysql_database "_savethebaby1" do
  connection mysql_connection_info
  action :create
end

mysql_database_user "_savethebaby1" do
  connection mysql_connection_info
  password   "savethebaby"
  database_name "_savethebaby1"
  privileges    [:all]
  host "localhost"
  action     :grant
end

template "/etc/my.cnf" do
  source "my.cnf.erb"
  notifies :restart, "service[mysqld]"
end

service "iptables" do
  action [:stop, :disable]
end

package "git" do
  action :install
end

package "httpd" do
  action :install
end

template "/etc/httpd/conf.d/vhosts.conf" do
  source "vhosts.conf.erb"
  notifies :restart, "service[httpd]"
end

package "mod_ssl" do
  action :install
end

#%w(php54 php54-mcrypt php54-mbstring php54-gd php54-mysql php54-xml php54-pear php54-devel php54-intl php54-pecl-xdebug).each do |package|
%w(php53 php53-mysql php53-mbstring php53-xml php-pecl-xdebug).each do |package|
  yum_package package do
    action :install
  end
end

template "/etc/php.ini" do
  source "php.ini.erb"
  notifies :restart, "service[httpd]"
end

package "phpmyadmin" do
  action :install
end

template "/etc/httpd/conf.d/phpMyAdmin.conf" do
  source "phpMyAdmin.conf.erb"
end

template "/etc/phpMyAdmin/config.inc.php" do
  source "config.inc.php.erb"
end

service "httpd" do
  action [:start, :enable]
  supports :status => true, :resart => true
end

service "mysqld" do
  action [:start, :enable]
  supports :status => true, :resart => true
end
