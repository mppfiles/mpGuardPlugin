# mpGuardPlugin #

Requires [symfony 1.4](https://github.com/symfony/symfony1) and [sfPropelORMPlugin](https://github.com/propelorm/sfPropelORMPlugin).
You can perform an automated installation of both using the [symfony1-boilerplate](https://github.com/mppfiles/symfony1-boilerplate).

This plugin is based on the [official sfGuardPlugin](http://www.symfony-project.org/plugins/sfGuardPlugin) on the latest version (currently **4.0.2**)

## Why yet another sfGuardPlugin clone??

I made this plugin because:

*   **sfGuardPlugin** and the `propel:build-schema` workflow simply don't like each other.
*   I am using **sfPropelORMPlugin**, and want to take advantage of that here.

Thus, this "clone" leaves your **sfGuardXXX** model, form and filter classes out of the plugin (in your project's `lib/model` folder and so on). It just includes a few classes named **PluginsfGuardXXX**, which you will need to extend in your project classes.

Mostly the rest of code remains untouched, until I completely replace the traces of the old Propel (ex. the Peer classes usage). Meanwhile, the included modules use the **admin15** theme instead of the default one.


## Installation

The steps marked with (!) can be automated by executing the `data/scripts/setup.sh` bash script (provided with this plugin) from your sf_root_dir:

`$ plugins/mpGuardPlugin/data/scripts/setup.sh`

Don't waste your precious time!

Now on the steps:

*   Install the plugin. `symfony plugin:install` does not work with git repos, so you have to clone this one:

```bash
  $ cd plugins
  $ git clone git://github.com/mppfiles/mpGuardPlugin.git              //or use HTTPS if you are behind a firewall
  $ cd ..
```
*   Enable the plugin in `config/ProjectConfiguration.class.php`:

```php
  class ProjectConfiguration extends sfProjectConfiguration
  {
    public function setup()
    {
      $this->enablePlugins('sfPropelORMPlugin', 'mpGuardPlugin');
```

*   Generate your guard tables using the provided script in `plugin's data/sql` folder. Some enhancements: 
    -   tables now are **InnoDB**
    - ` ENGINE=InnoDB` instead of `Type=InnoDB` to avoid conflicts
  
*   (!) Rebuild your schema:

    `$ symfony propel:build-schema`
  
*   (!) Place the `schema.custom.yml` from the plugin's `config/` folder to your project's config folder (or copy the statements if you already have such file)

    **IMPORTANT: perform this step before rebuilding your model!**. This avoids duplicated class names due to **sfGuardXXX** and **SfGuardXXX** issue (note the capital "S").

    `$ cp plugins/config/schema.custom.yml config/schema.custom.yml`
  
*   (!) Rebuild your model (**IMPORTANT: don't forget to perform the previous step before!**)

    `$ symfony propel:build --all-classes`
  
*   (!) Make the following classes extend from their corresponding `PluginsfGuardXXX` class:

```bash
lib/model/sfGuardGroup.php
lib/model/sfGuardGroupPeer.php
lib/model/sfGuardGroupPermission.php
lib/model/sfGuardGroupPermissionPeer.php
lib/model/sfGuardPermission.php
lib/model/sfGuardPermissionPeer.php
lib/model/sfGuardRememberKey.php
lib/model/sfGuardRememberKeyPeer.php
lib/model/sfGuardUser.php
lib/model/sfGuardUserPeer.php
lib/model/sfGuardUserGroup.php
lib/model/sfGuardUserGroupPeer.php
lib/model/sfGuardUserPermission.php
lib/model/sfGuardUserPermissionPeer.php
```


*   for example, open `sfGuardGroup.php` and change:

```php

<?php

class sfGuardGroup extends PluginsfGuardGroup
{
}
```

*   **IMPORTANT: don't modify any other files except the above ones!** For example, don't touch:
    *   the generated Query classes under `lib/model` (ex. **sfGuardUserQuery.php**)
    *   everything under `lib/model/om`
    *   everything under `lib/model/map`
    *   everything under `lib/form/base`
    *   everything under `lib/filter/base`
    *   everything other class under `lib/model` not named **sfGuardXXX**


*   Just continue with the classic sfGuardPlugin installation right from *"Enable one or more modules in your settings.yml (optional)"*

    (see **README.sf** for more details)