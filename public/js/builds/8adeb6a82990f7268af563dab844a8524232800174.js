
if(typeof jQuery==='undefined'){throw new Error('Jasny Bootstrap\'s JavaScript requires jQuery')}
+function($){'use strict';function transitionEnd(){var el=document.createElement('bootstrap')
var transEndEventNames={WebkitTransition:'webkitTransitionEnd',MozTransition:'transitionend',OTransition:'oTransitionEnd otransitionend',transition:'transitionend'}
for(var name in transEndEventNames){if(el.style[name]!==undefined){return{end:transEndEventNames[name]}}}
return false}
if($.support.transition!==undefined)return
$.fn.emulateTransitionEnd=function(duration){var called=false,$el=this
$(this).one($.support.transition.end,function(){called=true})
var callback=function(){if(!called)$($el).trigger($.support.transition.end)}
setTimeout(callback,duration)
return this}
$(function(){$.support.transition=transitionEnd()})}(window.jQuery);+function($){"use strict";var OffCanvas=function(element,options){this.$element=$(element)
this.options=$.extend({},OffCanvas.DEFAULTS,options)
this.state=null
this.placement=null
if(this.options.recalc){this.calcClone()
$(window).on('resize',$.proxy(this.recalc,this))}
if(this.options.autohide)
$(document).on('click',$.proxy(this.autohide,this))
if(this.options.toggle)this.toggle()
if(this.options.disablescrolling){this.options.disableScrolling=this.options.disablescrolling
delete this.options.disablescrolling}}
OffCanvas.DEFAULTS={toggle:true,placement:'auto',autohide:true,recalc:true,disableScrolling:true}
OffCanvas.prototype.offset=function(){switch(this.placement){case'left':case'right':return this.$element.outerWidth()
case'top':case'bottom':return this.$element.outerHeight()}}
OffCanvas.prototype.calcPlacement=function(){if(this.options.placement!=='auto'){this.placement=this.options.placement
return}
if(!this.$element.hasClass('in')){this.$element.css('visiblity','hidden !important').addClass('in')}
var horizontal=$(window).width()/this.$element.width()
var vertical=$(window).height()/this.$element.height()
var element=this.$element
function ab(a,b){if(element.css(b)==='auto')return a
if(element.css(a)==='auto')return b
var size_a=parseInt(element.css(a),10)
var size_b=parseInt(element.css(b),10)
return size_a>size_b?b:a}
this.placement=horizontal>=vertical?ab('left','right'):ab('top','bottom')
if(this.$element.css('visibility')==='hidden !important'){this.$element.removeClass('in').css('visiblity','')}}
OffCanvas.prototype.opposite=function(placement){switch(placement){case'top':return'bottom'
case'left':return'right'
case'bottom':return'top'
case'right':return'left'}}
OffCanvas.prototype.getCanvasElements=function(){var canvas=this.options.canvas?$(this.options.canvas):this.$element
var fixed_elements=canvas.find('*').filter(function(){return $(this).css('position')==='fixed'}).not(this.options.exclude)
return canvas.add(fixed_elements)}
OffCanvas.prototype.slide=function(elements,offset,callback){if(!$.support.transition){var anim={}
anim[this.placement]="+="+offset
return elements.animate(anim,350,callback)}
var placement=this.placement
var opposite=this.opposite(placement)
elements.each(function(){if($(this).css(placement)!=='auto')
$(this).css(placement,(parseInt($(this).css(placement),10)||0)+offset)
if($(this).css(opposite)!=='auto')
$(this).css(opposite,(parseInt($(this).css(opposite),10)||0)-offset)})
this.$element.one($.support.transition.end,callback).emulateTransitionEnd(350)}
OffCanvas.prototype.disableScrolling=function(){var bodyWidth=$('body').width()
var prop='padding-'+this.opposite(this.placement)
if($('body').data('offcanvas-style')===undefined){$('body').data('offcanvas-style',$('body').attr('style')||'')}
$('body').css('overflow','hidden')
if($('body').width()>bodyWidth){var padding=parseInt($('body').css(prop),10)+$('body').width()-bodyWidth
setTimeout(function(){$('body').css(prop,padding)},1)}}
OffCanvas.prototype.show=function(){if(this.state)return
var startEvent=$.Event('show.bs.offcanvas')
this.$element.trigger(startEvent)
if(startEvent.isDefaultPrevented())return
this.state='slide-in'
this.calcPlacement();var elements=this.getCanvasElements()
var placement=this.placement
var opposite=this.opposite(placement)
var offset=this.offset()
if(elements.index(this.$element)!==-1){$(this.$element).data('offcanvas-style',$(this.$element).attr('style')||'')
this.$element.css(placement,-1*offset)
this.$element.css(placement);}
elements.addClass('canvas-sliding').each(function(){if($(this).data('offcanvas-style')===undefined)$(this).data('offcanvas-style',$(this).attr('style')||'')
if($(this).css('position')==='static')$(this).css('position','relative')
if(($(this).css(placement)==='auto'||$(this).css(placement)==='0px')&&($(this).css(opposite)==='auto'||$(this).css(opposite)==='0px')){$(this).css(placement,0)}})
if(this.options.disableScrolling)this.disableScrolling()
var complete=function(){if(this.state!='slide-in')return
this.state='slid'
elements.removeClass('canvas-sliding').addClass('canvas-slid')
this.$element.trigger('shown.bs.offcanvas')}
setTimeout($.proxy(function(){this.$element.addClass('in')
this.slide(elements,offset,$.proxy(complete,this))},this),1)}
OffCanvas.prototype.hide=function(fast){if(this.state!=='slid')return
var startEvent=$.Event('hide.bs.offcanvas')
this.$element.trigger(startEvent)
if(startEvent.isDefaultPrevented())return
this.state='slide-out'
var elements=$('.canvas-slid')
var placement=this.placement
var offset=-1*this.offset()
var complete=function(){if(this.state!='slide-out')return
this.state=null
this.placement=null
this.$element.removeClass('in')
elements.removeClass('canvas-sliding')
elements.add(this.$element).add('body').each(function(){$(this).attr('style',$(this).data('offcanvas-style')).removeData('offcanvas-style')})
this.$element.trigger('hidden.bs.offcanvas')}
elements.removeClass('canvas-slid').addClass('canvas-sliding')
setTimeout($.proxy(function(){this.slide(elements,offset,$.proxy(complete,this))},this),1)}
OffCanvas.prototype.toggle=function(){if(this.state==='slide-in'||this.state==='slide-out')return
this[this.state==='slid'?'hide':'show']()}
OffCanvas.prototype.calcClone=function(){this.$calcClone=this.$element.clone().html('').addClass('offcanvas-clone').removeClass('in').appendTo($('body'))}
OffCanvas.prototype.recalc=function(){if(this.$calcClone.css('display')==='none'||(this.state!=='slid'&&this.state!=='slide-in'))return
this.state=null
this.placement=null
var elements=this.getCanvasElements()
this.$element.removeClass('in')
elements.removeClass('canvas-slid')
elements.add(this.$element).add('body').each(function(){$(this).attr('style',$(this).data('offcanvas-style')).removeData('offcanvas-style')})}
OffCanvas.prototype.autohide=function(e){if($(e.target).closest(this.$element).length===0)this.hide()}
var old=$.fn.offcanvas
$.fn.offcanvas=function(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.offcanvas')
var options=$.extend({},OffCanvas.DEFAULTS,$this.data(),typeof option==='object'&&option)
if(!data)$this.data('bs.offcanvas',(data=new OffCanvas(this,options)))
if(typeof option==='string')data[option]()})}
$.fn.offcanvas.Constructor=OffCanvas
$.fn.offcanvas.noConflict=function(){$.fn.offcanvas=old
return this}
$(document).on('click.bs.offcanvas.data-api','[data-toggle=offcanvas]',function(e){var $this=$(this),href
var target=$this.attr('data-target')||e.preventDefault()||(href=$this.attr('href'))&&href.replace(/.*(?=#[^\s]+$)/,'')
var $canvas=$(target)
var data=$canvas.data('bs.offcanvas')
var option=data?'toggle':$this.data()
e.stopPropagation()
if(data)data.toggle()
else $canvas.offcanvas(option)})}(window.jQuery);+function($){"use strict";var Rowlink=function(element,options){this.$element=$(element)
this.options=$.extend({},Rowlink.DEFAULTS,options)
this.$element.on('click.bs.rowlink','td:not(.rowlink-skip)',$.proxy(this.click,this))}
Rowlink.DEFAULTS={target:"a"}
Rowlink.prototype.click=function(e){var target=$(e.currentTarget).closest('tr').find(this.options.target)[0]
if($(e.target)[0]===target)return
e.preventDefault();if(target.click){target.click()}else if(document.createEvent){var evt=document.createEvent("MouseEvents");evt.initMouseEvent("click",true,true,window,0,0,0,0,0,false,false,false,false,0,null);target.dispatchEvent(evt);}}
var old=$.fn.rowlink
$.fn.rowlink=function(options){return this.each(function(){var $this=$(this)
var data=$this.data('bs.rowlink')
if(!data)$this.data('bs.rowlink',(data=new Rowlink(this,options)))})}
$.fn.rowlink.Constructor=Rowlink
$.fn.rowlink.noConflict=function(){$.fn.rowlink=old
return this}
$(document).on('click.bs.rowlink.data-api','[data-link="row"]',function(e){if($(e.target).closest('.rowlink-skip').length!==0)return
var $this=$(this)
if($this.data('bs.rowlink'))return
$this.rowlink($this.data())
$(e.target).trigger('click.bs.rowlink')})}(window.jQuery);+function($){"use strict";var isIphone=(window.orientation!==undefined)
var isAndroid=navigator.userAgent.toLowerCase().indexOf("android")>-1
var isIE=window.navigator.appName=='Microsoft Internet Explorer'
var Inputmask=function(element,options){if(isAndroid)return
this.$element=$(element)
this.options=$.extend({},Inputmask.DEFAULTS,options)
this.mask=String(this.options.mask)
this.init()
this.listen()
this.checkVal()}
Inputmask.DEFAULTS={mask:"",placeholder:"_",definitions:{'9':"[0-9]",'a':"[A-Za-z]",'w':"[A-Za-z0-9]",'*':"."}}
Inputmask.prototype.init=function(){var defs=this.options.definitions
var len=this.mask.length
this.tests=[]
this.partialPosition=this.mask.length
this.firstNonMaskPos=null
$.each(this.mask.split(""),$.proxy(function(i,c){if(c=='?'){len--
this.partialPosition=i}else if(defs[c]){this.tests.push(new RegExp(defs[c]))
if(this.firstNonMaskPos===null)
this.firstNonMaskPos=this.tests.length-1}else{this.tests.push(null)}},this))
this.buffer=$.map(this.mask.split(""),$.proxy(function(c,i){if(c!='?')return defs[c]?this.options.placeholder:c},this))
this.focusText=this.$element.val()
this.$element.data("rawMaskFn",$.proxy(function(){return $.map(this.buffer,function(c,i){return this.tests[i]&&c!=this.options.placeholder?c:null}).join('')},this))}
Inputmask.prototype.listen=function(){if(this.$element.attr("readonly"))return
var pasteEventName=(isIE?'paste':'input')+".mask"
this.$element.on("unmask.bs.inputmask",$.proxy(this.unmask,this)).on("focus.bs.inputmask",$.proxy(this.focusEvent,this)).on("blur.bs.inputmask",$.proxy(this.blurEvent,this)).on("keydown.bs.inputmask",$.proxy(this.keydownEvent,this)).on("keypress.bs.inputmask",$.proxy(this.keypressEvent,this)).on(pasteEventName,$.proxy(this.pasteEvent,this))}
Inputmask.prototype.caret=function(begin,end){if(this.$element.length===0)return
if(typeof begin=='number'){end=(typeof end=='number')?end:begin
return this.$element.each(function(){if(this.setSelectionRange){this.setSelectionRange(begin,end)}else if(this.createTextRange){var range=this.createTextRange()
range.collapse(true)
range.moveEnd('character',end)
range.moveStart('character',begin)
range.select()}})}else{if(this.$element[0].setSelectionRange){begin=this.$element[0].selectionStart
end=this.$element[0].selectionEnd}else if(document.selection&&document.selection.createRange){var range=document.selection.createRange()
begin=0-range.duplicate().moveStart('character',-100000)
end=begin+range.text.length}
return{begin:begin,end:end}}}
Inputmask.prototype.seekNext=function(pos){var len=this.mask.length
while(++pos<=len&&!this.tests[pos]);return pos}
Inputmask.prototype.seekPrev=function(pos){while(--pos>=0&&!this.tests[pos]);return pos}
Inputmask.prototype.shiftL=function(begin,end){var len=this.mask.length
if(begin<0)return
for(var i=begin,j=this.seekNext(end);i<len;i++){if(this.tests[i]){if(j<len&&this.tests[i].test(this.buffer[j])){this.buffer[i]=this.buffer[j]
this.buffer[j]=this.options.placeholder}else
break
j=this.seekNext(j)}}
this.writeBuffer()
this.caret(Math.max(this.firstNonMaskPos,begin))}
Inputmask.prototype.shiftR=function(pos){var len=this.mask.length
for(var i=pos,c=this.options.placeholder;i<len;i++){if(this.tests[i]){var j=this.seekNext(i)
var t=this.buffer[i]
this.buffer[i]=c
if(j<len&&this.tests[j].test(t))
c=t
else
break}}},Inputmask.prototype.unmask=function(){this.$element.unbind(".mask").removeData("inputmask")}
Inputmask.prototype.focusEvent=function(){this.focusText=this.$element.val()
var len=this.mask.length
var pos=this.checkVal()
this.writeBuffer()
var that=this
var moveCaret=function(){if(pos==len)
that.caret(0,pos)
else
that.caret(pos)}
moveCaret()
setTimeout(moveCaret,50)}
Inputmask.prototype.blurEvent=function(){this.checkVal()
if(this.$element.val()!==this.focusText)
this.$element.trigger('change')}
Inputmask.prototype.keydownEvent=function(e){var k=e.which
if(k==8||k==46||(isIphone&&k==127)){var pos=this.caret(),begin=pos.begin,end=pos.end
if(end-begin===0){begin=k!=46?this.seekPrev(begin):(end=this.seekNext(begin-1))
end=k==46?this.seekNext(end):end}
this.clearBuffer(begin,end)
this.shiftL(begin,end-1)
return false}else if(k==27){this.$element.val(this.focusText)
this.caret(0,this.checkVal())
return false}}
Inputmask.prototype.keypressEvent=function(e){var len=this.mask.length
var k=e.which,pos=this.caret()
if(e.ctrlKey||e.altKey||e.metaKey||k<32){return true}else if(k){if(pos.end-pos.begin!==0){this.clearBuffer(pos.begin,pos.end)
this.shiftL(pos.begin,pos.end-1)}
var p=this.seekNext(pos.begin-1)
if(p<len){var c=String.fromCharCode(k)
if(this.tests[p].test(c)){this.shiftR(p)
this.buffer[p]=c
this.writeBuffer()
var next=this.seekNext(p)
this.caret(next)}}
return false}}
Inputmask.prototype.pasteEvent=function(){var that=this
setTimeout(function(){that.caret(that.checkVal(true))},0)}
Inputmask.prototype.clearBuffer=function(start,end){var len=this.mask.length
for(var i=start;i<end&&i<len;i++){if(this.tests[i])
this.buffer[i]=this.options.placeholder}}
Inputmask.prototype.writeBuffer=function(){return this.$element.val(this.buffer.join('')).val()}
Inputmask.prototype.checkVal=function(allow){var len=this.mask.length
var test=this.$element.val()
var lastMatch=-1
for(var i=0,pos=0;i<len;i++){if(this.tests[i]){this.buffer[i]=this.options.placeholder
while(pos++<test.length){var c=test.charAt(pos-1)
if(this.tests[i].test(c)){this.buffer[i]=c
lastMatch=i
break}}
if(pos>test.length)
break}else if(this.buffer[i]==test.charAt(pos)&&i!=this.partialPosition){pos++
lastMatch=i}}
if(!allow&&lastMatch+1<this.partialPosition){this.$element.val("")
this.clearBuffer(0,len)}else if(allow||lastMatch+1>=this.partialPosition){this.writeBuffer()
if(!allow)this.$element.val(this.$element.val().substring(0,lastMatch+1))}
return(this.partialPosition?i:this.firstNonMaskPos)}
var old=$.fn.inputmask
$.fn.inputmask=function(options){return this.each(function(){var $this=$(this)
var data=$this.data('bs.inputmask')
if(!data)$this.data('bs.inputmask',(data=new Inputmask(this,options)))})}
$.fn.inputmask.Constructor=Inputmask
$.fn.inputmask.noConflict=function(){$.fn.inputmask=old
return this}
$(document).on('focus.bs.inputmask.data-api','[data-mask]',function(e){var $this=$(this)
if($this.data('bs.inputmask'))return
$this.inputmask($this.data())})}(window.jQuery);+function($){"use strict";var isIE=window.navigator.appName=='Microsoft Internet Explorer'
var Fileinput=function(element,options){this.$element=$(element)
this.$input=this.$element.find(':file')
if(this.$input.length===0)return
this.name=this.$input.attr('name')||options.name
this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]')
if(this.$hidden.length===0){this.$hidden=$('<input type="hidden">').insertBefore(this.$input)}
this.$preview=this.$element.find('.fileinput-preview')
var height=this.$preview.css('height')
if(this.$preview.css('display')!=='inline'&&height!=='0px'&&height!=='none'){this.$preview.css('line-height',height)}
this.original={exists:this.$element.hasClass('fileinput-exists'),preview:this.$preview.html(),hiddenVal:this.$hidden.val()}
this.listen()}
Fileinput.prototype.listen=function(){this.$input.on('change.bs.fileinput',$.proxy(this.change,this))
$(this.$input[0].form).on('reset.bs.fileinput',$.proxy(this.reset,this))
this.$element.find('[data-trigger="fileinput"]').on('click.bs.fileinput',$.proxy(this.trigger,this))
this.$element.find('[data-dismiss="fileinput"]').on('click.bs.fileinput',$.proxy(this.clear,this))},Fileinput.prototype.change=function(e){var files=e.target.files===undefined?(e.target&&e.target.value?[{name:e.target.value.replace(/^.+\\/,'')}]:[]):e.target.files
e.stopPropagation()
if(files.length===0){this.clear()
return}
this.$hidden.val('')
this.$hidden.attr('name','')
this.$input.attr('name',this.name)
var file=files[0]
if(this.$preview.length>0&&(typeof file.type!=="undefined"?file.type.match(/^image\/(gif|png|jpeg)$/):file.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!=="undefined"){var reader=new FileReader()
var preview=this.$preview
var element=this.$element
reader.onload=function(re){var $img=$('<img>')
$img[0].src=re.target.result
files[0].result=re.target.result
element.find('.fileinput-filename').text(file.name)
if(preview.css('max-height')!='none')$img.css('max-height',parseInt(preview.css('max-height'),10)-parseInt(preview.css('padding-top'),10)-parseInt(preview.css('padding-bottom'),10)-parseInt(preview.css('border-top'),10)-parseInt(preview.css('border-bottom'),10))
preview.html($img)
element.addClass('fileinput-exists').removeClass('fileinput-new')
element.trigger('change.bs.fileinput',files)}
reader.readAsDataURL(file)}else{this.$element.find('.fileinput-filename').text(file.name)
this.$preview.text(file.name)
this.$element.addClass('fileinput-exists').removeClass('fileinput-new')
this.$element.trigger('change.bs.fileinput')}},Fileinput.prototype.clear=function(e){if(e)e.preventDefault()
this.$hidden.val('')
this.$hidden.attr('name',this.name)
this.$input.attr('name','')
if(isIE){var inputClone=this.$input.clone(true);this.$input.after(inputClone);this.$input.remove();this.$input=inputClone;}else{this.$input.val('')}
this.$preview.html('')
this.$element.find('.fileinput-filename').text('')
this.$element.addClass('fileinput-new').removeClass('fileinput-exists')
if(e!==undefined){this.$input.trigger('change')
this.$element.trigger('clear.bs.fileinput')}},Fileinput.prototype.reset=function(){this.clear()
this.$hidden.val(this.original.hiddenVal)
this.$preview.html(this.original.preview)
this.$element.find('.fileinput-filename').text('')
if(this.original.exists)this.$element.addClass('fileinput-exists').removeClass('fileinput-new')
else this.$element.addClass('fileinput-new').removeClass('fileinput-exists')
this.$element.trigger('reset.bs.fileinput')},Fileinput.prototype.trigger=function(e){this.$input.trigger('click')
e.preventDefault()}
var old=$.fn.fileinput
$.fn.fileinput=function(options){return this.each(function(){var $this=$(this),data=$this.data('bs.fileinput')
if(!data)$this.data('bs.fileinput',(data=new Fileinput(this,options)))
if(typeof options=='string')data[options]()})}
$.fn.fileinput.Constructor=Fileinput
$.fn.fileinput.noConflict=function(){$.fn.fileinput=old
return this}
$(document).on('click.fileinput.data-api','[data-provides="fileinput"]',function(e){var $this=$(this)
if($this.data('bs.fileinput'))return
$this.fileinput($this.data())
var $target=$(e.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');if($target.length>0){e.preventDefault()
$target.trigger('click.bs.fileinput')}})}(window.jQuery);if(typeof jQuery==='undefined'){throw new Error('Bootstrap\'s JavaScript requires jQuery')}
+function($){'use strict';function transitionEnd(){var el=document.createElement('bootstrap')
var transEndEventNames={WebkitTransition:'webkitTransitionEnd',MozTransition:'transitionend',OTransition:'oTransitionEnd otransitionend',transition:'transitionend'}
for(var name in transEndEventNames){if(el.style[name]!==undefined){return{end:transEndEventNames[name]}}}
return false}
$.fn.emulateTransitionEnd=function(duration){var called=false
var $el=this
$(this).one('bsTransitionEnd',function(){called=true})
var callback=function(){if(!called)$($el).trigger($.support.transition.end)}
setTimeout(callback,duration)
return this}
$(function(){$.support.transition=transitionEnd()
if(!$.support.transition)return
$.event.special.bsTransitionEnd={bindType:$.support.transition.end,delegateType:$.support.transition.end,handle:function(e){if($(e.target).is(this))return e.handleObj.handler.apply(this,arguments)}}})}(jQuery);+function($){'use strict';var dismiss='[data-dismiss="alert"]'
var Alert=function(el){$(el).on('click',dismiss,this.close)}
Alert.VERSION='3.2.0'
Alert.prototype.close=function(e){var $this=$(this)
var selector=$this.attr('data-target')
if(!selector){selector=$this.attr('href')
selector=selector&&selector.replace(/.*(?=#[^\s]*$)/,'')}
var $parent=$(selector)
if(e)e.preventDefault()
if(!$parent.length){$parent=$this.hasClass('alert')?$this:$this.parent()}
$parent.trigger(e=$.Event('close.bs.alert'))
if(e.isDefaultPrevented())return
$parent.removeClass('in')
function removeElement(){$parent.detach().trigger('closed.bs.alert').remove()}
$.support.transition&&$parent.hasClass('fade')?$parent.one('bsTransitionEnd',removeElement).emulateTransitionEnd(150):removeElement()}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.alert')
if(!data)$this.data('bs.alert',(data=new Alert(this)))
if(typeof option=='string')data[option].call($this)})}
var old=$.fn.alert
$.fn.alert=Plugin
$.fn.alert.Constructor=Alert
$.fn.alert.noConflict=function(){$.fn.alert=old
return this}
$(document).on('click.bs.alert.data-api',dismiss,Alert.prototype.close)}(jQuery);+function($){'use strict';var Button=function(element,options){this.$element=$(element)
this.options=$.extend({},Button.DEFAULTS,options)
this.isLoading=false}
Button.VERSION='3.2.0'
Button.DEFAULTS={loadingText:'loading...'}
Button.prototype.setState=function(state){var d='disabled'
var $el=this.$element
var val=$el.is('input')?'val':'html'
var data=$el.data()
state=state+'Text'
if(data.resetText==null)$el.data('resetText',$el[val]())
$el[val](data[state]==null?this.options[state]:data[state])
setTimeout($.proxy(function(){if(state=='loadingText'){this.isLoading=true
$el.addClass(d).attr(d,d)}else if(this.isLoading){this.isLoading=false
$el.removeClass(d).removeAttr(d)}},this),0)}
Button.prototype.toggle=function(){var changed=true
var $parent=this.$element.closest('[data-toggle="buttons"]')
if($parent.length){var $input=this.$element.find('input')
if($input.prop('type')=='radio'){if($input.prop('checked')&&this.$element.hasClass('active'))changed=false
else $parent.find('.active').removeClass('active')}
if(changed)$input.prop('checked',!this.$element.hasClass('active')).trigger('change')}
if(changed)this.$element.toggleClass('active')}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.button')
var options=typeof option=='object'&&option
if(!data)$this.data('bs.button',(data=new Button(this,options)))
if(option=='toggle')data.toggle()
else if(option)data.setState(option)})}
var old=$.fn.button
$.fn.button=Plugin
$.fn.button.Constructor=Button
$.fn.button.noConflict=function(){$.fn.button=old
return this}
$(document).on('click.bs.button.data-api','[data-toggle^="button"]',function(e){var $btn=$(e.target)
if(!$btn.hasClass('btn'))$btn=$btn.closest('.btn')
Plugin.call($btn,'toggle')
e.preventDefault()})}(jQuery);+function($){'use strict';var Carousel=function(element,options){this.$element=$(element).on('keydown.bs.carousel',$.proxy(this.keydown,this))
this.$indicators=this.$element.find('.carousel-indicators')
this.options=options
this.paused=this.sliding=this.interval=this.$active=this.$items=null
this.options.pause=='hover'&&this.$element.on('mouseenter.bs.carousel',$.proxy(this.pause,this)).on('mouseleave.bs.carousel',$.proxy(this.cycle,this))}
Carousel.VERSION='3.2.0'
Carousel.DEFAULTS={interval:5000,pause:'hover',wrap:true}
Carousel.prototype.keydown=function(e){switch(e.which){case 37:this.prev();break
case 39:this.next();break
default:return}
e.preventDefault()}
Carousel.prototype.cycle=function(e){e||(this.paused=false)
this.interval&&clearInterval(this.interval)
this.options.interval&&!this.paused&&(this.interval=setInterval($.proxy(this.next,this),this.options.interval))
return this}
Carousel.prototype.getItemIndex=function(item){this.$items=item.parent().children('.item')
return this.$items.index(item||this.$active)}
Carousel.prototype.to=function(pos){var that=this
var activeIndex=this.getItemIndex(this.$active=this.$element.find('.item.active'))
if(pos>(this.$items.length-1)||pos<0)return
if(this.sliding)return this.$element.one('slid.bs.carousel',function(){that.to(pos)})
if(activeIndex==pos)return this.pause().cycle()
return this.slide(pos>activeIndex?'next':'prev',$(this.$items[pos]))}
Carousel.prototype.pause=function(e){e||(this.paused=true)
if(this.$element.find('.next, .prev').length&&$.support.transition){this.$element.trigger($.support.transition.end)
this.cycle(true)}
this.interval=clearInterval(this.interval)
return this}
Carousel.prototype.next=function(){if(this.sliding)return
return this.slide('next')}
Carousel.prototype.prev=function(){if(this.sliding)return
return this.slide('prev')}
Carousel.prototype.slide=function(type,next){var $active=this.$element.find('.item.active')
var $next=next||$active[type]()
var isCycling=this.interval
var direction=type=='next'?'left':'right'
var fallback=type=='next'?'first':'last'
var that=this
if(!$next.length){if(!this.options.wrap)return
$next=this.$element.find('.item')[fallback]()}
if($next.hasClass('active'))return(this.sliding=false)
var relatedTarget=$next[0]
var slideEvent=$.Event('slide.bs.carousel',{relatedTarget:relatedTarget,direction:direction})
this.$element.trigger(slideEvent)
if(slideEvent.isDefaultPrevented())return
this.sliding=true
isCycling&&this.pause()
if(this.$indicators.length){this.$indicators.find('.active').removeClass('active')
var $nextIndicator=$(this.$indicators.children()[this.getItemIndex($next)])
$nextIndicator&&$nextIndicator.addClass('active')}
var slidEvent=$.Event('slid.bs.carousel',{relatedTarget:relatedTarget,direction:direction})
if($.support.transition&&this.$element.hasClass('slide')){$next.addClass(type)
$next[0].offsetWidth
$active.addClass(direction)
$next.addClass(direction)
$active.one('bsTransitionEnd',function(){$next.removeClass([type,direction].join(' ')).addClass('active')
$active.removeClass(['active',direction].join(' '))
that.sliding=false
setTimeout(function(){that.$element.trigger(slidEvent)},0)}).emulateTransitionEnd($active.css('transition-duration').slice(0,-1)*1000)}else{$active.removeClass('active')
$next.addClass('active')
this.sliding=false
this.$element.trigger(slidEvent)}
isCycling&&this.cycle()
return this}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.carousel')
var options=$.extend({},Carousel.DEFAULTS,$this.data(),typeof option=='object'&&option)
var action=typeof option=='string'?option:options.slide
if(!data)$this.data('bs.carousel',(data=new Carousel(this,options)))
if(typeof option=='number')data.to(option)
else if(action)data[action]()
else if(options.interval)data.pause().cycle()})}
var old=$.fn.carousel
$.fn.carousel=Plugin
$.fn.carousel.Constructor=Carousel
$.fn.carousel.noConflict=function(){$.fn.carousel=old
return this}
$(document).on('click.bs.carousel.data-api','[data-slide], [data-slide-to]',function(e){var href
var $this=$(this)
var $target=$($this.attr('data-target')||(href=$this.attr('href'))&&href.replace(/.*(?=#[^\s]+$)/,''))
if(!$target.hasClass('carousel'))return
var options=$.extend({},$target.data(),$this.data())
var slideIndex=$this.attr('data-slide-to')
if(slideIndex)options.interval=false
Plugin.call($target,options)
if(slideIndex){$target.data('bs.carousel').to(slideIndex)}
e.preventDefault()})
$(window).on('load',function(){$('[data-ride="carousel"]').each(function(){var $carousel=$(this)
Plugin.call($carousel,$carousel.data())})})}(jQuery);+function($){'use strict';var Collapse=function(element,options){this.$element=$(element)
this.options=$.extend({},Collapse.DEFAULTS,options)
this.transitioning=null
if(this.options.parent)this.$parent=$(this.options.parent)
if(this.options.toggle)this.toggle()}
Collapse.VERSION='3.2.0'
Collapse.DEFAULTS={toggle:true}
Collapse.prototype.dimension=function(){var hasWidth=this.$element.hasClass('width')
return hasWidth?'width':'height'}
Collapse.prototype.show=function(){if(this.transitioning||this.$element.hasClass('in'))return
var startEvent=$.Event('show.bs.collapse')
this.$element.trigger(startEvent)
if(startEvent.isDefaultPrevented())return
var actives=this.$parent&&this.$parent.find('> .panel > .in')
if(actives&&actives.length){var hasData=actives.data('bs.collapse')
if(hasData&&hasData.transitioning)return
Plugin.call(actives,'hide')
hasData||actives.data('bs.collapse',null)}
var dimension=this.dimension()
this.$element.removeClass('collapse').addClass('collapsing')[dimension](0)
this.transitioning=1
var complete=function(){this.$element.removeClass('collapsing').addClass('collapse in')[dimension]('')
this.transitioning=0
this.$element.trigger('shown.bs.collapse')}
if(!$.support.transition)return complete.call(this)
var scrollSize=$.camelCase(['scroll',dimension].join('-'))
this.$element.one('bsTransitionEnd',$.proxy(complete,this)).emulateTransitionEnd(350)[dimension](this.$element[0][scrollSize])}
Collapse.prototype.hide=function(){if(this.transitioning||!this.$element.hasClass('in'))return
var startEvent=$.Event('hide.bs.collapse')
this.$element.trigger(startEvent)
if(startEvent.isDefaultPrevented())return
var dimension=this.dimension()
this.$element[dimension](this.$element[dimension]())[0].offsetHeight
this.$element.addClass('collapsing').removeClass('collapse').removeClass('in')
this.transitioning=1
var complete=function(){this.transitioning=0
this.$element.trigger('hidden.bs.collapse').removeClass('collapsing').addClass('collapse')}
if(!$.support.transition)return complete.call(this)
this.$element
[dimension](0).one('bsTransitionEnd',$.proxy(complete,this)).emulateTransitionEnd(350)}
Collapse.prototype.toggle=function(){this[this.$element.hasClass('in')?'hide':'show']()}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.collapse')
var options=$.extend({},Collapse.DEFAULTS,$this.data(),typeof option=='object'&&option)
if(!data&&options.toggle&&option=='show')option=!option
if(!data)$this.data('bs.collapse',(data=new Collapse(this,options)))
if(typeof option=='string')data[option]()})}
var old=$.fn.collapse
$.fn.collapse=Plugin
$.fn.collapse.Constructor=Collapse
$.fn.collapse.noConflict=function(){$.fn.collapse=old
return this}
$(document).on('click.bs.collapse.data-api','[data-toggle="collapse"]',function(e){var href
var $this=$(this)
var target=$this.attr('data-target')||e.preventDefault()||(href=$this.attr('href'))&&href.replace(/.*(?=#[^\s]+$)/,'')
var $target=$(target)
var data=$target.data('bs.collapse')
var option=data?'toggle':$this.data()
var parent=$this.attr('data-parent')
var $parent=parent&&$(parent)
if(!data||!data.transitioning){if($parent)$parent.find('[data-toggle="collapse"][data-parent="'+parent+'"]').not($this).addClass('collapsed')
$this[$target.hasClass('in')?'addClass':'removeClass']('collapsed')}
Plugin.call($target,option)})}(jQuery);+function($){'use strict';var backdrop='.dropdown-backdrop'
var toggle='[data-toggle="dropdown"]'
var Dropdown=function(element){$(element).on('click.bs.dropdown',this.toggle)}
Dropdown.VERSION='3.2.0'
Dropdown.prototype.toggle=function(e){var $this=$(this)
if($this.is('.disabled, :disabled'))return
var $parent=getParent($this)
var isActive=$parent.hasClass('open')
clearMenus()
if(!isActive){if('ontouchstart'in document.documentElement&&!$parent.closest('.navbar-nav').length){$('<div class="dropdown-backdrop"/>').insertAfter($(this)).on('click',clearMenus)}
var relatedTarget={relatedTarget:this}
$parent.trigger(e=$.Event('show.bs.dropdown',relatedTarget))
if(e.isDefaultPrevented())return
$this.trigger('focus')
$parent.toggleClass('open').trigger('shown.bs.dropdown',relatedTarget)}
return false}
Dropdown.prototype.keydown=function(e){if(!/(38|40|27)/.test(e.keyCode))return
var $this=$(this)
e.preventDefault()
e.stopPropagation()
if($this.is('.disabled, :disabled'))return
var $parent=getParent($this)
var isActive=$parent.hasClass('open')
if(!isActive||(isActive&&e.keyCode==27)){if(e.which==27)$parent.find(toggle).trigger('focus')
return $this.trigger('click')}
var desc=' li:not(.divider):visible a'
var $items=$parent.find('[role="menu"]'+desc+', [role="listbox"]'+desc)
if(!$items.length)return
var index=$items.index($items.filter(':focus'))
if(e.keyCode==38&&index>0)index--
if(e.keyCode==40&&index<$items.length-1)index++
if(!~index)index=0
$items.eq(index).trigger('focus')}
function clearMenus(e){if(e&&e.which===3)return
$(backdrop).remove()
$(toggle).each(function(){var $parent=getParent($(this))
var relatedTarget={relatedTarget:this}
if(!$parent.hasClass('open'))return
$parent.trigger(e=$.Event('hide.bs.dropdown',relatedTarget))
if(e.isDefaultPrevented())return
$parent.removeClass('open').trigger('hidden.bs.dropdown',relatedTarget)})}
function getParent($this){var selector=$this.attr('data-target')
if(!selector){selector=$this.attr('href')
selector=selector&&/#[A-Za-z]/.test(selector)&&selector.replace(/.*(?=#[^\s]*$)/,'')}
var $parent=selector&&$(selector)
return $parent&&$parent.length?$parent:$this.parent()}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.dropdown')
if(!data)$this.data('bs.dropdown',(data=new Dropdown(this)))
if(typeof option=='string')data[option].call($this)})}
var old=$.fn.dropdown
$.fn.dropdown=Plugin
$.fn.dropdown.Constructor=Dropdown
$.fn.dropdown.noConflict=function(){$.fn.dropdown=old
return this}
$(document).on('click.bs.dropdown.data-api',clearMenus).on('click.bs.dropdown.data-api','.dropdown form',function(e){e.stopPropagation()}).on('click.bs.dropdown.data-api',toggle,Dropdown.prototype.toggle).on('keydown.bs.dropdown.data-api',toggle+', [role="menu"], [role="listbox"]',Dropdown.prototype.keydown)}(jQuery);+function($){'use strict';var Modal=function(element,options){this.options=options
this.$body=$(document.body)
this.$element=$(element)
this.$backdrop=this.isShown=null
this.scrollbarWidth=0
if(this.options.remote){this.$element.find('.modal-content').load(this.options.remote,$.proxy(function(){this.$element.trigger('loaded.bs.modal')},this))}}
Modal.VERSION='3.2.0'
Modal.DEFAULTS={backdrop:true,keyboard:true,show:true}
Modal.prototype.toggle=function(_relatedTarget){return this.isShown?this.hide():this.show(_relatedTarget)}
Modal.prototype.show=function(_relatedTarget){var that=this
var e=$.Event('show.bs.modal',{relatedTarget:_relatedTarget})
this.$element.trigger(e)
if(this.isShown||e.isDefaultPrevented())return
this.isShown=true
this.checkScrollbar()
this.$body.addClass('modal-open')
this.setScrollbar()
this.escape()
this.$element.on('click.dismiss.bs.modal','[data-dismiss="modal"]',$.proxy(this.hide,this))
this.backdrop(function(){var transition=$.support.transition&&that.$element.hasClass('fade')
if(!that.$element.parent().length){that.$element.appendTo(that.$body)}
that.$element.show().scrollTop(0)
if(transition){that.$element[0].offsetWidth}
that.$element.addClass('in').attr('aria-hidden',false)
that.enforceFocus()
var e=$.Event('shown.bs.modal',{relatedTarget:_relatedTarget})
transition?that.$element.find('.modal-dialog').one('bsTransitionEnd',function(){that.$element.trigger('focus').trigger(e)}).emulateTransitionEnd(300):that.$element.trigger('focus').trigger(e)})}
Modal.prototype.hide=function(e){if(e)e.preventDefault()
e=$.Event('hide.bs.modal')
this.$element.trigger(e)
if(!this.isShown||e.isDefaultPrevented())return
this.isShown=false
this.$body.removeClass('modal-open')
this.resetScrollbar()
this.escape()
$(document).off('focusin.bs.modal')
this.$element.removeClass('in').attr('aria-hidden',true).off('click.dismiss.bs.modal')
$.support.transition&&this.$element.hasClass('fade')?this.$element.one('bsTransitionEnd',$.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal()}
Modal.prototype.enforceFocus=function(){$(document).off('focusin.bs.modal').on('focusin.bs.modal',$.proxy(function(e){if(this.$element[0]!==e.target&&!this.$element.has(e.target).length){this.$element.trigger('focus')}},this))}
Modal.prototype.escape=function(){if(this.isShown&&this.options.keyboard){this.$element.on('keyup.dismiss.bs.modal',$.proxy(function(e){e.which==27&&this.hide()},this))}else if(!this.isShown){this.$element.off('keyup.dismiss.bs.modal')}}
Modal.prototype.hideModal=function(){var that=this
this.$element.hide()
this.backdrop(function(){that.$element.trigger('hidden.bs.modal')})}
Modal.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove()
this.$backdrop=null}
Modal.prototype.backdrop=function(callback){var that=this
var animate=this.$element.hasClass('fade')?'fade':''
if(this.isShown&&this.options.backdrop){var doAnimate=$.support.transition&&animate
this.$backdrop=$('<div class="modal-backdrop '+animate+'" />').appendTo(this.$body)
this.$element.on('click.dismiss.bs.modal',$.proxy(function(e){if(e.target!==e.currentTarget)return
this.options.backdrop=='static'?this.$element[0].focus.call(this.$element[0]):this.hide.call(this)},this))
if(doAnimate)this.$backdrop[0].offsetWidth
this.$backdrop.addClass('in')
if(!callback)return
doAnimate?this.$backdrop.one('bsTransitionEnd',callback).emulateTransitionEnd(150):callback()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass('in')
var callbackRemove=function(){that.removeBackdrop()
callback&&callback()}
$.support.transition&&this.$element.hasClass('fade')?this.$backdrop.one('bsTransitionEnd',callbackRemove).emulateTransitionEnd(150):callbackRemove()}else if(callback){callback()}}
Modal.prototype.checkScrollbar=function(){if(document.body.clientWidth>=window.innerWidth)return
this.scrollbarWidth=this.scrollbarWidth||this.measureScrollbar()}
Modal.prototype.setScrollbar=function(){var bodyPad=parseInt((this.$body.css('padding-right')||0),10)
if(this.scrollbarWidth)this.$body.css('padding-right',bodyPad+this.scrollbarWidth)}
Modal.prototype.resetScrollbar=function(){this.$body.css('padding-right','')}
Modal.prototype.measureScrollbar=function(){var scrollDiv=document.createElement('div')
scrollDiv.className='modal-scrollbar-measure'
this.$body.append(scrollDiv)
var scrollbarWidth=scrollDiv.offsetWidth-scrollDiv.clientWidth
this.$body[0].removeChild(scrollDiv)
return scrollbarWidth}
function Plugin(option,_relatedTarget){return this.each(function(){var $this=$(this)
var data=$this.data('bs.modal')
var options=$.extend({},Modal.DEFAULTS,$this.data(),typeof option=='object'&&option)
if(!data)$this.data('bs.modal',(data=new Modal(this,options)))
if(typeof option=='string')data[option](_relatedTarget)
else if(options.show)data.show(_relatedTarget)})}
var old=$.fn.modal
$.fn.modal=Plugin
$.fn.modal.Constructor=Modal
$.fn.modal.noConflict=function(){$.fn.modal=old
return this}
$(document).on('click.bs.modal.data-api','[data-toggle="modal"]',function(e){var $this=$(this)
var href=$this.attr('href')
var $target=$($this.attr('data-target')||(href&&href.replace(/.*(?=#[^\s]+$)/,'')))
var option=$target.data('bs.modal')?'toggle':$.extend({remote:!/#/.test(href)&&href},$target.data(),$this.data())
if($this.is('a'))e.preventDefault()
$target.one('show.bs.modal',function(showEvent){if(showEvent.isDefaultPrevented())return
$target.one('hidden.bs.modal',function(){$this.is(':visible')&&$this.trigger('focus')})})
Plugin.call($target,option,this)})}(jQuery);+function($){'use strict';var Tooltip=function(element,options){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null
this.init('tooltip',element,options)}
Tooltip.VERSION='3.2.0'
Tooltip.DEFAULTS={animation:true,placement:'top',selector:false,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:'hover focus',title:'',delay:0,html:false,container:false,viewport:{selector:'body',padding:0}}
Tooltip.prototype.init=function(type,element,options){this.enabled=true
this.type=type
this.$element=$(element)
this.options=this.getOptions(options)
this.$viewport=this.options.viewport&&$(this.options.viewport.selector||this.options.viewport)
var triggers=this.options.trigger.split(' ')
for(var i=triggers.length;i--;){var trigger=triggers[i]
if(trigger=='click'){this.$element.on('click.'+this.type,this.options.selector,$.proxy(this.toggle,this))}else if(trigger!='manual'){var eventIn=trigger=='hover'?'mouseenter':'focusin'
var eventOut=trigger=='hover'?'mouseleave':'focusout'
this.$element.on(eventIn+'.'+this.type,this.options.selector,$.proxy(this.enter,this))
this.$element.on(eventOut+'.'+this.type,this.options.selector,$.proxy(this.leave,this))}}
this.options.selector?(this._options=$.extend({},this.options,{trigger:'manual',selector:''})):this.fixTitle()}
Tooltip.prototype.getDefaults=function(){return Tooltip.DEFAULTS}
Tooltip.prototype.getOptions=function(options){options=$.extend({},this.getDefaults(),this.$element.data(),options)
if(options.delay&&typeof options.delay=='number'){options.delay={show:options.delay,hide:options.delay}}
return options}
Tooltip.prototype.getDelegateOptions=function(){var options={}
var defaults=this.getDefaults()
this._options&&$.each(this._options,function(key,value){if(defaults[key]!=value)options[key]=value})
return options}
Tooltip.prototype.enter=function(obj){var self=obj instanceof this.constructor?obj:$(obj.currentTarget).data('bs.'+this.type)
if(!self){self=new this.constructor(obj.currentTarget,this.getDelegateOptions())
$(obj.currentTarget).data('bs.'+this.type,self)}
clearTimeout(self.timeout)
self.hoverState='in'
if(!self.options.delay||!self.options.delay.show)return self.show()
self.timeout=setTimeout(function(){if(self.hoverState=='in')self.show()},self.options.delay.show)}
Tooltip.prototype.leave=function(obj){var self=obj instanceof this.constructor?obj:$(obj.currentTarget).data('bs.'+this.type)
if(!self){self=new this.constructor(obj.currentTarget,this.getDelegateOptions())
$(obj.currentTarget).data('bs.'+this.type,self)}
clearTimeout(self.timeout)
self.hoverState='out'
if(!self.options.delay||!self.options.delay.hide)return self.hide()
self.timeout=setTimeout(function(){if(self.hoverState=='out')self.hide()},self.options.delay.hide)}
Tooltip.prototype.show=function(){var e=$.Event('show.bs.'+this.type)
if(this.hasContent()&&this.enabled){this.$element.trigger(e)
var inDom=$.contains(document.documentElement,this.$element[0])
if(e.isDefaultPrevented()||!inDom)return
var that=this
var $tip=this.tip()
var tipId=this.getUID(this.type)
this.setContent()
$tip.attr('id',tipId)
this.$element.attr('aria-describedby',tipId)
if(this.options.animation)$tip.addClass('fade')
var placement=typeof this.options.placement=='function'?this.options.placement.call(this,$tip[0],this.$element[0]):this.options.placement
var autoToken=/\s?auto?\s?/i
var autoPlace=autoToken.test(placement)
if(autoPlace)placement=placement.replace(autoToken,'')||'top'
$tip.detach().css({top:0,left:0,display:'block'}).addClass(placement).data('bs.'+this.type,this)
this.options.container?$tip.appendTo(this.options.container):$tip.insertAfter(this.$element)
var pos=this.getPosition()
var actualWidth=$tip[0].offsetWidth
var actualHeight=$tip[0].offsetHeight
if(autoPlace){var orgPlacement=placement
var $parent=this.$element.parent()
var parentDim=this.getPosition($parent)
placement=placement=='bottom'&&pos.top+pos.height+actualHeight-parentDim.scroll>parentDim.height?'top':placement=='top'&&pos.top-parentDim.scroll-actualHeight<0?'bottom':placement=='right'&&pos.right+actualWidth>parentDim.width?'left':placement=='left'&&pos.left-actualWidth<parentDim.left?'right':placement
$tip.removeClass(orgPlacement).addClass(placement)}
var calculatedOffset=this.getCalculatedOffset(placement,pos,actualWidth,actualHeight)
this.applyPlacement(calculatedOffset,placement)
var complete=function(){that.$element.trigger('shown.bs.'+that.type)
that.hoverState=null}
$.support.transition&&this.$tip.hasClass('fade')?$tip.one('bsTransitionEnd',complete).emulateTransitionEnd(150):complete()}}
Tooltip.prototype.applyPlacement=function(offset,placement){var $tip=this.tip()
var width=$tip[0].offsetWidth
var height=$tip[0].offsetHeight
var marginTop=parseInt($tip.css('margin-top'),10)
var marginLeft=parseInt($tip.css('margin-left'),10)
if(isNaN(marginTop))marginTop=0
if(isNaN(marginLeft))marginLeft=0
offset.top=offset.top+marginTop
offset.left=offset.left+marginLeft
$.offset.setOffset($tip[0],$.extend({using:function(props){$tip.css({top:Math.round(props.top),left:Math.round(props.left)})}},offset),0)
$tip.addClass('in')
var actualWidth=$tip[0].offsetWidth
var actualHeight=$tip[0].offsetHeight
if(placement=='top'&&actualHeight!=height){offset.top=offset.top+height-actualHeight}
var delta=this.getViewportAdjustedDelta(placement,offset,actualWidth,actualHeight)
if(delta.left)offset.left+=delta.left
else offset.top+=delta.top
var arrowDelta=delta.left?delta.left*2-width+actualWidth:delta.top*2-height+actualHeight
var arrowPosition=delta.left?'left':'top'
var arrowOffsetPosition=delta.left?'offsetWidth':'offsetHeight'
$tip.offset(offset)
this.replaceArrow(arrowDelta,$tip[0][arrowOffsetPosition],arrowPosition)}
Tooltip.prototype.replaceArrow=function(delta,dimension,position){this.arrow().css(position,delta?(50*(1-delta/dimension)+'%'):'')}
Tooltip.prototype.setContent=function(){var $tip=this.tip()
var title=this.getTitle()
$tip.find('.tooltip-inner')[this.options.html?'html':'text'](title)
$tip.removeClass('fade in top bottom left right')}
Tooltip.prototype.hide=function(){var that=this
var $tip=this.tip()
var e=$.Event('hide.bs.'+this.type)
this.$element.removeAttr('aria-describedby')
function complete(){if(that.hoverState!='in')$tip.detach()
that.$element.trigger('hidden.bs.'+that.type)}
this.$element.trigger(e)
if(e.isDefaultPrevented())return
$tip.removeClass('in')
$.support.transition&&this.$tip.hasClass('fade')?$tip.one('bsTransitionEnd',complete).emulateTransitionEnd(150):complete()
this.hoverState=null
return this}
Tooltip.prototype.fixTitle=function(){var $e=this.$element
if($e.attr('title')||typeof($e.attr('data-original-title'))!='string'){$e.attr('data-original-title',$e.attr('title')||'').attr('title','')}}
Tooltip.prototype.hasContent=function(){return this.getTitle()}
Tooltip.prototype.getPosition=function($element){$element=$element||this.$element
var el=$element[0]
var isBody=el.tagName=='BODY'
return $.extend({},(typeof el.getBoundingClientRect=='function')?el.getBoundingClientRect():null,{scroll:isBody?document.documentElement.scrollTop||document.body.scrollTop:$element.scrollTop(),width:isBody?$(window).width():$element.outerWidth(),height:isBody?$(window).height():$element.outerHeight()},isBody?{top:0,left:0}:$element.offset())}
Tooltip.prototype.getCalculatedOffset=function(placement,pos,actualWidth,actualHeight){return placement=='bottom'?{top:pos.top+pos.height,left:pos.left+pos.width/2-actualWidth/2}:placement=='top'?{top:pos.top-actualHeight,left:pos.left+pos.width/2-actualWidth/2}:placement=='left'?{top:pos.top+pos.height/2-actualHeight/2,left:pos.left-actualWidth}:{top:pos.top+pos.height/2-actualHeight/2,left:pos.left+pos.width}}
Tooltip.prototype.getViewportAdjustedDelta=function(placement,pos,actualWidth,actualHeight){var delta={top:0,left:0}
if(!this.$viewport)return delta
var viewportPadding=this.options.viewport&&this.options.viewport.padding||0
var viewportDimensions=this.getPosition(this.$viewport)
if(/right|left/.test(placement)){var topEdgeOffset=pos.top-viewportPadding-viewportDimensions.scroll
var bottomEdgeOffset=pos.top+viewportPadding-viewportDimensions.scroll+actualHeight
if(topEdgeOffset<viewportDimensions.top){delta.top=viewportDimensions.top-topEdgeOffset}else if(bottomEdgeOffset>viewportDimensions.top+viewportDimensions.height){delta.top=viewportDimensions.top+viewportDimensions.height-bottomEdgeOffset}}else{var leftEdgeOffset=pos.left-viewportPadding
var rightEdgeOffset=pos.left+viewportPadding+actualWidth
if(leftEdgeOffset<viewportDimensions.left){delta.left=viewportDimensions.left-leftEdgeOffset}else if(rightEdgeOffset>viewportDimensions.width){delta.left=viewportDimensions.left+viewportDimensions.width-rightEdgeOffset}}
return delta}
Tooltip.prototype.getTitle=function(){var title
var $e=this.$element
var o=this.options
title=$e.attr('data-original-title')||(typeof o.title=='function'?o.title.call($e[0]):o.title)
return title}
Tooltip.prototype.getUID=function(prefix){do prefix+=~~(Math.random()*1000000)
while(document.getElementById(prefix))
return prefix}
Tooltip.prototype.tip=function(){return(this.$tip=this.$tip||$(this.options.template))}
Tooltip.prototype.arrow=function(){return(this.$arrow=this.$arrow||this.tip().find('.tooltip-arrow'))}
Tooltip.prototype.validate=function(){if(!this.$element[0].parentNode){this.hide()
this.$element=null
this.options=null}}
Tooltip.prototype.enable=function(){this.enabled=true}
Tooltip.prototype.disable=function(){this.enabled=false}
Tooltip.prototype.toggleEnabled=function(){this.enabled=!this.enabled}
Tooltip.prototype.toggle=function(e){var self=this
if(e){self=$(e.currentTarget).data('bs.'+this.type)
if(!self){self=new this.constructor(e.currentTarget,this.getDelegateOptions())
$(e.currentTarget).data('bs.'+this.type,self)}}
self.tip().hasClass('in')?self.leave(self):self.enter(self)}
Tooltip.prototype.destroy=function(){clearTimeout(this.timeout)
this.hide().$element.off('.'+this.type).removeData('bs.'+this.type)}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.tooltip')
var options=typeof option=='object'&&option
if(!data&&option=='destroy')return
if(!data)$this.data('bs.tooltip',(data=new Tooltip(this,options)))
if(typeof option=='string')data[option]()})}
var old=$.fn.tooltip
$.fn.tooltip=Plugin
$.fn.tooltip.Constructor=Tooltip
$.fn.tooltip.noConflict=function(){$.fn.tooltip=old
return this}}(jQuery);+function($){'use strict';var Popover=function(element,options){this.init('popover',element,options)}
if(!$.fn.tooltip)throw new Error('Popover requires tooltip.js')
Popover.VERSION='3.2.0'
Popover.DEFAULTS=$.extend({},$.fn.tooltip.Constructor.DEFAULTS,{placement:'right',trigger:'click',content:'',template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'})
Popover.prototype=$.extend({},$.fn.tooltip.Constructor.prototype)
Popover.prototype.constructor=Popover
Popover.prototype.getDefaults=function(){return Popover.DEFAULTS}
Popover.prototype.setContent=function(){var $tip=this.tip()
var title=this.getTitle()
var content=this.getContent()
$tip.find('.popover-title')[this.options.html?'html':'text'](title)
$tip.find('.popover-content').empty()[this.options.html?(typeof content=='string'?'html':'append'):'text'](content)
$tip.removeClass('fade top bottom left right in')
if(!$tip.find('.popover-title').html())$tip.find('.popover-title').hide()}
Popover.prototype.hasContent=function(){return this.getTitle()||this.getContent()}
Popover.prototype.getContent=function(){var $e=this.$element
var o=this.options
return $e.attr('data-content')||(typeof o.content=='function'?o.content.call($e[0]):o.content)}
Popover.prototype.arrow=function(){return(this.$arrow=this.$arrow||this.tip().find('.arrow'))}
Popover.prototype.tip=function(){if(!this.$tip)this.$tip=$(this.options.template)
return this.$tip}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.popover')
var options=typeof option=='object'&&option
if(!data&&option=='destroy')return
if(!data)$this.data('bs.popover',(data=new Popover(this,options)))
if(typeof option=='string')data[option]()})}
var old=$.fn.popover
$.fn.popover=Plugin
$.fn.popover.Constructor=Popover
$.fn.popover.noConflict=function(){$.fn.popover=old
return this}}(jQuery);+function($){'use strict';function ScrollSpy(element,options){var process=$.proxy(this.process,this)
this.$body=$('body')
this.$scrollElement=$(element).is('body')?$(window):$(element)
this.options=$.extend({},ScrollSpy.DEFAULTS,options)
this.selector=(this.options.target||'')+' .nav li > a'
this.offsets=[]
this.targets=[]
this.activeTarget=null
this.scrollHeight=0
this.$scrollElement.on('scroll.bs.scrollspy',process)
this.refresh()
this.process()}
ScrollSpy.VERSION='3.2.0'
ScrollSpy.DEFAULTS={offset:10}
ScrollSpy.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)}
ScrollSpy.prototype.refresh=function(){var offsetMethod='offset'
var offsetBase=0
if(!$.isWindow(this.$scrollElement[0])){offsetMethod='position'
offsetBase=this.$scrollElement.scrollTop()}
this.offsets=[]
this.targets=[]
this.scrollHeight=this.getScrollHeight()
var self=this
this.$body.find(this.selector).map(function(){var $el=$(this)
var href=$el.data('target')||$el.attr('href')
var $href=/^#./.test(href)&&$(href)
return($href&&$href.length&&$href.is(':visible')&&[[$href[offsetMethod]().top+offsetBase,href]])||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){self.offsets.push(this[0])
self.targets.push(this[1])})}
ScrollSpy.prototype.process=function(){var scrollTop=this.$scrollElement.scrollTop()+this.options.offset
var scrollHeight=this.getScrollHeight()
var maxScroll=this.options.offset+scrollHeight-this.$scrollElement.height()
var offsets=this.offsets
var targets=this.targets
var activeTarget=this.activeTarget
var i
if(this.scrollHeight!=scrollHeight){this.refresh()}
if(scrollTop>=maxScroll){return activeTarget!=(i=targets[targets.length-1])&&this.activate(i)}
if(activeTarget&&scrollTop<=offsets[0]){return activeTarget!=(i=targets[0])&&this.activate(i)}
for(i=offsets.length;i--;){activeTarget!=targets[i]&&scrollTop>=offsets[i]&&(!offsets[i+1]||scrollTop<=offsets[i+1])&&this.activate(targets[i])}}
ScrollSpy.prototype.activate=function(target){this.activeTarget=target
$(this.selector).parentsUntil(this.options.target,'.active').removeClass('active')
var selector=this.selector+'[data-target="'+target+'"],'+
this.selector+'[href="'+target+'"]'
var active=$(selector).parents('li').addClass('active')
if(active.parent('.dropdown-menu').length){active=active.closest('li.dropdown').addClass('active')}
active.trigger('activate.bs.scrollspy')}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.scrollspy')
var options=typeof option=='object'&&option
if(!data)$this.data('bs.scrollspy',(data=new ScrollSpy(this,options)))
if(typeof option=='string')data[option]()})}
var old=$.fn.scrollspy
$.fn.scrollspy=Plugin
$.fn.scrollspy.Constructor=ScrollSpy
$.fn.scrollspy.noConflict=function(){$.fn.scrollspy=old
return this}
$(window).on('load.bs.scrollspy.data-api',function(){$('[data-spy="scroll"]').each(function(){var $spy=$(this)
Plugin.call($spy,$spy.data())})})}(jQuery);+function($){'use strict';var Tab=function(element){this.element=$(element)}
Tab.VERSION='3.2.0'
Tab.prototype.show=function(){var $this=this.element
var $ul=$this.closest('ul:not(.dropdown-menu)')
var selector=$this.data('target')
if(!selector){selector=$this.attr('href')
selector=selector&&selector.replace(/.*(?=#[^\s]*$)/,'')}
if($this.parent('li').hasClass('active'))return
var previous=$ul.find('.active:last a')[0]
var e=$.Event('show.bs.tab',{relatedTarget:previous})
$this.trigger(e)
if(e.isDefaultPrevented())return
var $target=$(selector)
this.activate($this.closest('li'),$ul)
this.activate($target,$target.parent(),function(){$this.trigger({type:'shown.bs.tab',relatedTarget:previous})})}
Tab.prototype.activate=function(element,container,callback){var $active=container.find('> .active')
var transition=callback&&$.support.transition&&$active.hasClass('fade')
function next(){$active.removeClass('active').find('> .dropdown-menu > .active').removeClass('active')
element.addClass('active')
if(transition){element[0].offsetWidth
element.addClass('in')}else{element.removeClass('fade')}
if(element.parent('.dropdown-menu')){element.closest('li.dropdown').addClass('active')}
callback&&callback()}
transition?$active.one('bsTransitionEnd',next).emulateTransitionEnd(150):next()
$active.removeClass('in')}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.tab')
if(!data)$this.data('bs.tab',(data=new Tab(this)))
if(typeof option=='string')data[option]()})}
var old=$.fn.tab
$.fn.tab=Plugin
$.fn.tab.Constructor=Tab
$.fn.tab.noConflict=function(){$.fn.tab=old
return this}
$(document).on('click.bs.tab.data-api','[data-toggle="tab"], [data-toggle="pill"]',function(e){e.preventDefault()
Plugin.call($(this),'show')})}(jQuery);+function($){'use strict';var Affix=function(element,options){this.options=$.extend({},Affix.DEFAULTS,options)
this.$target=$(this.options.target).on('scroll.bs.affix.data-api',$.proxy(this.checkPosition,this)).on('click.bs.affix.data-api',$.proxy(this.checkPositionWithEventLoop,this))
this.$element=$(element)
this.affixed=this.unpin=this.pinnedOffset=null
this.checkPosition()}
Affix.VERSION='3.2.0'
Affix.RESET='affix affix-top affix-bottom'
Affix.DEFAULTS={offset:0,target:window}
Affix.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset
this.$element.removeClass(Affix.RESET).addClass('affix')
var scrollTop=this.$target.scrollTop()
var position=this.$element.offset()
return(this.pinnedOffset=position.top-scrollTop)}
Affix.prototype.checkPositionWithEventLoop=function(){setTimeout($.proxy(this.checkPosition,this),1)}
Affix.prototype.checkPosition=function(){if(!this.$element.is(':visible'))return
var scrollHeight=$(document).height()
var scrollTop=this.$target.scrollTop()
var position=this.$element.offset()
var offset=this.options.offset
var offsetTop=offset.top
var offsetBottom=offset.bottom
if(typeof offset!='object')offsetBottom=offsetTop=offset
if(typeof offsetTop=='function')offsetTop=offset.top(this.$element)
if(typeof offsetBottom=='function')offsetBottom=offset.bottom(this.$element)
var affix=this.unpin!=null&&(scrollTop+this.unpin<=position.top)?false:offsetBottom!=null&&(position.top+this.$element.height()>=scrollHeight-offsetBottom)?'bottom':offsetTop!=null&&(scrollTop<=offsetTop)?'top':false
if(this.affixed===affix)return
if(this.unpin!=null)this.$element.css('top','')
var affixType='affix'+(affix?'-'+affix:'')
var e=$.Event(affixType+'.bs.affix')
this.$element.trigger(e)
if(e.isDefaultPrevented())return
this.affixed=affix
this.unpin=affix=='bottom'?this.getPinnedOffset():null
this.$element.removeClass(Affix.RESET).addClass(affixType).trigger($.Event(affixType.replace('affix','affixed')))
if(affix=='bottom'){this.$element.offset({top:scrollHeight-this.$element.height()-offsetBottom})}}
function Plugin(option){return this.each(function(){var $this=$(this)
var data=$this.data('bs.affix')
var options=typeof option=='object'&&option
if(!data)$this.data('bs.affix',(data=new Affix(this,options)))
if(typeof option=='string')data[option]()})}
var old=$.fn.affix
$.fn.affix=Plugin
$.fn.affix.Constructor=Affix
$.fn.affix.noConflict=function(){$.fn.affix=old
return this}
$(window).on('load',function(){$('[data-spy="affix"]').each(function(){var $spy=$(this)
var data=$spy.data()
data.offset=data.offset||{}
if(data.offsetBottom)data.offset.bottom=data.offsetBottom
if(data.offsetTop)data.offset.top=data.offsetTop
Plugin.call($spy,data)})})}(jQuery);(function(root,factory){"use strict";if(typeof define==="function"&&define.amd){define(["jquery"],factory);}else if(typeof exports==="object"){module.exports=factory(require("jquery"));}else{root.bootbox=factory(root.jQuery);}}(this,function init($,undefined){"use strict";var templates={dialog:"<div class='bootbox modal' tabindex='-1' role='dialog'>"+"<div class='modal-dialog'>"+"<div class='modal-content'>"+"<div class='modal-body'><div class='bootbox-body'></div></div>"+"</div>"+"</div>"+"</div>",header:"<div class='modal-header'>"+"<h4 class='modal-title'></h4>"+"</div>",footer:"<div class='modal-footer'></div>",closeButton:"<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>",form:"<form class='bootbox-form'></form>",inputs:{text:"<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",textarea:"<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",email:"<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",select:"<select class='bootbox-input bootbox-input-select form-control'></select>",checkbox:"<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",date:"<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",time:"<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",number:"<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",password:"<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"}};var defaults={locale:"en",backdrop:true,animate:true,className:null,closeButton:true,show:true,container:"body"};var exports={};function _t(key){var locale=locales[defaults.locale];return locale?locale[key]:locales.en[key];}
function processCallback(e,dialog,callback){e.stopPropagation();e.preventDefault();var preserveDialog=$.isFunction(callback)&&callback(e)===false;if(!preserveDialog){dialog.modal("hide");}}
function getKeyLength(obj){var k,t=0;for(k in obj){t++;}
return t;}
function each(collection,iterator){var index=0;$.each(collection,function(key,value){iterator(key,value,index++);});}
function sanitize(options){var buttons;var total;if(typeof options!=="object"){throw new Error("Please supply an object of options");}
if(!options.message){throw new Error("Please specify a message");}
options=$.extend({},defaults,options);if(!options.buttons){options.buttons={};}
options.backdrop=options.backdrop?"static":false;buttons=options.buttons;total=getKeyLength(buttons);each(buttons,function(key,button,index){if($.isFunction(button)){button=buttons[key]={callback:button};}
if($.type(button)!=="object"){throw new Error("button with key "+key+" must be an object");}
if(!button.label){button.label=key;}
if(!button.className){if(total<=2&&index===total-1){button.className="btn-primary";}else{button.className="btn-default";}}});return options;}
function mapArguments(args,properties){var argn=args.length;var options={};if(argn<1||argn>2){throw new Error("Invalid argument length");}
if(argn===2||typeof args[0]==="string"){options[properties[0]]=args[0];options[properties[1]]=args[1];}else{options=args[0];}
return options;}
function mergeArguments(defaults,args,properties){return $.extend(true,{},defaults,mapArguments(args,properties));}
function mergeDialogOptions(className,labels,properties,args){var baseOptions={className:"bootbox-"+className,buttons:createLabels.apply(null,labels)};return validateButtons(mergeArguments(baseOptions,args,properties),labels);}
function createLabels(){var buttons={};for(var i=0,j=arguments.length;i<j;i++){var argument=arguments[i];var key=argument.toLowerCase();var value=argument.toUpperCase();buttons[key]={label:_t(value)};}
return buttons;}
function validateButtons(options,buttons){var allowedButtons={};each(buttons,function(key,value){allowedButtons[value]=true;});each(options.buttons,function(key){if(allowedButtons[key]===undefined){throw new Error("button key "+key+" is not allowed (options are "+buttons.join("\n")+")");}});return options;}
exports.alert=function(){var options;options=mergeDialogOptions("alert",["ok"],["message","callback"],arguments);if(options.callback&&!$.isFunction(options.callback)){throw new Error("alert requires callback property to be a function when provided");}
options.buttons.ok.callback=options.onEscape=function(){if($.isFunction(options.callback)){return options.callback();}
return true;};return exports.dialog(options);};exports.confirm=function(){var options;options=mergeDialogOptions("confirm",["cancel","confirm"],["message","callback"],arguments);options.buttons.cancel.callback=options.onEscape=function(){return options.callback(false);};options.buttons.confirm.callback=function(){return options.callback(true);};if(!$.isFunction(options.callback)){throw new Error("confirm requires a callback");}
return exports.dialog(options);};exports.prompt=function(){var options;var defaults;var dialog;var form;var input;var shouldShow;var inputOptions;form=$(templates.form);defaults={className:"bootbox-prompt",buttons:createLabels("cancel","confirm"),value:"",inputType:"text"};options=validateButtons(mergeArguments(defaults,arguments,["title","callback"]),["cancel","confirm"]);shouldShow=(options.show===undefined)?true:options.show;options.message=form;options.buttons.cancel.callback=options.onEscape=function(){return options.callback(null);};options.buttons.confirm.callback=function(){var value;switch(options.inputType){case"text":case"textarea":case"email":case"select":case"date":case"time":case"number":case"password":value=input.val();break;case"checkbox":var checkedItems=input.find("input:checked");value=[];each(checkedItems,function(_,item){value.push($(item).val());});break;}
return options.callback(value);};options.show=false;if(!options.title){throw new Error("prompt requires a title");}
if(!$.isFunction(options.callback)){throw new Error("prompt requires a callback");}
if(!templates.inputs[options.inputType]){throw new Error("invalid prompt type");}
input=$(templates.inputs[options.inputType]);switch(options.inputType){case"text":case"textarea":case"email":case"date":case"time":case"number":case"password":input.val(options.value);break;case"select":var groups={};inputOptions=options.inputOptions||[];if(!inputOptions.length){throw new Error("prompt with select requires options");}
each(inputOptions,function(_,option){var elem=input;if(option.value===undefined||option.text===undefined){throw new Error("given options in wrong format");}
if(option.group){if(!groups[option.group]){groups[option.group]=$("<optgroup/>").attr("label",option.group);}
elem=groups[option.group];}
elem.append("<option value='"+option.value+"'>"+option.text+"</option>");});each(groups,function(_,group){input.append(group);});input.val(options.value);break;case"checkbox":var values=$.isArray(options.value)?options.value:[options.value];inputOptions=options.inputOptions||[];if(!inputOptions.length){throw new Error("prompt with checkbox requires options");}
if(!inputOptions[0].value||!inputOptions[0].text){throw new Error("given options in wrong format");}
input=$("<div/>");each(inputOptions,function(_,option){var checkbox=$(templates.inputs[options.inputType]);checkbox.find("input").attr("value",option.value);checkbox.find("label").append(option.text);each(values,function(_,value){if(value===option.value){checkbox.find("input").prop("checked",true);}});input.append(checkbox);});break;}
if(options.placeholder){input.attr("placeholder",options.placeholder);}
if(options.pattern){input.attr("pattern",options.pattern);}
form.append(input);form.on("submit",function(e){e.preventDefault();e.stopPropagation();dialog.find(".btn-primary").click();});dialog=exports.dialog(options);dialog.off("shown.bs.modal");dialog.on("shown.bs.modal",function(){input.focus();});if(shouldShow===true){dialog.modal("show");}
return dialog;};exports.dialog=function(options){options=sanitize(options);var dialog=$(templates.dialog);var innerDialog=dialog.find(".modal-dialog");var body=dialog.find(".modal-body");var buttons=options.buttons;var buttonStr="";var callbacks={onEscape:options.onEscape};each(buttons,function(key,button){buttonStr+="<button data-bb-handler='"+key+"' type='button' class='btn "+button.className+"'>"+button.label+"</button>";callbacks[key]=button.callback;});body.find(".bootbox-body").html(options.message);if(options.animate===true){dialog.addClass("fade");}
if(options.className){dialog.addClass(options.className);}
if(options.size==="large"){innerDialog.addClass("modal-lg");}
if(options.size==="small"){innerDialog.addClass("modal-sm");}
if(options.title){body.before(templates.header);}
if(options.closeButton){var closeButton=$(templates.closeButton);if(options.title){dialog.find(".modal-header").prepend(closeButton);}else{closeButton.css("margin-top","-10px").prependTo(body);}}
if(options.title){dialog.find(".modal-title").html(options.title);}
if(buttonStr.length){body.after(templates.footer);dialog.find(".modal-footer").html(buttonStr);}
dialog.on("hidden.bs.modal",function(e){if(e.target===this){dialog.remove();}});dialog.on("shown.bs.modal",function(){dialog.find(".btn-primary:first").focus();});dialog.on("escape.close.bb",function(e){if(callbacks.onEscape){processCallback(e,dialog,callbacks.onEscape);}});dialog.on("click",".modal-footer button",function(e){var callbackKey=$(this).data("bb-handler");processCallback(e,dialog,callbacks[callbackKey]);});dialog.on("click",".bootbox-close-button",function(e){processCallback(e,dialog,callbacks.onEscape);});dialog.on("keyup",function(e){if(e.which===27){dialog.trigger("escape.close.bb");}});$(options.container).append(dialog);dialog.modal({backdrop:options.backdrop,keyboard:false,show:false});if(options.show){dialog.modal("show");}
return dialog;};exports.setDefaults=function(){var values={};if(arguments.length===2){values[arguments[0]]=arguments[1];}else{values=arguments[0];}
$.extend(defaults,values);};exports.hideAll=function(){$(".bootbox").modal("hide");return exports;};var locales={br:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Sim"},cs:{OK:"OK",CANCEL:"Zrušit",CONFIRM:"Potvrdit"},da:{OK:"OK",CANCEL:"Annuller",CONFIRM:"Accepter"},de:{OK:"OK",CANCEL:"Abbrechen",CONFIRM:"Akzeptieren"},el:{OK:"Εντάξει",CANCEL:"Ακύρωση",CONFIRM:"Επιβεβαίωση"},en:{OK:"OK",CANCEL:"Cancel",CONFIRM:"OK"},es:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Aceptar"},et:{OK:"OK",CANCEL:"Katkesta",CONFIRM:"OK"},fi:{OK:"OK",CANCEL:"Peruuta",CONFIRM:"OK"},fr:{OK:"OK",CANCEL:"Annuler",CONFIRM:"D'accord"},he:{OK:"אישור",CANCEL:"ביטול",CONFIRM:"אישור"},id:{OK:"OK",CANCEL:"Batal",CONFIRM:"OK"},it:{OK:"OK",CANCEL:"Annulla",CONFIRM:"Conferma"},ja:{OK:"OK",CANCEL:"キャンセル",CONFIRM:"確認"},lt:{OK:"Gerai",CANCEL:"Atšaukti",CONFIRM:"Patvirtinti"},lv:{OK:"Labi",CANCEL:"Atcelt",CONFIRM:"Apstiprināt"},nl:{OK:"OK",CANCEL:"Annuleren",CONFIRM:"Accepteren"},no:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},pl:{OK:"OK",CANCEL:"Anuluj",CONFIRM:"Potwierdź"},pt:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Confirmar"},ru:{OK:"OK",CANCEL:"Отмена",CONFIRM:"Применить"},sv:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},tr:{OK:"Tamam",CANCEL:"İptal",CONFIRM:"Onayla"},zh_CN:{OK:"OK",CANCEL:"取消",CONFIRM:"确认"},zh_TW:{OK:"OK",CANCEL:"取消",CONFIRM:"確認"}};exports.init=function(_$){return init(_$||$);};return exports;}));