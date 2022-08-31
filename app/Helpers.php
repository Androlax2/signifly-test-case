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

    /**
     * Get flash notification for success.
     *
     * @param  string  $message
     * @return array
     */
    public static function getFlashSuccessMessage(string $message): array
    {
        return [
            'flash_notification' => [
                'message' => $message,
                'level' => 'success',
            ],
        ];
    }

    /**
     * Get flash notification for error.
     *
     * @param  string  $message
     * @return array
     */
    public static function getFlashErrorMessage(string $message): array
    {
        return [
            'flash_notification' => [
                'message' => $message,
                'level' => 'error',
            ],
        ];
    }
}
