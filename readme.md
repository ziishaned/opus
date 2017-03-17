![Opus](http://i.imgur.com/WZvXEXY.png)

> Opensource knowledge base application for Teams

Opus is a place for your team to document who you are, what you do and how you do it. It helps you create and maintain a knowledge base for your teams. [Demo here](https://github.com/zeeshanu/opus/blob/master/demo.md) 


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

- Clone the repository
  ```bash
  git clone https://github.com/zeeshanu/opus.git
  ```
- Create `.env` using `.env.example` and populate the relevant information
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

## Todo

- [x] ~~Access Control~~
  - [x] ~~Create and Update User Roles~~ 
  - [x] ~~Create User Roles~~
  - [x] ~~Assign Roles to Employees~~
  - [x] ~~Invite employees by email~~
- [x] Wikis
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
  - [ ] Watch Wikis to get notified for updates
  - [ ] Save pages in Read List (Like Watch Later in Youtube)
  - [ ] Add Tags to Pages
  - [ ] List all Pages available in a tag
- [x] ~~Team Dashboard (Monitor Team Activity)~~
- [x] ~~User Dashboard (Monitor User Activity)~~
- [ ] Export Documents
    - [ ] Export Page as PDF
    - [ ] Export Page as MS Word File
- [ ] Notifications  
  - [x] ~~Add slack integration in team~~
  - [x] ~~Notify on slack~~
  - [ ] Set Notification Preferences in Profile
  - [ ] In-app Notification balloon
  - [ ] Notifications by email
  - [ ] Mentioned in comment notifications
- [ ] Templates
  - [ ] Create Templates
  - [ ] Populate Wiki by Template (Dropdown on Create Wiki Page)
- [ ] Global Search
- [ ] Responsive
- [ ] Upload demo somewhere

## Contribution

* Report issues
* Open pull request with improvements
* Spread the word
* Reach out to me directly at ziishaned@gmail.com or on twitter [@ziishaned](https://twitter.com/ziishaned)

## License
MIT © [Zeeshan Ahmed](https://github.com/zeeshanu)
