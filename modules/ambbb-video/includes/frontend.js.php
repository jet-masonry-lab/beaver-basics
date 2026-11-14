<?php
// receives:
// - $module
// - $id
// - $settings

// Builder only: restart this video's player after Beaver Builder re-renders the module (partial refresh).
// Without this, the new <video> is never set up and stays a bare 300x150 .video-js box.
// On the published page this outputs nothing: video.js auto-setup starts every player once at page load.
if ( ! FLBuilderModel::is_builder_active() ) {
  return;
}
?>
( function() {
  var id = <?= wp_json_encode( 'ambbb-video--' . $id ); ?>;
  var el = document.getElementById( id );

  // no valid sources, video.js not loaded, or the player is already running
  if ( ! el || ! window.videojs || el.player ) {
    return;
  }

  // the player from before the re-render is still registered under this id; videojs( id ) would return it
  var old_player = videojs.getPlayer( id );
  if ( old_player ) {
    old_player.dispose();
  }

  // same call video.js auto-setup makes; reads the data-setup options from the element
  videojs( el );
} )();
