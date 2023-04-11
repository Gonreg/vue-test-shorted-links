<?php

namespace App\Services;

use App\Models\Link;

class LinkService
{
    public function store(string $link): Link
    {
        return Link::firstOrCreate(
            ['link' => $link],
            ['code' => bin2hex(random_bytes(5))]);
    }

    public function getLink(string $code)
    {
        return Link::where('code', $code)->value('link');
    }
}
