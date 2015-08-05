<?php
/**
 * Author: %%AUTHOR%%
 * URL: %%AUTHORURI%%
 * Description: %%DESCRIPTION%%
 * Version: %%VERSION%%
 */

/**
 * Create slug from anything
 * @description Used for creating a body-class based on the bloginfo name
 * @source: [http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string]
 */
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

function get_first_category( $id = null, $key = null ){

  $categories = get_the_category( $id );
  if( ! $categories ) return null;
  
  $category = (array) $categories[0];
  return ( $key ) ? $category[$key] : $category ;

}

function char_limit( $str, $limit ){

  return ( strlen( $str ) > $limit ) ? substr( $str, 0, $limit) . '...' : $str ;

}


function get_image_url_by_name( $img, $str = 'large', $fallback = '' ){

  $imgo = '';

  if( isset( $img['sizes'] ) && isset( $img['sizes'][ $str ] ) ) {

    $imgo = $img['sizes'][ $str ] ;

  } elseif( $fallback != '' ) {
    
    $imgo = $fallback ;

  }

  return $imgo ;

}

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