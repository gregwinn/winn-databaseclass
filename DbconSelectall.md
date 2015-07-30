# Select All #
**This method will get all records from a table.**

### How to use ###
This method needs two items:
  1. The table name that you will be selecting items from
  1. The columns you want returned

This method will only do a 'mysql\_query', to display the data you will need to use the function 'mysql\_fetch\_array'.

Below is how to use:

```
$db = new dbcon;

$select = $db->selectall('accounts','all');

while($row = mysql_fetch_array($select)) {
   print $row['firstname'];
}
```

The above code will output the column value of 'firstname'.