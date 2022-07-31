<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="robots" content="noindex">
<title>Export: eglass - Adminer</title>
<link rel="stylesheet" type="text/css" href="http://eglass.arceon.bitnamiapp.com/A.min371.php,qfile=default.css,aversion=3.7.1.pagespeed.cf.vWXtKSMslp.css">
<script type="text/javascript" src="min371.php?file=functions.js&amp;version=3.7.1"></script>
<link rel="shortcut icon" type="image/x-icon" href="min371.php?file=favicon.ico&amp;version=3.7.1">
<link rel="apple-touch-icon" href="min371.php?file=favicon.ico&amp;version=3.7.1">

<head/><body class="ltr nojs" onkeydown="bodyKeydown(event);" onclick="bodyClick(event);" onload="bodyLoad('5.5');"><noscript><meta HTTP-EQUIV="refresh" content="0;url='http://eglass.arceon.bitnamiapp.com/min371.php?username=root&amp;db=eglass&amp;dump=&amp;ModPagespeed=noscript'" /><style><!--table,div,span,font,p{display:none} --></style><div style="display:block">Please click <a href="http://eglass.arceon.bitnamiapp.com/min371.php?username=root&amp;db=eglass&amp;dump=&amp;ModPagespeed=noscript">here</a> if you are not redirected within a few seconds.</div></noscript>
<script type="text/javascript">document.body.className=document.body.className.replace(/ nojs/,' js');</script>

<div id="content">
<p id="breadcrumb"><a href="min371.php">MySQL</a> &raquo; <a href='min371.php?username=root' accesskey='1' title='Alt+Shift+1'>Server</a> &raquo; <a href="min371.php?username=root&amp;db=eglass">eglass</a> &raquo; Export
<h2>Export: eglass</h2>

<form action="" method="post">
<table cellspacing="0">
<tr><th>Output<td><label><input type='radio' name='output' value='text' checked>open</label><label><input type='radio' name='output' value='file'>save</label><label><input type='radio' name='output' value='gz'>gzip</label>
<tr><th>Format<td><label><input type='radio' name='format' value='sql' checked>SQL</label><label><input type='radio' name='format' value='csv'>CSV,</label><label><input type='radio' name='format' value='csv;'>CSV;</label><label><input type='radio' name='format' value='tsv'>TSV</label>
<tr><th>Database<td><select name='db_style'><option selected><option>USE<option>DROP+CREATE<option>CREATE</select><label><input type='checkbox' name='routines' value='1' checked>Routines</label><label><input type='checkbox' name='events' value='1' checked>Events</label><tr><th>Tables<td><select name='table_style'><option><option selected>DROP+CREATE<option>CREATE</select><label><input type='checkbox' name='auto_increment' value='1' checked>Auto Increment</label><label><input type='checkbox' name='triggers' value='1' checked>Triggers</label><tr><th>Data<td><select name='data_style'><option><option>TRUNCATE+INSERT<option selected>INSERT<option>INSERT+UPDATE</select></table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="18410">

<table cellspacing="0">
<thead><tr><th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables' checked onclick='formCheck(this, /^tables\[/);'>Tables</label><th style='text-align: right;'><label class='block'>Data<input type='checkbox' id='check-data' checked onclick='formCheck(this, /^data\[/);'></label></thead>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='docr_tasks' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">docr_tasks</label><td align='right'><label class='block'><span id='Rows-docr_tasks'></span><input type='checkbox' name='data[]' value='docr_tasks' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='qrcode_tasks' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">qrcode_tasks</label><td align='right'><label class='block'><span id='Rows-qrcode_tasks'></span><input type='checkbox' name='data[]' value='qrcode_tasks' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='settingsconfig' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">settingsconfig</label><td align='right'><label class='block'><span id='Rows-settingsconfig'></span><input type='checkbox' name='data[]' value='settingsconfig' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sysuser' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sysuser</label><td align='right'><label class='block'><span id='Rows-sysuser'></span><input type='checkbox' name='data[]' value='sysuser' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='translation_tasks' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">translation_tasks</label><td align='right'><label class='block'><span id='Rows-translation_tasks'></span><input type='checkbox' name='data[]' value='translation_tasks' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<script type='text/javascript'>ajaxSetHtml('min371.php?username=root&db=eglass&script=db');</script>
</table>
</form>
</div>

<form action='' method='post'>
<div id='lang'>Language: <select name='lang' onchange="this.form.submit();"><option value="en" selected>English<option value="ar">العربية<option value="bn">বাংলা<option value="ca">Català<option value="cs">Čeština<option value="de">Deutsch<option value="es">Español<option value="et">Eesti<option value="fa">فارسی<option value="fr">Français<option value="hu">Magyar<option value="id">Bahasa Indonesia<option value="it">Italiano<option value="ja">日本語<option value="ko">한국어<option value="lt">Lietuvių<option value="nl">Nederlands<option value="pl">Polski<option value="pt">Português<option value="ro">Limba Română<option value="ru">Русский язык<option value="sk">Slovenčina<option value="sl">Slovenski<option value="sr">Српски<option value="ta">த‌மிழ்<option value="tr">Türkçe<option value="uk">Українська<option value="zh">简体中文<option value="zh-tw">繁體中文</select> <input type='submit' value='Use' class='hidden'>
<input type='hidden' name='token' value='18410'>
</div>
</form>
<div id="menu">
<h1>
<a href='http://www.adminer.org/' id='h1'>Adminer</a> <span class="version">3.7.1</span>
<a href="http://www.adminer.org/#download" id="version">4.1.0</a>
</h1>
<form action="" method="post">
<p class="logout">
<a href='min371.php?username=root&amp;db=eglass&amp;sql=' title='Import'>SQL command</a>
<a href='min371.php?username=root&amp;db=eglass&amp;dump=' id='dump' class='active'>Dump</a>
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="18410">
</p>
</form>
<form action="">
<p id="dbs">
<input type="hidden" name="username" value="root"><select name='db' onmousedown='dbMouseDown(event, this);' onchange='dbChange(this);'><option value="">(database)<option>information_schema<option selected>eglass<option>mysql<option>mysql_db<option>performance_schema<option>test</select><input type='submit' value='Use' class='hidden'>
<input type="hidden" name="dump" value=""></p></form>
<p><a href="min371.php?username=root&amp;db=eglass&amp;create=">Create new table</a>
<p id='tables' onmouseover='menuOver(this, event);' onmouseout='menuOut(this);'>
<a href="min371.php?username=root&amp;db=eglass&amp;select=docr_tasks">select</a> <a href="min371.php?username=root&amp;db=eglass&amp;table=docr_tasks" title='Show structure'>docr_tasks</a><br>
<a href="min371.php?username=root&amp;db=eglass&amp;select=qrcode_tasks">select</a> <a href="min371.php?username=root&amp;db=eglass&amp;table=qrcode_tasks" title='Show structure'>qrcode_tasks</a><br>
<a href="min371.php?username=root&amp;db=eglass&amp;select=settingsconfig">select</a> <a href="min371.php?username=root&amp;db=eglass&amp;table=settingsconfig" title='Show structure'>settingsconfig</a><br>
<a href="min371.php?username=root&amp;db=eglass&amp;select=sysuser">select</a> <a href="min371.php?username=root&amp;db=eglass&amp;table=sysuser" title='Show structure'>sysuser</a><br>
<a href="min371.php?username=root&amp;db=eglass&amp;select=translation_tasks">select</a> <a href="min371.php?username=root&amp;db=eglass&amp;table=translation_tasks" title='Show structure'>translation_tasks</a><br>
<script type='text/javascript'>var jushLinks={sql:['min371.php?username=root&db=eglass&table=$&',/\b(docr_tasks|qrcode_tasks|settingsconfig|sysuser|translation_tasks)\b/g]};jushLinks.bac=jushLinks.sql;jushLinks.bra=jushLinks.sql;jushLinks.sqlite_quo=jushLinks.sql;jushLinks.mssql_bra=jushLinks.sql;</script>
</div>
<script type="text/javascript">setupSubmitHighlight(document);</script>
<script pagespeed_no_defer="">//<![CDATA[
(function(){var e=encodeURIComponent,f=window,h=document,m="width",n="documentElement",p="height",q="length",r="prototype",s="body",t="&",u="&ci=",w="&n=",x="&rd=",y=",",z="?",A="Content-Type",B="Microsoft.XMLHTTP",C="Msxml2.XMLHTTP",D="POST",E="application/x-www-form-urlencoded",F="img",G="input",H="load",I="oh=",J="on",K="pagespeed_url_hash",L="url=",M=function(a,c,d){if(a.addEventListener)a.addEventListener(c,d,!1);else if(a.attachEvent)a.attachEvent(J+c,d);else{var b=a[J+c];a[J+c]=function(){d.call(this);b&&b.call(this)}}};f.pagespeed=f.pagespeed||{};var N=f.pagespeed,O=function(a,c,d,b,g){this.d=a;this.f=c;this.g=d;this.a=g;this.c={height:f.innerHeight||h[n].clientHeight||h[s].clientHeight,width:f.innerWidth||h[n].clientWidth||h[s].clientWidth};this.e=b;this.b={}};O[r].j=function(a){a=a.getBoundingClientRect();return{top:a.top+(void 0!==f.pageYOffset?f.pageYOffset:(h[n]||h[s].parentNode||h[s]).scrollTop),left:a.left+(void 0!==f.pageXOffset?f.pageXOffset:(h[n]||h[s].parentNode||h[s]).scrollLeft)}};O[r].i=function(a){if(0>=a.offsetWidth&&0>=a.offsetHeight)return!1;a=this.j(a);var c=a.top.toString()+y+a.left.toString();if(this.b.hasOwnProperty(c))return!1;this.b[c]=!0;return a.top<=this.c[p]&&a.left<=this.c[m]};O[r].l=function(){for(var a=[F,G],c=[],d={},b=0;b<a[q];++b)for(var g=h.getElementsByTagName(a[b]),k=0;k<g[q];++k){var v=g[k].getAttribute(K);v&&g[k].getBoundingClientRect&&this.i(g[k])&&!(v in d)&&(c.push(v),d[v]=!0)}b=!1;a=I+this.g;this.a&&(a+=w+this.a);if(0!=c[q]){a+=u+e(c[0]);for(b=1;b<c[q];++b){d=y+e(c[b]);if(131072<a[q]+d[q])break;a+=d}b=!0}this.e&&(d=x+e(JSON.stringify(this.h())),131072>=a[q]+d[q]&&(a+=d),b=!0);N.criticalImagesBeaconData=a;if(b){var c=this.d,b=this.f,l;if(f.XMLHttpRequest)l=new XMLHttpRequest;else if(f.ActiveXObject)try{l=new ActiveXObject(C)}catch(P){try{l=new ActiveXObject(B)}catch(Q){}}l&&(l.open(D,c+(-1==c.indexOf(z)?z:t)+L+e(b)),l.setRequestHeader(A,E),l.send(a))}};O[r].h=function(){for(var a={},c=h.getElementsByTagName(F),d=0;d<c[q];++d){var b=c[d],g=b.getAttribute(K);if("undefined"==typeof b.naturalWidth||"undefined"==typeof b.naturalHeight||"undefined"==typeof g)break;if("undefined"==typeof a[b.src]&&0<b[m]&&0<b[p]&&0<b.naturalWidth&&0<b.naturalHeight||"undefined"!=typeof a[b.src]&&b[m]>=a[b.src].n&&b[p]>=a[b.src].m)a[g]={renderedWidth:b[m],renderedHeight:b[p],originalWidth:b.naturalWidth,originalHeight:b.naturalHeight}}return a};N.k=function(a,c,d,b,g){var k=new O(a,c,d,b,g);M(f,H,function(){f.setTimeout(function(){k.l()},0)})};N.criticalImagesBeaconInit=N.k;})();pagespeed.criticalImagesBeaconInit('/mod_pagespeed_beacon','http://eglass.arceon.bitnamiapp.com/min371.php?username=root&db=eglass&dump=','O-_tWHm2s1',false,'XD-rLGmxaSo');
//]]></script>