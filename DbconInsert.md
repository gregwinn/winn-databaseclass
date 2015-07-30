# Insert #
**This method will allow you to insert into you database**

### How to use ###
This method needs two items, first is the table name that the data will be inserted to. The second is the column name and the value.

Below is how to use this method:
```
$db = new dbcon;

$fname = 'Test';
$lname = 'Class'
$email = 'testclass@test.com';

$sql = "firstname=" . sanisql($fname) 
. ", lastname=" . sanisql($lname)
. ", email=" . sanisql($email);

$db->insert('accounts',$sql);
```

The above will output the data into the database like so:

| id | firstname | lastname | email |
|:---|:----------|:---------|:------|
| 1  | Test      | Class    | testclass@test.com |