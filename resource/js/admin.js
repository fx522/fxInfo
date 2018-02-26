layui.use('element', function(){
    
});

var toLogin = function(tgtUrl){
    layer.open({
        type: 2,
        title: '朕要登录后台瞅瞅~',
        closeBtn:0,
        content: tgtUrl,
        area: ['390px', '230px'],
        end:function(){
            
        }
    });
}