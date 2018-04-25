<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tom
 * Date: 22/04/2018
 * Time: 17:23
 */

abstract class Interaction {
    private static function sanitizeText($text) {
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
        return $text;
    }

    private static function sanitizeImage($image) {
        if(strstr(mime_content_type($image), 'image/')) {
            return $image;
        } else {
            return null;
        }
    }

    static function sanitizeTextInputs($whitelist, $POSTData) {
        $sanitizedData = [];
        foreach($whitelist as $key) {
            if (isset($POSTData[$key])) {
                $sanitizedData[$key] = self::sanitizeText($POSTData[$key]);
            }
        }
        return $sanitizedData;
    }

    static function sanitizeImageInputs($whitelist, $POSTData) {
        $sanitizedData = [];
        foreach($whitelist as $key) {
            if (isset($POSTData[$key])) {
                $sanitizedData[$key] = self::sanitizeImage($POSTData[$key]);
            }
        }
        return $sanitizedData;
    }
}
?>