;(function(window) {

var svgSprite = '<svg>' +
  ''+
    '<symbol id="icon-crown" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M514.592 232.256m-71.488 0a2.234 2.234 0 1 0 142.976 0 2.234 2.234 0 1 0-142.976 0Z"  ></path>'+
      ''+
      '<path d="M64.192 394.688m-53.6 0a1.675 1.675 0 1 0 107.2 0 1.675 1.675 0 1 0-107.2 0Z"  ></path>'+
      ''+
      '<path d="M965.024 341.408c-29.6 0-53.6 24-53.6 53.568 0 23.264 14.88 42.848 35.584 50.272l-216.064 182.976L515.936 307.264l-1.344-3.488L295.936 626.24 82.24 445.92l77.664 362.336 711.008 0 80.576-361.6c4.352 1.152 8.832 1.952 13.536 1.952 29.6 0 53.568-24 53.568-53.6C1018.592 365.408 994.624 341.408 965.024 341.408z"  ></path>'+
      ''+
      '<path d="M159.424 916.256 872.928 916.256 872.928 845.248 159.936 845.248Z"  ></path>'+
      ''+
    '</symbol>'+
  ''+
'</svg>'
var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
var shouldInjectCss = script.getAttribute("data-injectcss")

/**
 * document ready
 */
var ready = function(fn){
  if(document.addEventListener){
      document.addEventListener("DOMContentLoaded",function(){
          document.removeEventListener("DOMContentLoaded",arguments.callee,false)
          fn()
      },false)
  }else if(document.attachEvent){
     IEContentLoaded (window, fn)
  }

  function IEContentLoaded (w, fn) {
      var d = w.document, done = false,
      // only fire once
      init = function () {
          if (!done) {
              done = true
              fn()
          }
      }
      // polling for no errors
      ;(function () {
          try {
              // throws errors until after ondocumentready
              d.documentElement.doScroll('left')
          } catch (e) {
              setTimeout(arguments.callee, 50)
              return
          }
          // no errors, fire

          init()
      })()
      // trying to always fire before onload
      d.onreadystatechange = function() {
          if (d.readyState == 'complete') {
              d.onreadystatechange = null
              init()
          }
      }
  }
}

/**
 * Insert el before target
 *
 * @param {Element} el
 * @param {Element} target
 */

var before = function (el, target) {
  target.parentNode.insertBefore(el, target)
}

/**
 * Prepend el to target
 *
 * @param {Element} el
 * @param {Element} target
 */

var prepend = function (el, target) {
  if (target.firstChild) {
    before(el, target.firstChild)
  } else {
    target.appendChild(el)
  }
}

function appendSvg(){
  var div,svg

  div = document.createElement('div')
  div.innerHTML = svgSprite
  svg = div.getElementsByTagName('svg')[0]
  if (svg) {
    svg.setAttribute('aria-hidden', 'true')
    svg.style.position = 'absolute'
    svg.style.width = 0
    svg.style.height = 0
    svg.style.overflow = 'hidden'
    prepend(svg,document.body)
  }
}

if(shouldInjectCss && !window.__iconfont__svg__cssinject__){
  window.__iconfont__svg__cssinject__ = true
  try{
    document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
  }catch(e){
    console && console.log(e)
  }
}

ready(appendSvg)


})(window)
