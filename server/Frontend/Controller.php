<?php
class Frontend_Controller implements Frontend_Interface_Controller {

    private $modelFactory;

    /**
     * Создаёт экземпляр класса
     *
     * @param Model_Factory $modelFactory фабрика объектов модели
     */
    public function __construct(
        Model_Factory $modelFactory
    ) {
        $this->modelFactory = $modelFactory;
    }

    public function process(array $data) {

        $request =  array_key_exists('request', $data) ? $data['request'] : '';

        if (!empty($request)) {
            
            $thought = $this->modelFactory->makeThought($request);
            $thought->memorizeInformation();
            $thought->getContext();
            
            /*
            $translator = $this->modelFactory->makeTranslator($request);
            $errors = $translator->getErrors();
            if (!empty($errors)) {
                var_dump($errors);
            }
             */
        }
/*
        $myself = 777;

        $message = $this->modelFactory->makeMessage($request);
        $knowledge = $this->modelFactory->makeKnowledge($myself);
        $actionChecker = $this->modelFactory->makeActionChecker();
        $message->toKnowledge($knowledge, $actionChecker);
*/
        return array(
            'request' => $request
        );
    }

}