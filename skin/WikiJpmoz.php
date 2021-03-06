<?php

if( !defined( 'MEDIAWIKI' ) )
  die( -1 );

class SkinWikiJpmoz extends SkinTemplate {
  function initPage( OutputPage $out ) {
    parent::initPage( $out );
    $this->skinname  = 'wikijpmoz';
    $this->stylename = 'wikijpmoz';
    $this->template  = 'WikiJpmozTemplate';
  }

  function setupSkinUserCss( OutputPage $out ) {
    global $wgHandheldStyle;

    parent::setupSkinUserCss( $out );

    // Append to the default screen common & print styles...
    $out->addStyle( 'wikijpmoz/main.css', 'screen' );
    if( $wgHandheldStyle ) {
      // Currently in testing... try 'chick/main.css'
      $out->addStyle( $wgHandheldStyle, 'handheld' );
    }
    
    $out->addStyle( 'wikijpmoz/menubar.css', 'screen');

    $out->addStyle( 'monobook/IE50Fixes.css', 'screen', 'lt IE 5.5000' );
    $out->addStyle( 'monobook/IE55Fixes.css', 'screen', 'IE 5.5000' );
    $out->addStyle( 'monobook/IE60Fixes.css', 'screen', 'IE 6' );
    $out->addStyle( 'monobook/IE70Fixes.css', 'screen', 'IE 7' );

    $out->addStyle( 'monobook/rtl.css', 'screen', '', 'rtl' );
  }
}


class WikiJpmozTemplate extends QuickTemplate {
  var $skin;
  /**
   * Template filter callback for MonoBook skin.
   * Takes an associative array of data set from a SkinTemplate-based
   * class, and a wrapper for MediaWiki's localization database, and
   * outputs a formatted page.
   *
   * @access private
   */
  function execute() {
    global $wgRequest;
    $this->skin = $skin = $this->data['skin'];
    $action = $wgRequest->getText( 'action' );

    // Suppress warnings to prevent notices about missing indexes in $this->data
    wfSuppressWarnings();

?>
<!DOCTYPE html>
<html lang="ja"
  xmlns="<?php $this->text('xhtmldefaultnamespace') ?>" <?php
  foreach($this->data['xhtmlnamespaces'] as $tag => $ns) {
    ?>xmlns:<?php echo "{$tag}=\"{$ns}\" ";
  } ?>xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">

<head>
  <meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
  <?php $this->html('headlinks') ?>
  <title><?php $this->text('pagetitle') ?></title>
  <?php $this->html('csslinks') ?>

  <!--[if lt IE 7]><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/common/IEFixes.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
  <meta http-equiv="imagetoolbar" content="no" /><![endif]-->

  <?php print Skin::makeGlobalVariablesScript( $this->data ); ?>

  <script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>
  <!-- Head Scripts -->
<?php $this->html('headscripts') ?>
<?php  if($this->data['jsvarurl']) { ?>
    <script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"><!-- site js --></script>
<?php  } ?>
<?php  if($this->data['pagecss']) { ?>
    <style type="text/css"><?php $this->html('pagecss') ?></style>
<?php  }
    if($this->data['usercss']) { ?>
    <style type="text/css"><?php $this->html('usercss') ?></style>
<?php  }
    if($this->data['userjs']) { ?>
    <script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php  }
    if($this->data['userjsprev']) { ?>
    <script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php  }
    if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
  <script src="<?php $this->text('stylepath' ) ?>/wikijpmoz/menubar.js" type="text/javascript"></script>
</head>


<body<?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('dir') ?> <?php $this->text('pageclass') ?> <?php $this->text('skinnameclass') ?>">

<div id="globalWrapper">

<!--  TOP MENU BAR  -->

<div class="menuBar">
<!--
  <a class="menuButton"
    href=""
    onclick="return buttonClick(event, 'fileMenu');"
    onmouseover="buttonMouseover(event, 'fileMenu');" >File</a>
-->
  <a class="menuButton"
    href=""
    onclick="return buttonClick(event, 'editMenu');"
    onmouseover="buttonMouseover(event, 'editMenu');">編集</a>
<!--
  <a class="menuButton"
    href=""
    onclick="return buttonClick(event, 'viewMenu');"
    onmouseover="buttonMouseover(event, 'viewMenu');">View</a>
-->
  <a class="menuButton"
    href=""
    onclick="return buttonClick(event, 'toolsMenu');"
    onmouseover="buttonMouseover(event, 'toolsMenu');">ツール</a>
  <a class="menuButton"
    href=""
    onclick="return buttonClick(event, 'optionsMenu');"
    onmouseover="buttonMouseover(event, 'optionsMenu');">アカウント</a>
  <a class="menuButton"
    href=""
    onclick="return buttonClick(event, 'helpMenu');"
    onmouseover="buttonMouseover(event, 'helpMenu');">ヘルプ</a>


  <form action="<?php $this->text('wgScript') ?>" id="menuSearchform">
    <input type='hidden' name="title" value="<?php $this->text('searchtitle') ?>"/>
    <input id="searchInput" name="search" type="text"<?php echo $this->skin->tooltipAndAccesskey('search');
      if( isset( $this->data['search'] ) ) {
      ?> value="<?php $this->text('search') ?>"<?php } ?> />
    <input type='submit' name="go" class="searchButton" id="searchGoButton"  value="<?php $this->msg('searcharticle') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-go' ); ?> />
    <?php if ($wgUseTwoButtonsSearchForm) { ?>
      <input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-fulltext' ); ?> /><?php
    } else { ?>
      <a href="<?php $this->text('searchaction') ?>" rel="search"><?php $this->msg('powersearch-legend') ?></a><?php 
    } ?>
  </form>

  <span class="menuRight">
    <a href="http://twitter.com/home?status=http%3A%2F%2Fwiki.jpmoz.net/%20%23mozjpwiki%20wiki@jpmoz%20-%20<?php echo htmlspecialchars($this->text('title')) ?>" target="_blank" style="border: medium none;">
      <img id="menuTweet" title="このwikiページについてTwitterでつぶやく" 
        src="<?php $this->text('stylepath' ) ?>/wikijpmoz/tweet.png" style="border: medium none; vertical-align: top;">
    </a>
    <a href="/Special:%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3?type=signup" title="新規アカウント作成" class="menuButton" rel="nofollow">新規アカウント作成</a>
    <a href="/Special:%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3" title="ログイン" class="menuButton" rel="nofollow">ログイン</a>
  </span>
</div>


<div id="editMenu" class="menu" onmouseover="menuMouseover(event)"><?php
  foreach ($this->data['content_actions'] as $key => $tab) {
    if ((strcmp($key, "watch") == 0) || (strcmp($key, "unwatch") == 0) ||
        (strcmp($key, "varlang-0") == 0) || (strcmp($key, "print") == 0)) {
      echo '<div class="menuItemSep"></div>';
    } ?>
    <a id="<?php echo Sanitizer::escapeId( "ca-$key" ); ?>"
      class="menuItem"
      <?php if ( $tab['class'] ) {
        echo 'class="' . htmlspecialchars($tab['class']) . '"';
      } ?>
      href="<?php echo htmlspecialchars($tab['href']); ?>"
      <?php
        if( in_array( $action, array( 'edit', 'submit' ) )
         && in_array( $key, array( 'edit', 'watch', 'unwatch' ))) {
          echo $skin->tooltip( "ca-$key" );
        } else {
          echo $skin->tooltipAndAccesskey( "ca-$key" );
        }
      echo '>' . htmlspecialchars($tab['text']);
    ?></a>
  <?php if (strcmp($key, "talk") == 0) {echo '<div class="menuItemSep"></div>'; }
  } ?>
</div>

<div id="optionsMenu" class="menu" onmouseover="menuMouseover(event)"><?php
  foreach ($this->data['personal_urls'] as $key => $item) { ?>
    <a id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>"
      class="menuItem"
      <?php if ($item['active']) { echo 'class="active"'; } ?>
      href="<?php echo htmlspecialchars($item['href']) ?>"
      <?php
        echo $skin->tooltipAndAccesskey('pt-'.$key);
        if (!empty($item['class'])) { 
          echo 'class="' . htmlspecialchars($item['class']) . '"';
        }
      ?>><?php echo htmlspecialchars($item['text']) ?></a><?php
  } ?>
</div>

<div id="toolsMenu" class="menu" onmouseover="menuMouseover(event)"><?php
  if ($this->data['notspecialpage']) { ?>
    <a href="<?php echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href']) ?>"
      <?php echo $this->skin->tooltipAndAccesskey('t-whatlinkshere') ?>
      class="menuItem"
      ><?php $this->msg('whatlinkshere') ?></a><?php
    if ( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
      <a href="<?php echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href']) ?>"
        <?php echo $this->skin->tooltipAndAccesskey('t-recentchangeslinked') ?>
        class="menuItem"
        ><?php $this->msg('recentchangeslinked') ?></a><?php
    }
  }
  if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
    <a href="<?php echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href']) ?>"
      <?php echo $this->skin->tooltipAndAccesskey('t-trackbacklink') ?>
      class="menuItem"
      ><?php $this->msg('trackbacklink') ?></a><?php
  }
  if($this->data['feeds']) { 
    foreach($this->data['feeds'] as $key => $feed) {
      ?><a id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>" 
          href="<?php echo htmlspecialchars($feed['href']) ?>" rel="alternate" 
          type="application/<?php echo $key ?>+xml" class="feedlink"
          <?php echo $this->skin->tooltipAndAccesskey('feed-'.$key) ?>
          class="menuItem"
          ><?php echo htmlspecialchars($feed['text'])?></a><?php
    }
  }
  if (!empty($this->data['nav_urls']['print']['href'])) { ?>
    <a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href']) ?>"
      rel="alternate" 
      class="menuItem"
      <?php echo $this->skin->tooltipAndAccesskey('t-print') ?>
    ><?php $this->msg('printableversion') ?></a><?php
  }
  if (!empty($this->data['nav_urls']['permalink']['href'])) { ?>
    <a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href']) ?>"
      <?php echo $this->skin->tooltipAndAccesskey('t-permalink') ?>
      class="menuItem"
      ><?php $this->msg('permalink') ?></a><?php
  }
  wfRunHooks( 'MonoBookTemplateToolboxEnd', array( &$this ) );
  wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
  ?>
</div>

<div id="helpMenu" class="menu" onmouseover="menuMouseover(event)">
  <a href="/Help:About" class="menuItem">このサイトについて</a>
</div>

<!--

    <div id="wrapper" class="box">
      <div id="contents">
        <div id="contents_inner">
           <div id="wikibody" class="box"> BODY </div>
           <div class="attach"> ATTACH </div>
         </div>
       </div>
       <div id="menubar_wrapper">
         <div id="menubar" class="menu">
           <div id="menubar_inner" class="box">
             <h3>メニュー</h3>
             <ul>
               <li>A</li>
             </ul>
             <hr />
             <h3>リンク</h3>
             <ul>
               <li>B</li>
             </ul>
             <div>
               <a href="http://www16.atwiki.jp/jpmozwiki/editx/2.html">ここを編集</a>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div id="menubar2" class="menu">
       <div id="menubar_inner2" class="box">
         <h3>更新履歴</h3>
         <div class="plugin_recent">
           <p class="plugin_recent_day">2010-12-30</p>
           <div class="plugin_recent_day_div">
             <ul class="plugin_recent_ul">
               <li><a href="http://www16.atwiki.jp/jpmozwiki/pages/13.html" title="トラブルシューティング (48d)" >トラブルシューティング</a></li>
             </ul>
           </div>
         </div>
       </div>
     </div>
     <div id="footer">
       <div id="footer_inner">
         <hr>
         FOOTER
         <div id="recommend">RECOMMEND</div>
       </div>
     </div>
  </div>
</div>

-->


<div id="main-panel">
  <div id="content-header">
    <a name="top" id="top"></a>
    <a style="background-image: url(<?php $this->text('stylepath' ) ?>/wikijpmoz/foxkeh.png); "
       href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>"
       <?php echo $skin->tooltipAndAccesskey('p-logo') ?>
       id="toplogo"></a>
    <h1>　　　　<?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?></h1>
    <?php if($this->data['sitenotice']) { ?>
      <h2 id="siteNotice"><?php $this->html('sitenotice') ?></h2>
    <?php } ?>
  </div>
  <div id="column-content">
    <div id="bodyContent">
      <div id="bodyContent-inner">
        <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
        <div id="contentSub"><?php $this->html('subtitle') ?></div>
        <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php     $this->html('undelete') ?></div><?php } ?>
        <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
        <?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
        <!-- start content -->
        <?php $this->html('bodytext') ?>
        <?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
        <!-- end content -->
        <?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
        <div class="visualClear"></div>
      </div>
    </div>
    <div id="column-one">
      <div id="column-one-inner">
        <script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>
        <?php
          $sidebar = $this->data['sidebar'];
          foreach ($sidebar as $boxName => $cont) {
            if ( $boxName == 'SEARCH' ) {}
            elseif ( $boxName == 'TOOLBOX' ) {}
            elseif ( $boxName == 'LANGUAGES' ) {}
            else {$this->customBox( $boxName, $cont ); }
          }
        ?>
      </div>
    </div>
    <div class="visualClear"></div>
    <div id="footer"><?php
      if($this->data['poweredbyico']) { ?>
        <div id="f-poweredbyico"><?php $this->html('poweredbyico') ?></div><?php
      }
      if($this->data['copyrightico']) { ?>
        <div id="f-copyrightico"><?php $this->html('copyrightico') ?></div><?php
      }
      ?><ul id="f-list"><?php
        if (( isset($this->data['lastmod']) && $this->data['lastmod']) ||
            ( isset($this->data['viewcount']) && $this->data['viewcount'])) {
          ?><li id="viewcount"><?php
          if ( isset($this->data['lastmod']) && $this->data['lastmod']) {
            ?><?php $this->html('lastmod') ?><?php
          }
          if ( isset($this->data['viewcount']) && $this->data['viewcount']) {
            ?><?php $this->html('viewcount') ?><?php
          }
          ?></li><?php
        }
        if ( isset($this->data['copyright']) && $this->data['copyright']) { ?>
            <li id="copyright"><?php $this->html('copyright') ?></li><?php
        }
        if ( isset($this->data['about']) && $this->data['about']) { ?>
            <li id="about"><?php $this->html('about') ?></li><?php
        }
      ?></ul>
    </div>
  </div>
  </div>

<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
<?php $this->html('reporttime') ?>
<!-- Debug output:
<?php  if ( $this->data['debug'] ): $this->text( 'debug' ); endif;  ?>
-->
</body></html>


<?php
  wfRestoreWarnings();

  } // end of execute() method



  /*************************************************************************************************/
  function customBox( $bar, $cont ) {
?>
  <div class='generated-sidebar portlet' id='<?php echo Sanitizer::escapeId( "p-$bar" ) ?>'<?php echo $this->skin->tooltip('p-'.$bar) ?>>
    <h5><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h5>
    <div class='pBody'>
<?php   if ( is_array( $cont ) ) { ?>
      <ul>
<?php       foreach($cont as $key => $val) { ?>
        <li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
          if ( $val['active'] ) { ?> class="active" <?php }
        ?>><a href="<?php echo htmlspecialchars($val['href']) ?>"<?php echo $this->skin->tooltipAndAccesskey($val['id']) ?>><?php echo htmlspecialchars($val['text']) ?></a></li>
<?php      } ?>
      </ul>
<?php   } else {
      # allow raw HTML block to be defined by extensions
      print $cont;
    }
?>
    </div>
  </div>
<?php
  }

} // end of class


