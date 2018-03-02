function
alterClass(el,className,enable){if(el){el.className=el.className.replace(RegExp('(^|\\s)'+className+'(\\s|$)'),'$2')+(enable?' '+className:'');}}function
toggle(id){var
el=document.getElementById(id);el.className=(el.className=='hidden'?'':'hidden');return true;}function
cookie(assign,days){var
date=new
Date();date.setDate(date.getDate()+days);document.cookie=assign+'; expires='+date;}function
verifyVersion(current){cookie('adminer_version=0',1);var
iframe=document.createElement('iframe');iframe.src='https://www.adminer.org/version/?current='+current;iframe.frameBorder=0;iframe.marginHeight=0;iframe.scrolling='no';iframe.style.width='7ex';iframe.style.height='1.25em';if(window.postMessage&&window.addEventListener){iframe.style.display='none';addEventListener('message',function(event){if(event.origin=='https://www.adminer.org'){var
match=/version=(.+)/.exec(event.data);if(match){cookie('adminer_version='+match[1],1);}}},false);}document.getElementById('version').appendChild(iframe);}function
selectValue(select){if(!select.selectedIndex){return select.value;}var
selected=select.options[select.selectedIndex];return((selected.attributes.value||{}).specified?selected.value:selected.text);}function
isTag(el,tag){var
re=new
RegExp('^('+tag+')$','i');return re.test(el.tagName);}function
parentTag(el,tag){while(el&&!isTag(el,tag)){el=el.parentNode;}return el;}function
trCheck(el){var
tr=parentTag(el,'tr');alterClass(tr,'checked',el.checked);if(el.form&&el.form['all']&&el.form['all'].onclick){el.form['all'].onclick();}}function
selectCount(id,count){setHtml(id,(count===''?'':'('+(count+'').replace(/\B(?=(\d{3})+$)/g,' ')+')'));var
inputs=document.getElementById(id).parentNode.parentNode.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){var
input=inputs[i];if(input.type=='submit'){input.disabled=(count=='0');}}}function
formCheck(el,name){var
elems=el.form.elements;for(var
i=0;i<elems.length;i++){if(name.test(elems[i].name)){elems[i].checked=el.checked;trCheck(elems[i]);}}}function
tableCheck(){var
tables=document.getElementsByTagName('table');for(var
i=0;i<tables.length;i++){if(/(^|\s)checkable(\s|$)/.test(tables[i].className)){var
trs=tables[i].getElementsByTagName('tr');for(var
j=0;j<trs.length;j++){trCheck(trs[j].firstChild.firstChild);}}}}function
formUncheck(id){var
el=document.getElementById(id);el.checked=false;trCheck(el);}function
formChecked(el,name){var
checked=0;var
elems=el.form.elements;for(var
i=0;i<elems.length;i++){if(name.test(elems[i].name)&&elems[i].checked){checked++;}}return checked;}function
tableClick(event,click){click=(click||!window.getSelection||getSelection().isCollapsed);var
el=getTarget(event);while(!isTag(el,'tr')){if(isTag(el,'table|a|input|textarea')){if(el.type!='checkbox'){return;}checkboxClick(event,el);click=false;}el=el.parentNode;if(!el){return;}}el=el.firstChild.firstChild;if(click){el.checked=!el.checked;el.onclick&&el.onclick();}trCheck(el);}var
lastChecked;function
checkboxClick(event,el){if(!el.name){return;}if(event.shiftKey&&(!lastChecked||lastChecked.name==el.name)){var
checked=(lastChecked?lastChecked.checked:true);var
inputs=parentTag(el,'table').getElementsByTagName('input');var
checking=!lastChecked;for(var
i=0;i<inputs.length;i++){var
input=inputs[i];if(input.name===el.name){if(checking){input.checked=checked;trCheck(input);}if(input===el||input===lastChecked){if(checking){break;}checking=true;}}}}else{lastChecked=el;}}function
setHtml(id,html){var
el=document.getElementById(id);if(el){if(html==null){el.parentNode.innerHTML='&nbsp;';}else{el.innerHTML=html;}}}function
nodePosition(el){var
pos=0;while(el=el.previousSibling){pos++;}return pos;}function
pageClick(href,page,event){if(!isNaN(page)&&page){href+=(page!=1?'&page='+(page-1):'');location.href=href;}}function
menuOver(el,event){var
a=getTarget(event);if(isTag(a,'a|span')&&a.offsetLeft+a.offsetWidth>a.parentNode.offsetWidth-15){el.style.overflow='visible';}}function
menuOut(el){el.style.overflow='auto';}function
selectAddRow(field){field.onchange=function(){selectFieldChange(field.form);};field.onchange();var
row=cloneNode(field.parentNode);var
selects=row.getElementsByTagName('select');for(var
i=0;i<selects.length;i++){selects[i].name=selects[i].name.replace(/[a-z]\[\d+/,'$&1');selects[i].selectedIndex=0;}var
inputs=row.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){inputs[i].name=inputs[i].name.replace(/[a-z]\[\d+/,'$&1');inputs[i].className='';if(inputs[i].type=='checkbox'){inputs[i].checked=false;}else{inputs[i].value='';}}field.parentNode.parentNode.appendChild(row);}function
selectSearchKeydown(el,event){if(event.keyCode==13||event.keyCode==10){el.onsearch=function(){};}}function
selectSearchSearch(el){if(!el.value){el.parentNode.firstChild.selectedIndex=0;}}function
columnMouse(el,className){var
spans=el.getElementsByTagName('span');for(var
i=0;i<spans.length;i++){if(/column/.test(spans[i].className)){spans[i].className='column'+(className||'');}}}function
selectSearch(name){var
el=document.getElementById('fieldset-search');el.className='';var
divs=el.getElementsByTagName('div');for(var
i=0;i<divs.length;i++){var
div=divs[i];if(isTag(div.firstChild,'select')&&selectValue(div.firstChild)==name){break;}}if(i==divs.length){div.firstChild.value=name;div.firstChild.onchange();}div.lastChild.focus();}function
isCtrl(event){return(event.ctrlKey||event.metaKey)&&!event.altKey;}function
getTarget(event){return event.target||event.srcElement;}function
bodyKeydown(event,button){var
target=getTarget(event);if(target.jushTextarea){target=target.jushTextarea;}if(isCtrl(event)&&(event.keyCode==13||event.keyCode==10)&&isTag(target,'select|textarea|input')){target.blur();if(button){target.form[button].click();}else{target.form.submit();}target.focus();return false;}return true;}function
bodyClick(event){var
target=getTarget(event);if((isCtrl(event)||event.shiftKey)&&target.type=='submit'&&isTag(target,'input')){target.form.target='_blank';setTimeout(function(){target.form.target='';},0);}}function
editingKeydown(event){if((event.keyCode==40||event.keyCode==38)&&isCtrl(event)){var
target=getTarget(event);var
sibling=(event.keyCode==40?'nextSibling':'previousSibling');var
el=target.parentNode.parentNode[sibling];if(el&&(isTag(el,'tr')||(el=el[sibling]))&&isTag(el,'tr')&&(el=el.childNodes[nodePosition(target.parentNode)])&&(el=el.childNodes[nodePosition(target)])){el.focus();}return false;}if(event.shiftKey&&!bodyKeydown(event,'insert')){eventStop(event);return false;}return true;}function
functionChange(select){var
input=select.form[select.name.replace(/^function/,'fields')];if(selectValue(select)){if(input.origType===undefined){input.origType=input.type;input.origMaxLength=input.getAttribute('data-maxlength');}input.removeAttribute('data-maxlength');input.type='text';}else
if(input.origType){input.type=input.origType;if(input.origMaxLength>=0){input.setAttribute('data-maxlength',input.origMaxLength);}}oninput({target:input});helpClose();}function
keyupChange(){if(this.value!=this.getAttribute('value')){this.onchange();this.setAttribute('value',this.value);}}function
fieldChange(field){var
row=cloneNode(parentTag(field,'tr'));var
inputs=row.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){inputs[i].value='';}parentTag(field,'table').appendChild(row);field.onchange=function(){};}function
ajax(url,callback,data,message){var
request=(window.XMLHttpRequest?new
XMLHttpRequest():(window.ActiveXObject?new
ActiveXObject('Microsoft.XMLHTTP'):false));if(request){var
ajaxStatus=document.getElementById('ajaxstatus');if(message){ajaxStatus.innerHTML='<div class="message">'+message+'</div>';ajaxStatus.className=ajaxStatus.className.replace(/ hidden/g,'');}else{ajaxStatus.className+=' hidden';}request.open((data?'POST':'GET'),url);if(data){request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');}request.setRequestHeader('X-Requested-With','XMLHttpRequest');request.onreadystatechange=function(){if(request.readyState==4){if(/^2/.test(request.status)){callback(request);}else{ajaxStatus.innerHTML=(request.status?request.responseText:'<div class="error">'+offlineMessage+'</div>');ajaxStatus.className=ajaxStatus.className.replace(/ hidden/g,'');}}};request.send(data);}return request;}function
ajaxSetHtml(url){return ajax(url,function(request){var
data=eval('('+request.responseText+')');for(var
key
in
data){setHtml(key,data[key]);}});}function
ajaxForm(form,message,button){var
data=[];var
els=form.elements;for(var
i=0;i<els.length;i++){var
el=els[i];if(el.name&&!el.disabled){if(/^file$/i.test(el.type)&&el.value){return false;}if(!/^(checkbox|radio|submit|file)$/i.test(el.type)||el.checked||el==button){data.push(encodeURIComponent(el.name)+'='+encodeURIComponent(isTag(el,'select')?selectValue(el):el.value));}}}data=data.join('&');var
url=form.action;if(!/post/i.test(form.method)){url=url.replace(/\?.*/,'')+'?'+data;data='';}return ajax(url,function(request){setHtml('ajaxstatus',request.responseText);if(window.jush){jush.highlight_tag(document.getElementById('ajaxstatus').getElementsByTagName('code'),0);}},data,message);}function
selectClick(td,event,text,warning){var
target=getTarget(event);if(!isCtrl(event)||isTag(td.firstChild,'input|textarea')||isTag(target,'a')){return;}if(warning){return alert(warning);}var
original=td.innerHTML;text=text||/\n/.test(original);var
input=document.createElement(text?'textarea':'input');input.onkeydown=function(event){if(!event){event=window.event;}if(event.keyCode==27&&!event.shiftKey&&!event.altKey&&!isCtrl(event)){inputBlur.apply(input);td.innerHTML=original;}};var
pos=event.rangeOffset;var
value=td.firstChild.alt||td.textContent||td.innerText;input.style.width=Math.max(td.clientWidth-14,20)+'px';if(text){var
rows=1;value.replace(/\n/g,function(){rows++;});input.rows=rows;}if(value=='\u00A0'||td.getElementsByTagName('i').length){value='';}if(document.selection){var
range=document.selection.createRange();range.moveToPoint(event.clientX,event.clientY);var
range2=range.duplicate();range2.moveToElementText(td);range2.setEndPoint('EndToEnd',range);pos=range2.text.length;}td.innerHTML='';td.appendChild(input);setupSubmitHighlight(td);input.focus();if(text==2){return ajax(location.href+'&'+encodeURIComponent(td.id)+'=',function(request){if(request.responseText){input.value=request.responseText;input.name=td.id;}});}input.value=value;input.name=td.id;input.selectionStart=pos;input.selectionEnd=pos;if(document.selection){var
range=document.selection.createRange();range.moveEnd('character',-input.value.length+pos);range.select();}}function
selectLoadMore(a,limit,loading){var
title=a.innerHTML;var
href=a.href;a.innerHTML=loading;if(href){a.removeAttribute('href');return ajax(href,function(request){var
tbody=document.createElement('tbody');tbody.innerHTML=request.responseText;document.getElementById('table').appendChild(tbody);if(tbody.children.length<limit){a.parentNode.removeChild(a);}else{a.href=href.replace(/\d+$/,function(page){return+page+1;});a.innerHTML=title;}});}}function
eventStop(event){if(event.stopPropagation){event.stopPropagation();}else{event.cancelBubble=true;}}function
setupSubmitHighlight(parent){for(var
key
in{input:1,select:1,textarea:1}){var
inputs=parent.getElementsByTagName(key);for(var
i=0;i<inputs.length;i++){setupSubmitHighlightInput(inputs[i])}}}function
setupSubmitHighlightInput(input){if(!/submit|image|file/.test(input.type)){addEvent(input,'focus',inputFocus);addEvent(input,'blur',inputBlur);}}function
inputFocus(){var
submit=findDefaultSubmit(this);if(submit){alterClass(submit,'default',true);}}function
inputBlur(){var
submit=findDefaultSubmit(this);if(submit){alterClass(submit,'default');}}function
findDefaultSubmit(el){if(el.jushTextarea){el=el.jushTextarea;}var
inputs=el.form.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){var
input=inputs[i];if(input.type=='submit'&&!input.style.zIndex){return input;}}}function
addEvent(el,action,handler){if(el.addEventListener){el.addEventListener(action,handler,false);}else{el.attachEvent('on'+action,handler);}}function
focus(el){setTimeout(function(){el.focus();},0);}function
cloneNode(el){var
el2=el.cloneNode(true);setupSubmitHighlight(el2);return el2;}oninput=function(event){var
target=event.target;var
maxLength=target.getAttribute('data-maxlength');alterClass(target,'maxlength',target.value&&maxLength!=null&&target.value.length>maxLength);};function
bodyLoad(version){if(window.jush){jush.create_links=' target="_blank" rel="noreferrer"';if(version){for(var
key
in
jush.urls){var
obj=jush.urls;if(typeof
obj[key]!='string'){obj=obj[key];key=0;}obj[key]=obj[key].replace(/\/doc\/mysql/,'/doc/refman/'+version).replace(/\/docs\/current/,'/docs/'+version);}}if(window.jushLinks){jush.custom_links=jushLinks;}jush.highlight_tag('code',0);var
tags=document.getElementsByTagName('textarea');for(var
i=0;i<tags.length;i++){if(/(^|\s)jush-/.test(tags[i].className)){var
pre=jush.textarea(tags[i]);if(pre){setupSubmitHighlightInput(pre);}}}}}function
formField(form,name){for(var
i=0;i<form.length;i++){if(form[i].name==name){return form[i];}}}function
typePassword(el,disable){try{el.type=(disable?'text':'password');}catch(e){}}var
dbCtrl;var
dbPrevious={};function
dbMouseDown(event,el){dbCtrl=isCtrl(event);if(dbPrevious[el.name]==undefined){dbPrevious[el.name]=el.value;}}function
dbChange(el){if(dbCtrl){el.form.target='_blank';}el.form.submit();el.form.target='';if(dbCtrl&&dbPrevious[el.name]!=undefined){el.value=dbPrevious[el.name];dbPrevious[el.name]=undefined;}}function
selectFieldChange(form){var
ok=(function(){var
inputs=form.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){if(inputs[i].value&&/^fulltext/.test(inputs[i].name)){return true;}}var
ok=form.limit.value;var
selects=form.getElementsByTagName('select');var
group=false;var
columns={};for(var
i=0;i<selects.length;i++){var
select=selects[i];var
col=selectValue(select);var
match=/^(where.+)col\]/.exec(select.name);if(match){var
op=selectValue(form[match[1]+'op]']);var
val=form[match[1]+'val]'].value;if(col
in
indexColumns&&(!/LIKE|REGEXP/.test(op)||(op=='LIKE'&&val.charAt(0)!='%'))){return true;}else
if(col||val){ok=false;}}if((match=/^(columns.+)fun\]/.exec(select.name))){if(/^(avg|count|count distinct|group_concat|max|min|sum)$/.test(col)){group=true;}var
val=selectValue(form[match[1]+'col]']);if(val){columns[col&&col!='count'?'':val]=1;}}if(col&&/^order/.test(select.name)){if(!(col
in
indexColumns)){ok=false;}break;}}if(group){for(var
col
in
columns){if(!(col
in
indexColumns)){ok=false;}}}return ok;})();setHtml('noindex',(ok?'':'!'));}var
added='.',rowCount;function
delimiterEqual(val,a,b){return(val==a+'_'+b||val==a+b||val==a+b.charAt(0).toUpperCase()+b.substr(1));}function
idfEscape(s){return s.replace(/`/,'``');}function
editingNameChange(field){var
name=field.name.substr(0,field.name.length-7);var
type=formField(field.form,name+'[type]');var
opts=type.options;var
candidate;var
val=field.value;for(var
i=opts.length;i--;){var
match=/(.+)`(.+)/.exec(opts[i].value);if(!match){if(candidate&&i==opts.length-2&&val==opts[candidate].value.replace(/.+`/,'')&&name=='fields[1]'){return;}break;}var
table=match[1];var
column=match[2];var
tables=[table,table.replace(/s$/,''),table.replace(/es$/,'')];for(var
j=0;j<tables.length;j++){table=tables[j];if(val==column||val==table||delimiterEqual(val,table,column)||delimiterEqual(val,column,table)){if(candidate){return;}candidate=i;break;}}}if(candidate){type.selectedIndex=candidate;type.onchange();}}function
editingAddRow(button,focus){var
match=/(\d+)(\.\d+)?/.exec(button.name);var
x=match[0]+(match[2]?added.substr(match[2].length):added)+'1';var
row=parentTag(button,'tr');var
row2=cloneNode(row);var
tags=row.getElementsByTagName('select');var
tags2=row2.getElementsByTagName('select');for(var
i=0;i<tags.length;i++){tags2[i].name=tags[i].name.replace(/[0-9.]+/,x);tags2[i].selectedIndex=tags[i].selectedIndex;}tags=row.getElementsByTagName('input');tags2=row2.getElementsByTagName('input');var
input=tags2[0];for(var
i=0;i<tags.length;i++){if(tags[i].name=='auto_increment_col'){tags2[i].value=x;tags2[i].checked=false;}tags2[i].name=tags[i].name.replace(/([0-9.]+)/,x);if(/\[(orig|field|comment|default)/.test(tags[i].name)){tags2[i].value='';}if(/\[(has_default)/.test(tags[i].name)){tags2[i].checked=false;}}tags[0].onchange=function(){editingNameChange(tags[0]);};tags[0].onkeyup=function(){};row.parentNode.insertBefore(row2,row.nextSibling);if(focus){input.onchange=function(){editingNameChange(input);};input.onkeyup=function(){};input.focus();}added+='0';rowCount++;return true;}function
editingRemoveRow(button,name){var
field=formField(button.form,button.name.replace(/[^\[]+(.+)/,name));field.parentNode.removeChild(field);parentTag(button,'tr').style.display='none';return true;}function
editingMoveRow(button,dir){var
row=parentTag(button,'tr');if(!('nextElementSibling'in
row)){return false;}row.parentNode.insertBefore(row,dir?row.previousElementSibling:row.nextElementSibling?row.nextElementSibling.nextElementSibling:row.parentNode.firstChild);return true;}var
lastType='';function
editingTypeChange(type){var
name=type.name.substr(0,type.name.length-6);var
text=selectValue(type);for(var
i=0;i<type.form.elements.length;i++){var
el=type.form.elements[i];if(el.name==name+'[length]'){if(!((/(char|binary)$/.test(lastType)&&/(char|binary)$/.test(text))||(/(enum|set)$/.test(lastType)&&/(enum|set)$/.test(text)))){el.value='';}el.onchange.apply(el);}if(lastType=='timestamp'&&el.name==name+'[has_default]'&&/timestamp/i.test(formField(type.form,name+'[default]').value)){el.checked=false;}if(el.name==name+'[collation]'){alterClass(el,'hidden',!/(char|text|enum|set)$/.test(text));}if(el.name==name+'[unsigned]'){alterClass(el,'hidden',!/((^|[^o])int|float|double|decimal)$/.test(text));}if(el.name==name+'[on_update]'){alterClass(el,'hidden',!/timestamp|datetime/.test(text));}if(el.name==name+'[on_delete]'){alterClass(el,'hidden',!/`/.test(text));}}helpClose();}function
editingLengthChange(el){alterClass(el,'required',!el.value.length&&/var(char|binary)$/.test(selectValue(el.parentNode.previousSibling.firstChild)));}function
editingLengthFocus(field){var
td=field.parentNode;if(/(enum|set)$/.test(selectValue(td.previousSibling.firstChild))){var
edit=document.getElementById('enum-edit');var
val=field.value;edit.value=(/^'.+'$/.test(val)?val.substr(1,val.length-2).replace(/','/g,"\n").replace(/''/g,"'"):val);td.appendChild(edit);field.style.display='none';edit.style.display='inline';edit.focus();}}function
editingLengthBlur(edit){var
field=edit.parentNode.firstChild;var
val=edit.value;field.value=(/^'[^\n]+'$/.test(val)?val:"'"+val.replace(/\n+$/,'').replace(/'/g,"''").replace(/\n/g,"','")+"'");field.style.display='inline';edit.style.display='none';}function
columnShow(checked,column){var
trs=document.getElementById('edit-fields').getElementsByTagName('tr');for(var
i=0;i<trs.length;i++){alterClass(trs[i].getElementsByTagName('td')[column],'hidden',!checked);}}function
editingHideDefaults(){if(innerWidth<document.documentElement.scrollWidth){document.getElementById('form')['defaults'].checked=false;columnShow(false,5);}}function
partitionByChange(el){var
partitionTable=/RANGE|LIST/.test(selectValue(el));alterClass(el.form['partitions'],'hidden',partitionTable||!el.selectedIndex);alterClass(document.getElementById('partition-table'),'hidden',!partitionTable);helpClose();}function
partitionNameChange(el){var
row=cloneNode(parentTag(el,'tr'));row.firstChild.firstChild.value='';parentTag(el,'table').appendChild(row);el.onchange=function(){};}function
foreignAddRow(field){field.onchange=function(){};var
row=cloneNode(parentTag(field,'tr'));var
selects=row.getElementsByTagName('select');for(var
i=0;i<selects.length;i++){selects[i].name=selects[i].name.replace(/\]/,'1$&');selects[i].selectedIndex=0;}parentTag(field,'table').appendChild(row);}function
indexesAddRow(field){field.onchange=function(){};var
row=cloneNode(parentTag(field,'tr'));var
selects=row.getElementsByTagName('select');for(var
i=0;i<selects.length;i++){selects[i].name=selects[i].name.replace(/indexes\[\d+/,'$&1');selects[i].selectedIndex=0;}var
inputs=row.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){inputs[i].name=inputs[i].name.replace(/indexes\[\d+/,'$&1');inputs[i].value='';}parentTag(field,'table').appendChild(row);}function
indexesChangeColumn(field,prefix){var
names=[];for(var
tag
in{'select':1,'input':1}){var
columns=parentTag(field,'td').getElementsByTagName(tag);for(var
i=0;i<columns.length;i++){if(/\[columns\]/.test(columns[i].name)){var
value=selectValue(columns[i]);if(value){names.push(value);}}}}field.form[field.name.replace(/\].*/,'][name]')].value=prefix+names.join('_');}function
indexesAddColumn(field,prefix){field.onchange=function(){indexesChangeColumn(field,prefix);};var
select=field.form[field.name.replace(/\].*/,'][type]')];if(!select.selectedIndex){while(selectValue(select)!="INDEX"&&select.selectedIndex<select.options.length){select.selectedIndex++;}select.onchange();}var
column=cloneNode(field.parentNode);var
selects=column.getElementsByTagName('select');for(var
i=0;i<selects.length;i++){select=selects[i];select.name=select.name.replace(/\]\[\d+/,'$&1');select.selectedIndex=0;}var
inputs=column.getElementsByTagName('input');for(var
i=0;i<inputs.length;i++){var
input=inputs[i];input.name=input.name.replace(/\]\[\d+/,'$&1');if(input.type!='checkbox'){input.value='';}}parentTag(field,'td').appendChild(column);field.onchange();}function
triggerChange(tableRe,table,form){var
formEvent=selectValue(form['Event']);if(tableRe.test(form['Trigger'].value)){form['Trigger'].value=table+'_'+(selectValue(form['Timing']).charAt(0)+formEvent.charAt(0)).toLowerCase();}alterClass(form['Of'],'hidden',formEvent!='UPDATE OF');}var
that,x,y;function
schemaMousedown(el,event){if((event.which?event.which:event.button)==1){that=el;x=event.clientX-el.offsetLeft;y=event.clientY-el.offsetTop;}}function
schemaMousemove(ev){if(that!==undefined){ev=ev||event;var
left=(ev.clientX-x)/em;var
top=(ev.clientY-y)/em;var
divs=that.getElementsByTagName('div');var
lineSet={};for(var
i=0;i<divs.length;i++){if(divs[i].className=='references'){var
div2=document.getElementById((/^refs/.test(divs[i].id)?'refd':'refs')+divs[i].id.substr(4));var
ref=(tablePos[divs[i].title]?tablePos[divs[i].title]:[div2.parentNode.offsetTop/em,0]);var
left1=-1;var
id=divs[i].id.replace(/^ref.(.+)-.+/,'$1');if(divs[i].parentNode!=div2.parentNode){left1=Math.min(0,ref[1]-left)-1;divs[i].style.left=left1+'em';divs[i].getElementsByTagName('div')[0].style.width=-left1+'em';var
left2=Math.min(0,left-ref[1])-1;div2.style.left=left2+'em';div2.getElementsByTagName('div')[0].style.width=-left2+'em';}if(!lineSet[id]){var
line=document.getElementById(divs[i].id.replace(/^....(.+)-.+$/,'refl$1'));var
top1=top+divs[i].offsetTop/em;var
top2=top+div2.offsetTop/em;if(divs[i].parentNode!=div2.parentNode){top2+=ref[0]-top;line.getElementsByTagName('div')[0].style.height=Math.abs(top1-top2)+'em';}line.style.left=(left+left1)+'em';line.style.top=Math.min(top1,top2)+'em';lineSet[id]=true;}}}that.style.left=left+'em';that.style.top=top+'em';}}function
schemaMouseup(ev,db){if(that!==undefined){ev=ev||event;tablePos[that.firstChild.firstChild.firstChild.data]=[(ev.clientY-y)/em,(ev.clientX-x)/em];that=undefined;var
s='';for(var
key
in
tablePos){s+='_'+key+':'+Math.round(tablePos[key][0]*10000)/10000+'x'+Math.round(tablePos[key][1]*10000)/10000;}s=encodeURIComponent(s.substr(1));var
link=document.getElementById('schema-link');link.href=link.href.replace(/[^=]+$/,'')+s;cookie('adminer_schema-'+db+'='+s,30);}}var
helpOpen,helpIgnore;function
helpMouseover(el,event,text,side){var
target=getTarget(event);if(!text){helpClose();}else
if(window.jush&&(!helpIgnore||el!=target)){helpOpen=1;var
help=document.getElementById('help');help.innerHTML=text;jush.highlight_tag([help]);alterClass(help,'hidden');var
rect=target.getBoundingClientRect();var
body=document.documentElement;help.style.top=(body.scrollTop+rect.top-(side?(help.offsetHeight-target.offsetHeight)/2:help.offsetHeight))+'px';help.style.left=(body.scrollLeft+rect.left-(side?help.offsetWidth:(help.offsetWidth-target.offsetWidth)/2))+'px';}}function
helpMouseout(el,event){helpOpen=0;helpIgnore=(el!=getTarget(event));setTimeout(function(){if(!helpOpen){helpClose();}},200);}function
helpClose(){alterClass(document.getElementById('help'),'hidden',true);}