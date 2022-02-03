<?php

namespace Give\Promotions\FreeAddonModal;

trait CheckModalState
{
    /**
     * Whether the modal should be displayed.
     *
     * @return bool
     */
    protected function displayModal()
    {
        // Only display the modal if the user is an admin
        if ( ! current_user_can('manage_options')) {
            return false;
        }

        // Only display if the user did not dismiss or subscribe
        $status = get_option('give_free_addon_modal_displayed');

        if (empty($status)) {
            return true;
        }

        // The value will be something like rejected:1:1.18.0. The first number is the number of versions the modal has appeared
        // in, and the second number is the version number of the plugin at the time of last display.
        list($status, $iteration, $version) = explode(':', $status);

        if ($status === 'subscribed') {
            return false;
        }

        // Do not display if this has been displayed more than three times
        if ($iteration >= 3) {
            return false;
        }

        // Display if the version has changed since the last display
        return GIVE_VERSION !== $version;
    }
}
