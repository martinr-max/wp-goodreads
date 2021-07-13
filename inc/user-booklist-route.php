<?php

add_action('rest_api_init', 'userBooklistRoutes');

function userBooklistRoutes() {
  register_rest_route('books/v1', 'manageBooklist', array(
    'methods' => 'POST',
    'callback' => 'addBook'
  ));

  register_rest_route('books/v1', 'manageBooklist', array(
    'methods' => 'DELETE',
    'callback' => 'removeBook'
  ));
}

function addBook($data) {
  $bookId = sanitize_text_field($data['list_book']);

  wp_insert_post(array(
    'post_type' => 'my_booklist',
    'post_status' => 'publish',
    'post_title' => '2nd PHP Test',
    'meta_input' => array(
      'list_book' => $bookId
    )
  ));
}

function deleteLike() {
  return 'Thanks for trying to delete a like';
}