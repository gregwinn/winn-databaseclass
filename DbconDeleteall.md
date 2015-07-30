# Delete All #
**This will allow you to delete all records where conditions meet.**

### How to use ###
This method needs two items:
  1. The table you want to delete from
  1. The conditions that need to be met.

Below is how to use this:

```
$db = new dbcon;
$status = '1';

$conditions = 'status=' . $status;

$db->deleteall('accounts',$conditions);
```

The Above code will delete all records that have the status of 1.