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

## Steps:

- Download Woocommerce plugin into directory **woocommerce**
- Download Woocommerce Storefront theme into directory **storefront**
- Install wp-env running ```npm install -g wp-env```
- Run ```vp-env start```
- Add your customization into **boutique** directory

The boutique theme is the custom theme where your customizations go into.
You need to download the storefront theme and palce it into the storefront dir and the woocommerce plugin to download into the woocommerce directory.

The core attribute links to the Wordpress version you want to use, in this case gets the latest version.


Follow the [wiki](https://github.com/telefonosuci/wpenv_woocommerce_demo/wiki). for a detailed configuration guide.
