(function(){var e,t,i=Function.prototype.call,n=Array.prototype,a=Object.prototype,r=n.slice;if(Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var i=r.call(arguments,1),n=function(){if(this instanceof n){var a=function(){};a.prototype=t.prototype;var o=new a,s=t.apply(o,i.concat(r.call(arguments)));return null!==s&&Object(s)===s?s:o}return t.apply(e,i.concat(r.call(arguments)))};return n}),t=i.bind(a.toString),e=i.bind(a.hasOwnProperty),Array.isArray||(Array.isArray=function(e){return"[object Array]"==t(e)}),Array.prototype.forEach||(Array.prototype.forEach=function(e){var i=y(this),n=arguments[1],a=0,r=i.length>>>0;if("[object Function]"!=t(e))throw new TypeError;for(;r>a;)a in i&&e.call(n,i[a],a,i),a++}),Array.prototype.map||(Array.prototype.map=function(e){var i=y(this),n=i.length>>>0,a=Array(n),r=arguments[1];if("[object Function]"!=t(e))throw new TypeError;for(var o=0;n>o;o++)o in i&&(a[o]=e.call(r,i[o],o,i));return a}),Array.prototype.filter||(Array.prototype.filter=function(e){var i=y(this),n=i.length>>>0,a=[],r=arguments[1];if("[object Function]"!=t(e))throw new TypeError;for(var o=0;n>o;o++)o in i&&e.call(r,i[o],o,i)&&a.push(i[o]);return a}),Array.prototype.every||(Array.prototype.every=function(e){var i=y(this),n=i.length>>>0,a=arguments[1];if("[object Function]"!=t(e))throw new TypeError;for(var r=0;n>r;r++)if(r in i&&!e.call(a,i[r],r,i))return!1;return!0}),Array.prototype.some||(Array.prototype.some=function(e){var i=y(this),n=i.length>>>0,a=arguments[1];if("[object Function]"!=t(e))throw new TypeError;for(var r=0;n>r;r++)if(r in i&&e.call(a,i[r],r,i))return!0;return!1}),Array.prototype.reduce||(Array.prototype.reduce=function(e){var i=y(this),n=i.length>>>0;if("[object Function]"!=t(e))throw new TypeError;if(!n&&1==arguments.length)throw new TypeError;var a,r=0;if(arguments.length>=2)a=arguments[1];else for(;;){if(r in i){a=i[r++];break}if(++r>=n)throw new TypeError}for(;n>r;r++)r in i&&(a=e.call(void 0,a,i[r],r,i));return a}),Array.prototype.reduceRight||(Array.prototype.reduceRight=function(e){var i=y(this),n=i.length>>>0;if("[object Function]"!=t(e))throw new TypeError;if(!n&&1==arguments.length)throw new TypeError;var a,r=n-1;if(arguments.length>=2)a=arguments[1];else for(;;){if(r in i){a=i[r--];break}if(0>--r)throw new TypeError}do r in this&&(a=e.call(void 0,a,i[r],r,i));while(r--);return a}),Array.prototype.indexOf||(Array.prototype.indexOf=function(e){var t=y(this),i=t.length>>>0;if(!i)return-1;var n=0;for(arguments.length>1&&(n=v(arguments[1])),n=n>=0?n:i-Math.abs(n);i>n;n++)if(n in t&&t[n]===e)return n;return-1}),Array.prototype.lastIndexOf||(Array.prototype.lastIndexOf=function(e){var t=y(this),i=t.length>>>0;if(!i)return-1;var n=i-1;for(arguments.length>1&&(n=v(arguments[1])),n=n>=0?n:i-Math.abs(n);n>=0;n--)if(n in t&&e===t[n])return n;return-1}),2!=[1,2].splice(0).length){var o=Array.prototype.splice;Array.prototype.splice=function(e,t){return arguments.length?o.apply(this,[e===void 0?0:e,t===void 0?this.length-e:t].concat(r.call(arguments,2))):[]}}if(!Object.keys){var s=!0,u=["toString","toLocaleString","valueOf","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","constructor"],l=u.length;for(var p in{toString:null})s=!1;Object.keys=function(t){if("object"!=typeof t&&"function"!=typeof t||null===t)throw new TypeError("Object.keys called on a non-object");var i=[];for(var n in t)e(t,n)&&i.push(n);if(s)for(var a=0,r=l;r>a;a++){var o=u[a];e(t,o)&&i.push(o)}return i}}Date.prototype.toISOString||(Date.prototype.toISOString=function(){var e,t,i;if(!isFinite(this))throw new RangeError;for(e=[this.getUTCFullYear(),this.getUTCMonth()+1,this.getUTCDate(),this.getUTCHours(),this.getUTCMinutes(),this.getUTCSeconds()],t=e.length;t--;)i=e[t],10>i&&(e[t]="0"+i);return e.slice(0,3).join("-")+"T"+e.slice(3).join(":")+"."+("000"+this.getUTCMilliseconds()).slice(-3)+"Z"}),Date.now||(Date.now=function(){return(new Date).getTime()}),Date.prototype.toJSON||(Date.prototype.toJSON=function(){if("function"!=typeof this.toISOString)throw new TypeError;return this.toISOString()});var c="	\n\f\r   ᠎             　\u2028\u2029﻿";if(!String.prototype.trim||c.trim()){c="["+c+"]";var d=RegExp("^"+c+c+"*"),h=RegExp(c+c+"*$");String.prototype.trim=function(){return(this+"").replace(d,"").replace(h,"")}}if("0".split(void 0,0).length){var m=String.prototype.split;String.prototype.split=function(e,t){return e===void 0&&0===t?[]:m.apply(this,arguments)}}if("".substr&&"b"!=="0b".substr(-1)){var f=String.prototype.substr;String.prototype.substr=function(e,t){return f.call(this,0>e?0>(e=this.length+e)?0:e:e,t)}}var v=function(e){return e=+e,e!==e?e=-1:0!==e&&e!==1/0&&e!==-(1/0)&&(e=(e>0||-1)*Math.floor(Math.abs(e))),e},g="a"!="a"[0],y=function(e){if(null==e)throw new TypeError;return g&&"string"==typeof e&&e?e.split(""):Object(e)}})(),function(e,t){var i="defineProperty",n=!!(Object.create&&Object.defineProperties&&Object.getOwnPropertyDescriptor);if(n&&Object[i]&&Object.prototype.__defineGetter__&&function(){try{var e=document.createElement("foo");Object[i](e,"bar",{get:function(){return!0}}),n=!!e.bar}catch(t){n=!1}e=null}(),Modernizr.objectAccessor=!!(n||Object.prototype.__defineGetter__&&Object.prototype.__lookupSetter__),Modernizr.advancedObjectProperties=n,!(n&&Object.create&&Object.defineProperties&&Object.getOwnPropertyDescriptor&&Object.defineProperty)){var a=Function.prototype.call,r=Object.prototype,o=a.bind(r.hasOwnProperty);t.objectCreate=function(e,i,n,a){var r,o=function(){};return o.prototype=e,r=new o,a||"__proto__"in r||Modernizr.objectAccessor||(r.__proto__=e),i&&t.defineProperties(r,i),n&&(r.options=jQuery.extend(!0,{},r.options||{},n),n=r.options),r._create&&jQuery.isFunction(r._create)&&r._create(n),r},t.defineProperties=function(e,i){for(var n in i)o(i,n)&&t.defineProperty(e,n,i[n]);return e},t.defineProperty=function(e,t,i){return"object"!=typeof i||null===i?e:o(i,"value")?(e[t]=i.value,e):(e.__defineGetter__&&("function"==typeof i.get&&e.__defineGetter__(t,i.get),"function"==typeof i.set&&e.__defineSetter__(t,i.set)),e)},t.getPrototypeOf=function(e){return Object.getPrototypeOf&&Object.getPrototypeOf(e)||e.__proto__||e.constructor&&e.constructor.prototype},t.getOwnPropertyDescriptor=function(e,t){if("object"!=typeof e&&"function"!=typeof e||null===e)throw new TypeError("Object.getOwnPropertyDescriptor called on a non-object");var i;if(Object.defineProperty&&Object.getOwnPropertyDescriptor)try{return i=Object.getOwnPropertyDescriptor(e,t)}catch(n){}i={configurable:!0,enumerable:!0,writable:!0,value:void 0};var a=e.__lookupGetter__&&e.__lookupGetter__(t),r=e.__lookupSetter__&&e.__lookupSetter__(t);if(!a&&!r){if(!o(e,t))return;return i.value=e[t],i}return delete i.writable,delete i.value,i.get=i.set=void 0,a&&(i.get=a),r&&(i.set=r),i}}}(jQuery,jQuery.webshims);