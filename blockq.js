/*
Plugin Name: BlockQ
Plugin URI: http://box.net/iPublicis4Wordpress
Description: Break long &lt;blockquote&gt;'s into show/hidden sections.
Version: 1.0 
Author: Lopo Lencastre de Almeida <dev@ipublicis.com>
Author URI: http://ipublicis.com/
Donate link: http://smsh.me/7kit

License: GNU GPL v3 or later

    Copyright (C) 2009 iPublicis!COM

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

jQuery(document).ready(function() {

  jQuery(".clickmore").toggleClass("blockq_collapsed");
  jQuery(".blockq").hide();
  jQuery(".clickmore").show();
  
  jQuery(".clickmore").click(function() {
    jQuery(this).siblings().slideToggle("normal");
    jQuery(this).toggleClass("blockq_collapsed");
	jQuery(this).hide();
    return false;
  });

});
