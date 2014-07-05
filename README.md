# Worldmap

Prints a world map generated with the jquery plugin jvectormap and information contained in a database when clicking on a country.

## Installation

First download the latest version of Jvectormap here : http://jvectormap.com/download/

You need to include a CSS Jvectormap file, the jQuery file, and 2 JS Jvectormap files in the file where you'll print the map.
In my case it's ```countries.php```.
If you don't know how to do so, see the tutorial here to start using Jvectormap : http://jvectormap.com/tutorials/getting-started/

For more information, check the documentation here http://jvectormap.com/documentation/

I also included the Bootstrap CSS file for the pretty table class table-hover.
You can download it here : http://getbootstrap.com/getting-started/#download

## Initialization

You have two files :
* ```getdatabase.php```, where you connect to your database, get data and print it in JSON
* ```countries.php```, where you print the map and display the data returned by getdatabase.php in a table below the map

First, you need to put your information to connect to your database in the ```getdatabase.php``` file :

```php
$serv     = "localhost";
$base     = "BASE";
$login    = "LOGIN";
$pwd      = "PASSWORD";
```

You need to replace the strings above by your server, your database, your login and your password.

Then, in the SQL query :

```php
$sql = "SELECT field1, field2, field3, field4, field5 FROM Countries WHERE field1='".$code."'";
```

I just put field1 to field5, so you need to replace those fields by the fields in your database you want to get, like ```population, area, flag``` or whatever.
You need to replace the name of the table too if it's not ```Countries``` in your case.

Last step for ```getdatabase.php``` is to make the array ```$results``` according to your SQL query :

```php
$results[] = array (
            'field1' => utf8_encode($row['field1']),
            'field2' => utf8_encode($row['field2']),
            'field3' => utf8_encode($row['field3']),
            'field4' => utf8_encode($row['field4']),
            'field5' => utf8_encode($row['field5']),
        );
```

Just replace the fields by those you get in your request above.

Now you need to print the map in ```countries.php``` according to the data you get in ```getdatabase.php```.

So in the javascript loop :

```javascript
for (i = 1; i <= data[0]; i++) {
				total += "<tr><td>"+data[i].field1+"</td><td>"+data[i].field2+"</td><td>"+data[i].field3+"</td><td>"+data[i].field4+"</td><td>"+data[i].field5+"</td></tr>";
		    }
```

And in the HTML div :

```javascript
$('#countries-infos').replaceWith("<div id=\"countries-infos\"><table class=\"table table-hover\"><tr><td><h5>Field1</h5></td><td><h5>Field2</h5></td><td><h5>Field3</h5></td><td><h5>Field4</h5></td><td><h5>Field5</h5></td></tr>"+total+"</table></div>");
```

Just replace once again by the fields you get in your database.
