# Wiki

> This tool helps you to create your organiaztion or projects wiki with simple steps.

## Features

* You can create thousand of wikis.
* Invite your organization employees so that can also work on your organization wikis.   
* Instantly get notification if someone modify wiki.
* Add wiki pages to your favourite list so that you can read it after a while.
* Add wiki to your watch list.
* and more features are comming... 

## Installation

* Clone this repo:

```shell
$ git clone git@gitlab.com:zeeshanu/wiki.git
```

* Create following database `wiki` 

* Run migration

```shell
$ php artisan migrate
```

* Fill database with dummy data - optional

```shell
$ php artisan db:seed
```

* Create a virtual host or just run the following command in your project root directory:

```shello
$ php artisan serve	
```

* Lastly in your favourite browser open following url 

```
localhost:8000
```