function save(){

var action = document.getElementsByName("action"); //getElementsByName���ص���һ�����飬��Ϊ��ͬԪ�ص�name������ͬ
var container;
for(var i in action)
{
    if (action[i].value=="doPost"){ //��⵽���������⡱����
					
        container=document.getElementById("task_title");
        if (container.value=="")	//����ǰ����Ϊ�գ�˵��δ��д
        {
            alert("����д���������ٷ���");
            return false;
        }
        dealWithTitle(container);
        if (container.value=="")	//���˺�����Ϊ�գ�˵����д��ȫ���ǷǷ�����
        {
            alert("������⺬����Ч���ݣ���������д���ύ��");
            return false;
        }
						
        container=document.getElementById("task_content");
        //Ŀǰ��ʱ���������������Ϊ��
        if (container.value == "") {
            alert("����д�������ݺ󷢱�");
        }						
        dealWithContent(container);
        if (container.value=="")
        {
            alert("��������Ч���ݣ���������д���ύ��");
            return false;
        }
        break;
    }
    else if(action[i].value=="doReply"){ //��⵽������ظ�������
        container=document.getElementById("task_reply");
        if (container.value=="")
        {
            alert("�ظ����ݲ���Ϊ�գ�");
            return false;
        }
        dealWithContent(container);
        if (container.value=="")
        {
            alert("�ظ�������Ч���ݣ���������д���ύ��");
            return false;
        }
        break;					
    }
	document.getElementById("form").submit();
}
//alert(document.getElementById("content_1").value);//�����ã�������ɺ���ע�͵�����ͬ
//alert(document.getElementById("title").value);
document.getElementById("postForm").submit()
return true;
				
}
		
function dealWithContent(obj){	//�������������е��к���ǩ��ע�⣺��ʱ����"<"��">"�ѱ��༭��ת��
    if (!obj) return;
    var str =  obj.value; 
    str=str.replace(/&lt;\/?html.*?&gt;/gi, " ");  //�滻html��ǩ
    str=str.replace(/&lt;\/?head.*?&gt;/gi, " ");  //�滻head��ǩ
    str=str.replace(/&lt;\/?meta.*?&gt;/gi, " ");   //�滻meta��ǩ
    str=str.replace(/&lt;\/?link.*?&gt;/gi, " ");  //�滻link��ǩ
    str=str.replace(/&lt;\/?body.*?&gt;/gi, " ");   //�滻body��ǩ
    str=str.replace(/&lt;\/?form.*?&gt;/gi, " ");  //�滻form��ǩ
    str=str.replace(/&lt;(applet.*?)&gt;(.*?)&lt;(\/applet.*?)&gt;/gi, " ");  //�滻applet��ǩ
    str=str.replace(/&lt;(\/?applet.*?)&gt;/gi," "); //����applet��ǩ
    str=str.replace(/&lt;(style.*?)&gt;(.*?)&lt;(\/style.*?)&gt;/gi, " "); //����style��ǩ
    str=str.replace(/&lt;(\/?style.*?)&gt;/gi," "); //����style��ǩ
    str=str.replace(/&lt;(title.*?)&gt;(.*?)&lt;(\/title.*?)&gt;/gi," "); //����title��ǩ
    str=str.replace(/&lt;(\/?title.*?)&gt;/gi," "); //����title��ǩ
    str=str.replace(/&lt;(object.*?)&gt;(.*?)&lt;(\/object.*?)&gt;/gi," "); //����object��ǩ
    str=str.replace(/&lt;(\/?object.*?)&gt;/gi," "); //����object��ǩ
    str=str.replace(/&lt;(noframes.*?)&gt;(.*?)&lt;(\/noframes.*?)&gt;/gi," "); //����noframes��ǩ
    str=str.replace(/&lt;(\/?noframes.*?)&gt;/gi," "); //����noframes��ǩ
    str=str.replace(/&lt;(i?frame.*?)&gt;(.*?)&lt;(\/?frame.*?)&gt;/gi," "); //����frame��ǩ
    str=str.replace(/&lt;(\/?i?frame.*?)&gt;/gi," "); //����frame��ǩ
    str=str.replace(/&lt;(script.*?)&gt;(.*?)&lt;(\/script.*?)&gt;/gi," "); //����script��ǩ
    str=str.replace(/&lt;(\/?script.*?)&gt;/gi," "); //����script��ǩ
    str=str.replace(/&lt;(iframe.*?)&gt;(.*?)&lt;(\/iframe.*?)&gt;/gi," "); //����iframe��ǩ
    str=str.replace(/&lt;(\/?iframe.*?)&gt;/gi," "); //����iframe��ǩ
                
    str=str.replace(/(\s*$)/g,"");	//���˽�β����Ŀհ��ַ�
                
    obj.value = str;
}
		
function dealWithTitle(obj){	//�������������е��к���ǩ
    if (!obj) return;
    var str =  obj.value; 
    str=str.replace(/<\/?html.*?>/gi, " ");  //�滻html��ǩ
    str=str.replace(/<\/?head.*?>/gi, " ");  //�滻head��ǩ
    str=str.replace(/<\/?meta.*?>/gi, " ");   //�滻meta��ǩ
    str=str.replace(/<\/?link.*?>/gi, " ");  //�滻link��ǩ
    str=str.replace(/<\/?body.*?>/gi, " ");   //�滻body��ǩ
    str=str.replace(/<\/?form.*?>/gi, " ");  //�滻form��ǩ
    str=str.replace(/<(applet.*?)>(.*?)<(\/applet.*?)>/gi, " ");  //�滻applet��ǩ
    str=str.replace(/<(\/?applet.*?)>/gi," "); //����applet��ǩ
    str=str.replace(/<(style.*?)>(.*?)<(\/style.*?)>/gi, " "); //����style��ǩ
    str=str.replace(/<(\/?style.*?)>/gi," "); //����style��ǩ
    str=str.replace(/<(title.*?)>(.*?)<(\/title.*?)>/gi," "); //����title��ǩ
    str=str.replace(/<(\/?title.*?)>/gi," "); //����title��ǩ
    str=str.replace(/<(object.*?)>(.*?)<(\/object.*?)>/gi," "); //����object��ǩ
    str=str.replace(/<(\/?object.*?)>/gi," "); //����object��ǩ
    str=str.replace(/<(noframes.*?)>(.*?)<(\/noframes.*?)>/gi," "); //����noframes��ǩ
    str=str.replace(/<(\/?noframes.*?)>/gi," "); //����noframes��ǩ
    str=str.replace(/<(i?frame.*?)>(.*?)<(\/?frame.*?)>/gi," "); //����frame��ǩ
    str=str.replace(/<(\/?i?frame.*?)>/gi," "); //����frame��ǩ
    str=str.replace(/<(script.*?)>(.*?)<(\/script.*?)>/gi," "); //����script��ǩ
    str=str.replace(/<(\/?script.*?)>/gi," "); //����script��ǩ
    str=str.replace(/&lt;(iframe.*?)&gt;(.*?)&lt;(\/iframe.*?)&gt;/gi," "); //����iframe��ǩ
    str=str.replace(/&lt;(\/?iframe.*?)&gt;/gi," "); //����iframe��ǩ
                     
    //��ǿ�������ӱ���					 
    str=str.replace(/<(div.*)>(.*?)<(\/div.*)>/gi," "); //�滻div��ǩ
    str=str.replace(/<(\/?div.*)>/gi," "); //����div��ǩ
    str=str.replace(/<(span.*?)>(.*?)<(\/span.*?)>/gi," "); //�滻span��ǩ
    str=str.replace(/<(\/?span.*?)>/gi," "); //����span��ǩ
    str=str.replace(/<(a.*?)>(.*?)<(\/a.*?)>/gi," "); //�滻a��ǩ
    str=str.replace(/<(\/?a.*?)>/gi," "); //����a��ǩ
    str=str.replace(/<(font.*?)>(.*?)<(\/font.*?)>/gi," "); //�滻font��ǩ
    str=str.replace(/<(\/?font.*?)>/gi," "); //����font��ǩ
    str=str.replace(/<(font.*?)>(.*?)<(\/font.*?)>/gi," "); //�滻font��ǩ
    str=str.replace(/<(\/?font.*?)>/gi," "); //����font��ǩ
    str=str.replace(/<(table.*?)>(.*?)<(\/table.*?)>/gi," "); //�滻table��ǩ
    str=str.replace(/<(\/?table.*?)>/gi," "); //����table��ǩ
    str=str.replace(/<(tr.*?)>(.*?)<(\/tr.*?)>/gi," "); //�滻tr��ǩ
    str=str.replace(/<(\/?tr.*?)>/gi," "); //����tr��ǩ
    str=str.replace(/<(td.*?)>(.*?)<(\/td.*?)>/gi," "); //�滻td��ǩ
    str=str.replace(/<(\/?td.*?)>/gi," "); //����td��ǩ
    str=str.replace(/<(ul.*?)>(.*?)<(\/ul.*?)>/gi," "); //�滻ul��ǩ
    str=str.replace(/<(\/?ul.*?)>/gi," "); //����ul��ǩ
    str=str.replace(/<(li.*?)>(.*?)<(\/li.*?)>/gi," "); //�滻li��ǩ
    str=str.replace(/<(\/?li.*?)>/gi," "); //����li��ǩ
    str=str.replace(/<(img.*?)\/>/gi," "); //�滻img��ǩ
    //TODO:��Ӹ�����ܵ��±�����ʽ���ƻ��ı�ǩ
                
    str=str.replace(/(^\s*)|(\s*$)/g, "");	//���˿�ͷ���β����Ŀհ��ַ�
                
    obj.value = str;
}