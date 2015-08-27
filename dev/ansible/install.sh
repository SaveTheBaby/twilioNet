#!/usr/bin/env bash

if ! [ `which ansible` ]; then
  sudo rpm -Uvh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
  yum update -y
  yum install -y ansible
fi

export PYTHONUNBUFFERED=1
ansible-playbook -i /ansible/hosts /ansible/site.yml