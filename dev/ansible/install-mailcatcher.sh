#!/usr/bin/env bash

if ! [ `which mailcatcher` ]; then
  source /usr/local/rvm/scripts/rvm
  rvm use --install 1.9.3
  rvm 1.9.3@mailcatcher --create do gem install mailcatcher --no-rdoc --no-ri
  rvm wrapper 1.9.3@mailcatcher --no-prefix mailcatcher catchmail
fi

initctl start mailcatcher


