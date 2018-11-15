/**
 * @file
 * Placeholder file for custom sub-theme behaviors.
 *
 */
(function ($, Drupal) {

  /**
   * Use this behavior as a template for custom Javascript.
   */
  Drupal.behaviors.exampleBehavior = {
    attach: function (context, settings) {
      //alert("I'm alive!");
    }
  };


  jQuery('.calendar-calendar .day a').click(function(e) {
    e.preventDefault();
    //do other stuff when a click happens
});



})(jQuery, Drupal);
