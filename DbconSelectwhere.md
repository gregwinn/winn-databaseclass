# Select Where #
**This method will allow you to select records that match a condition.**

### How to use ###
This method needs three items:
  1. The table name where you want to get data from
  1. What columns you want to get
  1. The conditions

The method also needs a 'mysql\_fetch\_array' to display the data.

Below is how to use:

```
$db = new dbcon;

$fname = 'Test';
$lname = 'Class';
$email = 'testclass@test.com';

$vars[] = 'firstname=' . sanisql($fname);
$vars[] = 'lastname=' . sanisql($lname);
$vars[] = 'email' . sanisql($email);

$select = $db->selectall('accounts','all',$vars);

while($row = mysql_fetch_array($select)) {
   print $row['id'];
}
```

The above code will out put the the ID of the record that meets the conditions as show in the variable '$vars'.