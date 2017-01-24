# Masonic Lodge Website

This is a trimmed down version of the website used by
[Kempsville Masonic Lodge](http://kempsvillelodge.org/) in Virginia Beach.
Like many websites, the original evolved over several years, starting as
a couple of pages and slowly developing into its current state. The original
design was never seen as a potential starting point for other lodges. This repository
is an attempt to make the site available to other lodges that might like to
use it as a starting point for their own website.

## Configuration Files

After retreiving the repository, there are a few steps necessary to complete the configuration:

* cp inc/config.inc-sample inc/config.inc
* cp css/offcanvas.less-sample css/offcanvas.less
* cp data/database.db-sample data/database.db

### inc/config.inc

This file contains a collection of (hopefully) self-explanatory PHP variables used throughout the site.

### css/offcanvas.less

At this point, there are only two colors that are easily configured and are contained
in offcanvas.less: @main-color and @main-color-dark

### data/database.db

The site is driven by a SQLite3 database. By default, the site looks for "database.db" but can
be changed via the $cnf_database variable in inc/config.inc.

The database is managed via the Administrative module accessed from http://domain.com/admin or,
if necessary, the included phpLiteAdmin application at http://domain.com/admin/phpliteadmin

## Securing /admin

The /admin directory should be secured using whatever method is appropriate for
your web server. For example, an Apache .htaccess such as:
```
AuthType Basic
AuthName "Website Administration"
AuthUserFile /path/to/the/.htpasswd
Require valid-user

```

## Caveats

* in its current state, the site must be installed at DocumentRoot on your web server
* the "Yearly" pages contained in /years must be created manually. There are some simple examples
provided. Creating these pages via the Admin application is a work-in-progress.