<?php

class ArrayFileHandler
{
	/**
	 * Store array from file
	 * @var array
	 */
	private $array;
	
	/**
	 * Path to array file
	 * @var string
	 */
	private $path;

	/**
	 * Init object path and array
	 * @param string $pathToFile 
	 */
	public function __construct($pathToFile)
	{
		$this->path = $pathToFile;
		
		$this->array = file_exists($pathToFile) ? require $this->path : [];
	}

	/**
	 * Get array
	 * @return array
	 */
	public function fetch()
	{
		return $this->array;
	}

	/**
	 * Reset array property
	 * @param  array $newArray 
	 * @return this           
	 */
	public function reset(array $newArray)
	{
		$this->array = $newArray;

		return $this;
	}

	/**
	 * Modify array with callback
	 * @param  callable $callback 
	 * @return this             
	 */
	public function modify(callable $callback)
	{
		$expect = $callback($this->array);

		if(is_array($expect)){
			$this->array = $expect;
		}
		
		return $this;
	}
	
	/**
	 * iterates over the items in the collection and passes each item to a callback
	 * @param callable $callback
	 */
	public function each(callable $callback)
	{
		foreach ($this->array as $key => $value)
		{
			$returned = $callback($value, $key);
			
			if (! $returned) {
				break;
			}
		}
	}
	
	/**
	 * iterates over the items in the collection and passes each item to a callback and replace it
	 * @param callable $callback
	 */
	public function transform(callable $callback)
	{
		foreach ($this->array as $key => $value)
		{
			$this->array[$key] = $callback($value, $key);
	
		}
	}

	/**
	 * Add new element into array
	 * @param string $key   
	 * @param mixed $value 
	 */
	public function add($key, $value)
	{
		$this->array[$key] = $value;

		return $this;
	}

	/**
	 * Rmove element by key
	 * @param  string $key 
	 * @return this      
	 */
	public function remove($key)
	{
		if (array_key_exists($key, $this->array))  {
			unset($this->array[$key]);
		}

		return $this;
	}

	/**
	 * Save array file
	 * @return void
	 */
	public function save()
	{
		file_put_contents($this->path, '<?php return ' . var_export($this->array, true) . ';');
	}
}
