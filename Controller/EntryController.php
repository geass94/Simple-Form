<?php


namespace Controller;
use Model\EntryModel;
use Service\MailProvider;
use Service\SmsProvider;

class EntryController
{
    private $mailService;
    private $smsService;

    public function __construct()
    {
        $this->mailService = new MailProvider();
        $this->smsService = new SmsProvider();
    }

    public function submitForm()
    {
        $data = $_POST['data'];

        // Perform necessary input validation here

        $model = new EntryModel();
        $id = $model->saveEntry($data);

        $this->mailService->send($data);
        $this->smsService->send($data);

        // Redirect to the display page
        header("Location: index.php?view=display&entryId=$id");
        exit();
    }

    public function displayEntry(int $id)
    {
        // Perform necessary input validation here

        $model = new EntryModel();
        $data = $model->getEntry($id);

        // Sanitize the data before displaying it in the view
        $sanitizedData = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

        // Display the sanitized data in the view
        echo $sanitizedData;
    }
}