<?php

class Gemini extends Controller {

    public function index() {
      $user = $this->model('User');
      $data = $user->test();

      $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=".$_ENV['GEMINI'];

      $data = array(
        "contents" => array(
          array(
            "role" => "user",
            "parts" => array(
              array(
                // Echo this to the screen of our movie controller in that view.
                "text" => 'Please give a review of Barbie from someone who rated it a 4 out of 5.'
              )
            )
          )
        )
      );

      $json_data = json_encode($data);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);
      curl_close($ch);
      if(curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
      }

      echo "<pre>";
      echo $response;
      die;
    }

}
