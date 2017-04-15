# clickdelivery-user-manager
Clickdelivery-user-manager-test

This application is an user manager, it has a normal login system using laravel's auth system, facebook authentication using Socialite package and a system based in roles, because we are using laravel auth system the order of the data in the roles table Must be like this:

| id| name | alias |
|---| ------ | ------ |
| 1 | Administrator | ADM |
| 2 | Agent | AGT |
| 3 | User | USR |

This ensures a proper execution of the system.

# You should now
- When a new user is been registered by himself, his/her account must be activated by an administrator
- When a new user is been registered by using facebook, the account is automatically activated