# CHANGE LOG: User Login History (z4m_loginhistory)

## Version 1.3, 2024-09-08
- BUG FIXING: PHP ZnetDK Error DAO-006 when purging history if no criterium is selected.
- BUG FIXING: the 'Purge' button is now disabled if the history is empty.

## Version 1.2, 2024-08-05
- BUG FIXING: error 'E_WARNING - Undefined array key "HTTP_USER_AGENT"' if user
  agent is missing in the $_SERVER superglobal variable.

## Version 1.1, 2024-05-23
- CHANGE: new Purge button added to the login hitory view (`z4m_loginhistory`).
  When clicked, all the rows matching the filter criteria are removed.
- CHANGE: for security reasons, the `Z4MLoginHistoryCtrl::action_all()` and
 `Z4MLoginHistoryCtrl::action_purge()` methods can only be executed if called
  from the web browser in JavaScript by a user authorized to access the view
 `z4m_loginhistory`.

## Version 1.0, 2024-05-06
First version.