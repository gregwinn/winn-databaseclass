# Update #
**This method will allow you to update a record by providing the ID**

### How to use ###
This method needs three items:
  1. The table to update
  1. The Column name and new value
  1. The record ID

Below is how to use this method

```
$db = new dbcon;
$id = '10';
$fname = 'Test';
$lname = 'Class'
$email = 'testclass@test.com';

$sql = "firstname=" . sanisql($fname) 
. ", lastname=" . sanisql($lname)
. ", email=" . sanisql($email);

$db->update('accounts',$sql,$id);
```

The above code would update the record with the ID of 10 and set it to:

| id | firstname | lastname | email |
|:---|:----------|:---------|:------|
| 10 | Test      | Class    | testclass@test.com |