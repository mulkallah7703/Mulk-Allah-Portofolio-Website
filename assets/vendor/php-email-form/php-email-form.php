<?php
/**
* PHP Email Form Configuration
* Website: https://bootstrapmade.com/php-email-form/
*/

class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $ajax = false;
  public $smtp = false;
  public $messages = array();

  public function add_message($content, $label = '', $length = 0) {
    $this->messages[] = array(
      'content' => $content,
      'label' => $label,
      'length' => $length
    );
  }

  public function send() {
    $message_content = '';
    foreach ($this->messages as $message) {
      $label = $message['label'] ? $message['label'] . ": " : '';
      $content = $message['content'];
      $message_content .= $label . $content . "\n";
    }

    $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n" .
               'Reply-To: ' . $this->from_email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if ($this->smtp) {
      return $this->send_smtp($message_content);
    } else {
      if (mail($this->to, $this->subject, $message_content, $headers)) {
        return 'OK';
      } else {
        return 'Something went wrong. Please try again later.';
      }
    }
  }

  private function send_smtp($message_content) {
    // SMTP not implemented in free version
    return 'SMTP is not available in the free version of PHP Email Form.';
  }
}
?>
