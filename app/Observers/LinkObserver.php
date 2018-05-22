<?php
/**
 * Created by PhpStorm.
 * User: zvan
 * Date: 2018/5/22
 * Time: 12:07
 */

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver{
    public function saved(Link $link){
        Cache::forget($link->cache_key);
    }
}