<?php

namespace App\Traits;

/**
 *  Example browser link structure in storage/config/link_nav.json file.
 *
 *  "name" : "Welcome",
 *  "slug" : "welcome",
 *   "type" : "link",
 *   "route" : "welcome",
 *   "active" : "active disabled",
 *   "icono" : "",
 *   "icono_color" : "",
 *   "class" : "link-menu",
 *   "tooltip" : {
 *       "position" : "down",
 *       "class" : "custom-tooltip",
 *       "text" : "Page Welcome"
 *   },
 *   "items" : {
 *          "name" : "Welcome",
 *          "slug" : "welcome",
 *          "type" : "link",
 *          "route" : "welcome",
 *          "active" : "active disabled",
 *          "icono" : "",
 *          "icono_color" : "",
 *          "class" : "link-menu",
 *          "tooltip" : {
 *           "position" : "down",
 *           "class" : "custom-tooltip",
 *           "text" : "Page Welcome",
 *           "items" : {}
 *       }
 *   }
 *
 */



trait LinksNav
{
    public static function Links()  {
        return read_json("link_nav.json", "config");
    }
}
