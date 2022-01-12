<?php

namespace Give\API\Endpoints\DonationForms;

use Give\API\RestRoute;
use WP_Error;

/**
 * @unreleased
 */

abstract class Endpoint implements RestRoute
{

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Check user permissions
     * @return bool|WP_Error
     */
    public function permissionsCheck()
    {
        if ( ! current_user_can('edit_posts')) {
            return new WP_Error(
                'rest_forbidden',
                esc_html__('You dont have the right permissions to view Donation List', 'give'),
                ['status' => $this->authorizationStatusCode()]
            );
        }

        return true;
    }

    // Sets up the proper HTTP status code for authorization.
    public function authorizationStatusCode()
    {
        if (is_user_logged_in()) {
            return 403;
        }

        return 401;
    }
}
