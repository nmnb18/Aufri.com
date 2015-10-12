jQuery.webshims.register("dom-extend",function(e,t,i,n,a){"use strict";t.assumeARIA=e.support.getSetAttribute||Modernizr.canvas||Modernizr.video||Modernizr.boxsizing,("text"==e('<input type="email" />').attr("type")||""===e("<form />").attr("novalidate")||"required"in e("<input />")[0].attributes)&&t.error("IE browser modes are busted in IE10. Please test your HTML/CSS/JS with a real IE version or at least IETester or similiar tools"),e.parseHTML||t.error("Webshims needs jQuery 1.8+ to work properly. Please update your jQuery version or downgrade webshims.");var r=t.modules,o=/\s*,\s*/,s={},u={},l={},p={},c={},d=e.fn.val,h=function(t,i,n,a,r){return r?d.call(e(t)):d.call(e(t),n)};e.widget||function(){var t=e.cleanData;e.cleanData=function(i){if(!e.widget)for(var n,a=0;null!=(n=i[a]);a++)try{e(n).triggerHandler("remove")}catch(r){}t(i)}}(),e.fn.val=function(t){var i=this[0];if(arguments.length&&null==t&&(t=""),!arguments.length)return i&&1===i.nodeType?e.prop(i,"value",t,"val",!0):d.call(this);if(e.isArray(t))return d.apply(this,arguments);var n=e.isFunction(t);return this.each(function(r){if(i=this,1===i.nodeType)if(n){var o=t.call(i,r,e.prop(i,"value",a,"val",!0));null==o&&(o=""),e.prop(i,"value",o,"val")}else e.prop(i,"value",t,"val")})},e.fn.onTrigger=function(e,t){return this.on(e,t).each(t)},e.fn.onWSOff=function(t,i,a){e(n)[a?"onTrigger":"on"](t,i),this.on("remove",function(a){a.originalEvent||e(n).off(t,i)})};var m="_webshimsLib"+Math.round(1e3*Math.random()),f=function(t,i,n){if(t=t.jquery?t[0]:t,!t)return n||{};var r=e.data(t,m);return n!==a&&(r||(r=e.data(t,m,{})),i&&(r[i]=n)),i?r&&r[i]:r};[{name:"getNativeElement",prop:"nativeElement"},{name:"getShadowElement",prop:"shadowElement"},{name:"getShadowFocusElement",prop:"shadowFocusElement"}].forEach(function(t){e.fn[t.name]=function(){var i=[];return this.each(function(){var n=f(this,"shadowData"),a=n&&n[t.prop]||this;-1==e.inArray(a,i)&&i.push(a)}),this.pushStack(i)}}),e.Tween.propHooks._default&&e.css&&function(){var i=!1;try{i="10px"==e.css(e('<b style="width: 10px" />')[0],"width","")}catch(n){t.error(n)}var a=i?function(t,i){return e.css(t,i,!1,"")}:function(t,i){return e.css(t,i,"")};e.extend(e.Tween.propHooks._default,{get:function(t){var i;return null==t.elem[t.prop]&&!u[t.prop]||t.elem.style&&null!=t.elem.style[t.prop]?(i=a(t.elem,t.prop),i&&"auto"!==i?i:0):u[t.prop]?e.prop(t.elem,t.prop):t.elem[t.prop]},set:function(t){jQuery.fx.step[t.prop]?jQuery.fx.step[t.prop](t):t.elem.style&&(null!=t.elem.style[jQuery.cssProps[t.prop]]||jQuery.cssHooks[t.prop])?jQuery.style(t.elem,t.prop,t.now+t.unit):u[t.prop]?e.prop(t.elem,t.prop,t.now):t.elem[t.prop]=t.now}})}(),["removeAttr","prop","attr"].forEach(function(i){s[i]=e[i],e[i]=function(t,n,r,o,p){var d="val"==o,m=d?h:s[i];if(!t||!u[n]||1!==t.nodeType||!d&&o&&"attr"==i&&e.attrFn[n])return m(t,n,r,o,p);var f,v,g,y=(t.nodeName||"").toLowerCase(),b=l[y],w="attr"!=i||r!==!1&&null!==r?i:"removeAttr";if(b||(b=l["*"]),b&&(b=b[n]),b&&(f=b[w]),f){if("value"==n&&(v=f.isVal,f.isVal=d),"removeAttr"===w)return f.value.call(t);if(r===a)return f.get?f.get.call(t):f.value;f.set&&("attr"==i&&r===!0&&(r=n),g=f.set.call(t,r)),"value"==n&&(f.isVal=v)}else g=m(t,n,r,o,p);if((r!==a||"removeAttr"===w)&&c[y]&&c[y][n]){var T;T="removeAttr"==w?!1:"prop"==w?!!r:!0,c[y][n].forEach(function(e){(!e.only||(e.only="prop"&&"prop"==i)||"attr"==e.only&&"prop"!=i)&&e.call(t,r,T,d?"val":w,i)})}return g},p[i]=function(e,n,r){l[e]||(l[e]={}),l[e][n]||(l[e][n]={});var o=l[e][n][i],u=function(e,t,a){return t&&t[e]?t[e]:a&&a[e]?a[e]:"prop"==i&&"value"==n?function(e){var t=this;return r.isVal?h(t,n,e,!1,0===arguments.length):s[i](t,n,e)}:"prop"==i&&"value"==e&&r.value.apply?function(){var e=s[i](this,n);return e&&e.apply&&(e=e.apply(this,arguments)),e}:function(e){return s[i](this,n,e)}};l[e][n][i]=r,r.value===a&&(r.set||(r.set=r.writeable?u("set",r,o):t.cfg.useStrict&&"prop"==n?function(){throw n+" is readonly on "+e}:function(){t.info(n+" is readonly on "+e)}),r.get||(r.get=u("get",r,o))),["value","get","set"].forEach(function(e){r[e]&&(r["_sup"+e]=u(e,o))})}});var v=function(){var e=t.getPrototypeOf(n.createElement("foobar")),i=Object.prototype.hasOwnProperty,a=Modernizr.advancedObjectProperties&&Modernizr.objectAccessor;return function(r,o,s){var u,l;if(!(a&&(u=n.createElement(r))&&(l=t.getPrototypeOf(u))&&e!==l)||u[o]&&i.call(u,o))s._supvalue=function(){var e=f(this,"propValue");return e&&e[o]&&e[o].apply?e[o].apply(this,arguments):e&&e[o]},g.extendValue(r,o,s.value);else{var p=u[o];s._supvalue=function(){return p&&p.apply?p.apply(this,arguments):p},l[o]=s.value}s.value._supvalue=s._supvalue}}(),g=function(){var i={};t.addReady(function(n,r){var o={},s=function(t){o[t]||(o[t]=e(n.getElementsByTagName(t)),r[0]&&e.nodeName(r[0],t)&&(o[t]=o[t].add(r)))};e.each(i,function(e,i){return s(e),i&&i.forEach?(i.forEach(function(t){o[e].each(t)}),a):(t.warn("Error: with "+e+"-property. methods: "+i),a)}),o=null});var r,o=e([]),s=function(t,a){i[t]?i[t].push(a):i[t]=[a],e.isDOMReady&&(r||e(n.getElementsByTagName(t))).each(a)};return{createTmpCache:function(t){return e.isDOMReady&&(r=r||e(n.getElementsByTagName(t))),r||o},flushTmpCache:function(){r=null},content:function(t,i){s(t,function(){var t=e.attr(this,i);null!=t&&e.attr(this,i,t)})},createElement:function(e,t){s(e,t)},extendValue:function(t,i,n){s(t,function(){e(this).each(function(){var e=f(this,"propValue",{});e[i]=this[i],this[i]=n})})}}}(),y=function(e,t){e.defaultValue===a&&(e.defaultValue=""),e.removeAttr||(e.removeAttr={value:function(){e[t||"prop"].set.call(this,e.defaultValue),e.removeAttr._supvalue.call(this)}}),e.attr||(e.attr={})};e.extend(t,{getID:function(){var t=(new Date).getTime();return function(i){i=e(i);var n=i.prop("id");return n||(t++,n="ID-"+t,i.eq(0).prop("id",n)),n}}(),implement:function(e,i){var n=f(e,"implemented")||f(e,"implemented",{});return n[i]?(t.warn(i+" already implemented for element #"+e.id),!1):(n[i]=!0,!0)},extendUNDEFProp:function(t,i){e.each(i,function(e,i){e in t||(t[e]=i)})},createPropDefault:y,data:f,moveToFirstEvent:function(t,i,n){var a,r=(e._data(t,"events")||{})[i];r&&r.length>1&&(a=r.pop(),n||(n="bind"),"bind"==n&&r.delegateCount?r.splice(r.delegateCount,0,a):r.unshift(a)),t=null},addShadowDom:function(){var a,r,o,s={init:!1,runs:0,test:function(){var e=s.getHeight(),t=s.getWidth();e!=s.height||t!=s.width?(s.height=e,s.width=t,s.handler({type:"docresize"}),s.runs++,9>s.runs&&setTimeout(s.test,90)):s.runs=0},handler:function(t){clearTimeout(a),a=setTimeout(function(){if("resize"==t.type){var a=e(i).width(),u=e(i).width();if(u==r&&a==o)return;r=u,o=a,s.height=s.getHeight(),s.width=s.getWidth()}e(n).triggerHandler("updateshadowdom")},"resize"==t.type?50:9)},_create:function(){e.each({Height:"getHeight",Width:"getWidth"},function(e,t){var i=n.body,a=n.documentElement;s[t]=function(){return Math.max(i["scroll"+e],a["scroll"+e],i["offset"+e],a["offset"+e],a["client"+e])}})},start:function(){!this.init&&n.body&&(this.init=!0,this._create(),this.height=s.getHeight(),this.width=s.getWidth(),setInterval(this.test,600),e(this.test),t.ready("WINDOWLOAD",this.test),e(i).bind("resize",this.handler),function(){var t,i=e.fn.animate;e.fn.animate=function(){return clearTimeout(t),t=setTimeout(function(){s.test()},99),i.apply(this,arguments)}}())}};return t.docObserve=function(){t.ready("DOM",function(){s.start()})},function(i,n,a){a=a||{},i.jquery&&(i=i[0]),n.jquery&&(n=n[0]);var r=e.data(i,m)||e.data(i,m,{}),o=e.data(n,m)||e.data(n,m,{}),s={};a.shadowFocusElement?a.shadowFocusElement&&(a.shadowFocusElement.jquery&&(a.shadowFocusElement=a.shadowFocusElement[0]),s=e.data(a.shadowFocusElement,m)||e.data(a.shadowFocusElement,m,s)):a.shadowFocusElement=n,r.hasShadow=n,s.nativeElement=o.nativeElement=i,s.shadowData=o.shadowData=r.shadowData={nativeElement:i,shadowElement:n,shadowFocusElement:a.shadowFocusElement},a.shadowChilds&&a.shadowChilds.each(function(){f(this,"shadowData",o.shadowData)}),a.data&&(s.shadowData.data=o.shadowData.data=r.shadowData.data=a.data),a=null,t.docObserve()}}(),propTypes:{standard:function(e){y(e),e.prop||(e.prop={set:function(t){e.attr.set.call(this,""+t)},get:function(){return e.attr.get.call(this)||e.defaultValue}})},"boolean":function(e){y(e),e.prop||(e.prop={set:function(t){t?e.attr.set.call(this,""):e.removeAttr.value.call(this)},get:function(){return null!=e.attr.get.call(this)}})},src:function(){var t=n.createElement("a");return t.style.display="none",function(i,n){y(i),i.prop||(i.prop={set:function(e){i.attr.set.call(this,e)},get:function(){var i,a=this.getAttribute(n);if(null==a)return"";if(t.setAttribute("href",a+""),!e.support.hrefNormalized){try{e(t).insertAfter(this),i=t.getAttribute("href",4)}catch(r){i=t.getAttribute("href",4)}e(t).detach()}return i||t.href}})}}(),enumarated:function(e){y(e),e.prop||(e.prop={set:function(t){e.attr.set.call(this,t)},get:function(){var t=(e.attr.get.call(this)||"").toLowerCase();return t&&-1!=e.limitedTo.indexOf(t)||(t=e.defaultValue),t}})}},reflectProperties:function(i,n){"string"==typeof n&&(n=n.split(o)),n.forEach(function(n){t.defineNodeNamesProperty(i,n,{prop:{set:function(t){e.attr(this,n,t)},get:function(){return e.attr(this,n)||""}}})})},defineNodeNameProperty:function(i,n,a){return u[n]=!0,a.reflect&&t.propTypes[a.propType||"standard"](a,n),["prop","attr","removeAttr"].forEach(function(r){var o=a[r];o&&(o="prop"===r?e.extend({writeable:!0},o):e.extend({},o,{writeable:!0}),p[r](i,n,o),"*"!=i&&t.cfg.extendNative&&"prop"==r&&o.value&&e.isFunction(o.value)&&v(i,n,o),a[r]=o)}),a.initAttr&&g.content(i,n),a},defineNodeNameProperties:function(e,i,n,a){for(var r in i)!a&&i[r].initAttr&&g.createTmpCache(e),n&&(i[r][n]||(i[r][n]={},["value","set","get"].forEach(function(e){e in i[r]&&(i[r][n][e]=i[r][e],delete i[r][e])}))),i[r]=t.defineNodeNameProperty(e,r,i[r]);return a||g.flushTmpCache(),i},createElement:function(i,n,a){var r;return e.isFunction(n)&&(n={after:n}),g.createTmpCache(i),n.before&&g.createElement(i,n.before),a&&(r=t.defineNodeNameProperties(i,a,!1,!0)),n.after&&g.createElement(i,n.after),g.flushTmpCache(),r},onNodeNamesPropertyModify:function(t,i,n,a){"string"==typeof t&&(t=t.split(o)),e.isFunction(n)&&(n={set:n}),t.forEach(function(e){c[e]||(c[e]={}),"string"==typeof i&&(i=i.split(o)),n.initAttr&&g.createTmpCache(e),i.forEach(function(t){c[e][t]||(c[e][t]=[],u[t]=!0),n.set&&(a&&(n.set.only=a),c[e][t].push(n.set)),n.initAttr&&g.content(e,t)}),g.flushTmpCache()})},defineNodeNamesBooleanProperty:function(i,n,r){r||(r={}),e.isFunction(r)&&(r.set=r),t.defineNodeNamesProperty(i,n,{attr:{set:function(e){this.setAttribute(n,e),r.set&&r.set.call(this,!0)},get:function(){var e=this.getAttribute(n);return null==e?a:n}},removeAttr:{value:function(){this.removeAttribute(n),r.set&&r.set.call(this,!1)}},reflect:!0,propType:"boolean",initAttr:r.initAttr||!1})},contentAttr:function(e,t,i){if(e.nodeName){var n;return i===a?(n=e.attributes[t]||{},i=n.specified?n.value:null,null==i?a:i):("boolean"==typeof i?i?e.setAttribute(t,t):e.removeAttribute(t):e.setAttribute(t,i),a)}},activeLang:function(){var i,n,a=[],o={},s=/:\/\/|^\.*\//,u=function(i,n,a){var r;return n&&a&&-1!==e.inArray(n,a.availabeLangs||[])?(i.loading=!0,r=a.langSrc,s.test(r)||(r=t.cfg.basePath+r),t.loader.loadScript(r+n+".js",function(){i.langObj[n]?(i.loading=!1,p(i,!0)):e(function(){i.langObj[n]&&p(i,!0),i.loading=!1})}),!0):!1},l=function(e){o[e]&&o[e].forEach(function(e){e.callback(i,n,"")})},p=function(e,t){if(e.activeLang!=i&&e.activeLang!==n){var a=r[e.module].options;e.langObj[i]||n&&e.langObj[n]?(e.activeLang=i,e.callback(e.langObj[i]||e.langObj[n],i),l(e.module)):t||u(e,i,a)||u(e,n,a)||!e.langObj[""]||""===e.activeLang||(e.activeLang="",e.callback(e.langObj[""],i),l(e.module))}},c=function(t){return"string"==typeof t&&t!==i?(i=t,n=i.split("-")[0],i==n&&(n=!1),e.each(a,function(e,t){p(t)})):"object"==typeof t&&(t.register?(o[t.register]||(o[t.register]=[]),o[t.register].push(t),t.callback(i,n,"")):(t.activeLang||(t.activeLang=""),a.push(t),p(t))),i};return c}()}),e.each({defineNodeNamesProperty:"defineNodeNameProperty",defineNodeNamesProperties:"defineNodeNameProperties",createElements:"createElement"},function(e,i){t[e]=function(e,n,a,r){"string"==typeof e&&(e=e.split(o));var s={};return e.forEach(function(e){s[e]=t[i](e,n,a,r)}),s}}),t.isReady("webshimLocalization",!0)}),function(e,t){if(!(!e.webshims.assumeARIA||"content"in t.createElement("template")||(e(function(){var t=e("main").attr({role:"main"});t.length>1?webshims.error("only one main element allowed in document"):t.is("article *, section *")&&webshims.error("main not allowed inside of article/section elements")}),"hidden"in t.createElement("a")))){var i={article:"article",aside:"complementary",section:"region",nav:"navigation",address:"contentinfo"},n=function(e,t){var i=e.getAttribute("role");i||e.setAttribute("role",t)};e.webshims.addReady(function(a,r){if(e.each(i,function(t,i){for(var o=e(t,a).add(r.filter(t)),s=0,u=o.length;u>s;s++)n(o[s],i)}),a===t){var o=t.getElementsByTagName("header")[0],s=t.getElementsByTagName("footer"),u=s.length;if(o&&!e(o).closest("section, article")[0]&&n(o,"banner"),!u)return;var l=s[u-1];e(l).closest("section, article")[0]||n(l,"contentinfo")}})}}(jQuery,document);