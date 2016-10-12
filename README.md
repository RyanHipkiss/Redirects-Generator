#Description

This project allows the transformation of a CSV file containing Redirects and converts them to the format acceptable by .htaccess files

#Setup

###First, require the class

```php
require('redirects.class.php');
```

###Then load in the file and set the variables

```php
$redirects = new Redirects('file.csv');
$redirects->set_domain('http://example.com');
$redirects->set_old_url_column(1);
$redirects->set_new_url_column(2);
$redirects->set_redirect_type('301');
```

If your CSV redirect doesn't contain an "old domain" then you can leave this as a blank string ''. Then we set the two columns for the CSV where the redirects are set. The columns start counting from 0. Finally we set the redirect type (301 or 302).

###Generate Redirects and store them in a file.

```php
$redirects->generate_redirects();
$redirects->insert_to_file('redirects.txt');
```

This will generate the redirects, and then insert them into the file we pass in.
