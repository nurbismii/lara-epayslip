<?php

namespace App\Support;

final class Alert
{
    public static function success(string $title = '', string $text = ''): void
    {
        self::flash('success', $title, $text);
    }

    public static function error(string $title = '', string $text = ''): void
    {
        self::flash('error', $title, $text);
    }

    public static function info(string $title = '', string $text = ''): void
    {
        self::flash('info', $title, $text);
    }

    public static function warning(string $title = '', string $text = ''): void
    {
        self::flash('warning', $title, $text);
    }

    private static function flash(string $icon, string $title, string $text): void
    {
        $config = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'timer' => (int) config('sweetalert.timer', 5000),
            'heightAuto' => (bool) config('sweetalert.height_auto', true),
            'showConfirmButton' => (bool) config('sweetalert.show_confirm_button', true),
            'showCloseButton' => (bool) config('sweetalert.show_close_button', false),
        ];

        session()->flash(
            'alert.config',
            json_encode($config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR)
        );
    }
}
