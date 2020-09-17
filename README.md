# Magento 2 CMS Alternate Language

This module allows search-engines to read the content of this page with different alternates depending on
the language of the store view.

In a technical way, it's adding a `<link rel="alternate">` with the proper information for each store view that
is enabled in the CMS page  

## Comments

This module was tested with Magento 2.3.3.
  
## How to install

### Via composer

Edit `composer.json`

```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ozzytop/m2-cms-alternate-language"
        }
    ],
}
```

```
composer require ozzytop/m2-cms-alternate-language:dev-master
php bin/magento module:enable Ozzytop_Cms
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

### Or Copy and paste

Download latest version from GitHub

Paste into `app/code/Ozzytop/Cms` directory

```
php bin/magento module:enable Ozzytop_Cms
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## Configuring

In the Admin Dashboard go to `Content -> Pages`

Then Select the page that you want to enable this feature. Inside the edit page, go to `Page in Websites` section and
select those store views that you want to show the alternate link.

### Additional Requirements

It's important to know that some configuration has to be added in order to make this work:
* Base Url -> `Stores -> Configuration`, Select the corresponding Store View, then `General -> Web -> Base URLs -> Base URL`
* Language -> `Stores -> Configuration`, Select the corresponding Store View, then `General -> General -> Locale Options -> Locale`

## How does it work?

The full implementation of CMS Alternate Language is outside the scope of this README, but this is what this module does:

1. Gets the current page Id 
2. Gets all the store's view and check for the base_url and language configuration
3. Builds the `<link rel="alternate">` with the proper information inside the `<header>` tag.

