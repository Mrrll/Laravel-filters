<?php

namespace App\Traits;

/**
 *  Example browser link structure in storage/config/link_nav.json file.
 *
 *  "welcome": {
 *  "name": "Welcome",
 *  "slug": "welcome",
 *  "type": "link",
 *  "route": "welcome",
 *  "class": "nav-link",
 *  "icon": {
 *      "type" : "i",
 *      "name" : "fa-solid fa-magnifying-glass fa-2xl"
 *      "color": "#FFD43B"
 * },
 *  "tooltip": {
 *      "position": "down",
 *      "class": "custom-tooltip",
 *      "text": "Page Welcome"
 *  },
 *  "items": {
 *      "welcome : {
 *          "name": "Welcome",
 *          "slug": "welcome",
 *          "type": "link",
 *          "route": "welcome",
 *          "class": "nav-link",
 *          "icon": {
 *              "type" : "i",
 *              "name" : "fa-solid fa-magnifying-glass fa-2xl"
 *              "color": "#FFD43B"
 *          }
 *          "tooltip": {
 *              "position": "down",
 *              "class": "custom-tooltip",
 *              "text": "Page Welcome"
 *          }
 *      }
 *  }
 *
 */



trait LinksNav
{
    public static function Links()  {
        return read_json("link_nav.json", "config");
    }
}
