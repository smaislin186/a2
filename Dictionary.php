<?php

class Dictionary{
    public $words;

    public function __contruct($jsonPath){

        $dictJson = file_get_contents($jsonPath);
        $this->dictionary = json_decode($dictJson, true);
    }

    public function getAllWords(){
        return $this->words;
    }
    public function lookup(String $word){
            $definition = '';
            
            $wordUp = strtoupper($word);

            if(!$this->dictionary[$wordUp] == ''){
                $definition = $this->dictionary[$wordUp];
            }

            return $definition;
    }

}# eoc