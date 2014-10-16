consh
=====

concrete5 5.7 shell scripts

This is the successor to the previous consh scripts for concrete5.5 / 5.6 rewritten for concrete5.7.

# Installation

* clone this repository `git clone https://github.com/triplei/consh.git`
* switch to the newly created directory `cd consh`
* install dependencies using composer `composer install`
* symlink the consh script to your place of choosing. `sudo ln -s /usr/local/bin/consh consh` or `ln -s ~/bin/consh consh`

# Usage

In the base directory of a local concrete5.7 installation run the consh configuration script `consh config`. 

*consh currently assumes that you have your concrete5 installation in a public_html/ sub-folder* The plan is to have 
this dynamically discovered from a number of common sub-folders (or non at all). 

This will create a config file in ./public_html/application/config/generated_overrides/consh/consh.php

Now you should be able to run the various consh commands.

# Current Commands

* `consh config` Write the initial configuration file
* `consh db:pull` Pull the remote site's database and import it into the local installation
* `consh db:backup` create a backup of the remote database on the local system
* `consh db:restore <filename>` restore one of the previously created local backups
* `consh files:pull` Rsync the remote site's files directory to the local filesystem
* `consh pull` Pulls the database and files from the remote server

# Pull Requests

If you have found a bug and have a suggestion for how to fix it or you have developed a new command / feature you wish 
to share, please fork this repository, create a branch and then submit a pull request.

Please make sure you have the correct licensing for all code submitted. consh is released under the MIT License.

# Bug Reports / Feature Requests

If you have found a bug or have an idea for a feature, please feel free to open an issue. In the case of a bug, any
information you can provide (error messages, the command run, what you expected to happen, what happened) would be helpful.
For a feature request, a detailed description of the use-case would be great.

Keep in mind, this is a project in my (limited) spare time. I'll do my best to get to bug reports / feature requests,
but please be patient.

# Credits

The consh script is written by Dan Klassen <dan@triplei.ca>. I am the owner / lead developer of Triple I Web Solutions
<http://www.triplei.ca>.