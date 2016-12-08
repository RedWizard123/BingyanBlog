




var index_onload = function(){
    q("#in3").onclick=function(){
        reqwest({
            url: '../php/putData.php?req=login',
            method: 'post',
            data: {
                username:q("#in1").value,
                sha1_password:hex_sha1(q("#in2").value)
            },
            success: function(resp){
                if(resp.result=="success"){
                    window.location="../Editor.php";
                }else{
                    alert("登录失败!");
                }
            }
        });
        return(false);
    }
};