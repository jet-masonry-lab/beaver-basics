<?php

// Allow only minimal formatting tags
// For use in short strings such as headings, button text, form labels, etc
function ambbb__allowed_html__inline()
{
  return [
    'a' => [
      'class' => [],
      'href' => [],
      'rel' => [],
      'target' => [],
    ],
    'b' => [ 'class' => [] ],
    'br' => [],
    'del' => [ 'class' => [] ],
    'em' => [ 'class' => [] ],
    'i' => [ 'class' => [] ],
    'ins' => [ 'class' => [] ],
    'mark' => [ 'class' => [] ],
    'span' => [ 'class' => [] ],
    'strong' => [ 'class' => [] ],
    'sub' => [ 'class' => [] ],
    'sup' => [ 'class' => [] ],
    'u' => [ 'class' => [] ],
  ];
}