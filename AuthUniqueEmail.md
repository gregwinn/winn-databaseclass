# Authorization uniqueness of email #
This auth method will allow you to check users email address to your current database. You may set a variable to tell the class if the user is new or the user is editing the information.


Below is how to call and use the method:

```
$auth = new auth();

// For new users
$auth->validates_uniqueness_of_email('email@testemail.tld','new');
// Will return 'TRUE' if the email address is not is use.

// For current users
$auth->validates_uniqueness_of_email('email@testemail.tld','edit');
// Will return 'TRUE' if the email address is not is use.
```


---


### Sample ###
**Database table**
| id | email |
|:---|:------|
| 1  | test@test.com |
| 2  | test2@test.com |

#### NEW ####
First this will try to validate an email address that is in the database for a new user.
```
$Val = $auth->validates_uniqueness_of_email('test@test.com','new');
// Output
FALSE
```
The output is FALSE and the user can not use the email address.

Now lets try a new email address that is not in the database.
```
$Val = $auth->validates_uniqueness_of_email('test3@test.com','new');
// Output
TRUE
```
Output is TRUE and the user adds the email to the database.

#### EDIT ####
Now lets change my address from 'test@test.com' to test3@test.com using edit.
```
$MyCurrentEmail = 'test@test.com';
$TryNewEmail = 'test3@test.com';
$auth->validates_uniqueness_of_email($TryNewEmail,'edit');
// Output
TRUE
```
The user is allowed to change from 'test@test.com' to 'test3@test.com'.

In this sample we will try to change our email address from 'test@test.com' to 'test2@test.com'
```
$MyCurrentEmail = 'test@test.com';
$TryNewEmail = 'test2@test.com';
$auth->validates_uniqueness_of_email($TryNewEmail,'edit');
// Output
FALSE
```
The user is rejected as the email address 'test2@test.com' is in the database table.