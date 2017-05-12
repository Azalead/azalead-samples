<?php
/**
* Account label
**/
class LabelController
{
  /**
  *  request api for account labels
  **/
  public function requestLabels($token) {
    $ch = curl_init('https://api.azalead.com/latest/label');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Auth-Token:Bearer '.$token)
    );

    $apiResults = requestAPI($ch);
    return $apiResults;
  }


  public function mapLabels($apiLabels) {
    $labels = null;
    for ($i=0; $i < count($apiLabels) ; $i++) {
      $label = new Label();
      $label->setId($apiLabels[$i]->id);
      $label->setLabel($apiLabels[$i]->label);
      $labels[] = $label;
    }
    return $labels;
  }

  public function findLabelName($idLabel, $labels) {
    for ($i=0; $i < count($labels) ; $i++) {
      if ($idLabel == $labels[$i]->getId()) {
        return $labels[$i]->getLabel();
      }
    }
  }
}
?>
