import Waypoint from 'waypoint'; // included by Beaver Builder

// elements we'll be listening on or manipulating
var video_els = document.querySelectorAll( '.ambbb-video--play-on-scroll' );

video_els.forEach( video_el => {

  var video_player = videojs( video_el.dataset.video_id );

  video_player.ready( function() {

    // … scrolling down, video fully enters view —> play
    var video_enters_bottom = new Waypoint( {
      element: video_el,
      handler: function( direction ) {
        if (
          'down' === direction
          && video_player.paused()
        ) {
          video_player.play();
        }
      },
      offset: 'bottom-in-view'
    } );

    // … scrolling down, video fully leaves view —> pause and rewind
    var video_exits_top = new Waypoint( {
      element: video_el,
      handler: function( direction ) {
        if (
          'down' === direction
          && !video_player.paused()
        ) {
          video_player.pause();
          video_player.currentTime( 0 );
        }
      },
      offset: function() {
        return -1 * video_player.currentHeight()
      }
    } );

    // … scrolling up, video fully enters view —> play
    var video_enters_top = new Waypoint( {
      element: video_el,
      handler: function( direction ) {
        if (
          'up' === direction
          && video_player.paused()
        ) {
          video_player.play();
        }
      },
      offset: 0
    } );

    // … scrolling up, video fully leaves view —> pause and rewind
    var video_exits_bottom = new Waypoint( {
      element: video_el,
      handler: function( direction ) {
        if (
          'up' === direction
          && !video_player.paused()
        ) {
          video_player.pause();
          video_player.currentTime( 0 );
        }
      },
      offset: '100%'
    } );

  } );

} );
