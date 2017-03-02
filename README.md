# simplehttpclient
A very simple Http Client that works on PHP 5.3 

## Installation

To install simply run this :

```bash
    composer require fabricekabongo/simplehttpclient
```

## Usage

This client offers 3 interfaces:
### Get request
without query parameters:
```php
$client = new FabriceKabongo\Http\HttpClient();
$responseData = $client->get('http://www.google.com');
```
or with query parameters:
```php
$client = new FabriceKabongo\Http\HttpClient();
$responseData = $client->get('http://www.google.com', array('q' => 'tallest falls in africa');//http://www.google.com?q=tallest%20falls%20in%20africa
```

### post Request

with post parameters:
```php
$client = new FabriceKabongo\Http\HttpClient();
$responseData = $client->post('http://www.myawesomeapi.com', array('foo' => 'bar');
```

### base64 upload
sends a file using base64 content (think android developers lol):

```bash
touch myfile.txt && echo "random content" > myfile.txt
```
then:
```php
$client = new FabriceKabongo\Http\HttpClient();
try {
    $responseData = $client->base64Upload('http://www.myawesomeapi.com', __DIR__."/myfile.txt");
} catch (\Exception $ex) {
    //log oups
}
```

## other informations
This code need php-curl to be installed (obviously you choose php5.3-curl, php5.6-curl php7.0-curl depending of your version)

# License

MIT. you are free dude.

