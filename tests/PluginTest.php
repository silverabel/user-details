<?php
use PHPUnit\Framework\TestCase;
use Brain\Monkey;

define('ABSPATH', 1);

class MonkeyTestCase extends TestCase {

  protected function setUp(): void {
    parent::setUp();
    Monkey\setUp();
  }

  protected function tearDown(): void {
    Monkey\tearDown();
    parent::tearDown();
  }
}

class MyTestCase extends MonkeyTestCase {

  public function testAddHooks() {
    // unrecognized function in Brain Monkey
    function register_deactivation_hook() {
      return;
    }

    User_Details_Plugin::addHooks();
    self::assertTrue( has_action( 'init', 'User_Details_Plugin::add_rewrite' ) );
    self::assertTrue( has_action( 'parse_request', 'User_Details_Plugin::user_details_parse' ) );
  }
}