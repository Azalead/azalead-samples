<?php

/**
* Request API and get results
**/
function requestAPI($ch) {
  //execute request
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  //close connection
  curl_close($ch);

  $decodedData = json_decode($response);

  $apiResults = new ApiResult();
  if ($httpcode != 200) {
    $apiError = new ApiError();
    if (isset($decodedData->title)) {
      $apiError->setTitle($decodedData->title);
    }
    if (isset($decodedData->status)) {
      $apiError->setStatus($decodedData->status);
    }
    if (isset($decodedData->detail)) {
      $apiError->setDetail($decodedData->detail);
    }
    if (isset($decodedData->message)) {
      $apiError->setDetail($decodedData->message);
    }
    $apiResults->setApiError($apiError);
  } else {
    $apiResults->setResults($decodedData);
  }

  return $apiResults;
}

/**
* authenticate to the API and get an authentification token
**/
function authenticate($username, $password) {
  $data = array("username" => $username, "password" => $password);
  $data_string = json_encode($data);

  //authenticate
  $ch = curl_init('https://api.azalead.com/latest/authenticate');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  );

  $apiResults = requestAPI($ch);
  return $apiResults;
}

function inDateRange ($theDate, $afterDate, $beforeDate) {
  if ($theDate > $afterDate && $theDate < $beforeDate) {
    return true;
  }
  return false;
}
?>
