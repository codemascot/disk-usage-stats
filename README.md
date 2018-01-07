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

## Design Description
#### Design Pattern
Here as you asked to implement a well known design pattern, I've implemented *Singleton* pattern at the plugin main file [disk-usage-stats.php](disk-usage-stats.php). I didn't find any other pattern helpful for this small project.
#### DRY Principle
I tried to design it with DRY principle and loosly coupled as much as it could be. 

#### API
A hook based API has been added, so that some add-ons as well as other module can be added easily or any other developer can extend this plugin easily.
#### Single Responsibility Principle
*Single Responsibility Principle* has been followed. Means each method and each class does one single thing.
#### Modular
A directory based modular approach has been followed.
#### Translatable
This plugin is fully translatable.

#### AJAX & Chunking
Got the idea of making it AJAXified and chunked result, but couldn't got the time.

#### DB Table & Data Save
I at first thought to store the data in the table by `serialize`. But later saw that the data is huge. So couldn't figure out what would be the best procedure to store this kinda data.

#### Unit Test
One unit test has been provided for the accessibility for different user role for the admin menu item this plugin is creating. I followed **WP-CLI** based testing library. For testing setup please follow [this procedure](https://make.wordpress.org/cli/handbook/plugin-unit-tests/). 

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
- [x] **Step 1:** Designing structure
- [x] **Step 2:** Creating Skeleton or Boilerplate Setup
- [x] **Step 3:** UI/UX Design & Coding
- [ ] **Step 4:** Functionality Development

### DB Table
- ID
- Created at
- User ID
- Serialized Data

As I said earlier that, later I couldn't figure out the best way to save this data. So couldn't do it.

## Acknowledgement

- [WooCommerce](https://github.com/woocommerce/woocommerce): I inherited the dynamic admin page procedure from here. 
- This [DiskStatus](http://pmav.eu/stuff/php-disk-status/source.html) cass