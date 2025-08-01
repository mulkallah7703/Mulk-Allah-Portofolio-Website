<?php
  /**
   * Requires the "PHP Email Form" library
   * The "PHP Email Form" library is available only in the pro version of the template
   * The library should be uploaded to: assets/vendor/php-email-form/php-email-form.php
   * More info: https://bootstrapmade.com/php-email-form/
   */

  // 🔁 استبدل هذا بالبريد الإلكتروني الذي تريد استلام الرسائل عليه
  $receiving_email_address = 'your-email@example.com';

  // 🔍 تحميل مكتبة PHP Email Form
  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  // ⬇️ تهيئة الكائن الأساسي
  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  // 📨 إعدادات الرسالة
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'] ?? '';
  $contact->from_email = $_POST['email'] ?? '';
  $contact->subject = $_POST['subject'] ?? 'New Message';

  // ✅ إعدادات SMTP (اختياري - عند الحاجة لإرسال عبر Gmail مثلاً)
  /*
  $contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'your-email@gmail.com',
    'password' => 'your-app-password',
    'port' => '587',
    'encryption' => 'tls'
  );
  */

  // 📝 محتوى الرسالة
  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['message'], 'Message', 10);

  // 🚀 إرسال الرسالة
  echo $contact->send();
?>
