<?php
class Model_Reader_TextFormat_TextFormat {

    private $message;
    private $errorFactory;
    private $errors; 

    public function __construct(
        Model_Reader_Message $message,
        Model_Reader_TextFormat_Error_FormatErrorFactory $errorFactory
    ) {

        $this->message = $message;
        $this->errorFactory = $errorFactory;
        $this->errors = array();

        $this->check();

    }

    
    public function hasErrors() {

        return !empty($this->errors);

    }

    public function getErrors() {

        return $this->errors;
        
    }

    
    private function check() {
        
        // ВНИМАНИЕ! Числа не менять. По кодам ошибок может производиться очистка текста.

        $this->checkBeginning(1);
        $this->checkEnd(2);
        $this->checkFistLineExists(3);
        $this->checkSecondLineExists(4);
        $this->checkEmptyLinesExceptFirstLine(5);
        $this->checkCharacterBetweenTabs(6);
        $this->checkMultipleSpaces(7);
        $this->checkNoCharacterBeforeTab(8);
        $this->checkNoSpaceBeforeFirstWord(9);
        $this->checkTabIncrement(10);
        $this->checkCarriageReturn(11);

    }

    private function checkBeginning($number) {

        $errorCount = preg_match(
                                    '/\A(\s|\n)+?(?=(\S|\Z))/u',
                                    $this->message->getText(),
                                    $matches
        );

        if ($errorCount > 0) {

            $message = 'Сообщение должно начинаться со слова. Обнаружены пробельные символы.';
            $startPosition = 0;
            $endPosition = strlen($matches[0]);
            
            $this->errors[] = $this->errorFactory->makeFormatError(
                $number, 
                $message, 
                $startPosition, 
                $endPosition
            );
            
        }

    }

    private function checkEnd($number) {

        $errorCount = preg_match(
                                    '/(?<=\S)(\s|\n)+?\z/u',
                                    $this->message->getText(),
                                    $matches
        );

        if ($errorCount > 0) {

            $message = 'После последнего слова сообщения не должно быть пробельных символов.';
            $endPosition = strlen($this->message->getText());
            $startPosition = $endPosition - strlen($matches[0]);
            
            $this->errors[] = $this->errorFactory->makeFormatError(
                $number, 
                $message, 
                $startPosition, 
                $endPosition
            );
            
        }
        
    }
    
    private function checkFistLineExists($number) {
        
        $messageLength = strlen($this->message->getText());
        
        if ($messageLength == 0) {

            $message = 'Отсутствует первая строка, в которой должен быть указан отправитель сообщения.';
            $endPosition = 0;
            $startPosition = 0;
            
            $this->errors[] = $this->errorFactory->makeFormatError(
                $number, 
                $message, 
                $startPosition, 
                $endPosition
            );
            
        }
        
    }
    
    private function checkSecondLineExists($number) {
        
        $breakPosition = strpos($this->message->getText(), "\n");

        if ($breakPosition === false) {

            $message = 'Отсутствует вторая строка, в которой должно быть указано первое действие сообщения.';
            $startPosition = strlen($this->message->getText());
            $endPosition = $startPosition;
            
            $this->errors[] = $this->errorFactory->makeFormatError(
                $number, 
                $message, 
                $startPosition, 
                $endPosition
            );
            
        }
        
    }
    
    private function checkEmptyLinesExceptFirstLine($number) {

        $errorCount = preg_match_all(
                                    '/(?<=(\n))\s*?(?=\n)/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );
        
        $errorCount2 = preg_match_all(
                                    '/(?<=(\n))\s*?$/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );

        if ($errorCount > 0 || $errorCount2 > 0) {

            $message = 'В сообщении не должно быть строк, в которых отсутствуют слова.';
            
            foreach ($matches[0] as $match) {
                
                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }

        }

    }

    private function checkCharacterBetweenTabs($number) {

        $errorCount = preg_match_all(
                                    '/(?<=\t)(\w|\d| )+?(?=\t)/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );

        if ($errorCount > 0) {

            $message = 'Между знаками табуляции не должно быть никаких других символов.';
            
            foreach ($matches[0] as $match) {
            
                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }

        }

    }
    
    private function checkMultipleSpaces($number) {

        $errorCount = preg_match_all(
                                    '/ {2,}/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );

        if ($errorCount > 0) {

            $message = 'Для разделения слов достаточно одного пробела.';
            
            foreach ($matches[0] as $match) {
            
                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }

        }

    }

    private function checkNoCharacterBeforeTab($number) {

        $errorCount = preg_match_all(
                                    '/(?<=\n)(\w|\d| )+(?=\t)/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );

        if ($errorCount > 0) {

            $message = 'Между началом строки и табулятором не должно быть никаких других символов.';
            
            foreach ($matches[0] as $match) {
            
                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }

        }

    }
    
    private function checkNoSpaceBeforeFirstWord($number) {

        $errorCount = preg_match_all(
                                    '/(?<=\n) +?(?=\S)/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );

        if ($errorCount > 0) {

            $message = 'Перед первым словом строки можно вставлять только табуляторы.';
            
            foreach ($matches[0] as $match) {
            
                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }

        }

    }
    
    private function checkTabIncrement($number) {
        
        preg_match_all(
            '/(?<=\n)\t*?(?=\S)/u',
            $this->message->getText(),
            $matches,
            PREG_OFFSET_CAPTURE
        );

        $depth = 0;
        foreach ($matches[0] as $match) {
            
            $currentDepth = strlen($match[0]);
            
            $difference = $currentDepth - $depth;
            
            if ($difference > 1) {
                
                $message = 'На следующей строке может быть только на один отступ больше.';

                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }
            
            $depth = $currentDepth;
            
        }
        
    }
    
    private function checkCarriageReturn($number) {
        
        $errorCount = preg_match_all(
                                    '/\r/u',
                                    $this->message->getText(),
                                    $matches,
                                    PREG_OFFSET_CAPTURE
        );

        if ($errorCount > 0) {

            $message = 'Для разделения строк достаточно одного символа \n (line feed).';
            
            foreach ($matches[0] as $match) {
            
                $startPosition = $match[1];
                $endPosition = $startPosition + strlen($match[0]) - 1;

                $this->errors[] = $this->errorFactory->makeFormatError(
                    $number,
                    $message,
                    $startPosition,
                    $endPosition
                );
                
            }

        }
        
    }
    
}