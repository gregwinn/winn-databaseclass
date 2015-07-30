# Num Records #
**This method will return the number of rows.**

### How to use ###
This method needs three items:
  1. The first is the table name where you want to count
  1. The column name you want to match with the value
  1. The value of the column name

How to use this:

```
$db = new dbcon;
$status = '1';

$num = $db->numrecords('accounts','status',sanisql($status));
```

The above code will output the number of rows where status=1.