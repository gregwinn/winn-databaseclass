# Delete #
**This will allow you to delete a single record from the database, when called in a loop you can delete multiple records at once**

### How to use ###

The method needs two items:
  * The table name you want to delete from
  * The id of the record that will be deleted

Here is a sample of how to use this:

```
$db = new dbcon;
$id = '10';

$db->delete('accounts',$id);
```

The above code will delete the record with the ID of 10.