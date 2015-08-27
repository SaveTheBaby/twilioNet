#!/usr/bin/env bash

if ! [ `which rvm` ]; then
  gpg2 --keyserver hkp://keys.gnupg.net --recv-keys D39DC0E3

  curl -sSL https://get.rvm.io | bash -s $1
fi