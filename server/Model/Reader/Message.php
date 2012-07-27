<?php
class Model_Reader_Message {

    private $text;

    public function __construct($text) {

        $this->text = $text;

    }

    public function getText() {

        return $this->text;

    }

}