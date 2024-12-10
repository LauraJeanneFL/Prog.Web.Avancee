<?php

namespace App\Providers;

class Validator {
    public static function validateForm($data, $requiredFields) {
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new \Exception("Le champ $field est requis.");
            }
        }
        return $data;
    }
}