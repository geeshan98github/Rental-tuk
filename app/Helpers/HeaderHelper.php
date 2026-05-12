<?php

namespace App\Helpers;

use App\Models\MetaTag;

class HeaderHelper
{
    public static function getMeta($page)
    {
        $meta = MetaTag::where('status', 'Y')
            ->where('is_delete', 0)
            ->where('page_name', $page)
            ->first();
        return $meta;
    }
}
