var timeout = 0;

;(function($) {
    $.preloadImages = function(images, func) {
        var i = 0;
        var cache = [];
        var loaded = 0;
        var num = images.length;
        
        for ( ; i < num; i++ ) (function(i) {
            var new_image = $('<img/>').attr('src', images[i]).load(function(){
                loaded++;
                
                if(loaded == num)
                {                                                
                    func();                   
                }
            });						
            cache.push(new_image);
        })(i);
        
        return true;
    };
    
    $.fn.imgSlider = function(cont, images, orientation, type) {
        if (!$(this).length) {
            return this;
        }
        
        if(type=='resize')
        {        
            $(cont).css('background', 'url('+images[0]+') no-repeat');
        }
        else
        {
            $('<img/>').attr('class', 'to_change').attr('src', images[0]).css({'position':'absolute', 'top':0, 'left':0, 'z-index':5}).appendTo(cont);
        }
        
        var nav = '#'+$(this).attr('id');
        
        var parent = this;                                    
        var width = $(cont).width();
        var height = $(cont).height();
        var changeBack = 5000;
        var num = images.length;        
        
        $(nav).find('li > a').each(function(i){
            var ind = i;
            
            $(this).hover(function(){
                clearTimeout(timeout);
                changeTo(ind);                
            }, function(){
                timeout = setTimeout(function(){                    
                    changeTo(0);
                }, changeBack);                                            
            });
        });
        
        function changeTo(to)
        {
            var img = null;
            
            var css = {'width':width};
            if(orientation == 'left')
            {
                css.left = 0;
                css.right = 'auto';
            }
            else
            {
                css.left = 'auto';
                css.right = 0;
            }
            var cssTo;
            var cssFrom;
            
            if(type=='resize')
            {
                cssTo = {'opacity':0.3, 'height':height,'width':100};
                cssFrom = {'opacity': 1, 'height':height,'width':width};
            }
            else
            {
                cssTo = {'opacity':0.8};
                cssFrom = {'opacity':1};
            }
            
            var image = $(cont).find('.to_change');
            
            if(image.attr('src')!==images[to])
            {
                if(image.length==0)
                {
                    image = $('<img/>').attr('class', 'to_change').css({'position':'absolute', 'top':0, 'left':0, 'z-index':5}).appendTo(cont);
                }
                
                image.stop().css(css).animate(cssTo, 100, function(){                                                
                    try{$(this).attr('src', images[to]).animate(cssFrom, 100);}
                    catch(e){alert(e.message);}
                });
            }           
        }
        
        return true;
    };
})(jQuery);