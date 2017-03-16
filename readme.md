# Opus
> Opus is a place for your team to document who you are, what you do and how to achieve results. Opus helps you to create your team wikis. 

## Features

* You can create thousand of wikis.
* Invite your organization employees so that can also work on your organization wikis.   
* Instantly get notification if someone modify wiki.
* Add wiki pages to your favorite list so that you can read it after a while.
* Add wiki to your watch list.
* and more features are coming... 

## Requirements

For running this project/repository on your desktop you have following required things:

* Apache 2+
* PHP 7.0+
* MYSQL 5+
* Composer (Dependency Manager)

## Optional Requirements

- [MailHog](https://github.com/mailhog/MailHog) (MailHog is an email testing tool)

## Installation

1. First step you have to clone this repository/project on your desktop by running the following command: 
```bash
$ git clone git@gitlab.com:zeeshanu/wiki.git
```

2. You have to configure the database for the application e.g.
> Create a database with the following name  `opus`

3. After creating database you have to create tables. Don't worry it's the simplest step in the installing of this project. just open your terminal and open the root directory in terminal and run the following command:
```bash
$ php artisan migrate
``` 
**Note:**
If you want to fill the tables with dummy data after running `php artisan migrate` just run the following command:
```
$ php artisan db:seed
```

4. Now you have to create `.env` file at the root of cloned project/repository. Open the `.env` in code editor ( Sublime Text ) and set the required parameters.
> If you don't know how to create to create `.env` just rename `.env.example` to `.env` and write the required parameters.

5. After configuring the database open the root directory of the project that you cloned in first step and run the following command.
```bash
    composer install
```

6. Hurray! you installed the application.

## Contribution

* Report issues
* Open pull request with improvements
* Spread the word
* Reach out to me directly at ziishaned@gmail.com or on twitter [@ziishaned](https://twitter.com/ziishaned)

## License
MIT © [Zeeshan Ahmed](https://github.com/zeeshanu)