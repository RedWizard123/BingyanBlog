var editor;
var imgURL="";
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
            url: 'php/getData.php?req=getValue&id='+id,
            method: 'get',
            success: function(resp){
                if(resp.result=="success"){
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
        if(id!=-1){
            reqwest({
                url: 'php/putData.php?req=updateArticle',
                method: 'post',
                data: {
                    id:id,
                    value:editor.getValue(),
                    title: q("div.title-input>input").value,
                    desp: q("div.title-input>textarea").value,
                    pic:imgURL
                },
                success: function(resp){
                    if(resp.result=="success"){
                        alert("保存成功！");
                        //window.location="Editor.php?id="+id;
                        window.onload();
                    }else{
                        alert("保存失败！");
                    }
                }
            });
        }else{
            reqwest({
                url: 'php/putData.php?req=addArticle',
                method: 'post',
                data: {
                    writer: "Faraway",
                    value: editor.getValue(),
                    title: q("div.title-input>input").value,
                    desp: q("div.title-input>textarea").value,
                    pic:imgURL
                },
                success: function (resp) {
                    if (resp.result == "success") {
                        alert("保存成功！");
                        window.onload();
                    } else {
                        alert("提交失败！");
                    }
                }
            });
        }
    };
    q("#commit-article").onclick=function(){
        if(id==-1) {
            reqwest({
                url: 'php/putData.php?req=addArticle',
                method: 'post',
                data: {
                    writer: "Faraway",
                    value: editor.getValue(),
                    title: q("div.title-input>input").value,
                    desp: q("div.title-input>textarea").value,
                    pic:imgURL
                },
                success: function (resp) {
                    if (resp.result == "success") {
                        window.location = "article.php";
                    } else {
                        alert("提交失败！");
                    }
                }
            });
        }else{
            reqwest({
                url: 'php/putData.php?req=updateArticle',
                method: 'post',
                data: {
                    id:id,
                    value:editor.getValue(),
                    title: q("div.title-input>input").value,
                    desp: q("div.title-input>textarea").value,
                    pic:imgURL
                },
                success: function(resp){
                    if(resp.result=="success"){
                        window.location="article.php";
                    }else{
                        alert("保存失败！");
                    }
                }
            });
        }

    };
    q("input.file-select:last-child").onclick=function(){
        var oData = new FormData(document.forms.namedItem("uploadForm"));
        var oReq = new XMLHttpRequest();
        oReq.open( "POST", "php/putData.php?req=uploadAvatar" , true );
        oReq.onload = function() {
            if (oReq.status == 200){
                var json=eval("("+oReq.responseText+");");
                if(json.result=="success"){
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
