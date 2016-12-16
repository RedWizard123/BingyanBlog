var index_onload = function(){
    q("#in3").onclick=function(){
        reqwest({
            url: '../php/Data.php?req=login',
            method: 'post',
            data: {
                username:q("#in1").value,
                sha1_password:hex_sha1(q("#in2").value)
            },
            success: function(resp){
                if(resp.result=="successful"){
                    window.location="../Editor.php";
                }else{
                    alert("登录失败!");
                }
            }
        });
        return(false);
    }
};



function slide_to(n){
    q("div.current").classList.remove("current");
    q("#tab-"+n).classList.add("current");
    q("a.current").classList.remove("current");
    q("#tab-a-"+n).classList.add("current");
}




var admin_onload=function(){
    reqwest({
        url: '../php/Data.php?req=articleList',
        method: 'get',
        success: function(resp){
            if(resp.result=="successful"){
                for(var i=0;i<resp.data.length;i++){
                    var cloneDiv= q("li.articles-list.hidden").cloneNode(true);
                    q("ul.articles-ul").appendChild(cloneDiv);
                    cloneDiv.setAttribute("id","");
                    cloneDiv.classList.remove("hidden");
                    var HTML= cloneDiv.innerHTML;
                    HTML=HTML.replace("{{n}}",i);
                    HTML=HTML.replace("{{id}}",resp.data[i].id);
                    HTML=HTML.replace("{{id}}",resp.data[i].id);
                    HTML=HTML.replace("{{id}}",resp.data[i].id);
                    HTML=HTML.replace("{{title}}",resp.data[i].title);
                    HTML=HTML.replace("{{desp}}",resp.data[i].desp);


                    cloneDiv.innerHTML=HTML;
                }
            }else{
                alert("登录失败!");
            }
        }
    });
    return(false);



};


function delete_article(id){
    reqwest({
        url: '../php/Data.php?req=deleteArticle',
        method: 'post',
        data: {
            id:id
        },
        success: function(resp){
            if(resp.result=="successful"){
                if(confirm("确定要删除这篇文章吗？")){
                    if(confirm("真的没点错吗？")){
                        if(confirm("再问一遍要删除吗？")){
                            alert("删除成功！");
                        }
                    }
                }
                window.location="admin.php";
            }else{
                alert("删除失败!");
            }
        }
    });
}

function upload_avatar(){
    var oData = new FormData(document.forms.namedItem("uploadForm"));
    var oReq = new XMLHttpRequest();
    oReq.open( "POST", "../php/Data.php?req=putBlogerAvatar" , true );
    oReq.onload = function() {
        if (oReq.status == 200){
            var json=eval("("+oReq.responseText+");");
            if(json.result=="successful"){
                alert("上传成功！");
                window.location="admin.php";

            }else{
                alert("上传失败,文件不符合要求！");
            }
        }else{
            alert("上传失败！");
        }
    };
    oReq.send(oData);
}