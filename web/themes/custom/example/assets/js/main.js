(function ($, Drupal) {

  Drupal.behaviors.example = {
    attach: function (context) {
      var body = $('body', context).once('time');
      if (body.length === 0) {
        var time = $.formatDateTime('dd/mm/y g:ii a', new Date());
        // alert(time);
      }
    }
  }

})(jQuery, Drupal);
