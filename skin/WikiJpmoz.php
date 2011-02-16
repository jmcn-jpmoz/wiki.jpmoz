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
    $out->addStyle( 'monobook/main.css', 'screen' );
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

</head>


<body<?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('dir') ?> <?php $this->text('pageclass') ?> <?php $this->text('skinnameclass') ?>">

<div class="box" id="headBarWrapper">
  <div class="headBar" id="headbar_inner">
    <a class="headmenuButton" href="javascript:void(0);" onclick="return headmenuButtonClick(event, 'hb_fileMenu');" onmouseover="headmenuButtonMouseover(event, 'hb_fileMenu');">メニュー</a>
    <a class="headmenuButton" href="javascript:void(0);" onclick="return headmenuButtonClick(event, 'hb_editMenu');" onmouseover="headmenuButtonMouseover(event, 'hb_editMenu');">編集</a>
    <a class="headmenuButton" href="javascript:void(0);" onclick="return headmenuButtonClick(event, 'hb_viewMenu');" onmouseover="headmenuButtonMouseover(event, 'hb_viewMenu');">表示</a>
    <a class="headmenuButton" href="javascript:void(0);" onclick="return headmenuButtonClick(event, 'hb_toolsMenu');" onmouseover="headmenuButtonMouseover(event, 'hb_toolsMenu');">ツール</a>
    <a class="headmenuButton" href="javascript:void(0);" onclick="return headmenuButtonClick(event, 'hb_helpMenu');" onmouseover="headmenuButtonMouseover(event, 'hb_helpMenu');">ヘルプ</a>
    <a class="headmenuButton" href="http://atwiki.jp/l/" target="_blank">新規</a>
    <form style="margin: 0pt ! important; padding: 0pt ! important; display: inline ! important; vertical-align: bottom ! important; position: absolute ! important;" method="get" action="http://www16.atwiki.jp/jpmozwiki/">
      <input name="cmd" value="search" type="hidden">
      <input id="s" value="wiki内検索" style="display: inline ! important; width: 90px ! important; font-size: 13px ! important; position: absolute ! important; left: 10px ! important; top: -2px ! important; padding: 1px ! important;" name="keyword" onfocus="formClear(this)" type="text">
      <input value="検索" style="display: inline ! important; width: 40px ! important; font-size: 12px ! important; position: absolute ! important; left: 105px ! important; top: -2px ! important; border: 1px solid rgb(187, 187, 187) ! important; background-color: rgb(232, 232, 232) ! important; padding: 1px 3px ! important;" type="submit">
    </form>
    <div style="position: absolute; top: 4px; right: 2px;"></div>
  </div>

  <div style="position: absolute; top: -1px; right: 0pt; background: none repeat scroll 0% 0% transparent ! important; border: medium none ! important;" class="headBar">
    <a href="http://twitter.com/home?status=jpmozwiki%20%40%20%E3%82%A6%E3%82%A3%E3%82%AD%20-%20%E3%83%88%E3%83%83%E3%83%97%E3%83%9A%E3%83%BC%E3%82%B8%20http://www16.atwiki.jp/jpmozwiki/%20%23atwiki" target="_blank" style="border: medium none;">
      <img title="このwikiについてTwitterでつぶやく" src="jpmozwiki-style_files/tweet.png" style="border: medium none; vertical-align: top;">
    </a>
    <a href="http://www16.atwiki.jp/jpmozwiki/contributor" title="このウィキに参加" class="headmenuButton" rel="nofollow">このウィキに参加</a>
    <a href="http://www16.atwiki.jp/jpmozwiki/login/1.html" title="ログイン" class="headmenuButton" rel="nofollow">ログイン</a>
  </div>
</div>

  <div id="globalWrapper">
    <div id="column-content">
  <div id="content">
    <a name="top" id="top"></a>
    <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
    <h1 id="firstHeading" class="firstHeading"><?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?></h1>
    <div id="bodyContent">
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
    </div>
    <div id="column-one">
  <div id="p-cactions" class="portlet">
    <h5><?php $this->msg('views') ?></h5>
    <div class="pBody">
      <ul>
  <?php    foreach($this->data['content_actions'] as $key => $tab) {
          echo '
         <li id="' . Sanitizer::escapeId( "ca-$key" ) . '"';
          if( $tab['class'] ) {
            echo ' class="'.htmlspecialchars($tab['class']).'"';
          }
          echo'><a href="'.htmlspecialchars($tab['href']).'"';
          # We don't want to give the watch tab an accesskey if the
          # page is being edited, because that conflicts with the
          # accesskey on the watch checkbox.  We also don't want to
          # give the edit tab an accesskey, because that's fairly su-
          # perfluous and conflicts with an accesskey (Ctrl-E) often
          # used for editing in Safari.
           if( in_array( $action, array( 'edit', 'submit' ) )
           && in_array( $key, array( 'edit', 'watch', 'unwatch' ))) {
             echo $skin->tooltip( "ca-$key" );
           } else {
             echo $skin->tooltipAndAccesskey( "ca-$key" );
           }
           echo '>'.htmlspecialchars($tab['text']).'</a></li>';
        } ?>
      </ul>
    </div>
  </div>
  <div class="portlet" id="p-personal">
    <h5><?php $this->msg('personaltools') ?></h5>
    <div class="pBody">
      <ul>
<?php       foreach($this->data['personal_urls'] as $key => $item) { ?>
        <li id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>"<?php
          if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
        echo htmlspecialchars($item['href']) ?>"<?php echo $skin->tooltipAndAccesskey('pt-'.$key) ?><?php
        if(!empty($item['class'])) { ?> class="<?php
        echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
        echo htmlspecialchars($item['text']) ?></a></li>
<?php      } ?>
      </ul>
    </div>
  </div>
  <div class="portlet" id="p-logo">
    <a style="background-image: url(<?php $this->text('logopath') ?>);" <?php
      ?>href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>"<?php
      echo $skin->tooltipAndAccesskey('p-logo') ?>></a>
  </div>
  <script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>
<?php
    $sidebar = $this->data['sidebar'];
    if ( !isset( $sidebar['SEARCH'] ) ) $sidebar['SEARCH'] = true;
    if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
    if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;
    foreach ($sidebar as $boxName => $cont) {
      if ( $boxName == 'SEARCH' ) {
        $this->searchBox();
      } elseif ( $boxName == 'TOOLBOX' ) {
        $this->toolbox();
      } elseif ( $boxName == 'LANGUAGES' ) {
        $this->languageBox();
      } else {
        $this->customBox( $boxName, $cont );
      }
    }
?>
    </div><!-- end of the left (by default at least) column -->
      <div class="visualClear"></div>
      <div id="footer">
<?php
    if($this->data['poweredbyico']) { ?>
        <div id="f-poweredbyico"><?php $this->html('poweredbyico') ?></div>
<?php   }
    if($this->data['copyrightico']) { ?>
        <div id="f-copyrightico"><?php $this->html('copyrightico') ?></div>
<?php  }

    // Generate additional footer links
    $footerlinks = array(
      'lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright',
      'privacy', 'about', 'disclaimer', 'tagline',
    );
    $validFooterLinks = array();
    foreach( $footerlinks as $aLink ) {
      if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
        $validFooterLinks[] = $aLink;
      }
    }
    if ( count( $validFooterLinks ) > 0 ) {
?>      <ul id="f-list">
<?php
      foreach( $validFooterLinks as $aLink ) {
        if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
?>          <li id="<?php echo$aLink?>"><?php $this->html($aLink) ?></li>
<?php       }
      }
?>
      </ul>
<?php  }
?>
    </div>
</div>
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>

-->
<?php endif; ?>
</body></html>
<?php
  wfRestoreWarnings();
  } // end of execute() method

  /*************************************************************************************************/
  function searchBox() {
    global $wgUseTwoButtonsSearchForm;
?>
  <div id="p-search" class="portlet">
    <h5><label for="searchInput"><?php $this->msg('search') ?></label></h5>
    <div id="searchBody" class="pBody">
      <form action="<?php $this->text('wgScript') ?>" id="searchform"><div>
        <input type='hidden' name="title" value="<?php $this->text('searchtitle') ?>"/>
        <input id="searchInput" name="search" type="text"<?php echo $this->skin->tooltipAndAccesskey('search');
          if( isset( $this->data['search'] ) ) {
            ?> value="<?php $this->text('search') ?>"<?php } ?> />
        <input type='submit' name="go" class="searchButton" id="searchGoButton"  value="<?php $this->msg('searcharticle') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-go' ); ?> /><?php if ($wgUseTwoButtonsSearchForm) { ?>&nbsp;
        <input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-fulltext' ); ?> /><?php } else { ?>

        <div><a href="<?php $this->text('searchaction') ?>" rel="search"><?php $this->msg('powersearch-legend') ?></a></div><?php } ?>

      </div></form>
    </div>
  </div>
<?php
  }

  /*************************************************************************************************/
  function toolbox() {
?>
  <div class="portlet" id="p-tb">
    <h5><?php $this->msg('toolbox') ?></h5>
    <div class="pBody">
      <ul>
<?php
    if($this->data['notspecialpage']) { ?>
        <li id="t-whatlinkshere"><a href="<?php
        echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
        ?>"<?php echo $this->skin->tooltipAndAccesskey('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
<?php
      if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
        <li id="t-recentchangeslinked"><a href="<?php
        echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
        ?>"<?php echo $this->skin->tooltipAndAccesskey('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked') ?></a></li>
<?php     }
    }
    if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
      <li id="t-trackbacklink"><a href="<?php
        echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
        ?>"<?php echo $this->skin->tooltipAndAccesskey('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li>
<?php   }
    if($this->data['feeds']) { ?>
      <li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
          ?><a id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>" href="<?php
          echo htmlspecialchars($feed['href']) ?>" rel="alternate" type="application/<?php echo $key ?>+xml" class="feedlink"<?php echo $this->skin->tooltipAndAccesskey('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;
          <?php } ?></li><?php
    }

    foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

      if($this->data['nav_urls'][$special]) {
        ?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
        ?>"<?php echo $this->skin->tooltipAndAccesskey('t-'.$special) ?>><?php $this->msg($special) ?></a></li>
<?php    }
    }

    if(!empty($this->data['nav_urls']['print']['href'])) { ?>
        <li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
        ?>" rel="alternate"<?php echo $this->skin->tooltipAndAccesskey('t-print') ?>><?php $this->msg('printableversion') ?></a></li><?php
    }

    if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
        <li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
        ?>"<?php echo $this->skin->tooltipAndAccesskey('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php
    } elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
        <li id="t-ispermalink"<?php echo $this->skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li><?php
    }

    wfRunHooks( 'MonoBookTemplateToolboxEnd', array( &$this ) );
    wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
?>
      </ul>
    </div>
  </div>
<?php
  }

  /*************************************************************************************************/
  function languageBox() {
    if( $this->data['language_urls'] ) {
?>
  <div id="p-lang" class="portlet">
    <h5><?php $this->msg('otherlanguages') ?></h5>
    <div class="pBody">
      <ul>
<?php    foreach($this->data['language_urls'] as $langlink) { ?>
        <li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
        ?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
<?php    } ?>
      </ul>
    </div>
  </div>
<?php
    }
  }

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


