# SayChat

SayChat is a web application that provides a private and encrypted communication. It encrypts our conversation and decrypts that by a sequence which is changed everyday at 00:00.

### For example;
##### Feb 2 23:59:59
----
Berk Cetinsaya will be encrytped as
> 111110&1000011&1011001&1000111&`&101111&1000011&110011&1000100&1001110&110000&111100&1000101&111100

----

##### Feb 3 00:00:00.
----
Berk Cetinsaya will be encrypted as 
> 101000&101001&1001000&1100000&`&1001111&101001&1010111&100110&101111&1000010&1001101&1000111&1001101

## Usage

When you clone it, put the master folder to your web server directory. Then, import the saychat.sql file to your mysql database. By default, it will create a new database called as saychat with the tables. In case if it does not work, you can use saychatTable.sql to import only the tables into the database you created.

The only thing you have to change is the google captcha api key in `signin.php` and `signup.php`.

```
<div class="g-recaptcha" data-sitekey="YOURKEY"></div><br />
```