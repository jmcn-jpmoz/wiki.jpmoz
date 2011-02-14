<?php

if( !defined( 'MEDIAWIKI' ) )
  die( -1 );

class SkinMySkin extends SkinTemplate {
  function initPage( OutputPage $out ) {
    parent::initPage( $out );
    $this->skinname  = 'wikijpmoz';
    $this->stylename = 'wikijpmoz';
    $this->template  = 'MonoBookTemplate';
  }
}
