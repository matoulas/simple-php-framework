<?php

namespace Api\Core;

class Language {
    protected static $languages;

    protected static function config($lang) {
        if(stream_resolve_include_path("Api/i18n/$lang.inc"))
            self::$languages = include "Api/i18n/$lang.inc";
    }
    
    public static function i18n($key) {
        isset(self::$languages[$key]) ? $word = self::$languages[$key] : $word = $key;
        return $word;
    }
}