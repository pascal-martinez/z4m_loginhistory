# ZnetDK 4 Mobile module: User Login History (z4m_loginhistory)
The **z4m_loginhistory** module extends the [ZnetDK 4 Mobile](/../../../znetdk4mobile) starter application by adding the following features:
- Stores in the application's MySQL database, the history of successful and failed user connections to the application.
- Provides a view that displays in a list the history of user connections to the application.
- Purge the entire history or only those corresponding to a given period and status.

![Screenshot of the User Login History view provided by the ZnetDK 4 Mobile 'z4m_loginhistory' module](https://mobile.znetdk.fr/applications/default/public/images/modules/z4m_loginhistory/screenshot.png?v1.1)
## LICENCE
This module is published under the version 3 of GPL General Public Licence.

## FEATURES
This module contains the view `z4m_loginhistory` to declare within the
[`menu.php`](/../../../znetdk4mobile/blob/master/applications/default/app/menu.php) of the
application in order to visualize the history of user logins.  
User login history is stored in database within the `zdk_user_login_history` SQL
table created automatically on module execution.

## REQUIREMENTS
- [ZnetDK 4 Mobile](/../../../znetdk4mobile) version 2.0 or higher,
- A **MySQL** database is configured to store the application data,
- Authentication is enabled
([`CFG_AUTHENT_REQUIRED`](https://mobile.znetdk.fr/settings#z4m-settings-auth-required)
is `TRUE` in the App's
[`config.php`](/../../../znetdk4mobile/blob/master/applications/default/app/config.php)).

## TRANSLATIONS
This module is translated in **French**, **English** and **Spanish** languages.  
To translate this module in another language or change the standard
translations:
1. Copy in the clipboard the PHP constants declared within the 
[`locale_en.php`](mod/lang/locale_en.php) script of the module,
2. Paste them from the clipboard within the
[`locale.php`](/../../../znetdk4mobile/blob/master/applications/default/app/lang/locale.php) script of your application,   
3. Finally, translate each text associated with these PHP constants into your own
language.

## INSTALLATION
1. Add a new subdirectory named `z4m_loginhistory` within the
[`./engine/modules/`](/../../../znetdk4mobile/tree/master/engine/modules/) subdirectory of your
ZnetDK 4 Mobile starter App,
2. Copy module's code in the new `./engine/modules/z4m_loginhistory/` subdirectory,
or from your IDE, pull the code from this module's GitHub repository,
3. Edit the App's [`menu.php`](/../../../znetdk4mobile/blob/master/applications/default/app/menu.php)
located in the [`./applications/default/app/`](/../../../znetdk4mobile/tree/master/applications/default/app/)
subfolder and add a new menu item definition for the view `z4m_loginhistory`.
For example:  
```php
\MenuManager::addMenuItem('_authorizations', 'z4m_loginhistory', MOD_Z4M_LOGINHISTORY_MENU_LABEL, 'fa-history');
```

## USERS GRANTED TO SEE LOGIN HISTORY
Once the **Login history** menu item is added to the application, you can restrict 
its access via a [user profile](https://mobile.znetdk.fr/settings#z4m-settings-user-rights).  
For example:
1. Create a user profile named `Admin` from the **Authorizations | Profiles** menu,
2. Select for this new profile, the **Login history** menu item,
3. Finally for each allowed user, add them the `Admin` profile from the
**Authorizations | Users** menu. 

## ISSUES
The `zdk_user_login_history` SQL table is created automatically by the module 
when login history is read or stored for the first time.  
If the MySQL user declared through the
[`CFG_SQL_APPL_USR`](https://mobile.znetdk.fr/settings#z4m-settings-db-user)
PHP constant does not have `CREATE` privilege, the module can't create the
required SQL table.   
In this case, you can create the `zdk_user_login_history` SQL table by importing
in MySQL or phpMyAdmin the script
[`z4m_loginhistory.sql`](mod/sql/z4m_loginhistory.sql) provided by the module.

## CHANGE LOG
See [CHANGELOG.md](CHANGELOG.md) file.

## CONTRIBUTING
Your contribution to the **ZnetDK 4 Mobile** project is welcome. Please refer to the [CONTRIBUTING.md](https://github.com/pascal-martinez/znetdk4mobile/blob/master/CONTRIBUTING.md) file.
