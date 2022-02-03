<?php

namespace Give\Promotions\FreeAddonModal\Controllers;

use Give\Promotions\FreeAddonModal\CheckModalState;

class EnqueueModal
{
    use CheckModalState;

    public function enqueueScripts()
    {
        if ( !$this->displayModal() ) {
            return;
        }

        wp_enqueue_script('give_free_addon_modal', GIVE_PLUGIN_URL . 'assets/dist/js/admin-free-addon-modal.js', [], GIVE_VERSION, true);
        wp_add_inline_script('give_free_addon_modal', 'var giveFreeAddonModal = ' . json_encode($this->getScriptData()) . ';', 'before');
    }

    private function getScriptData()
    {
        return [
            'siteUrl' => site_url(),
            'siteName' => get_bloginfo('name'),
        ];
    }
}
