<?php

namespace piyo2\util;

/**
 * Case-insensitive map
 */
class CIMap
{
	/** @var mixed[] */
	protected $map = [];

	/**
	 * newMap で置き換える
	 *
	 * @param mixed[] $newMap 置き換える内容
	 * @return void
	 */
	public function replace(array $newMap): void
	{
		$this->map = $newMap;
	}

	/**
	 * 指定したキーに対応する値を返す
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get(string $key)
	{
		$lcKey = strtolower($key);
		foreach ($this->map as $k => $value) {
			if (strtolower($k) === $lcKey) {
				return $value;
			}
		}
		return null;
	}

	/**
	 * キーに対応する値を設定する
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function set(string $key, $value): void
	{
		$this->reset($key);
		$this->map[$key] = $value;
	}

	/**
	 * キーに対応する値を削除する
	 *
	 * NOTE: unset は PHP 5.6 までトークン文字列なので使用不可
	 *
	 * @param string $key
	 * @return void
	 */
	public function reset(string $key): void
	{
		$lcKey = strtolower($key);
		foreach ($this->map as $k => $value) {
			if (strtolower($k) === $lcKey) {
				unset($this->map[$k]);
			}
		}
	}

	/**
	 * 連想配列として取得する
	 *
	 * @return mixed[]
	 */
	public function toArray(): array
	{
		return $this->map;
	}

	/**
	 * 配列からインスタンスを作成する
	 
	 * @param mixed[] $data
	 * @return CIMap
	 */
	public static function fromArray(array $data): CIMap
	{
		$inst = new CIMap();
		$inst->replace($data);
		return $inst;
	}
}
