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

#License

MIT License

Copyright (c) [2016] [Ryan Hipkiss]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
