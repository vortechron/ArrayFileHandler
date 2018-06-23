# ArrayFileHandler

Handle php array file fluently

## Usage

```php

$handler = new ArrayFileHandler('path/to/array/file.php');

$handler
->add(1)
->add(2)
->add(3)
->save();

// [1, 2, 3]

```

#### transform()

The transform method iterates over the collection and calls the given callback with each item in the collection. The items in the collection will be replaced by the values returned by the callback:

```php

$handler->transform(function ($item, $key) {
  return $item * 10;
})->save();

// [10, 20, 30]

```

### Available methods

+ add
+ remove
+ modify
+ fetch
+ reset
+ transform
+ each
