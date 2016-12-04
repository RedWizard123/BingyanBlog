window.onload=function(){
    var editor = document.getElementById('Editor');
    MarkdownIME.Enhance(editor);
    var math = new MarkdownIME.Addon.MathAddon();
    MarkdownIME.Renderer.inlineRenderer.addRule(math);











    q("#font-color-change").onclick=function(){
        var selection=window.getSelection();
        var node= selection.focusNode;
        var s,e;
        var color=q("#color-select").value;

        var HTML=node.parentNode.innerHTML;
        if(selection.anchorOffset != selection.focusOffset){
            if(selection.anchorOffset>selection.focusOffset){
                s=selection.focusOffset;
                e=selection.anchorOffset;
            }else{
                e=selection.focusOffset;
                s=selection.anchorOffset;
            }
            var selectionText=node.nodeValue.substring(s,e);

            if(node.parentNode.nodeName=="P"||node.parentNode.nodeName=="H1"||node.parentNode.nodeName=="FONT"){
                //First to be set color;
                HTML=HTML.replace(selectionText,"<font color=\""+color+"\">" + selectionText + "</font>");
                node.parentNode.innerHTML=HTML;
            }else if(node.parentNode.nodeName=="FONT" && HTML==selectionText){
                //已被更改且全部选择
                HTML=node.parentNode.parentNode.innerHTML;
                HTML=HTML.replace(/color=".*?"/,"color=\""+ color+"\"");
                node.parentNode.innerHTML=HTML;
            }
        }









    };









};