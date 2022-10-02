<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initializing our api
include_once('../core/initialize.php');

// instantiate category class

$category = new Category($db);

// blog category query
$result = $category->read();

// get the row count
$num = $result->rowCount();

if ($num > 0) {
  $category_arr = array();
  $category_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    // extract()함수는 배열 속의 키값을 변수화 시켜주는 함수이다.
    extract($row);

    // html_entity_decode => HTML 엔티티를 문자로 변환
    $category_item = array(
      'id' => $id,
      'name' => $name,
      'create_at' => $create_at
    );
    array_push($category_arr['data'], $category_item);
  }
  // convert to JSON and output
  echo json_encode($category_arr);
} else {
  echo json_encode(array('message' => 'No categories found.'));
}
