# Disk Usage Stats
This is a WordPress plugin developed for showing disk usage statistics. It is a test project for *SnapCreek Software*.

Copyright (c) 2018 Khan M Rashedun-Naby, TheDramatist, rnaby

Good news, this plugin is free for everyone! Since it's released under the [GPL License](LICENSE) you can use it free of charge on your personal or commercial website.

# Design document for *Disk Usage Stats*

## Abstract Architectural Idea
- ‎Target user group is *PHP >= 5.6*, cause handling *PHP < 5.6* is very pain full. Besides, the user group for *PHP < 5.6* is too small.
- ‎Namespacing and other modern approach will be followed.
- ‎In main file a *Singleton* pattern will be applied. But I haven't found other patterns helpful for this tiny project within this short time.
- ‎*Single Responsibility Principle* will be followed.
- Mostly *DRY (Don't Repeat Yourself)* principle will be followed.
- Most of the things will be loosely coupled.
- ‎Directory based modular approach will be followed.
- ‎A WordPress hook based API will be provided to manipulate data or extend this plugin.
- ‎Unit testing will be provided.

## Coding Styles & Technique
- All input and frontend data should be escaped and validated.
- Developed as *Composer* package.
- *PSR-4* autoloading used.
- **YODA** condition checked.
- Maintained *Right Margin* carefully, which is **80 characters**.
- Used `true`, `false` and `null` in stead of `TRUE`, `FALSE` and `NULL`.
- **INDENTATION:** *TABS* has been used in stead of *SPACES*.
- *PHP Codesniffer* checked.
- *WordPress VIP* coding standard followed mostly.
- Symentic version controll.
- Unit tested.

## Workflow ( In Steps )
- [ ] **Step 1:** Designing class diagram and DB table
- [ ] **Step 2:** Creating Skeleton or Boilerplate Setup
- [ ] **Step 3:** UI/UX Design & Coding
- [ ] **Step 4:** Functionality Development

### DB Table
- ID
- Created at
- User ID
- Serialized Data

> Image will be here

## Class Diagram Design

> Image will be here

## Acknowledgement