<?php

namespace App\Traits;

trait FlashMessages
{
    /**
     * @var array
     */
    protected $errorMessages = [];
    protected $infoMessages = [];
    protected $successMessages = [];
    protected $warningMessages = [];

    /**
     * @param string $message
     * @param string $type
     */
    protected function setFlashMessage(string $message, string $type)
    {
        $model = 'infoMessages';

        switch ($type) {
            case 'info' : {
                $model = 'infoMessages';
            }
            break;

            case 'error' : {
                $model = 'errorMessages';
            }
            break;

            case 'success' : {
                $model = 'successMessages';
            }
            break;

            case 'warning' : {
                $model = 'warningMessages';
            }
            break;
        }

        if (is_array($messages)) {
            foreach ($message as $key => $value)
            {
                array_push($this->$model, $value);
            }
        } else {
            array_push($this->$model, $message);
        }
    }

    /**
     * @return array
     */
    protected function getFlashMessage()
    {
        return [
            'error'     => $this->errorMessages,
            'info'      => $this->infoMessages,
            'success'   => $this->successMessages,
            'warning'   => $this->warningMessages,
        ];
    }

    protected function showFlashMessage()
    {
        session()->flash('error', $this->errorMessages);
        session()->flash('info', $this->infoMessages);
        session()->flash('success', $this->successMessages);
        session()->flash('warning', $this->warningMessages);
    }
}