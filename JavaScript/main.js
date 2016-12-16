function q(s){
    return(document.querySelector(s));
}


var _index_onload =function() {
    if(id!=-1){
        reqwest({
            url: 'php/Data.php?req=getValue&id='+id,
            method: 'get',
            success: function(resp){
                if(resp.result=="successful"){
                    if(resp.data.comments==""){
                        q("#comments-n").innerHTML="0";
                    }else{
                        q("#comments-n").innerHTML=resp.data.comments.split(',').length;
                    }
                    if(resp.data.like==""){
                        q("#likes-n").innerHTML="0";
                    }else{
                        q("#likes-n").innerHTML=resp.data.like.split(',').length;
                    }
                    reqwest({
                        url: 'php/Data.php?req=getComments&id='+id,
                        method: 'get',
                        success: function(resp){
                            if(resp.result=="successful"){
                                q("div.insert-to").innerHTML="";
                                for(var i=0;i<resp.data.length;i++){
                                    var cloneDiv= q("div.comments-items").cloneNode(true);
                                    q("div.insert-to").appendChild(cloneDiv);
                                    cloneDiv.classList.remove("hidden");
                                    var HTML= cloneDiv.innerHTML;
                                    HTML=HTML.replace("{{comments-name}}",resp.data[i].writer);
                                    HTML=HTML.replace("{{comments-value}}",resp.data[i].value);
                                    HTML=HTML.replace("{{comments-date}}",resp.data[i].create_date);
                                    cloneDiv.innerHTML=HTML;
                                }
                            }else{
                                alert("读取文章评论失败！");
                            }
                        }
                    });
                }else{
                    alert("读取文章内容失败！");
                    window.location="index.php";
                }
            }
        });
    }
};
function like_plus(){
    if(id!=-1){
        reqwest({
            url: 'php/Data.php?req=likePlus',
            method: 'get',
            data:{
                "id":id
            },
            success: function(resp){
                if(resp.result=="successful"){
                    alert("已赞！");
                    _index_onload();
                }else{
                    if(resp.error=="Already Likes!"){
                        alert("您已赞过！");

                    }
                }
            }
        });
    }
}


function add_comments(){
    if(q("div.input-comments>input").value==""||q("div.input-comments>textarea").value==""){
        alert("请完整填写！");
        return;
    }
    if(id!=-1){
        reqwest({
            url: 'php/Data.php?req=addComment',
            method: 'post',
            data:{
                "id":id,
                "name":q("div.input-comments>input").value,
                "comment":q("div.input-comments>textarea").value
            },
            success: function(resp){
                if(resp.result=="successful"){
                    alert("已提交评论！");
                    q("div.input-comments>input").value="";
                    q("div.input-comments>textarea").value="";
                    _index_onload();
                }else{
                    alert("评论提交失败！"+resp.error);
                }
            }
        });
    }



}
