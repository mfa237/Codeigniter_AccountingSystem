$(function () {

        $.skylo({'flat':true});

    $('#demoskylo').on('click',function(){
        $.skylo('start');

        setTimeout(function(){
            $.skylo('set',50);
        },1000);

        setTimeout(function(){
            $.skylo('end');
        },1500);
    });
    
    $('#setskylo').on('click',function(){
        $.skylo('show',function(){
            $.skylo('set',50);
        });
    });
    
    $('#getskylo').on('click',function(){
        alert($.skylo('get')+'%');
    });
    
    $('#inchskylo').on('click',function(){
        $.skylo('show',function(){
            $.skylo('inch',10);
        });
    });

});