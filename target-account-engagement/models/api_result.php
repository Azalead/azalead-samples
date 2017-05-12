<?php
/**
* Api Result is the result of an api request
**/
class ApiResult
{
  private $apiError;
  private $results;

  public function setApiError($apiError) {
    $this->apiError = $apiError;
  }

  public function getApiError() {
    return $this->apiError;
  }

  public function setResults($results) {
    $this->results = $results;
  }

  public function getResults() {
    return $this->results;
  }
}
?>
