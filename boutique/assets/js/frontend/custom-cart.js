/* global wc_cart_params */
jQuery(function ($) {

  // wc_cart_params is required to continue, ensure the object exists
  if (typeof wc_cart_params === 'undefined') {
    return false;
  }

  // Utility functions for the file.

  /**
   * Gets a url for a given AJAX endpoint.
   *
   * @param {String} endpoint The AJAX Endpoint
   * @return {String} The URL to use for the request
   */
  var get_url = function (endpoint) {
    return wc_cart_params.wc_ajax_url.toString().replace(
      '%%endpoint%%',
      endpoint
    );
  };


  /**
   * Object to handle cart UI.
   */
  var cart = {
    /**
     * Initialize cart UI events.
     */
    init: function () {

      console.log("Initialized custom cart");

      this.test_alert = this.test_alert.bind(this);


      $(document).on(
        'click',
        '.product-subtotal',
        this.test_alert);

    },

    /**
     * After an input is changed, enable the update cart button.
     */
    test_alert: function () {
      alert("Cart extension is working");
    }

  };

  cart.init();
});
