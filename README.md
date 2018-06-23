# ArrayFileHandler

Handle php array file fluently

## Usage

```php

// constructor can either accept path to array file or array variable itself
// $handler = new ArrayFileHandler('path/to/array/file.php');
$handler = new ArrayFileHandler([99, 88]);

$handler
->add(1)
->add(2)
->add(3)
->all();

// [99, 88, 1, 2, 3]

```

#### transform()

The transform method iterates over the collection and calls the given callback with each item in the collection. The items in the collection will be replaced by the values returned by the callback:

```php

$handler->transform(function ($item, $key) {
  return $item * 10;
})->all();

// [990, 880, 10, 20, 30]

```

you can call save() method to save current array into specified path.

```php

$handler->setPath('new/directory/array.php')->save();

```

### Available methods

+ add
+ remove
+ modify
+ all
+ reset
+ transform
+ each
