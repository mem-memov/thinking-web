<?php
class Model_PhraseFactory {

    public function makePhrase($string) {

        return new Model_Phrase($string);

    }

}