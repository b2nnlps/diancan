/*!
 * iScroll v4.2.2 ~ Copyright (c) 2012 Matteo Spinelli, http://cubiq.org
 * Released under MIT license, http://cubiq.org/license
 */
(function(window, doc){
    var m = Math,_bindArr = [],
        dummyStyle = doc.createElement('div').style,
        vendor = (function () {
            var vendors = 't,webkitT,MozT,msT,OT'.split(','),
                t,
                i = 0,
                l = vendors.length;

            for ( ; i < l; i++ ) {
                t = vendors[i] + 'ransform';
                if ( t in dummyStyle ) {
                    return vendors[i].substr(0, vendors[i].length - 1);
                }
            }

            return false;
        })(),
        cssVendor = vendor ? '-' + vendor.toLowerCase() + '-' : '',


    // Style properties
        transform = prefixStyle('transform'),
        transitionProperty = prefixStyle('transitionProperty'),
        transitionDuration = prefixStyle('transitionDuration'),
        transformOrigin = prefixStyle('transformOrigin'),
        transitionTimingFunction = prefixStyle('transitionTimingFunction'),
        transitionDelay = prefixStyle('transitionDelay'),

    // Browser capabilities
        isAndroid = (/android/gi).test(navigator.appVersion),
        isTouchPad = (/hp-tablet/gi).test(navigator.appVersion),

        has3d = prefixStyle('perspective') in dummyStyle,
        hasTouch = 'ontouchstart' in window && !isTouchPad,
        hasTransform = !!vendor,
        hasTransitionEnd = prefixStyle('transition') in dummyStyle,

        RESIZE_EV = 'onorientationchange' in window ? 'orientationchange' : 'resize',
        START_EV = hasTouch ? 'touchstart' : 'mousedown',
        MOVE_EV = hasTouch ? 'touchmove' : 'mousemove',
        END_EV = hasTouch ? 'touchend' : 'mouseup',
        CANCEL_EV = hasTouch ? 'touchcancel' : 'mouseup',
        TRNEND_EV = (function () {
            if ( vendor === false ) return false;

            var transitionEnd = {
                ''			: 'transitionend',
                'webkit'	: 'webkitTransitionEnd',
                'Moz'		: 'transitionend',
                'O'			: 'otransitionend',
                'ms'		: 'MSTransitionEnd'
            };

            return transitionEnd[vendor];
        })(),

        nextFrame = (function() {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimationFrame ||
                function(callback) { return setTimeout(callback, 1); };
        })(),
        cancelFrame = (function () {
            return window.cancelRequestAnimationFrame ||
                window.webkitCancelAnimationFrame ||
                window.webkitCancelRequestAnimationFrame ||
                window.mozCancelRequestAnimationFrame ||
                window.oCancelRequestAnimationFrame ||
                window.msCancelRequestAnimationFrame ||
                clearTimeout;
        })(),

    // Helpers
        translateZ = has3d ? ' translateZ(0)' : '',

    // Constructor
        iScroll = function (el, options) {
            var that = this,
                i;

            that.wrapper = typeof el == 'object' ? el : doc.getElementById(el);
            that.wrapper.style.overflow = 'hidden';
            that.scroller = that.wrapper.children[0];

            that.translateZ = translateZ;
            // Default options
            that.options = {
                hScroll: true,
                vScroll: true,
                x: 0,
                y: 0,
                bounce: true,
                bounceLock: false,
                momentum: true,
                lockDirection: true,
                useTransform: true,
                useTransition: false,
                topOffset: 0,
                checkDOMChanges: false,		// Experimental
                handleClick: true,


                // Events
                onRefresh: null,
                onBeforeScrollStart: function (e) { e.preventDefault(); },
                onScrollStart: null,
                onBeforeScrollMove: null,
                onScrollMove: null,
                onBeforeScrollEnd: null,
                onScrollEnd: null,
                onTouchEnd: null,
                onDestroy: null

            };

            // User defined options
            for (i in options) that.options[i] = options[i];

            // Set starting position
            that.x = that.options.x;
            that.y = that.options.y;

            // Normalize options
            that.options.useTransform = hasTransform && that.options.useTransform;

            that.options.useTransition = hasTransitionEnd && that.options.useTransition;



            // Set some default styles
            that.scroller.style[transitionProperty] = that.options.useTransform ? cssVendor + 'transform' : 'top left';
            that.scroller.style[transitionDuration] = '0';
            that.scroller.style[transformOrigin] = '0 0';
            if (that.options.useTransition) that.scroller.style[transitionTimingFunction] = 'cubic-bezier(0.33,0.66,0.66,1)';

            if (that.options.useTransform) that.scroller.style[transform] = 'translate(' + that.x + 'px,' + that.y + 'px)' + translateZ;
            else that.scroller.style.cssText += ';position:absolute;top:' + that.y + 'px;left:' + that.x + 'px';



            that.refresh();

            that._bind(RESIZE_EV, window);
            that._bind(START_EV);


            if (that.options.checkDOMChanges) that.checkDOMTime = setInterval(function () {
                that._checkDOMChanges();
            }, 500);
        };

// Prototype
    iScroll.prototype = {
        enabled: true,
        x: 0,
        y: 0,
        steps: [],
        scale: 1,
        currPageX: 0, currPageY: 0,
        pagesX: [], pagesY: [],
        aniTime: null,
        isStopScrollAction:false,

        handleEvent: function (e) {
            var that = this;
            switch(e.type) {
                case START_EV:
                    if (!hasTouch && e.button !== 0) return;
                    that._start(e);
                    break;
                case MOVE_EV: that._move(e); break;
                case END_EV:
                case CANCEL_EV: that._end(e); break;
                case RESIZE_EV: that._resize(); break;
                case TRNEND_EV: that._transitionEnd(e); break;
            }
        },

        _checkDOMChanges: function () {
            if (this.moved ||  this.animating ||
                (this.scrollerW == this.scroller.offsetWidth * this.scale && this.scrollerH == this.scroller.offsetHeight * this.scale)) return;

            this.refresh();
        },

        _resize: function () {
            var that = this;
            setTimeout(function () { that.refresh(); }, isAndroid ? 200 : 0);
        },

        _pos: function (x, y) {
            x = this.hScroll ? x : 0;
            y = this.vScroll ? y : 0;

            if (this.options.useTransform) {
                this.scroller.style[transform] = 'translate(' + x + 'px,' + y + 'px) scale(' + this.scale + ')' + translateZ;
            } else {
                x = m.round(x);
                y = m.round(y);
                this.scroller.style.left = x + 'px';
                this.scroller.style.top = y + 'px';
            }

            this.x = x;
            this.y = y;

        },



        _start: function (e) {
            var that = this,
                point = hasTouch ? e.touches[0] : e,
                matrix, x, y,
                c1, c2;

            if (!that.enabled) return;

            if (that.options.onBeforeScrollStart) that.options.onBeforeScrollStart.call(that, e);

            if (that.options.useTransition ) that._transitionTime(0);

            that.moved = false;
            that.animating = false;

            that.distX = 0;
            that.distY = 0;
            that.absDistX = 0;
            that.absDistY = 0;
            that.dirX = 0;
            that.dirY = 0;
            that.isStopScrollAction = false;

            if (that.options.momentum) {
                if (that.options.useTransform) {
                    // Very lame general purpose alternative to CSSMatrix
                    matrix = getComputedStyle(that.scroller, null)[transform].replace(/[^0-9\-.,]/g, '').split(',');
                    x = +matrix[4];
                    y = +matrix[5];
                } else {
                    x = +getComputedStyle(that.scroller, null).left.replace(/[^0-9-]/g, '');
                    y = +getComputedStyle(that.scroller, null).top.replace(/[^0-9-]/g, '');
                }

                if (x != that.x || y != that.y) {
                    that.isStopScrollAction = true;
                    if (that.options.useTransition) that._unbind(TRNEND_EV);
                    else cancelFrame(that.aniTime);
                    that.steps = [];
                    that._pos(x, y);
                    if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);
                }
            }



            that.startX = that.x;
            that.startY = that.y;
            that.pointX = point.pageX;
            that.pointY = point.pageY;

            that.startTime = e.timeStamp || Date.now();

            if (that.options.onScrollStart) that.options.onScrollStart.call(that, e);

            that._bind(MOVE_EV, window);
            that._bind(END_EV, window);
            that._bind(CANCEL_EV, window);
        },

        _move: function (e) {
            var that = this,
                point = hasTouch ? e.touches[0] : e,
                deltaX = point.pageX - that.pointX,
                deltaY = point.pageY - that.pointY,
                newX = that.x + deltaX,
                newY = that.y + deltaY,

                timestamp = e.timeStamp || Date.now();

            if (that.options.onBeforeScrollMove) that.options.onBeforeScrollMove.call(that, e);

            that.pointX = point.pageX;
            that.pointY = point.pageY;

            // Slow down if outside of the boundaries
            if (newX > 0 || newX < that.maxScrollX) {
                newX = that.options.bounce ? that.x + (deltaX / 2) : newX >= 0 || that.maxScrollX >= 0 ? 0 : that.maxScrollX;
            }
            if (newY > that.minScrollY || newY < that.maxScrollY) {
                newY = that.options.bounce ? that.y + (deltaY / 2) : newY >= that.minScrollY || that.maxScrollY >= 0 ? that.minScrollY : that.maxScrollY;
            }

            that.distX += deltaX;
            that.distY += deltaY;
            that.absDistX = m.abs(that.distX);
            that.absDistY = m.abs(that.distY);

            if (that.absDistX < 6 && that.absDistY < 6) {
                return;
            }

            // Lock direction
            if (that.options.lockDirection) {
                if (that.absDistX > that.absDistY + 5) {
                    newY = that.y;
                    deltaY = 0;
                } else if (that.absDistY > that.absDistX + 5) {
                    newX = that.x;
                    deltaX = 0;
                }
            }

            that.moved = true;

            // internal for header scroll

            that._beforePos ? that._beforePos(newY, deltaY) && that._pos(newX, newY) : that._pos(newX, newY);

            that.dirX = deltaX > 0 ? -1 : deltaX < 0 ? 1 : 0;
            that.dirY = deltaY > 0 ? -1 : deltaY < 0 ? 1 : 0;

            if (timestamp - that.startTime > 300) {
                that.startTime = timestamp;
                that.startX = that.x;
                that.startY = that.y;
            }

            if (that.options.onScrollMove) that.options.onScrollMove.call(that, e);
        },

        _end: function (e) {
            if (hasTouch && e.touches.length !== 0) return;

            var that = this,
                point = hasTouch ? e.changedTouches[0] : e,
                target, ev,
                momentumX = { dist:0, time:0 },
                momentumY = { dist:0, time:0 },
                duration = (e.timeStamp || Date.now()) - that.startTime,
                newPosX = that.x,
                newPosY = that.y,
                newDuration;


            that._unbind(MOVE_EV, window);
            that._unbind(END_EV, window);
            that._unbind(CANCEL_EV, window);

            if (that.options.onBeforeScrollEnd) that.options.onBeforeScrollEnd.call(that, e);


            if (!that.moved) {

                if (hasTouch && this.options.handleClick && !that.isStopScrollAction) {
                    that.doubleTapTimer = setTimeout(function () {
                        that.doubleTapTimer = null;

                        // Find the last touched element
                        target = point.target;
                        while (target.nodeType != 1) target = target.parentNode;

                        if (target.tagName != 'SELECT' && target.tagName != 'INPUT' && target.tagName != 'TEXTAREA') {
                            ev = doc.createEvent('MouseEvents');
                            ev.initMouseEvent('click', true, true, e.view, 1,
                                point.screenX, point.screenY, point.clientX, point.clientY,
                                e.ctrlKey, e.altKey, e.shiftKey, e.metaKey,
                                0, null);
                            ev._fake = true;
                            target.dispatchEvent(ev);
                        }
                    },  0);
                }


                that._resetPos(400);

                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }

            if (duration < 300 && that.options.momentum) {
                momentumX = newPosX ? that._momentum(newPosX - that.startX, duration, -that.x, that.scrollerW - that.wrapperW + that.x, that.options.bounce ? that.wrapperW : 0) : momentumX;
                momentumY = newPosY ? that._momentum(newPosY - that.startY, duration, -that.y, (that.maxScrollY < 0 ? that.scrollerH - that.wrapperH + that.y - that.minScrollY : 0), that.options.bounce ? that.wrapperH : 0) : momentumY;

                newPosX = that.x + momentumX.dist;
                newPosY = that.y + momentumY.dist;

                if ((that.x > 0 && newPosX > 0) || (that.x < that.maxScrollX && newPosX < that.maxScrollX)) momentumX = { dist:0, time:0 };
                if ((that.y > that.minScrollY && newPosY > that.minScrollY) || (that.y < that.maxScrollY && newPosY < that.maxScrollY)) momentumY = { dist:0, time:0 };
            }

            if (momentumX.dist || momentumY.dist) {
                newDuration = m.max(m.max(momentumX.time, momentumY.time), 10);



                that.scrollTo(m.round(newPosX), m.round(newPosY), newDuration);

                if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
                return;
            }



            that._resetPos(200);
            if (that.options.onTouchEnd) that.options.onTouchEnd.call(that, e);
        },

        _resetPos: function (time) {
            var that = this,
                resetX = that.x >= 0 ? 0 : that.x < that.maxScrollX ? that.maxScrollX : that.x,
                resetY = that.y >= that.minScrollY || that.maxScrollY > 0 ? that.minScrollY : that.y < that.maxScrollY ? that.maxScrollY : that.y;

            if (resetX == that.x && resetY == that.y) {
                if (that.moved) {
                    that.moved = false;
                    if (that.options.onScrollEnd) that.options.onScrollEnd.call(that);		// Execute custom code on scroll end
                    if (that._afterPos) that._afterPos();
                }

                return;
            }

            that.scrollTo(resetX, resetY, time || 0);
        },



        _transitionEnd: function (e) {
            var that = this;

            if (e.target != that.scroller) return;

            that._unbind(TRNEND_EV);

            that._startAni();
        },


        /**
         *
         * Utilities
         *
         */
        _startAni: function () {
            var that = this,
                startX = that.x, startY = that.y,
                startTime = Date.now(),
                step, easeOut,
                animate;

            if (that.animating) return;

            if (!that.steps.length) {
                that._resetPos(400);
                return;
            }

            step = that.steps.shift();

            if (step.x == startX && step.y == startY) step.time = 0;

            that.animating = true;
            that.moved = true;

            if (that.options.useTransition) {
                that._transitionTime(step.time);
                that._pos(step.x, step.y);
                that.animating = false;
                if (step.time) that._bind(TRNEND_EV);
                else that._resetPos(0);
                return;
            }

            animate = function () {
                var now = Date.now(),
                    newX, newY;

                if (now >= startTime + step.time) {
                    that._pos(step.x, step.y);
                    that.animating = false;
                    if (that.options.onAnimationEnd) that.options.onAnimationEnd.call(that);			// Execute custom code on animation end
                    that._startAni();
                    return;
                }

                now = (now - startTime) / step.time - 1;
                easeOut = m.sqrt(1 - now * now);
                newX = (step.x - startX) * easeOut + startX;
                newY = (step.y - startY) * easeOut + startY;
                that._pos(newX, newY);
                if (that.animating) that.aniTime = nextFrame(animate);
            };

            animate();
        },

        _transitionTime: function (time) {
            time += 'ms';
            this.scroller.style[transitionDuration] = time;

        },

        _momentum: function (dist, time, maxDistUpper, maxDistLower, size) {
            var deceleration = 0.0006,
                speed = m.abs(dist) * (this.options.speedScale||1) / time,
                newDist = (speed * speed) / (2 * deceleration),
                newTime = 0, outsideDist = 0;

            // Proportinally reduce speed if we are outside of the boundaries
            if (dist > 0 && newDist > maxDistUpper) {
                outsideDist = size / (6 / (newDist / speed * deceleration));
                maxDistUpper = maxDistUpper + outsideDist;
                speed = speed * maxDistUpper / newDist;
                newDist = maxDistUpper;
            } else if (dist < 0 && newDist > maxDistLower) {
                outsideDist = size / (6 / (newDist / speed * deceleration));
                maxDistLower = maxDistLower + outsideDist;
                speed = speed * maxDistLower / newDist;
                newDist = maxDistLower;
            }

            newDist = newDist * (dist < 0 ? -1 : 1);
            newTime = speed / deceleration;

            return { dist: newDist, time: m.round(newTime) };
        },

        _offset: function (el) {
            var left = -el.offsetLeft,
                top = -el.offsetTop;

            while (el = el.offsetParent) {
                left -= el.offsetLeft;
                top -= el.offsetTop;
            }

            if (el != this.wrapper) {
                left *= this.scale;
                top *= this.scale;
            }

            return { left: left, top: top };
        },



        _bind: function (type, el, bubble) {
            _bindArr.concat([el || this.scroller, type, this]);
            (el || this.scroller).addEventListener(type, this, !!bubble);
        },

        _unbind: function (type, el, bubble) {
            (el || this.scroller).removeEventListener(type, this, !!bubble);
        },


        /**
         *
         * Public methods
         *
         */
        destroy: function () {
            var that = this;

            that.scroller.style[transform] = '';



            // Remove the event listeners
            that._unbind(RESIZE_EV, window);
            that._unbind(START_EV);
            that._unbind(MOVE_EV, window);
            that._unbind(END_EV, window);
            that._unbind(CANCEL_EV, window);



            if (that.options.useTransition) that._unbind(TRNEND_EV);

            if (that.options.checkDOMChanges) clearInterval(that.checkDOMTime);

            if (that.options.onDestroy) that.options.onDestroy.call(that);

            //娓呴櫎鎵€鏈夌粦瀹氱殑浜嬩欢
            for (var i = 0, l = _bindArr.length; i < l;) {
                _bindArr[i].removeEventListener(_bindArr[i + 1], _bindArr[i + 2]);
                _bindArr[i] = null;
                i = i + 3
            }
            _bindArr = [];

            //骞叉帀澶栬竟鐨勫鍣ㄥ唴瀹�
            var div = doc.createElement('div');
            div.appendChild(this.wrapper);
            div.innerHTML = '';
            that.wrapper = that.scroller = div = null;
        },

        refresh: function () {
            var that = this,
                offset;



            that.wrapperW = that.wrapper.clientWidth || 1;
            that.wrapperH = that.wrapper.clientHeight || 1;

            that.minScrollY = -that.options.topOffset || 0;
            that.scrollerW = m.round(that.scroller.offsetWidth * that.scale);
            that.scrollerH = m.round((that.scroller.offsetHeight + that.minScrollY) * that.scale);
            that.maxScrollX = that.wrapperW - that.scrollerW;
            that.maxScrollY = that.wrapperH - that.scrollerH + that.minScrollY;
            that.dirX = 0;
            that.dirY = 0;

            if (that.options.onRefresh) that.options.onRefresh.call(that);

            that.hScroll = that.options.hScroll && that.maxScrollX < 0;
            that.vScroll = that.options.vScroll && (!that.options.bounceLock && !that.hScroll || that.scrollerH > that.wrapperH);


            offset = that._offset(that.wrapper);
            that.wrapperOffsetLeft = -offset.left;
            that.wrapperOffsetTop = -offset.top;


            that.scroller.style[transitionDuration] = '0';
            that._resetPos(400);
        },

        scrollTo: function (x, y, time, relative) {
            var that = this,
                step = x,
                i, l;

            that.stop();

            if (!step.length) step = [{ x: x, y: y, time: time, relative: relative }];

            for (i=0, l=step.length; i<l; i++) {
                if (step[i].relative) { step[i].x = that.x - step[i].x; step[i].y = that.y - step[i].y; }
                that.steps.push({ x: step[i].x, y: step[i].y, time: step[i].time || 0 });
            }

            that._startAni();
        },

        scrollToElement: function (el, time) {
            var that = this, pos;
            el = el.nodeType ? el : that.scroller.querySelector(el);
            if (!el) return;

            pos = that._offset(el);
            pos.left += that.wrapperOffsetLeft;
            pos.top += that.wrapperOffsetTop;

            pos.left = pos.left > 0 ? 0 : pos.left < that.maxScrollX ? that.maxScrollX : pos.left;
            pos.top = pos.top > that.minScrollY ? that.minScrollY : pos.top < that.maxScrollY ? that.maxScrollY : pos.top;
            time = time === undefined ? m.max(m.abs(pos.left)*2, m.abs(pos.top)*2) : time;

            that.scrollTo(pos.left, pos.top, time);
        },

        scrollToPage: function (pageX, pageY, time) {
            var that = this, x, y;

            time = time === undefined ? 400 : time;

            if (that.options.onScrollStart) that.options.onScrollStart.call(that);


            x = -that.wrapperW * pageX;
            y = -that.wrapperH * pageY;
            if (x < that.maxScrollX) x = that.maxScrollX;
            if (y < that.maxScrollY) y = that.maxScrollY;


            that.scrollTo(x, y, time);
        },

        disable: function () {
            this.stop();
            this._resetPos(0);
            this.enabled = false;

            // If disabled after touchstart we make sure that there are no left over events
            this._unbind(MOVE_EV, window);
            this._unbind(END_EV, window);
            this._unbind(CANCEL_EV, window);
        },

        enable: function () {
            this.enabled = true;
        },

        stop: function () {
            if (this.options.useTransition) this._unbind(TRNEND_EV);
            else cancelFrame(this.aniTime);
            this.steps = [];
            this.moved = false;
            this.animating = false;
        },

        isReady: function () {
            return !this.moved &&  !this.animating;
        }
    };

    function prefixStyle (style) {
        if ( vendor === '' ) return style;

        style = style.charAt(0).toUpperCase() + style.substr(1);
        return vendor + style;
    }

    dummyStyle = null;	// for the sake of it

    if (typeof exports !== 'undefined') exports.iScroll = iScroll;
    else window.iScroll = iScroll;

    (function($){
        if(!$)return;
        var orgiScroll = iScroll,
            id = 0,
            cacheInstance = {};
        function createInstance(el,options){
            var uqid = 'iscroll' + id++;
            el.data('_iscroll_',uqid);
            return cacheInstance[uqid] = new orgiScroll(el[0],options)
        }
        window.iScroll = function(el,options){
            return createInstance($(typeof el == 'string' ? '#' + el : el),options)
        };
        $.fn.iScroll = function(method){
            var resultArr = [];
            this.each(function(i,el){
                if(typeof method == 'string'){
                    var instance = cacheInstance[$(el).data('_iscroll_')],pro;
                    if(instance && (pro = instance[method])){
                        var result = $.isFunction(pro) ? pro.apply(instance, Array.prototype.slice.call(arguments,1)) : pro;
                        if(result !== instance && result !== undefined){
                            resultArr.push(result);
                        }
                    }
                }else{
                    if(!$(el).data('_iscroll_'))
                        createInstance($(el),method)
                }
            });

            return resultArr.length ? resultArr : this;
        }
    })(window.Zepto || null)



})(window, document);
/**
 * Change list
 * 淇敼璁板綍
 *
 * 1. 2012-08-14 瑙ｅ喅婊戝姩涓寜浣忓仠姝㈡粴鍔紝鏉惧紑鍚庤鐐瑰厓绱犺Е鍙戠偣鍑讳簨浠躲€�
 *
 * 鍏蜂綋淇敼:
 * a. 202琛� 娣诲姞isStopScrollAction: false 缁檌Scroll鐨勫師鍨嬩笂娣诲姞鍙橀噺
 * b. 365琛� _start鏂规硶閲岄潰娣诲姞that.isStopScrollAction = false; 榛樿璁╄繖涓€间负false
 * c. 390琛� if (x != that.x || y != that.y)鏉′欢璇彞閲岄潰 娣诲姞浜�  that.isStopScrollAction = true; 褰撶洰鏍囧€间笌瀹為檯鍊间笉涓€鑷达紝璇存槑杩樺湪婊氬姩鍔ㄧ敾涓�
 * d. 554琛� that.isStopScrollAction || (that.doubleTapTimer = setTimeout(function () {
 *          ......
 *          ......
 *          }, that.options.zoom ? 250 : 0));
 *   濡傛灉isStopScrollAction涓簍rue灏变笉娲鹃€乧lick浜嬩欢
 *
 *
 * 2. 2012-08-14 缁檕ptions閲岄潰娣诲姞speedScale灞炴€э紝鎻愪緵澶栭儴鎺у埗鍐查噺婊氬姩閫熷害
 *
 * 鍏蜂綋淇敼
 * a. 108琛� 娣诲姞speedScale: 1, 缁檕ptions閲岄潰娣诲姞speedScale灞炴€э紝榛樿涓�1
 * b. 798琛� speed = m.abs(dist) * this.options.speedScale / time, 鍦ㄥ師鏉ラ€熷害鐨勫熀纭€涓�*speedScale鏉ユ敼鍙橀€熷害
 *
 * 3. 2012-08-21 淇敼閮ㄥ垎浠ｇ爜锛岀粰iscroll_plugin澧欑敤鐨�
 *
 * 鍏蜂綋淇敼
 * a. 517琛�  鍦╛pos涔嬪墠锛岃皟鐢╛beforePos,濡傛灉閲岄潰涓嶈繑鍥瀟rue,  灏嗕笉浼氳皟鐢╛pos
 *  // internal for header scroll
 *  if (that._beforePos)
 *      that._beforePos(newY, deltaY) && that._pos(newX, newY);
 *  else
 *      that._pos(newX, newY);
 *
 * b. 680琛� 鍦ㄦ粴鍔ㄧ粨鏉熷悗璋冪敤 _afterPos.
 * // internal for header scroll
 * if (that._afterPos) that._afterPos();
 *
 * c. 106琛屾瀯閫犲櫒閲岄潰娣诲姞浠ヤ笅浠ｇ爜
 * // add var to this for header scroll
 * that.translateZ = translateZ;
 *
 * 涓哄鐞嗘孩鍑�
 * _bind 鏂规硶
 * destroy 鏂规硶
 * 鏈€寮€澶寸殑 _bindArr = []
 *
 */
/**
 * @file GMU瀹氬埗鐗坕scroll锛屽熀浜嶽iScroll 4.2.2](http://cubiq.org/iscroll-4), 鍘婚櫎zoom, pc鍏煎锛宻nap, scrollbar绛夊姛鑳姐€傚悓鏃舵妸iscroll鎵╁睍鍒颁簡Zepto鐨勫師鍨嬩腑銆�
 * @name iScroll
 * @import core/zepto.js
 * @desc GMU瀹氬埗鐗坕scroll锛屽熀浜巤@link[http://cubiq.org/iscroll-4] iScroll 4.2.2}, 鍘婚櫎zoom, pc鍏煎锛宻nap, scrollbar绛夊姛鑳姐€傚悓鏃舵妸iscroll鎵╁睍鍒颁簡***Zepto***鐨勫師鍨嬩腑銆�
 */

/**
 * @name iScroll
 * @grammar new iScroll(el,[options])  鈬� self
 * @grammar $('selecotr').iScroll([options])  鈬� zepto瀹炰緥
 * @desc 灏唅Scroll鍔犲叆鍒颁簡***$.fn***涓紝鏂逛究鐢╖epto鐨勬柟寮忚皟鐢╥Scroll銆�
 * **el**
 * - ***el {String/ElementNode}*** iscroll瀹瑰櫒鑺傜偣
 *
 * **Options**
 * - ***hScroll*** {Boolean}: (鍙€�, 榛樿: true)妯悜鏄惁鍙互婊氬姩
 * - ***vScroll*** {Boolean}: (鍙€�, 榛樿: true)绔栧悜鏄惁鍙互婊氬姩
 * - ***momentum*** {Boolean}: (鍙€�, 榛樿: true)鏄惁甯︽湁婊氬姩鏁堟灉
 * - ***checkDOMChanges*** {Boolean, 榛樿: false}: (鍙€�)姣忎釜500姣鍒ゆ柇涓€涓嬫粴鍔ㄥ尯鍩熺殑瀹瑰櫒鏄惁鏈夋柊杩藉姞鐨勫唴瀹癸紝濡傛灉鏈夊氨璋冪敤refresh閲嶆柊娓叉煋涓€娆�
 * - ***useTransition*** {Boolean, 榛樿: false}: (鍙€�)鏄惁浣跨敤css3鏉ユ潵瀹炵幇鍔ㄧ敾锛岄粯璁ゆ槸false,寤鸿寮€鍚�
 * - ***topOffset*** {Number}: (鍙€�, 榛樿: 0)鍙粴鍔ㄥ尯鍩熷ご閮ㄧ缉绱у灏戦珮搴︼紝榛樿鏄�0锛� ***涓昏鐢ㄤ簬澶撮儴涓嬫媺鍔犺浇鏇村鏃讹紝鏀惰捣澶撮儴鐨勬彁绀烘寜閽�***
 * @example
 * $('div').iscroll().find('selector').atrr({'name':'aaa'}) //淇濇寔閾惧紡璋冪敤
 * $('div').iScroll('refresh');//璋冪敤iScroll鐨勬柟娉�
 * $('div').iScroll('scrollTo', 0, 0, 200);//璋冪敤iScroll鐨勬柟娉�, 200ms鍐呮粴鍔ㄥ埌椤堕儴
 */


/**
 * @name destroy
 * @desc 閿€姣乮Scroll瀹炰緥锛屽湪鍘焛Scroll鐨刣estroy鐨勫熀纭€涓婂鍒涘缓鐨刣om鍏冪礌杩涜浜嗛攢姣�
 * @grammar destroy()  鈬� undefined
 */

/**
 * @name refresh
 * @desc 鏇存柊iScroll瀹炰緥锛屽湪婊氬姩鐨勫唴瀹瑰鍑忔椂锛屾垨鑰呭彲婊氬姩鍖哄煙鍙戠敓鍙樺寲鏃堕渶瑕佽皟鐢�***refresh***鏂规硶鏉ョ籂姝ｃ€�
 * @grammar refresh()  鈬� undefined
 */

/**
 * @name scrollTo
 * @desc 浣縤Scroll瀹炰緥锛屽湪鎸囧畾鏃堕棿鍐呮粴鍔ㄥ埌鎸囧畾鐨勪綅缃紝 濡傛灉relative涓簍rue, 璇存槑x, y鐨勫€兼槸鐩稿涓庡綋鍓嶄綅缃殑銆�
 * @grammar scrollTo(x, y, time, relative)  鈬� undefined
 */
/**
 * @name scrollToElement
 * @desc 婊氬姩鍒版寚瀹氬唴閮ㄥ厓绱 
 * @grammar scrollToElement(element, time)  鈬� undefined
 * @grammar scrollToElement(selector, time)  鈬� undefined
 */
/**
 * @name scrollToPage
 * @desc 璺焥crollTo寰堝儚锛岃繖閲屼紶鍏ョ殑鏄櫨鍒嗘瘮銆�
 * @grammar scrollToPage(pageX, pageY, time)  鈬� undefined
 */
/**
 * @name disable
 * @desc 绂佺敤iScroll
 * @grammar disable()  鈬� undefined
 */
/**
 * @name enable
 * @desc 鍚敤iScroll
 * @grammar enable()  鈬� undefined
 */
/**
 * @name stop
 * @desc 瀹氬埗iscroll婊氬姩
 * @grammar stop()  鈬� undefined
 */

