(function ($) {
  // Sample behavior
  Drupal.behaviors.larrylipshultz_theme_default_behavior = {
    attach: function(context, settings) {
      $('.region-postscript-second a.expand', context).click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('.region-postscript-second .webform-component--message', context).slideToggle();
      });
    }
  }
})(jQuery);
