<?php

namespace App;

use Illuminate\Support\Str;

final class Helpers
{
    /**
     * Get the administration url for a given URL.
     *
     * @param  string  $url
     * @return string
     */
    public static function getAdministrationUrl(string $url): string
    {
        if (! Str::startsWith($url, '/')) {
            $url = '/'.$url;
        }

        return env('ADMINISTRATION_URL').$url;
    }
}
