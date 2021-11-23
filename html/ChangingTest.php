<?php
use PHPUnit\Framework\TestCase;
require_once './Changing.php';
 
class ChangingTest extends TestCase
{
	private $change;
 
	protected function setUp(): void
	{
		$this->change = new Changing();
	}
 
	protected function tearDown(): void
	{
		$this->change = NULL;
	}
 
	public function testChanging()
	{
		$result = $this->change->revertCharacters('Привет! Давно, не  виделись.');
		$this->assertEquals('Тевирп! Онвад, ен ьсиледив.', $result);
	}
}
?>