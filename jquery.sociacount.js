/**
	jQuery Sociacount 0.0.1
	http://zourbuth.com/plugins/sociacount
	Description: Display the media count for facebook, twitter and much more.
	License: GPL
   
    Copyright 2013  zourbuth.com  (email : zourbuth@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**/

(function ($) {
    $.fn.sociacount = function (options) {

        var defaults = {
            facebook: '',
            twitter: '',
            youtube: '',
            dribbble: '',
            forrst: '',
            github: '',
            vimeo: '',
            ajaxurl: 'sociacount.php'
        }, url, selector, social, url, data;

        options  = $.extend(defaults, options);		
		ajaxurl = options.ajaxurl;
        selector  = this;
		
		social = {};
		url = {};
		if (options.facebook) { social['facebook'] = options.facebook; url['facebook'] = 'http://www.facebook.com/'+options.facebook; }
		if (options.twitter)  { social['twitter'] = options.twitter; url['twitter'] = 'http://twitter.com/'+options.twitter; }
		if (options.youtube)  { social['youtube'] = options.youtube; url['youtube'] = 'http://www.youtube.com/user/'+options.youtube; }
		if (options.dribbble) { social['dribbble'] = options.dribbble; url['dribbble'] = 'http://dribbble.com/'+options.dribbble; }
		if (options.forrst)   { social['forrst'] = options.forrst; url['forrst'] = 'http://forrst.com/people/'+options.forrst; }
		if (options.github)   { social['github'] = options.github; url['github'] = 'http://github.com/'+options.github; }
		if (options.vimeo)    { social['vimeo'] = options.vimeo; url['vimeo'] = 'http://vimeo.com/'+options.vimeo; }
				
		$(selector).append('<span class="loadingsc">Loading...</span>');
		
        return this.each( function() {
			$.each(social, function(key, value) {				
				data = {};
				data[key] = value;
				$.post( ajaxurl, data, function(count) {
					if( count )
						$('<a title="'+key+'" href="'+url[key]+'"><span class="'+key+'">'+key+'</span>'+count+'</a>').appendTo(selector).hide().fadeIn();
					
				});
			});
			
			$(this).ajaxStop(function() { 
				$(this).find('.loadingsc').fadeTo("slow", 0.00, function(){
					$(this).animate({width: 0}, function() {
						$(this).remove();
					 });
				 });
			});			
        });
    };
})(jQuery);