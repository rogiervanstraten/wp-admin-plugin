<?php
/**
 * Author: Baldadig
 * URL: http://baldadig.nl/
 * Description: 
 * Version: 1.0.1
 */

/**
 * Create slug from anything
 * @description Used for creating a body-class based on the bloginfo name
 * @source: [http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string]
 */
if ( !function_exists('slugify') ) :
  function slugify( $text = '' ) {

    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    if ( empty( $text ) ) {
      return 'n-a';
    }

    return $text;
  }
endif;

if ( ! function_exists('get_first_category') ) :
  function get_first_category( $id = null, $key = null ){

    $categories = get_the_category( $id );
    if( ! $categories ) return null;

    $category = (array) $categories[0];
    return ( $key ) ? $category[$key] : $category ;

  }
endif;

if ( ! function_exists('char_limit') ) :
  function char_limit( $str, $limit ){

    return ( strlen( $str ) > $limit ) ? substr( $str, 0, $limit) . '...' : $str ;

  }
endif;

if ( ! function_exists('get_image_html') ) :
  function get_image_html( $image = array(), $str = 'large', $attributes = array() ){

    // Stringify the attributes
    $html_attributes = '';
    foreach ($attributes as $key => $value) {
      $html_attributes .= "$key=\"$value\" " ;
    }

    // Check if the sizes exists.
    if( isset( $image['sizes'] ) && isset( $image['sizes'][ $str ] ) ) {
      $image_url = $image['sizes'][ $str ];
      $image_result = "<img $html_attributes src=\"$image_url\">";
      return $image_result;
    }

    // Fallback image
    $image_result = "<img $html_attributes src=\"" . $fallback . "\">" ;
    return $image_result;

  }
endif;

if ( ! function_exists('get_image_url_by_name') ) :
  function get_image_url_by_name( $img, $str = 'large', $fallback = '' ){

    $imgo = '';

    if( isset( $img['sizes'] ) && isset( $img['sizes'][ $str ] ) ) {

      $imgo = $img['sizes'][ $str ];

    } elseif( $fallback != '' ) {

      $imgo = $fallback ;

    }

    return $imgo ;

  }
endif;

if ( ! function_exists('get_image_by_title') ) :
  function get_image_by_title( $img, $str = 'large', $s = false, $fallback = '' ) {

    $imgo = '';

    if( isset( $img['sizes'] ) && isset( $img['sizes'][ $str ] ) ) {

      $wh = ( $s ) ? 'width="' . $img['sizes'][ $str . '-width' ] . '" height="' . $img['sizes'][ $str . '-height' ] . '" ': '' ;
      $imgo = "<img src=\"" . $img['sizes'][ $str ] . "\" $wh>" ;

    } elseif( $fallback != '' ) {

      $imgo = "<img src=\"" . $fallback . "\">" ;

    }

    return $imgo ;

  }
endif;
