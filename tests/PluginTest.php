<?php declare(strict_types=1);
// phpcs:disable PSR1.Files.SideEffects
namespace silverabel;

use PHPUnit\Framework\TestCase;

use Brain\Monkey;

require_once('MonkeyTestCase.php');
const ABSPATH = 1;

// unrecognized function in Brain Monkey
function register_deactivation_hook()
{
    return null;
}

class PluginTest extends MonkeyTestCase
{
    public function testAddHooks()
    {
        UserDetailsPlugin::addHooks();
        self::assertTrue(has_action('init', 'silverabel\UserDetailsPlugin::addRewrite'));
        self::assertTrue(has_action('parse_request', 'silverabel\UserDetailsPlugin::userDetailsParse'));
    }
}
