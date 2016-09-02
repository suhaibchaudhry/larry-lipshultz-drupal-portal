<?php
function larrylipshultz_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb['breadcrumb'])) {
    if ($breadcrumb['breadcrumb'][0] == l(t('Home'), '<front>')){  		  // For blog nodes... 
      unset($breadcrumb['breadcrumb'][1]);                      // ...remove "user's blog"...                             
     // unset($breadcrumb['breadcrumb'][1]);                      // ...and "blogs".
      
    }
    // Now call the original theme with this modified breadcrumb array, to get formatting.
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb['breadcrumb']) .'</div>';
  }
}


function larrylipshultz_menu_link(array $variables) {
  $element = $variables['element'];

  $sub_menu = '';
  $element['#localized_options']['html'] = TRUE;

  /* Even/odd class on menu items */
  static $count = 0;
  $zebra = ($count % 2) ? 'even' : 'odd';
  $count++;
  $element['#attributes']['class'][] = $zebra;

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  /**
   * Add menu item's description below the menu title
   * Source: fusiondrupalthemes.com/forum/using-fusion/descriptions-under-main-menu
   */
  if ($element['#original_link']['menu_name'] == "main-menu" && isset($element['#localized_options']['attributes']['title'])){
    $element['#title'] .= '<span>' . $element['#localized_options']['attributes']['title'] . '</span>';
  }

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function larrylipshultz_preprocess_node(&$variables) {
  $user = user_load($variables['uid']);
  $variables['submitted'] = t('!date — by !author', array('!author' => $user->field_full_name['und'][0]['value'], '!date' => date("M j, Y", $variables['created'])));
}
