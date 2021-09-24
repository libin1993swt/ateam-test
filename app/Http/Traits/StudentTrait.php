<?php

namespace App\Http\Traits;

trait StudentTrait {
    public function getGender() {
        $genders = ["male" => "Male", "female" => "Female", "others" => "Others"];
        return $genders;
    }
}