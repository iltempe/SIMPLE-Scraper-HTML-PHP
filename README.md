<img src="http://oi60.tinypic.com/2vkj2n8.jpg" /> Simple SCRAPER for HTML
========================================

This class is a simple and fast, tiny, with no dependency, scraping tool for
HTML files, require PHP 5.3 or later and it's PSR1 standard compliant.


# Table of Contents
1. [Scraping by ID](#Scraping-By-ID)
2. [Getting TAG properties](#Getting-TAG-properties)
3. [Getting ALL ocurrences](#Getting-ALL-ocurrences)
4. [LICENCE](https://github.com/botero/SIMPLE-Scraper-HTML-PHP/blob/master/licence.txt)


---
<a name="Scraping-By-ID"/>
## Scraping by ID

Simple scraping data.

### Input

```html

<div id="YourID">
	<table style="width:300px">
		<tr>
		  <td>Jill</td>
		  <td>Smith</td>
		  <td>50</td>
		</tr>
		<tr>
		  <td>Eve</td>
		  <td>Jackson</td>
		</tr>
	</table>
</div>

```

### PHP code

```php

$HTML = file_get_contents('EXAMPLE.html');
$Scraper = new Scraper();
$result = $Scraper->execute('#YourID table tr td', $HTML);

```

### Result

```php

array (size=2)
  0 =>
    array (size=3)
      0 => string 'Jill' (length=4)
      1 => string 'Smith' (length=5)
      2 => string '50' (length=2)
  1 =>
    array (size=2)
      0 => string 'Eve' (length=3)
      1 => string 'Jackson' (length=7)

```
<a name="Getting-TAG-properties"/>
## Getting TAG properties

Getting properties information.

### Input

```html

<div id="YourID">
	<div>
		<img  src="image_1.jpg" />
	</div>
	<div>
		<img  src="image_2.jpg" />
		<img  src="image_3.jpg" />
	</div>
</div>

```

### PHP Code

```php


$result = $Scraper->execute('#YourID div img:src');

```

### Result

```php

array (size=2)
  0 =>
    array (size=1)
      0 => string 'image_1.jpg' (length=11)
  1 =>
    array (size=2)
      0 => string 'image_2.jpg' (length=11)
      1 => string 'image_3.jpg' (length=11)


```
<a name="Getting-ALL-ocurrences"/>
## Getting ALL ocurrences

Using the * character at the end to get the all the coincidences, useful to merge
multiple results with [array_merge_recursive](http://php.net/manual/en/function.array-merge-recursive.php).

### Input

```html

<div id="YourID">
	<div>
		Text
	</div>
	<div>
		<div>
			<img src="image.jpg" />
		</div>
	</div>
	<div>
		<div>
		</div>
	</div>
</div>

```

### PHP Code

```php

$result = $Scraper->execute('#YourID div div img:src*');

```

### Result

```php

array (size=3)
  0 => null
  1 =>
    array (size=1)
      0 => string 'image.jpg' (length=9)
  2 =>
    array (size=1)
      0 => null

```