var editor;
var imgURL="";
var pic_num=0;
var imgNode;
window.onload=function(){
    editor= new Simditor({
        textarea: $('#editor'),
        upload: false,
        toolbar:[
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',
            'ul',
            'blockquote',
            'code',
            'table',
            'link',
            'image',
            'hr',
            'indent',
            'outdent',
            'alignment'
        ]
    });
    if(id!=-1){
        reqwest({
            url: 'php/Data.php?req=getValue&id='+id,
            method: 'get',
            success: function(resp){
                if(resp.result=="successful"){
                    editor.setValue(resp.data.value);
                    imgURL=resp.data.pic;
                    q("div.Editor-title>h1").innerHTML="编辑博文";
                    q("div.title-input>input").value=resp.data.title;
                    q("div.title-input>textarea").value=resp.data.desp;
                    q("div.img-upload>img").src="upload/"+imgURL;
                }else{
                    alert("读取文章内容失败！");
                    id=-1;
                }
            }
        });
    }
    q("#save-change").onclick=function(){
        uploadAll_();
    };
    q("#commit-article").onclick=function(){
        uploadAll();
    };
    q("input.file-select:last-child").onclick=function(){
        var oData = new FormData(document.forms.namedItem("uploadForm"));
        var oReq = new XMLHttpRequest();
        oReq.open( "POST", "php/Data.php?req=uploadAvatar" , true );
        oReq.onload = function() {
            if (oReq.status == 200){
                var json=eval("("+oReq.responseText+");");
                if(json.result=="successful"){
                    alert("上传成功！");
                    imgURL=json.URL;
                    q("div.img-upload>img").src="upload/"+imgURL;
                }else{
                    alert("上传失败,文件不符合要求！");
                }
            }else{
                alert("上传失败！");
            }
        };
        oReq.send(oData);

    }
};
function uploadBody(){
        if(id==-1) {
            reqwest({
                url: 'php/Data.php?req=addArticle',
                method: 'post',
                data: {
                    writer: "Faraway",
                    value: editor.getValue(),
                    title: q("div.title-input>input").value,
                    desp: q("div.title-input>textarea").value,
                    pic:imgURL
                },
                success: function (resp) {
                    if (resp.result == "successful") {
                        window.location = "article.php";
                    } else {
                        alert("提交失败！");
                    }
                }
            });
        }else{
            reqwest({
                url: 'php/Data.php?req=updateArticle',
                method: 'post',
                data: {
                    id:id,
                    value:editor.getValue(),
                    title: q("div.title-input>input").value,
                    desp: q("div.title-input>textarea").value,
                    pic:imgURL
                },
                success: function(resp){
                    if(resp.result=="successful"){
                        window.location="article.php";
                    }else{
                        alert("保存失败！");
                    }
                }
            });
        }
}
function uploadBody_(){
    if(id!=-1){
        reqwest({
            url: 'php/Data.php?req=updateArticle',
            method: 'post',
            data: {
                id:id,
                value:editor.getValue(),
                title: q("div.title-input>input").value,
                desp: q("div.title-input>textarea").value,
                pic:imgURL
            },
            success: function(resp){
                if(resp.result=="successful"){
                    alert("保存成功！");
                    //window.location="Editor.php?id="+id;
                    //window.onload();
                }else{
                    alert("保存失败！");
                }
            }
        });
    }else{
        reqwest({
            url: 'php/Data.php?req=addArticle',
            method: 'post',
            data: {
                writer: "Faraway",
                value: editor.getValue(),
                title: q("div.title-input>input").value,
                desp: q("div.title-input>textarea").value,
                pic:imgURL
            },
            success: function (resp) {
                if (resp.result == "successful") {
                    alert("保存成功！");
                    //window.onload();
                } else {
                    alert("提交失败！");
                }
            }
        });
    }
}
function uploadAll(){
    imgNode=document.querySelectorAll("div.simditor-body img");
    for(var i=0;i<imgNode.length;i++){
        if(imgNode[i].src.indexOf("base64")==-1){
            pic_num++;
            uploadBody();
        }else{
        reqwest({url: 'php/Data.php?req=uploadBase64',
            method: 'post',
            data: {
                "i":i,
                "base64":imgNode[i].src
            },
            success: function(resp){
                if(resp.result=="successful"){
                    imgNode[resp.i].src="upload/"+resp.filename;
                    pic_num++;
                    uploadBody();
                }else{
                    alert("保存失败！");
                }
            }
        });
        }
    }
}
function uploadAll_(){
    imgNode=document.querySelectorAll("div.simditor-body img");
    for(var i=0;i<imgNode.length;i++){
        if(imgNode[i].src.indexOf("base64")==-1){
            pic_num++;
            uploadBody_();
        }else{
        reqwest({url: 'php/Data.php?req=uploadBase64',
            method: 'post',
            data: {
                "i":i,
                "base64":imgNode[i].src
            },
            success: function(resp){
                if(resp.result=="successful"){
                    imgNode[resp.i].src="upload/"+resp.filename;
                    pic_num++;
                    console.log(pic_num);
                    if(pic_num==imgNode.length){
                        uploadBody_();
                    }
                }else{
                    alert("保存失败！");
                }
            }
        });
    }
    }

}
