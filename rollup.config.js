import babel from 'rollup-plugin-babel';
import commonjs from '@rollup/plugin-commonjs';
import livereload from 'rollup-plugin-livereload';
import postcss from 'rollup-plugin-postcss';
import resolve from '@rollup/plugin-node-resolve';
import { terser } from "rollup-plugin-terser";


let get_postcss_config = function()
{
  return {
    extract: true,
    use: {
      sass: {
        outputStyle: ( 'production' === process.env.BUILD ? 'compressed' : 'expanded' ),
      }
    },
  };
}


// css config
let get_css_config = function( input, output )
{
  return {
    input: input,
    output: {
      file: output,
    },
    plugins: [
      postcss( get_postcss_config() )
    ],
    watch: {
      exclude: ['node_modules/**'],
    },
  };
}


// module css config
let get_module_css_config = function( module_name, file_name )
{
  return get_css_config(
    'modules/ambbb-' + module_name + '/src/' + file_name + '.scss',
    'modules/ambbb-' + module_name + '/css/' + file_name + '.css',
  );
}


// js config
let get_js_config = function( input, output )
{
  let js_config = {
    input: input,
    external: [
      'jquery',
      'waypoint'
    ],
    output: {
      file: output,
      format: 'iife',
      globals: {
        jquery: '$',
        waypoint: 'Waypoint',
      },
    },
    plugins: [
      resolve(),
      commonjs(),
      babel({
        exclude: 'node_modules/**' // only transpile our source code
      }),
    ],
    watch: {
      exclude: ['node_modules/**'],
    },
  };
  if ( 'production' === process.env.BUILD ) {
    js_config.plugins.push( terser( {
      output: {
        comments: false,
      },
    } ) );
  }
  if (
    'development' === process.env.BUILD
    && process.env.ROLLUP_WATCH
  ) {
    js_config.plugins.push( livereload() )
  }
  return js_config;
}


// module js config
let get_module_js_config = function( module_name, file_name )
{
  return get_js_config(
    'modules/ambbb-' + module_name + '/src/' + file_name + '.js',
    'modules/ambbb-' + module_name + '/js/' + file_name + '.js',
  );
}


// put it all together
let rollup_config = [

  // CSS Sources
  get_css_config( 'src/scss/settings.layout.scss', 'dist/settings.layout.css' ),
  get_module_css_config( 'callout', 'frontend' ),
  get_module_css_config( 'image', 'frontend' ),
  get_module_css_config( 'image-grid', 'frontend' ),
  get_module_css_config( 'quote', 'frontend' ),
  get_module_css_config( 'separator', 'frontend' ),
  get_module_css_config( 'slider', 'frontend' ),
  get_module_css_config( 'video', 'video-js' ),
  get_module_css_config( 'youtube', 'frontend' ),

  // JS Sources
  get_module_js_config( 'slider', 'frontend' ),
  get_module_js_config( 'video', 'autoplay-scroll' ),
  get_module_js_config( 'video', 'video-js' ),

];


// export configuration
export default rollup_config;
