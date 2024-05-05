# ZnetDK 4 Module Login History
Allows the ZnetDK 4 Mobile application to display user login history.

## FEATURES
This module contains the view `z4m_loginhistory` to declare within the
`menu.php` of the application in order to visualize the history of user logins.
User login history is stored in database within the `zdk_user_login_history` SQL
table.

## REQUIREMENTS
- ZnetDK 4 Mobile version 2.0 or higher,
- Authentication is enabled (`CFG_AUTHENT_REQUIRED` is TRUE in App's `config.php`).

## TRANSLATIONS
This module is translated in **French**, **English** and **Spanish** languages.  
To translate this module in another language or change the standard
translations, copy the PHP constants declared within the `locale_en.php` of the
module and paste them within the `locale.php` file of your application.   
Next, translate each text associated with these PHP constants into your own
language.

## INSTALLATION
1. Copy module's code in the `./engine/modules/z4m_loginhistory/` subdirectory,
2. Edit the App's `menu.php` located in the `./applications/default/app/`
subfolder and add a new menu item definition for the view named
`z4m_loginhistory`.
For example:
`\MenuManager::addMenuItem('_authorizations', 'z4m_loginhistory',
MOD_Z4M_LOGINHISTORY_MENU_LABEL, 'fa-history');`

## USERS GRANTED TO SEE LOGIN HISTORY
Once the **Login history** menu item is added to the application, you can restrict 
its access via a user profile.  
For example:
1. Create a user profile named `Admin` from the **Authorizations | Profiles** menu,
2. Select for this new profile, the **Login history** menu item,
3. Finally for each allowed user, add them the `Admin` profile from the
**Authorizations | Users** menu. 

## ISSUES
The `zdk_user_login_history` SQL table is created automatically when login
history is read or stored.  
If the MySQL user declared through the `CFG_SQL_APPL_USR` PHP constant does not
have `CREATE` privilege, the module can't create the required SQL table.   
In this case, you can create the `zdk_user_login_history` SQL table by importing
in MySQL the script `z4m_loginhistory/mod/sql/z4m_loginhistory.sql` provided by
the module.

