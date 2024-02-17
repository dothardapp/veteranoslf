<?php

namespace App\Admin\Actions;

use OpenAdmin\Admin\Actions\RowAction;

class ViewZonas extends RowAction
{
    public $name = 'Ver zonas';

    public $icon = 'icon-book-reader';

    /**
     * @return  string
     */
    public function href()
    {
        return "/admin/vista_zonas";
    }
}