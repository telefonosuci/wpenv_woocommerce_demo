# Custom Woocommerce theme development environment

## Description:

This repo is tset up to develop a Wordpress custom theme to extend the storefront Woocommerce theme.
The main directory contain a .wp-env.json file tto start a development enviromnet with wp-env.

### .wp-env.json
```
{
  "core": "https://wordpress.org/latest.zip",
  "plugins": [
    "./woocommerce"
  ],
  "themes": [
    "./storefront",
    "./boutique"
  ],
  "port": 9000,
  "testsPort": 9001,
  "config": {
    "WP_DEBUG_DISPLAY": true
  }
}
```

The boutique theme is the custom theme where your customizations go into.
You need to download the storefront theme and palce it into the storefront dir and the woocommerce plugin to download into the woocommerce directory.

The core attribute links to the Wordpress version you want to use, in this case gets the latest version.
