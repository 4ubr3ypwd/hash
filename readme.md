# Hash

Hash is a simple chat system designed to keep chats persistent, simple, hacker-friendly, and identity-flexible. 

A few things to consider when using Hash:

* A hash, is a chat room
* Anyone can join a hash, so naming your hash "myhash" might not be a good idea, something like "myHash4356c9" might be better.
* Hash names and Nicks are case sensitive, so a hash called "myhash4356c9" is different from "myHash4356c9"
* Nicks belong to no one
* Chats are persistent and cannot be erased except by someone who controls the database

Hash was created because I wanted something like IRC, persistent and easy like HipChat, open source, and based
on PHP, MySQL, HTML, and Javascript. Oh and **dead** simple!

# Installation

- Clone this repo down
- Checkout or [download](https://github.com/aubreypwd/hash/releases) a version of Hash
- Copy `config.php.sample` to `config.php` and populate with your values
- Import `db.sql` to your database and start hashing it out!

# VVV Development

There is a [VarryingVagrantVagrants](https://github.com/Varying-Vagrant-Vagrants/VVV) 
setup over at [https://github.com/aubreypwd/hash-vvv](https://github.com/aubreypwd/hash-vvv)

# Documentation

## How do I change my nick when I'm in a hash?

In the title bar, click your nick and it will take you back so you can change it and re-join the hash.

## How do I change the hash I am in?

Also, in the title bar, click the name of the Hash and it will take you back to join another hash.

# Changelog

## 0.8

- Basic concept that works and was developed in Chrome