import smoothscroll from 'smoothscroll-polyfill';

var slider_els = document.querySelectorAll( '.ambbb-slider' ),
    sliders = [];

function initSlider( slider )
{
  var element = slider,
      viewport = slider.querySelector( '.ambbb-slider__viewport' ),
      slides = slider.querySelectorAll( '.ambbb-slider__slide' ),
      active,
      interval,
      pause_ms = 3000;

  function set( i )
  {
    if ( 'undefined' !== typeof active ) {
      slides[active].classList.remove( 'active' );
    }
    active = i;
    slider.dataset.active = i;
    slider.style.setProperty( '--active', i );
    slides[i].classList.add( 'active' );
  }

  function goTo( i )
  {
    if ( i < 0 || i > slides.length ) return;

    var goto_event = new CustomEvent( 'slider:goto', { detail: { i: i, slide: slides[i] } } );
    slider.dispatchEvent( goto_event );
    set( i );
  }

  function shift( direction )
  {
    var next = active + direction;
    if ( next < 0 ) next = slides.length - 1;
    if ( next >= slides.length ) next = 0;
    goTo( next );
  }

  function play()
  {
    var play_event = new CustomEvent( 'slider:play' );
    slider.dispatchEvent( play_event );
    interval = setInterval( function(){
      shift( 1 );
    }, pause_ms );
  }

  function stop()
  {
    if ( 'undefined' === typeof interval ) return;

    var stop_event = new CustomEvent( 'slider:stop' );
    slider.dispatchEvent( stop_event );
    clearInterval( interval );
  }

  function prev()
  {
    shift( -1 );
  }

  function next()
  {
    shift( 1 );
  }

  function init()
  {
    set( 0 );
    play();

    slider.addEventListener( 'click', function( event ) {

      // prev
      if ( event.target.matches( '.ambbb-slider__prev' ) ) {
        stop();
        prev();
      }

      // next
      else if ( event.target.matches( '.ambbb-slider__next' ) ) {
        stop();
        next();
      }

      // goto
      else if ( event.target.matches( '.ambbb-slider__goto' ) ) {
        stop();
        goTo( parseInt( event.target.dataset.goto ) );
      }

      // no match
      else return;

    } );
  }

  init();

  return {
    element: element,
    viewport: viewport,
    set: set,
    goTo: goTo,
    play: play,
    stop: stop,
    prev: prev,
    next: next
  };

}


// Inintialize scrolling
var initScrolling = function( slider )
{
  var js_scroll = false,
      prev_scroll_position = 0;

  slider.element.addEventListener( 'slider:goto', function( e ) {

    // indicate script-based scrolling
    js_scroll = true;
    var scroll_to = e.detail.i * slider.viewport.offsetWidth,
        onScroll = function() {
          if ( scroll_to === slider.viewport.scrollLeft ) {
            slider.viewport.removeEventListener( 'scroll', onScroll );
            // when scroll reaches target position, switch back to user-based
            js_scroll = false;
          }
        };
    slider.viewport.addEventListener( 'scroll', onScroll );
    slider.viewport.scrollTo( { top: 0, left: scroll_to, behavior: 'smooth' } );

  } );

  slider.viewport.addEventListener( 'scroll', function( e ) {

    // script scrolling
    if ( js_scroll ) return;

    // user scrolling
    slider.stop();

    if ( Math.abs( slider.viewport.scrollLeft - prev_scroll_position ) < 5 ) {

      // scrolling has stopped
      prev_scroll_position = 0;
      updateAfterScroll();

    } else {

      // still scrolling
      prev_scroll_position = slider.viewport.scrollLeft;

    }

  } );
}

var updateAfterScroll = function()
{
  // update active element based on scroll position
  var scroll_position = viewport.scrollLeft,
      viewport_width = viewport.offsetWidth,
      i = Math.round( scroll_position / viewport_width );
  set( i );
}


// run polyfill
smoothscroll.polyfill();

// find slider modules
// initialize them... settings should be in data attributes


for ( let i = 0; i < slider_els.length; i++ ) {
  sliders.push( initSlider( slider_els[i] ) );
}

for ( let i = 0; i < sliders.length; i++ ) {
  initScrolling( sliders[i] );
}
