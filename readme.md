<p align="center">
<a href="http://i.imgur.com/Oxh9Mhg.png"><img src="http://i.imgur.com/AfFX7vQ.png"/></a>
</p>

#

<p align="center">
Opensource knowledge base application for Teams.
</p>

<p align="center">
<a href="https://travis-ci.org/zeeshanu/opus"><img src="https://travis-ci.org/zeeshanu/opus.svg?branch=master"/></a>
<a href="https://github.com/zeeshanu/opus"><img src="https://img.shields.io/github/release/zeeshanu/opus.svg" /></a>
<a href="https://app.fossa.io/projects/git%2Bgithub.com%2Fzeeshanu%2Fopus?ref=badge_shield" alt="FOSSA Status"><img src="https://app.fossa.io/api/projects/git%2Bgithub.com%2Fzeeshanu%2Fopus.svg?type=shield"/></a>
</p>

## Introduction

Opus is a place for your team to document who you are, what you do and how you do it. It helps you create and maintain a knowledge base for your teams.

![Opus](http://i.imgur.com/WZvXEXY.png)

## Motivation
As companies grow, it becomes difficult to manage and communicate the knowledge across different departments, Opus acts as a single source of truth; a go-to place for the employees to get knowledge. It gives enterprises the power to create anything and everything; from meeting notes, project plans, product requirements, technical documentations, orchestrate processes, work-flows and more. 

There are spaces for every team, department or major project. Then employees can create, organize and share knowledge inside their relevant teams and keep work organized. There is a structured hierarchy and powerful search engine to find what you need quickly and easily. Apart from that, templates help creating documents without any hassle and there is PDF and Office Docs generation for the ease of sharing.

## Features

* Create manage Wikis (group of knowledge pages)
* Create nested pages inside wikis
* Manage wikis and pages by spaces and tags
* Invite employees by email
* Powerful ACL to assign different roles and permissions to employees.
* Slack notifications for the wiki updates
* Mark wikis and pages as favorite
* Watch wiki/pages to get notified
* In-app notifications
* Discussions using comments
* Create reusable page templates
* Search across the knowledge base
* ..and more

## Requirements

* PHP 7.0+
* MySQL 5+

## Installation

- Run the below command in your terminal:
  ```bash
  composer create-project zeeshanu/opus
  ```
- Create `.env` using `.env.dist` and populate the relevant information
- Install the dependencies
  ```bash
  composer install
  ```
- Open the project directory and run the below
  ```bash
  php artisan migrate
  ``` 
- Generate an application key
  ```bash
  php artisan key:generate
  ```
- Run the database seeder
  ```bash
  php artisan db:seed
  ```

## Todo

- [x] ~~Access Control~~
  - [x] ~~Create and Update User Roles~~ 
  - [x] ~~Create User Roles~~
  - [x] ~~Assign Roles to Employees~~
  - [x] ~~Invite employees by email~~
- [x] ~~Wikis~~
  - [x] ~~Create Spaces (Group of Wikis)~~ 
  - [x] ~~Create Wikis inside Spaces~~
  - [x] ~~Update and Delete Wikis~~
  - [x] ~~Create Pages inside Wikis~~
  - [x] ~~Syntax Highlighting for Code~~
  - [x] ~~Update and Delete Pages~~
  - [x] ~~Hierarchical Page Trees~~
  - [x] ~~Rearrange Pages in Wikis~~
  - [x] ~~Mark Pages as Favorite~~
  - [x] ~~Leave Comments~~
    - [x] ~~Mention Team Members~~
    - [x] ~~Add Emojis~~
  - [x] ~~Watch Wikis to get notified for updates~~
  - [x] ~~Save pages in Read List (Like Watch Later in Youtube)~~
  - [x] ~~Add Tags to Pages~~
  - [x] ~~List all Pages available in a tag~~
- [x] ~~Team Dashboard (Monitor Team Activity)~~
- [x] ~~User Dashboard (Monitor User Activity)~~
- [x] ~~Export Documents~~
    - [x] ~~Export Page as PDF~~
    - [x] ~~Export Page as MS Word File~~
- [x] ~~Notifications~~
  - [x] ~~Add slack integration in team~~
  - [x] ~~Notify on slack~~
  - [x] ~~In-app Notification balloon~~
  - [x] ~~Mentioned in comment notifications~~
- [x] ~~Global Search~~
- [ ] Responsive
- [x] ~~Upload demo somewhere~~

## Contribution

* Report issues
* Open pull request to **DEV BRANCH** with improvements
* Spread the word
* Reach out to me directly at ziishaned@gmail.com or on twitter [@ziishaned](https://twitter.com/ziishaned)

## License
The license holder is allowed to use the software for free, as long as they don't make money using it. [Read more in License](https://github.com/zeeshanu/opus/blob/master/LICENSE.md)


[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fzeeshanu%2Fopus.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fzeeshanu%2Fopus?ref=badge_large)