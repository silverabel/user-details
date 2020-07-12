<?php declare(strict_types=1);
namespace silverabel;

class UserDetailsPlugin
{
    public static function addRewrite()
    {
        add_rewrite_endpoint('user-details', EP_ROOT);
        flush_rewrite_rules();
    }

    public static function removeRewrite()
    {
        flush_rewrite_rules();
    }

    public static function userDetailsParse(object $request)
    {
        if (array_key_exists('user-details', $request->query_vars)) {
            $httpRequest = wp_remote_get('https://jsonplaceholder.typicode.com/users');

            if (is_wp_error($httpRequest)) {
                echo 'Could not retrieve data';
                die();
            }

            $body = wp_remote_retrieve_body($httpRequest);
            $data = json_decode($body, true);

            if (empty($data)) {
                echo 'Request failed';
                die();
            }

            $javascriptUrl = plugins_url() . '/silverabel-user-details/js/main.js';

            echo '<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User details</title>

<script src="' . esc_url($javascriptUrl) . '" defer></script>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
    </tr>';
            
            foreach ($data as $user) {
                $userid = $user['id'];
                echo '
    <tr>
        <td><a href="" data-id="' . esc_attr($userid) . '">' . esc_textarea($userid) . '</a></td>
        <td><a href="" data-id="' . esc_attr($userid) . '">' . esc_textarea($user['name']) . '</a></td>
        <td><a href="" data-id="' . esc_attr($userid) . '">' . esc_textarea($user['username']) . '</a></td>
    </tr>';
            }
            
            echo '
</table>
</body>
</html>';
            
            die();
        }
    }

    public static function addHooks()
    {
        add_action('init', __CLASS__ . '::addRewrite');
        add_action('parse_request', __CLASS__ . '::userDetailsParse');

        register_deactivation_hook(__FILE__, __CLASS__ . '::removeRewrite');
    }
}
